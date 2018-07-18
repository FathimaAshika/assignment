@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit  Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($student, ['method' => 'PATCH','route' => ['students.update', $student->id]]) !!}
<div class="row">
   <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>DOB : </strong>
            {!! Form::date('dob', null, array('placeholder' => 'Date of birth ','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>City :</strong>
            {!! Form::text('city',null, array('placeholder' => 'City ','class' => 'form-control')) !!}
        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select class="form-control" name ="cource_id">
                <option value="0"> Select a cource </option>
                @foreach($cources as $c)
                  <option value="{{$c->id }}"> {{ $c->name}} </option>
                @endforeach 
            </select>
        </div>
    </div>
   <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select class="form-control" name ="parent_id">
                <option value="0"> Select a Parent  </option>
                @foreach($parents as $p)
                  <option value="{{$p->id }}"> {{ $p->name}} </option>
                @endforeach 
            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</div>
{!! Form::close() !!}


@endsection