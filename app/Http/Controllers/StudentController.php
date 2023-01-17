<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator; // Validator klase, kuri mum prijungia tam tikrus irankius su kurias galime patikrinti duomenis

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
        return view('students.create');
    }

    public function createBulk(Request $request) {

        $student_count = 2;

        if($request->student_count) {
            $student_count = $request->student_count;
        }
        
        $student_count += $request->addStudent;

        if($student_count<2) {
            $student_count = 2;
        }

        return view('students.createBulk', ['student_count' => $student_count]);
    }

    public function createBulkAjax() {
        return view('students.createbulkajax');
    }

    public function storeBulk(Request $request) {
        
       // dd($request->student_name); //masyvu

       // .* - reiskia kad bus daugiau nei vienas elementas tokiu pat vardu
       $request->validate([
            'student_name.*' => 'required|max:11|min:2|alpha',
            'student_surname.*' => 'required|max:64|min:2|alpha',
            'student_email.*' => 'required|email',
            'student_avg_grade.*' => 'required|integer|min:1|max:100'
       ]);

        $students_count = count($request->student_name); //kiek studentu yra - 2

        for($i=0; $i<$students_count; $i++) {
          $student = new Student;
          $student->name = $request->student_name[$i];
            $student->surname = $request->student_surname[$i];
            $student->email = $request->student_email[$i];
            $student->avg_grade = $request->student_avg_grade[$i];
            $student->save();
        }

        //ajax > paprasta forma

        return redirect()->route('students.index')->with('success', 'Students created successfully.');


    }
    // StoreStudentRequest $request - jisai eina per apsaugos failas StoreStudentRequest ajax uzklausa uzblokuos
    // Request $request - tinginio request, neapsaugotas request
    public function storeBulkAjax(Request $request) {


        $validator = Validator::make($request->all(), [
            'student_name.*' => 'required|max:11|min:2|alpha',
            'student_surname.*' => 'required|max:64|min:2|alpha',
            'student_email.*' => 'required|email',
            'student_avg_grade.*' => 'required|integer|min:1|max:100',
        ]); 

        if($validator->fails()) {
            return response()->json(
                array(
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                )
            );

        }
        


        $students_count = count($request->student_name); //kiek studentu yra - 2

        for($i=0; $i<$students_count; $i++) {
          $student = new Student;
          $student->name = $request->student_name[$i];
            $student->surname = $request->student_surname[$i];
            $student->email = $request->student_email[$i];
            $student->avg_grade = $request->student_avg_grade[$i];
            $student->save();
        }

        //ajax > paprasta forma

       return response()->json(['success' => 'Students created successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {

        //Validator klase


        //1. Patikriname duomenis is input lauku
        //2. jei duomenys geri - issaugome duomenis i duomenu baze
        //3. Kitu atveju - graziname atgal i forma su klaidomis


        // student_name - ne ilgensi nei 11 simboliu duombazeje


        //required - privalomas ir ar ne tuscias
        //max:11 - ne ilgesnis nei 11 simboliu
        //min:2 - ne trumpesnis nei 2 simboliai
        //alpha - turi buti tik raides
        //alpha_dash - turi buti tik raides, skaiciai, apatinis bruksnys(_) ir bruksnys(-)
        //alpha_num - turi buti tik raides ir skaiciai
        //email - turi buti tinkamas el. pasto adresas

        //Pirma raide didzioji, likusios mazosios, leidziami simboliai tiktai - Algimantas-Juozas ???????? regex
        // patikrinti ar ivestas skaicius yra LT telefono numeris

        //student_name - privalomas laukas, ar jis ne tuscias, neilgesnis nei 11 simboliu, ir turi buti tiktai raides
        //student_surname - privalomas laukas, ar jis ne tuscias, ne ilgesnis nei 64 simbolius, ir turi buti tiktai raides
        //student_email - privalomas laukas, ar jis ne tuscias, , turi buti tinkamas el. pasto adresas
        //student_avg_grade - privalomas laukas, ar jis ne tuscias, turi buti skaicius nuo 1 iki 100
        
        
        //deprecated, jau nebepatartina

        //$request->validate =  rules() metodas StoreStudentRequest klaseje
    

        //validate(masyva su taisyklemis) - jeigu viskas gerai, po sio metodo vykdomos sekancios eilutes
        //jeigu ne - ties 76 eilute kodas nutruksta 


        $stundent = new Student;
        $stundent->name = $request->student_name;
        $stundent->surname = $request->student_surname;
        $stundent->email = $request->student_email;
        $stundent->avg_grade = $request->student_avg_grade;

        $stundent->save();

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }



    public function storeAjax(Request $request) {


        // Susikuriant savo validatoriu    

        //validate() -metodas. Numatytaji validatoriu

        //jei viskas gerai kodas vyksta toliau
        //jei ne ties 102 eilute nutruksta kodas

        $validator = Validator::make($request->all(), [
            'student_name' => 'required|max:11|min:2|alpha',
            'surname' => 'required|max:64|min:2|alpha',
            'email' => 'required|email',
            'avg_grade' => 'required|integer|min:1|max:100',
        ]); //Validatoriaus objektas

        //$validator->fails() - ar visi musu ivesti duomenis praejo taisykles(false), jeigu nepraejo (true)

        if($validator->fails()) {
            //jei nepraejo taisykles, graziname klaidos masyva

            return response()->json(
                array(
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                )
            );

        }
        


        //koki atsakyma gauna AJAX(javascript)?

        //1. ajax nieko negauna


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

     // Student - PHP klase
     // $student - objektas
    public function edit(Student $student)
    {
        //
    }
    // Javascript
    //Gali nesuprasti Studento klases(PHP kalba)
    //
    public function editAjax(Request $request) {
        $student_id = $request->student_id;
        $student = Student::find($student_id);
        return response()->json($student);
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

    public function updateAjax(Request $request) {

        $student_id = $request->student_id;
        $student = Student::find($student_id);

        $student->name = $request->edit_student_name;
        $student->surname = $request->edit_student_surname;
        $student->email = $request->edit_student_email;
        $student->avg_grade = $request->edit_student_avg_grade;

        $student->save();

        return response()->json(array(
            'student' => $student,
            'success'=> "Student $student_id $student->name $student->surname updated successfully"
        ));

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
