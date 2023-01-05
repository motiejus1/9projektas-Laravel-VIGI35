<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }



    public function storeAjax(StoreStudentRequest $request) {

        $student = new Student;
        $student->name = $request->student_name;
        $student->surname = $request->surname;
        $student->email = $request->email;
        $student->avg_grade = $request->avg_grade;

        $student->save();

        //zinute
        //studento informacija
        return response()->json(array(
            'student' => $student,
            'success' => 'Student created successfully'
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
    }

    public function destroyAjax(Request $request) {
        $student_id = $request->student_id;
        $student = Student::find($student_id);
        $student->delete();

        return response()->json(array(
            'success' => "Student $student_id $student->name $student->surname deleted successfully"
        ));

    }

    public function search() {
        //$_GET ir $_POST
        $search = request()->query('search');
        //$students = Student::all(); //visus studentus
        
        //Filtravimo/paieskos uzklausa
        //SELECT * FROM students 
        // WHERE filtravimoStulpelis Filtravimo operatorius 'filtravimo reiksme/raktazodis'
        // OR kitaStulpeli LIKE '%raktazodis%'
        // where('filtravimo stulpelis', 'filtravimo operatorius', 'filtravimo reiksme')
        //
        $students = Student::where('name', 'LIKE', "%$search%")
            ->orWhere('surname', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('avg_grade', 'LIKE', "%$search%")
            ->get();
        return view('students.index', ['students' => $students, 'search'=>$search]);
    }

    public function searchAjax() {
        $search = request()->query('search');
        //$students = Student::all(); //visus studentus
        
        //Filtravimo/paieskos uzklausa
        //SELECT * FROM students 
        // WHERE filtravimoStulpelis Filtravimo operatorius 'filtravimo reiksme/raktazodis'
        // OR kitaStulpeli LIKE '%raktazodis%'
        // where('filtravimo stulpelis', 'filtravimo operatorius', 'filtravimo reiksme')
        //
        $students = Student::where('name', 'LIKE', "%$search%")
            ->orWhere('surname', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('avg_grade', 'LIKE', "%$search%")
            ->get();
       // return response()->json($students);

         return response()->json($students);
    }
}
