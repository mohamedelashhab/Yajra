<?php

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
        if (!file_exists(public_path('uploads/images'))) {
            mkdir(public_path('uploads/images'), 0777, true);
        }
        $this->call(TasksTableSeeder::class);
    }
}
