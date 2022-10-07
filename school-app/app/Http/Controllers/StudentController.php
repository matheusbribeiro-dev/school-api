<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return new StudentCollection(Student::paginate(2));
    }

    public function store(StudentRequest $request)
    {
        return response(Student::create($request->all()), 201);
    }

    public function show($id)
    {
        return new StudentResource(Student::findOrFail($id));
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->update($request->all());
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return [];
    }
}
