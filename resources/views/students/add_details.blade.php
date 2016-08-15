@extends ('_layouts.master')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 col-lg-offset-3 ">

			<div class="panel-group" id="accordion">
				<div class="panel panel-primary">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
						<h4 class="panel-title text-center">
							Add Subject
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body form-inline text-center add_subject">
							{!! Form::open(['method' => 'POST', 'url' => 'save_subject', 'data-remote'=>'data-remote','data-remote-success'=>'Done', 'class' => 'form-horizontal']) !!}

							<div class="form-group @if($errors->first('name')) has-error @endif">
								{!! Form::label('name', 'Subject Name') !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="btn-group pull-right">

								{!! Form::submit("Save", ['class' => 'btn btn-primary']) !!}
							</div>

							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
						<h4 class="panel-title text-center">

							Add Class
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body form-inline text-center add_class">
							{!! Form::open(['method' => 'POST', 'url' => 'save_class', 'data-remote'=>'data-remote','data-remote-success'=>'Done', 'class' => 'form-horizontal']) !!}

							<div class="form-group @if($errors->first('name')) has-error @endif">
								{!! Form::label('name', 'Class Name') !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="btn-group pull-right">

								{!! Form::submit("Save", ['class' => 'btn btn-primary']) !!}
							</div>

							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
						<h4 class="panel-title text-center" >

							Add Batch
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body form-inline text-center add_batch">
							{!! Form::open(['method' => 'POST', 'url' => 'save_batch', 'data-remote'=>'data-remote','data-remote-success'=>'Done', 'class' => 'form-horizontal']) !!}

							<div class="form-group @if($errors->first('name')) has-error @endif">
								{!! Form::label('name', 'Batch Name') !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="btn-group pull-right">

								{!! Form::submit("Save", ['class' => 'btn btn-primary']) !!}
							</div>

							{!! Form::close() !!}
						</div>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						<h4 class="panel-title text-center" >

							Add Shift
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body form-inline text-center add_shift">
							{!! Form::open(['method' => 'POST', 'url' => 'save_shift', 'data-remote'=>'data-remote','data-remote-success'=>'Done', 'class' => 'form-horizontal']) !!}

							<div class="form-group @if($errors->first('name')) has-error @endif">
								{!! Form::label('name', 'Shift Name') !!}
								{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="btn-group pull-right">

								{!! Form::submit("Save", ['class' => 'btn btn-primary']) !!}
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