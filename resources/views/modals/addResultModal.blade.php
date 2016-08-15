<!-- Modal for editing an existing subject -->

<div class="modal fade" id="addResult" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="editStudentLabel"> Add Result</h4>

					<p class="student_details"></p>


				</div>

				<?php $month = array(
	'January' => 'January',
	'February' => 'February',
	'March' => 'March',
	'April' => 'April',
	'May' => 'May',
	'June' => 'June',
	'July' => 'July',
	'August' => 'August',
	'September' => 'September',
	'October' => 'October',
	'November' => 'November',
	'December' => 'December')?>



				<div class="add_result">

				{!! Form::open(['url'=>'/add-result','data-remote'=>'data-remote','data-remote-success'=>'Result Added successfully']) !!}

				<div class="modal-body">

					{!! Form::hidden('student_id', null,['class'=> 'id']) !!}

					<div class="form-group @if($errors->first('month')) has-error @endif">
					    {!! Form::label('month', 'Month') !!}
					    {!! Form::select('month', $month, null, ['class' => 'form-control getmonth', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('month') }}</small>
					</div>

					<div class="form-group @if($errors->first('subject')) has-error @endif">
					    {!! Form::label('subject', 'Subject') !!}
					    {!! Form::select('subject', $subjects, null, ['class' => 'form-control getsubject', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('subject') }}</small>
					</div>


					<div class="form-group @if($errors->first('tarikh')) has-error @endif">
					    {!! Form::label('tarikh', 'Date') !!}
					    {!! Form::text('tarikh', 1, ['class' => 'form-control gettarikh', 'required' => 'required','placeholder' => 'Enter Date from 1 to 31']) !!}
					    <small class="text-danger">{{ $errors->first('tarikh') }}</small>
					</div>

					<div class="form-group @if($errors->first('marks')) has-error @endif">
					    {!! Form::label('marks', 'Marks') !!}
					    {!! Form::text('marks', null, ['class' => 'form-control', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('marks') }}</small>
					</div>
				<div class="modal-footer">

					{!! Form::submit("Cancel", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}

					{!! Form::submit("Add Result", ['class' => 'btn btn-primary btnGo']) !!}

				</div>

				{!! Form::close() !!}

				</div>

			</div>

		</div>

	</div>
	</div>