<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        User::query()->firstOrCreate([
            'username' => ADMIN_ACCOUNT_FIELDS['username']
        ], array_merge(ADMIN_ACCOUNT_FIELDS, [
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]));
    }
}
