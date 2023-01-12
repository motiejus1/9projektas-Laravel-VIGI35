@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
        @if($student_count)
            {{$student_count}} 
        @endif  
        students
        </h1>  
        <form method="GET" action="{{route('students.createbulk')}}">
            @csrf
            @if($student_count)
                <input type="hidden" name="student_count" value="{{$student_count}}">
            @endif    
            <button type="submit" name="addStudent" value="1" class="btn btn-primary">+1</button>
            <button type="submit" name="addStudent" value="-1" class="btn btn-danger">-1</button>

        </form> 
        <form method="POST" action="{{ route('students.storebulk') }}">
            @csrf

            @for($i=0; $i<$student_count; $i++)
                <div class="row">
                    <div class="col-3">
                        <label for="name">Name</label>
                        <input type="text" name="student_name[]" class="form-control @error('student_name.'.$i) is-invalid @enderror"
                            placeholder="Name" value="{{ old('student_name.'.$i) }}">
                        @error('student_name.'.$i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="surname">Surname</label>
                        <input type="text" name="student_surname[]"
                            class="form-control @error('student_surname.'.$i) is-invalid @enderror" placeholder="Surname"
                            value="{{ old('student_surname.'.$i) }}">
                        @error('student_surname.'.$i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-3">
                        <label for="email">Email</label>
                        <input type="text" name="student_email[]"
                            class="form-control @error('student_email.'.$i) is-invalid @enderror" placeholder="Email"
                            value="{{ old('student_email.'.$i) }}">

                        @error('student_email.'.$i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="avg_grade">Average grade</label>
                        <input type="text" name="student_avg_grade[]"
                            class="form-control @error('student_avg_grade.'.$i) is-invalid @enderror" placeholder="Average grade"
                            value="{{ old('student_avg_grade.'.$i) }}">
                        @error('student_avg_grade.'.$i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            @endfor    
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
