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


<table class="table table-bordered">
@if($role=="admin")
<tr> <h2>   <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Cource </a> </h2></tr>
@endif  

 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Year </th>
 
   <th width="280px">Action</th>
 </tr>
 @foreach ($cources as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->year }}</td>
    @if($role=="admin")
    <td>
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


{!! $cources->render() !!}


@endsection