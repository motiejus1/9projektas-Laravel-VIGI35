@extends('layouts.app')

@section('content')
     
    <div class="container">


        <div class="alert alert-success d-none" >
        </div>


        @if(isset($search))
            <p>Search results for keyword: {{$search}}</p>
            <a class="btn btn-primary" href="{{route('students.index')}}">Back to all students</a>
        @endif


        
        <div class="row">
            <div class="col-md-4">
                <form method="GET" action="{{route('students.search')}}">
                    @csrf
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="Submit">Search</button>
                </form>
            </div>
            <div class="col-md-4">
                {{-- mes nenorime kad PHP mums kazka darytu --}}
                <div id="ajaxSearch" data-ajax-action-url="{{route('students.searchAjax')}}">
                    @csrf
                    <input id="search" type="text" name="search" class="form-control" placeholder="Search">
                    {{-- <button id="searchBtn" class="btn btn-primary" type="Submit">Search</button> --}}
                </div>
            </div>

            
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentCreateModal">
            Create student AJAX
          </button>

        <a href="{{route('students.create')}}" class="btn btn-primary">Create student</a>
        
        <form method="GET" action="{{route('students.index')}}">
            <select name='sortColumn'>
                <option value="id">Id</option>
                <option value="name">Name</option>
                <option value="surname">Surname</option>
                <option value="email">Email</option>
                <option value="avg_grade">Average grade</option>
            </select> 
            <select name='sortDirection' >
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
            <select name='filter'>
                <option value="50">Positive grades</option> 
            </select>
            <button class="btn btn-primary" type="submit">Sort and filter</button> 
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('name', 'Name')</th>
                    <th>@sortablelink('surname', 'Surname')</th>
                    <th>@sortablelink('email', 'Email')</th>
                    <th>@sortablelink('avg_grade', 'Average Grade')</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="students">
                @foreach ($students as $student)
                    <tr class="student{{$student->id}}">
                        <td class="student_id">{{ $student->id }}</td>
                        <td class="student_name">{{ $student->name }}</td>
                        <td class="student_surname">{{ $student->surname }}</td>
                        <td class="student_email" >{{ $student->email }}</td>
                        <td class="student_avg_grade">{{ $student->avg_grade }}</td>
                        <td>
                            {{-- <form action="{{route('student.destroy', $student)}}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form> --}}

                            <button  
                                class="delete-button btn btn-danger" 
                                data-ajax-action-url="{{route('students.destroyAjax')}}" 
                                data-student-id='{{$student->id}}'>
                                Delete
                            </button>
                            {{-- 
                                
                                editAjax
                                
                                --}}
                            <button
                                class="edit-button btn btn-secondary"
                                data-student-id="{{$student->id}}"
                                data-ajax-action-url="{{route('students.editAjax')}}"
                                data-bs-toggle="modal" data-bs-target="#studentEditModal"
                            >
                                Edit
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- metodas atvaizduoti puslapiavimo numeriukams --}}
        {{-- {{$students->links()}} --}}

    
      
    {{-- {{ $students->appends(['sortColumn' => $sortColumn, 'sortDirection' => $sortDirection, 'filter' => $filter])->links() }} --}}
        {{ $students->appends(\Request::except('page'))->links()}}

    </div>
           

@extends('students.modals')

@endsection

{{-- Javascript be biblioteku sunkiai apdoroja AJAX uzklausas --}}
{{-- Jquery - javascript BIBLIOTEKA --}}
{{-- $

!!! integruotis JQUERY biblioteka

    --}}