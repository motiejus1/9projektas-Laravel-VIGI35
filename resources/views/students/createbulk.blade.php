@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('students.storebulk') }}">
            @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="name">Name</label>
                        <input type="text" name="student_name[]" class="form-control @error('student_name') is-invalid @enderror"
                            placeholder="Name" value="{{ old('student_name') }}">
                        @error('student_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="surname">Surname</label>
                        <input type="text" name="student_surname[]"
                            class="form-control @error('student_surname') is-invalid @enderror" placeholder="Surname"
                            value="{{ old('student_surname') }}">
                        @error('student_surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-3">
                        <label for="email">Email</label>
                        <input type="text" name="student_email[]"
                            class="form-control @error('student_email') is-invalid @enderror" placeholder="Email"
                            value="{{ old('student_email') }}">

                        @error('student_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="avg_grade">Average grade</label>
                        <input type="text" name="student_avg_grade[]"
                            class="form-control @error('student_avg_grade') is-invalid @enderror" placeholder="Average grade"
                            value="{{ old('student_avg_grade') }}">
                        @error('student_avg_grade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="name">Name</label>
                        <input type="text" name="student_name[]" class="form-control @error('student_name') is-invalid @enderror"
                            placeholder="Name" value="{{ old('student_name') }}">
                        @error('student_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="surname">Surname</label>
                        <input type="text" name="student_surname[]"
                            class="form-control @error('student_surname') is-invalid @enderror" placeholder="Surname"
                            value="{{ old('student_surname') }}">
                        @error('student_surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-3">
                        <label for="email">Email</label>
                        <input type="text" name="student_email[]"
                            class="form-control @error('student_email') is-invalid @enderror" placeholder="Email"
                            value="{{ old('student_email') }}">

                        @error('student_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="avg_grade">Average grade</label>
                        <input type="text" name="student_avg_grade[]"
                            class="form-control @error('student_avg_grade') is-invalid @enderror" placeholder="Average grade"
                            value="{{ old('student_avg_grade') }}">
                        @error('student_avg_grade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
