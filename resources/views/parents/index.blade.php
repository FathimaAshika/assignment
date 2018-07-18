@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Parents  Management - {{ $role }} </h2>
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
<tr> <h2>   <a class="btn btn-success" href="{{ route('parents.create') }}"> Create New Parent  </a> </h2></tr>
@endif 
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>DOB</th>
   <th>Type</th>

   <th width="280px">Action</th>
 </tr>
 @foreach ($parents as $p)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $p->name }}</td>
    <td>{{ $p->dob }}</td>
        <td>{{ $p->type  }}</td>
  
    @if($role=="admin")
    <td>
       
       <a class="btn btn-primary" href="{{ route('parents.edit',$p->id) }}">Edit</a>

 
        {!! Form::open(['method' => 'DELETE','route' => ['parents.destroy', $p->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
    @else 
    <td> No actions allowed </td>
    @endif
  </tr>
 @endforeach
</table>


{!! $parents->render() !!}


@endsection