@extends ('_layouts.master')

@section ('title')

<title>Add Result</title>

@endsection

@section ('content')

<div class="row">

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


		<div class="col-md-12">

			<div class="overlay" id="loading" style="display: none;">

				<div class="load">

					<img  src="images/clock.gif">

				</div>

			</div> 

			<div class="panel panel-default">

				<div class="panel-heading">Select Year Class and Batch Shift</div>

				<div class="main panel-body form-inline text-center">

					<div class="form-group @if($errors->first('year')) has-error @endif">
						{!! Form::label('year', 'Year') !!}
						{!! Form::select('year',$years,null, ['id' => 'select_year_result', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Year']) !!}
						<small class="text-danger">{{ $errors->first('year') }}</small>
					</div>

					<div class="form-group @if($errors->first('class')) has-error @endif">
						{!! Form::label('class', 'Class') !!}
						{!! Form::select('class', $classes, null, ['id' => 'select_class_result', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Class']) !!}
						<small class="text-danger">{{ $errors->first('class') }}</small>
					</div>

					<div class="form-group @if($errors->first('batch')) has-error @endif">
						{!! Form::label('batch', 'Batch') !!}
						{!! Form::select('batch', $batches, null, ['id' => 'select_batch_result', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Batch']) !!}
						<small class="text-danger">{{ $errors->first('batch') }}</small>
					</div>

					<div class="form-group @if($errors->first('shift')) has-error @endif">
						{!! Form::label('shift', 'Shift') !!}
						{!! Form::select('shift',$shifts, null, ['id' => 'select_shift_result', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Shift']) !!}
						<small class="text-danger">{{ $errors->first('shift') }}</small>

					</div>

					<div class="form-group"></div>

					<div class="form-group @if($errors->first('search_result')) has-error @endif">
						{!! Form::label('search_result', 'Search') !!}
						{!! Form::text('search_result', null, ['id' => 'search' ,'class' => 'form-control', 'placeholder' => 'Search Here...']) !!}
						<small class="text-danger">{{ $errors->first('search_result') }}</small>
					</div>

					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body form-inline selected_month_subject">

							<div class="form-group @if($errors->first('month')) has-error @endif">
								{!! Form::label('month', 'Select Month') !!}
								{!! Form::select('month',$month, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('month') }}</small>
							</div>

							<div class="form-group @if($errors->first('subject')) has-error @endif">
								{!! Form::label('subject', 'Select Subject') !!}
								{!! Form::selectRange('subject', 1, 5, ['id' => 'subject', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('subject') }}</small>
							</div>

							<div class="form-group{{ $errors->has('tarikh') ? ' has-error' : '' }}">
								{!! Form::label('tarikh', 'Date') !!}
								{!! Form::selectRange('tarikh', 1, 31, ['id' => 'tarikh', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Pick a date...']) !!}
								<small class="text-danger">{{ $errors->first('tarikh') }}</small>
							</div>
						</div>
					</div>


				</div>

			</div>


			<div class="student_list" id="student_list">


				@if (count($students)>0)

				<div class="table-responsive">

					<table class="table studentTable" id="studentTable">
						<thead>

							<tr class="success">

								<td>SL</td>

								<th>Student Name</th>

								<th>Class</th>

								<th>Roll</th>

								<th>Batch</th>

								<th>Shift</th>

								<th>Year</th>

								<td></td>

							</tr>

						</thead>

						<tbody>

							@foreach ($students as $key => $student)

							<tr class="">

								<td>{{ $key+1 }}</td>

								<td>{{ $student->name }}</td>
								<td>{{ $student->class }}</td>
								<td>{{ $student->roll }}</td>
								<td>{{ $student->batch }}</td>
								<td>{{ $student->shift }}</td>
								<td>{{ $student->year }}</td>

								<td >

									<div class="form-inline save_result">

										{!! Form::open(['url'=>'/save_result','data-remote'=>'data-remote','data-remote-success'=>'Result Added successfully']) !!}

										{!! Form::hidden('student_id', $student->id,['class'=> 'id']) !!}
										{!! Form::hidden('month', 'January',['class'=> 'getmonth']) !!}
										{!! Form::hidden('subject', '1',['class'=> 'getsubject']) !!}
										{!! Form::hidden('tarikh', '1',['class'=> 'gettarikh']) !!}

										{!! Form::text('marks', null, ['class' => 'form-control', 'required' => 'required']) !!}

										{!! Form::submit("Add", ['class' => 'btn btn-primary btnGo']) !!}

										<img class="tik_image" style="display:none" src="images/tik.png" alt="not found">
										
										<img id="load_save" style="display:none" src="images/loading.gif">

										{!! Form::close() !!}



									</div>

								</td>


							</tr>

							@endforeach

						</tbody>

					</table>

				</div>

				@else

				<h5>Sorry No student available yet.</h5>

				@endif

			</div>

		</div>

	</div>

	@endsection

	@section('jsSection')

	@endsection


