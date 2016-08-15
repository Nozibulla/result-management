@extends ('_layouts.master')

@section ('content')

<div class="container">

	<div class="row">

		<div class="col-md-12 ">

			<div class="panel panel-default">

				<div class="panel-heading">Select month to show resukt for that month</div>

				<div class="main panel-body col-lg-6 col-lg-offset-3">

				{!! Form::open(['method' => 'POST', 'url' => "show_invivisual_result", 'class' => 'form-horizontal']) !!}

				{!! Form::hidden('id', $student_id, ['class'=> 'id']) !!}

				<div class="form-group @if($errors->first('month')) has-error @endif">
				    {!! Form::label('month', 'Select First Month') !!}
				    {!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
				    <small class="text-danger">{{ $errors->first('month') }}</small>
				</div>

				    <div class="btn-group pull-right">

				        {!! Form::submit("Submit", ['class' => 'btn btn-success']) !!}
				    </div>

				{!! Form::close() !!}

			</div>

		</div>

		</div>
	</div>
</div>


@endsection