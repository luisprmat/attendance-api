<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    public $open = false;

    public $search = '';

    public $name = '', $course_id = '';

    public $courses;

    protected $rules = [
        'name' => ['required', 'min:3'],
        'course_id' => ['required', 'exists:courses,id']
    ];

    public function mount()
    {
        $this->courses = Course::orderBy('name')
            ->pluck('name','id')
            ->prepend('Curso', '');
    }

    public function save()
    {
        $this->validate();

        Student::create([
            'name' => $this->name,
            'course_id' => $this->course_id
        ]);

        $this->reset(['open', 'name', 'course_id']);
        $this->render();
    }

    public function render()
    {
        $students = Student::with('course')
            ->where('name', 'LIKE', "%{$this->search}%")
            ->orderBy('course_id')
            ->get();

        return view('livewire.students', compact('students'));
    }
}
