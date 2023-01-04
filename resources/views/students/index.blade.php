@extends('layouts.app')

@section('content')
     
    <div class="container">
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
                <form id="ajaxSearch" data-ajax-action-url="{{route('students.searchAjax')}}">
                    @csrf
                    <input id="search" type="text" name="search" class="form-control" placeholder="Search">
                    <button id="searchBtn" class="btn btn-primary" type="Submit">Search</button>
                </form>
            </div>

            
        </div>
        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Average grade</th>
            </tr>

            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->surname }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->avg_grade }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

{{-- Javascript be biblioteku sunkiai apdoroja AJAX uzklausas --}}
{{-- Jquery - javascript BIBLIOTEKA --}}
{{-- $

!!! integruotis JQUERY biblioteka

    --}}