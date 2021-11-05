<?php

namespace App\Http\Services;

use App\Http\Repositories\StudentRepository;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentService
{
    /**
     * @var bool
     */
    private $repository;

    public function __construct()
    {
        $this->repository = app()->make(StudentRepository::class);
    }

    public function getAll(): AnonymousResourceCollection
    {
        return StudentResource::collection($this->repository->all());
    }

    public function create(array $studentData): StudentResource
    {
        return new StudentResource($this->repository->create($studentData));
    }
}
