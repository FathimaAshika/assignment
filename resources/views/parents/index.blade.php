@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management {{ $role }} </h2>
        </div>
        <div class="pull-right">
          
        </div>
    </div>
</div>

<div class="row">
<a href="students" class="btn btn-primary" > Students  </a> 
<a href="cources" class="btn btn-primary" > Cources  </a> 
<a href="parents" class="btn btn-primary" > Parents  </a> 
   
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
    
    </td>
    @if($role=="admin")
    <td>
        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

 
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


{!! $data->render() !!}


@endsection