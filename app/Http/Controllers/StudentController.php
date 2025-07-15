<?php

namespace App\Http\Controllers;

use App\Models\Student as StudentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class StudentController extends Controller
{
    /* Read */
    public function index(StudentsModel $model)
    {
        return Inertia::render('StudentsDashboard', [
            'studentsData' => $model->all(),
            'count' => $model->count(),
        ]);
    }

    /* Create */
    public function store(Request $request, StudentsModel $model)
    {
        $model->create($request->validate([
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'department' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:students,email',
        ]));

        return back()->with('message', 'Student added successfully');
    }

    /* Update */
    public function update(Request $request, StudentsModel $model, $student_id)
    {
        Log::info('Update request received for student ID: ' . $student_id);
        Log::info('Update request data: ', $request->all());

        $validatedData = $request->validate([
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'department' => 'required|max:255|min:2',
            'email' => 'required|email|max:255',
        ], [
            'email.unique' => 'The email has already been taken.',
        ]);

        $student = $model->findOrFail($student_id);
        $student->update($validatedData);

        return back()->with('message', 'Student updated successfully');
    }

    /* Delete */
    public function destroy(StudentsModel $model, $student_id)
    {
        $student = $model->findOrFail($student_id);
        $student->delete();

        return back()->with('message', 'Student deleted successfully');
    }
}
