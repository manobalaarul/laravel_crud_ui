<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student_add', compact('students'));
    }

    public function add_student(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female,Others',
            'department' => 'required|string',
            'doj' => 'required|date',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'A valid email is required.',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
            'gender.in' => 'The gender must be one of Male, Female, or Other.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['parttime'] = $request->has('parttime') ? 1 : 0;

        Student::create($validatedData);

        return redirect()->route('home')->with('message', 'Student created successfully');
    }

    public function del_student(Request $request)
    {
        $id = $request->query('id');
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return redirect()->route('home')->with('message', 'Student deleted successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Student not found.');
        }
    }

    public function edit_student($id)
    {
        $student = Student::findOrFail($id); // Fetch the student by ID
        return view('student_edit', compact('student'));
    }

    public function update_student(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female,Others',
            'department' => 'required|string',
            'doj' => 'required|date',
        ]);

        // Add part-time data
        $validatedData['parttime'] = $request->has('parttime') ? 1 : 0;

        // Update the student record
        $student = Student::findOrFail($id);
        $student->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('home')->with('message', 'Student updated successfully!');
    }
}
