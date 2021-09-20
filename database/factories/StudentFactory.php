<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $courses = Course::all();

        return [
            'name' => $this->faker->name(),
            'course_id' => $courses->random()->id
        ];
    }
}
