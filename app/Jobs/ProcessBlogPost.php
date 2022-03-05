<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBlogPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    private array $data;

    /**
     * @var int
     */
    public int $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    final public function handle(): void
    {
        Post::query()->create($this->data);
    }

    /**
     * Handle a job failure.
     *
     * @param Throwable $exception
     * @return void
     */
    final public function failed(Throwable $exception): void
    {
        // Notify user or log data
        Log::error($exception->getMessage(), $exception->getTrace());
    }
}
