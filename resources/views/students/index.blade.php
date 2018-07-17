@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Student's Detail --  {{ $role }} </h2>
        </div>
        <div class="pull-right">
          
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
   @if($role=="admin")
<tr> <h2>   <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Student</a> </h2></tr>
@endif 
 <tr>
   <th>Name</th>
   <th>Cource Id </th>
   <th> DOB </th>
   <th> City  </th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($students as $key => $user)
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->cource_id }}</td>
     <td>{{ $user->dob }}</td>
    <td>{{ $user->city  }}</td>
    @if($role=="admin")
    <td>
       
       <a class="btn btn-primary" href="{{ route('students.edit',$user->id) }}">Edit</a>

 
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
    @else 
    <td> No actions allowed </td>
    @endif
  </tr>
 @endforeach
</table>


{!! $students->render() !!}


@endsection