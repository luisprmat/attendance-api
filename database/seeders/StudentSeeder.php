<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = Course::create(['name' => '7A']);
        Student::create([
            'name' => 'Leonel Vargas',
            'course_id' => $course->id
        ]);

        $course = Course::create(['name' => '8B']);
        Student::create([
            'name' => 'Pablo Hernández',
            'course_id' => $course->id
        ]);

        $course = Course::create(['name' => '10A']);
        Student::create([
            'name' => 'Pepito Pérez',
            'course_id' => $course->id
        ]);

        Student::create([
            'name' => 'Carla Betancourt',
            'course_id' => $course->id
        ]);
    }
}
