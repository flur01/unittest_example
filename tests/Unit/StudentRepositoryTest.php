<?php

namespace Tests\Unit;

use App\Http\Repositories\StudentRepository;
use App\Models\Student;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class StudentRepositoryTest extends TestCase
{
    public function testGetAllReturnCorrectData()
    {
        $students = Student::factory()->count(5)->make();
        app()->instance(
            Student::class,
            Mockery::mock(Student::class, function (MockInterface $mock) use ($students) {
                $mock
                    ->shouldReceive('all')
                    ->once()
                    ->andReturn($students);
            })->makePartial()
        );
        $studentRepository = app()->make(StudentRepository::class);
        $this->assertEquals(
            $students,
            $studentRepository->all()
        );
    }

    public function testCreateReturnCorrectData()
    {
        $student = Student::factory()->make();
        app()->instance(
            Student::class,
            Mockery::mock(Student::class, function (MockInterface $mock) use ($student) {
                $mock
                    ->shouldReceive('create')
                    ->once()
                    ->with($student->toArray())
                    ->andReturn($student);
            })->makePartial()
        );
        $studentRepository = app()->make(StudentRepository::class);
        $this->assertEquals(
            $student,
            $studentRepository->create($student->toArray())
        );
    }
}
