@extends ('_layouts.master')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 ">

<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			<h4 class="panel-title">
				Show Position by Class
			</h4>
		</div>
		<div id="collapse1" class="panel-collapse collapse in">
			<div class="panel-body form-inline">
				{!! Form::open(['method' => 'POST', 'target' => '_blank', 'url' => 'show_position_in_class', 'class' => 'form-horizontal']) !!}
				<div class="form-group @if($errors->first('year')) has-error @endif">
				    {!! Form::label('year', 'Select Year') !!}
				    {!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
				    <small class="text-danger">{{ $errors->first('year') }}</small>
				</div>


				<div class="form-group @if($errors->first('month')) has-error @endif">
					{!! Form::label('month', 'Select Month') !!}
					{!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('month') }}</small>
				</div>

				<div class="form-group @if($errors->first('class')) has-error @endif">
					{!! Form::label('class', 'Select Class') !!}
					{!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('class') }}</small>
				</div>

				<div class="btn-group pull-right">

					{!! Form::submit("Show Position", ['class' => 'btn btn-success']) !!}
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading"  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			<h4 class="panel-title">

				Show Position by Shift
			</h4>
		</div>
		<div id="collapse2" class="panel-collapse collapse">
			<div class="panel-body form-inline">
				{!! Form::open(['method' => 'POST', 'target' => '_blank', 'url' => 'show_position_in_shift', 'class' => 'form-horizontal']) !!}

				<div class="form-group @if($errors->first('year')) has-error @endif">
				    {!! Form::label('year', 'Select Year') !!}
				    {!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
				    <small class="text-danger">{{ $errors->first('year') }}</small>
				</div>

				<div class="form-group @if($errors->first('month')) has-error @endif">
					{!! Form::label('month', 'Select Month') !!}
					{!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('month') }}</small>
				</div>

				<div class="form-group @if($errors->first('class')) has-error @endif">
					{!! Form::label('class', 'Select Class') !!}
					{!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('class') }}</small>
				</div>

				<div class="form-group @if($errors->first('shift')) has-error @endif">
					{!! Form::label('shift', 'Select Shift') !!}
					{!! Form::select('shift',$shifts, null, ['id' => 'shift', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('shift') }}</small>
				</div>

				<div class="btn-group pull-right">

					{!! Form::submit("Show Position", ['class' => 'btn btn-success']) !!}
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			<h4 class="panel-title" >

				Show Position by Batch
			</h4>
		</div>
		<div id="collapse3" class="panel-collapse collapse">
			<div class="panel-body form-inline">
				{!! Form::open(['method' => 'POST', 'target' => '_blank', 'url' => 'show_position_in_batch', 'class' => 'form-horizontal']) !!}

				<div class="form-group @if($errors->first('year')) has-error @endif">
				    {!! Form::label('year', 'Select Year') !!}
				    {!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
				    <small class="text-danger">{{ $errors->first('year') }}</small>
				</div>

				<div class="form-group @if($errors->first('month')) has-error @endif">
					{!! Form::label('month', 'Select Month') !!}
					{!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('month') }}</small>
				</div>

				<div class="form-group @if($errors->first('class')) has-error @endif">
					{!! Form::label('class', 'Select Class') !!}
					{!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('class') }}</small>
				</div>

				<div class="form-group @if($errors->first('shift')) has-error @endif">
					{!! Form::label('shift', 'Select Shift') !!}
					{!! Form::select('shift',$shifts, null, ['id' => 'shift', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('shift') }}</small>
				</div>

				<div class="form-group @if($errors->first('batch')) has-error @endif">
					{!! Form::label('batch', 'Select Batch') !!}
					{!! Form::select('batch',$batches, null, ['id' => 'batch', 'class' => 'form-control', 'required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('batch') }}</small>
				</div>

				

				<div class="btn-group pull-right">

					{!! Form::submit("Show Position", ['class' => 'btn btn-success']) !!}
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>

</div>


</div>
</div>
</div>


@endsection