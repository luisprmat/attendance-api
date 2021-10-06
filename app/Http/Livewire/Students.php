<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    public $openCreate = false, $openEdit = false;

    public $search = '';

    public $name = '', $course_id = '';

    public $courses, $student;

    protected $rules = [
        'student.name' => ['required', 'min:3'],
        'student.course_id' => ['required', 'exists:courses,id']
    ];

    public function mount()
    {
        $this->student = new Student;

        $this->courses = Course::orderBy('name')
            ->pluck('name','id')
            ->prepend('Curso', '');
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'course_id' => ['required', 'exists:courses,id']
        ];

        $this->validate($rules);

        Student::create([
            'name' => $this->name,
            'course_id' => $this->course_id
        ]);

        $this->reset(['openCreate', 'name', 'course_id']);
        $this->render();
    }

    public function edit(Student $student)
    {
        $this->student = $student;
        $this->resetValidation();
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->student->save();

        $this->reset(['openEdit']);
        $this->student = new Student;

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
