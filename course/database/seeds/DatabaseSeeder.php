<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Student::class,150)->create();
        // factory(App\Professor::class,100)->create();
        // factory(App\Courses::class,50)->create();
        factory(App\Attends::class,100)->create();
    }
}
