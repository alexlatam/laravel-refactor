<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->times(1)->create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt("admin")
        ]);

        Project::factory()->times(40)->create();
    }
}
