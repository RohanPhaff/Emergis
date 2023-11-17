<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ProgramsSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(RisksSeeder::class);
        $this->call(TasksSeeder::class);
    }
}
