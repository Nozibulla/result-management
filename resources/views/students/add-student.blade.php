@extends ('_layouts.master')

@section ('title')

<title>Add Student</title>

@endsection

@section ('content')

<div class="main">



	<h1>Add Student</h1>


		<div class="aler alert-success" id="alert" display="none">

			<p>Student Added Successfully</p>

		</div>

	<div class="addstudent col-lg-4">


		{!! Form::open(['url'=>'savestudent', 'data-remote'=>'data-remote','data-remote-success'=>'Student saved successfully']) !!}

		<div class="form-group @if($errors->first('name')) has-error @endif">
			{!! Form::label('name', 'Students Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control name', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('name') }}</small>
		</div>

		<div class="form-group @if($errors->first('class')) has-error @endif">
			{!! Form::label('class', 'Class') !!}
			{!! Form::select('class',$classes, null, ['class' => 'form-control', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('class') }}</small>
		</div>

		<div class="form-group @if($errors->first('roll')) has-error @endif">
			{!! Form::label('roll', 'Roll') !!}
			{!! Form::text('roll', null, ['class' => 'form-control roll', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('roll') }}</small>
		</div>

		<div class="form-group @if($errors->first('shift')) has-error @endif">
			{!! Form::label('shift', 'Shift') !!}
			{!! Form::select('shift', $shifts, null, ['class' => 'form-control', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('shift') }}</small>
		</div>

		<div class="form-group @if($errors->first('batch')) has-error @endif">
			{!! Form::label('batch', 'Batch') !!}
			{!! Form::select('batch', $batches, null, ['class' => 'form-control', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('batch') }}</small>
		</div>

		<div class="form-group @if($errors->first('mobile')) has-error @endif">
		    {!! Form::label('mobile', 'Mobile No.') !!}
		    {!! Form::text('mobile', null, ['class' => 'form-control mobile', 'required' => 'required']) !!}
		    <small class="text-danger">{{ $errors->first('mobile') }}</small>
		</div>

		<div class="form-group @if($errors->first('year')) has-error @endif">
			{!! Form::label('year', 'Year') !!}
			{!! Form::date('year', date('Y'), ['class' => 'form-control', 'required' => 'required']) !!}
			<small class="text-danger">{{ $errors->first('year') }}</small>
		</div>

		{!! Form::submit('Add', ['class' => 'btn btn-info pull-right']) !!}


		{!! Form::close() !!}

	</div>

</div>



@endsection


