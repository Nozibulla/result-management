<!-- Modal for editing an existing subject -->

<div class="modal fade" id="deleteResult" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="deleteResultLabel">Are you sure to delete result?</h4>

				</div>

				<div class="fetch_result_to_be_deleted">

				{!! Form::open(['url'=>'/deleteresult','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}

				<div class="modal-body">

					{!! Form::hidden('id', null,['class'=> 'id']) !!}
					{!! Form::hidden('month', null,['class'=> 'month']) !!}
					{!! Form::hidden('subject', null,['class'=> 'subject']) !!}

					<div class="form-group @if($errors->first('tarikh')) has-error @endif">
					    {!! Form::label('tarikh', 'Date') !!}
					    {!! Form::text('tarikh', null, ['class' => 'form-control tarikh', 'required' => 'required','placeholder' => 'Enter Date from 1 to 31 in which you want to delete result']) !!}
					    <small class="text-danger">{{ $errors->first('tarikh') }}</small>
					</div>

				</div>

				<div class="modal-footer">

					{!! Form::submit("Cancel", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}

					{!! Form::submit("Delete", ['class' => 'btn btn-primary btnGo']) !!}

				</div>

				{!! Form::close() !!}

				</div>

			</div>

		</div>

	</div>