<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

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
        //
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
        return response()->json($students);

        // return response()->json($search);
    }
}
