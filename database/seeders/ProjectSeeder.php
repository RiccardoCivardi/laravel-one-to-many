<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 100; $i++){
            $new_project = new Project();
            $new_project->name = $faker->sentence(5);
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->client_name = $faker->sentence(5);
            $new_project->summary = $faker->paragraph(5);
            // $new_project->cover_image = 'https://www.newgroove.it/wp-content/uploads/woocommerce-placeholder-1024x1024.png';

            // dd($new_project);

            $new_project->save();
        }

    }
}
