@extends('layouts.app')

@section('content')
    <div class="container">


        <button type="submit" class="addStudentCount btn btn-primary" value="1" class="btn btn-primary">+</button>

        <div class="studentsCreateTable">
            <div class="row">
                <div class="col-3">
                    <label for="name">Name</label>
                    <input type="text" name="student_name[]" class="form-control" placeholder="Name">
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <div class="col-3">
                    <label for="surname">Surname</label>
                    <input type="text" name="student_surname[]" class="form-control" placeholder="Surname">

                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>

                <div class="col-3">
                    <label for="email">Email</label>
                    <input type="text" name="student_email[]" class="form-control " placeholder="Email">


                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>
                <div class="col-3">
                    <label for="avg_grade">Average grade</label>
                    <input type="text" name="student_avg_grade[]" class="form-control" placeholder="Average grade">
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>
            </div>
        </div>
        <button class="btn btn-primary saveAllStudents" data-ajax-action-url='{{ route('students.storebulkajax') }}'>Save
            all</button>




        <div class="studentTemplate d-none">
            <div class="hidden row">
                <div class="col-3">
                    <label for="name">Name</label>
                    <input type="text" name="student_name[]" class="form-control" placeholder="Name">
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <div class="col-3">
                    <label for="surname">Surname</label>
                    <input type="text" name="student_surname[]" class="form-control" placeholder="Surname">

                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>

                <div class="col-3">
                    <label for="email">Email</label>
                    <input type="text" name="student_email[]" class="form-control " placeholder="Email">


                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>
                <div class="col-2">
                    <label for="avg_grade">Average grade</label>
                    <input type="text" name="student_avg_grade[]" class="form-control" placeholder="Average grade">
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>

                </div>
                <div class="col-1">
                    <button type="submit" class="minusStudentCount btn btn-danger" value="-1"
                        class="btn btn-primary">-</button>
                </div>
            </div>
        </div>

    </div>
@endsection
