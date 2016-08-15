@extends ('_layouts.master')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 ">

			<div class="panel panel-default">
				<div class="panel-heading">Select Year Class, Batch and Shift</div>
				<div class="main panel-body form-inline">

					{!! Form::open(['method' => 'POST', 'target' => '_blank', 'url' => 'successive_class_perfomance_by_class_and_batch', 'class' => 'form-horizontal']) !!}
					<div class="form-group @if($errors->first('year')) has-error @endif">
						{!! Form::label('year', 'Select Year') !!}
						{!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('year') }}</small>
					</div>

					<div class="form-group @if($errors->first('class')) has-error @endif">
						{!! Form::label('class', 'Select Class') !!}
						{!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('class') }}</small>
					</div>

					<div class="form-group @if($errors->first('batch')) has-error @endif">
						{!! Form::label('batch', 'Select Batch') !!}
						{!! Form::select('batch', $batches, null, ['id' => 'batch', 'class' => 'form-control', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('batch') }}</small>
					</div>

					<div class="form-group @if($errors->first('shift')) has-error @endif">
					    {!! Form::label('shift', 'Select Shift') !!}
					    {!! Form::select('shift',$shifts, null, ['id' => 'shift', 'class' => 'form-control', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('shift') }}</small>
					</div>

					<div class="btn-group pull-right">

						{!! Form::submit("Show Progressive Result", ['class' => 'btn btn-success']) !!}
					</div>

					{!! Form::close() !!}

				</div>

			</div>

		</div>
	</div>
</div>


@endsection