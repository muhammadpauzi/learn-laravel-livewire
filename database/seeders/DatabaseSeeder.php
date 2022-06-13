<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->hasComments(10)->has->create([
        //     'name' => 'Muhammad Pauzi',
        //     'email' => 'pauzi@example.com',
        // ]);

        \App\Models\SupportTicket::factory(3)->create();
    }
}
