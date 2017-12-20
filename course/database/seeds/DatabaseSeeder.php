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
        // factory(App\Courses::class,300)->create();
        // factory(App\Attends::class,500)->create();
        // factory(App\Admin::class,20)->create();
        // factory(App\Branch::class,20)->create();
        // factory(App\Comment::class,500)->create();
        // factory(App\Employee::class,30)->create();
        // factory(App\Room::class,100)->create();
        $faker = Faker\Factory::create();
        // for ($i = 0; $i < 100; $i++) {
        //     DB::table('rooms')->insert([ //,
        //         'number' => $i+1,
        //         'availability' => $faker->numberBetween(0,1),
        //         'AC' => $faker->numberBetween(0,1),
        //         'projector' => $faker->numberBetween(0,1),
        //         'capacity' => $faker->numberBetween(10,200),
        //         'branch_code' => $faker->numberBetween(1,20),
        //     ]);
        // }

        // for ($i = 0; $i < 200; $i++) {
        //     $number = $faker->numberBetween(1,28);
        //     $hours = $faker->numberBetween(0,22);
        //     $minutes = $faker->numberBetween(0,59);
        //     DB::table('timetables')->insert([ //,
        //         'room_number' => $faker->numberBetween(0, 100),
        //         'course_code' => $faker->numberBetween(1,500),
        //         'start_date' => '2017-12-' . $number . ' ' . $hours . ':' . $minutes . ':' . '00',
        //         'end_date' => '2017-12-' . $number . ' ' . strval(intval($hours) + 1) . ':' . $minutes . ':' . '00',
        //         'branch_code' => $faker->numberBetween(1,20),
        //     ]);
        // }
    }
}
