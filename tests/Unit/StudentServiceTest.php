<?php

namespace Tests\Unit;

use App\Http\Repositories\StudentRepository;
use App\Http\Resources\StudentResource;
use App\Http\Services\StudentService;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    public function testGetAllReturnCorrectData()
    {
        $students = Student::factory()->count(5)->make();
        $studentCollection = Collection::make($students);
        app()->instance(
            StudentRepository::class,
            Mockery::mock(StudentRepository::class, function (MockInterface $mock) use ($studentCollection){
                $mock
                    ->shouldReceive('all')
                    ->once()
                    ->andReturn($studentCollection);
            })->makePartial()
        );
        $studentService = app()->make(StudentService::class);
        $this->assertEquals(
            StudentResource::collection($studentCollection),
            $studentService->getAll()
        );
    }

    public function testCreateReturnCorrectData()
    {
        $student = Student::factory()->make();
        app()->instance(
            StudentRepository::class,
            Mockery::mock(StudentRepository::class, function (MockInterface $mock) use ($student){
                $mock
                    ->shouldReceive('create')
                    ->once()
                    ->with($student->toArray())
                    ->andReturn($student);
            })->makePartial()
        );
        $studentService = app()->make(StudentService::class);
        $this->assertEquals(
            new StudentResource($student),
            $studentService->create($student->toArray())
        );
    }
}
