@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as  {{ $role }} ! 
                </div>

                <div class="row">
<a href="students" class="btn btn-primary" > Students  </a> 
<a href="cources" class="btn btn-primary" > Cources  </a> 
<a href="parents" class="btn btn-primary" > Parents  </a> 
   
</div>

<table class="table table-striped ">
    <tr>
        <h4>Students older than 18  </h4>
    </tr>
    <tr>
        <th> ID </th>
        <th> Name </th>
    </tr>
    <tbody>
        
    
    @foreach($studentsOlderthan18  as $s )
    @if($s->id)
    <tr>
        <td>{{ $s->id  }} </td>
        <td>  {{ $s->name }} </td>
    </tr>
    @else
     <tr>
       <h2>No data  </h2>
    </tr>

    @endif

    @endforeach 
    </tbody>
 
</table>

<br><br>


<table class="table table-striped ">
    <tr>
       <h4>Students who are older than 16 and their parnets older than 50   </h4>
    </tr>
    <tr>
        <th> ID </th>
        <th> Name </th>
    </tr>
    <tbody>
        
    
    @foreach($parent50Student16  as $s )
    @if($s->id)
    <tr>
        <td>{{ $s->id  }} </td>
        <td>  {{ $s->name }} </td>
    </tr>
    @else
     <tr>
       <h2>No data  </h2>
    </tr>

    @endif

    @endforeach 
    </tbody>
 
</table>
<br><br>






<table class="table table-striped ">
    <tr>
      <h4>  Students who are in class 8 in 2010  studentsInClassYear  </h4>
    </tr>
    <tr>
        <th> ID </th>
        <th> Name </th>
    </tr>
    <tbody>
        
    
    @foreach($studentsInClassYear  as $s )
    @if($s->id)
    <tr>
        <td>{{ $s->id  }} </td>
        <td>  {{ $s->name }} </td>
    </tr>
    @else
     <tr>
       <h2>No data  </h2>
    </tr>

    @endif

    @endforeach 
    </tbody>
 
</table>

<br><br>

<table class="table table-striped ">
    <tr>
     <h4> Particular  Student's class and Parent </h4>

    </tr>
    <tr>
        <th> Class  </th>
        <th> Parent  </th>
    </tr>
    <tbody>
        
    
   
    @if($getClassandParent)
    <tr>
        <td>{{ $getClassandParent['class']  }} </td>
        <td>  {{ $getClassandParent['parentName']  }} </td>
    </tr>
    @else
     <tr>
       <h2>No data  </h2>
    </tr>

    @endif
    </tbody>
 
</table>
<br><br>


            </div>
        </div>
    </div>
</div>
@endsection
