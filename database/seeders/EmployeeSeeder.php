<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $positions = ['Manager', 'Developer', 'Designer'];

        for ($i = 0; $i < 50; $i++) {
            Employee::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'position' => $faker->randomElement($positions),
                'join_date' => $faker->dateTimeBetween('-5 years', 'now'),
                'salary' => $faker->numberBetween(3000000, 15000000),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}