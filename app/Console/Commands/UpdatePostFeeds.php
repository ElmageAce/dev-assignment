<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdatePostFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This saves the new posts from an external API to the application database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    final public function handle(): int
    {
        try {
            $response = Http::acceptJson()->get( (string) config('services.feed.endpoint') );

            if( $response->failed() ){
                Log::error('There was an error fetching posts from feed server', $response->json());
                return 1;
            }

            DB::disableQueryLog();

            $posts = $response->json('data');

            DB::transaction(function() use ($posts){
                $admin = User::query()
                    ->select(['id'])
                    ->where('username', ADMIN_ACCOUNT_FIELDS['username'])
                    ->first();

                foreach ($posts as $post){
                    DB::table('posts')->insert(array_merge($post, [
                        'user_id' => $admin->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'slug' => slugger($post['title'], uniqid())
                    ]));
                }
            });

            $this->info(count($posts) . ' posts from the feed server has been added to the database');

        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return 2;
        }

        return 0;
    }
}
