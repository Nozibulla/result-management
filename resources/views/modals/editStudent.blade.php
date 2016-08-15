<!-- Modal for editing an existing subject -->

<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="editStudentLabel"> Edit Student</h4>

				</div>

				<div class="edit_student">

				{!! Form::open(['url'=>'/save-edited-student','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}

				<div class="modal-body">

					{!! Form::hidden('id', null,['class'=> 'id']) !!}

					<div class="form-group @if($errors->first('name')) has-error @endif">
						{!! Form::label('name', 'Students Name') !!}
						{!! Form::text('name', null, ['class' => 'form-control name', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('name') }}</small>
					</div>

					<div class="form-group @if($errors->first('class')) has-error @endif">
						{!! Form::label('class', 'Class') !!}
						{!! Form::select('class', $classes, null, ['class' => 'form-control class', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('class') }}</small>
					</div>

					<div class="form-group @if($errors->first('roll')) has-error @endif">
						{!! Form::label('roll', 'Roll') !!}
						{!! Form::text('roll', null, ['class' => 'form-control roll', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('roll') }}</small>
					</div>

					<div class="form-group @if($errors->first('batch')) has-error @endif">
						{!! Form::label('batch', 'Batch') !!}
						{!! Form::select('batch', $batches, null, ['class' => 'form-control batch', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('batch') }}</small>
					</div>

					<div class="form-group @if($errors->first('shift')) has-error @endif">
						{!! Form::label('shift', 'Shift') !!}
						{!! Form::select('shift', $shifts, null, ['class' => 'form-control shift', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('shift') }}</small>
					</div>

					<div class="form-group @if($errors->first('mobile')) has-error @endif">
					    {!! Form::label('mobile', 'Mobile No.') !!}
					    {!! Form::text('mobile', null, ['class' => 'form-control mobile', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('mobile') }}</small>
					</div>

					<div class="form-group @if($errors->first('year')) has-error @endif">
						{!! Form::label('year', 'Year') !!}
						{!! Form::date('year', date('Y'), ['class' => 'form-control year', 'required' => 'required']) !!}
						<small class="text-danger">{{ $errors->first('year') }}</small>
					</div>

				</div>

				<div class="modal-footer">

					{!! Form::submit("Cancel", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}

					{!! Form::submit("Save Changes", ['class' => 'btn btn-primary btnGo']) !!}

				</div>

				{!! Form::close() !!}

				</div>

			</div>

		</div>

	</div>