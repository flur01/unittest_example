<?php

namespace App\Http\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository
{
    /**
     * @var Student
     */
    private $model;

    public function __construct()
    {
        $this->model = app()->make(Student::class);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $studentData): Student
    {
        return $this->model->create($studentData);
    }
}
