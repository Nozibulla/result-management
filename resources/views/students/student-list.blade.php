@extends ('_layouts.master')

@section ('title')

<title>Student List</title>

@endsection

@section ('content')

<div class="row">

	@include('modals.editStudent')

	@include('modals.addResultModal')

	<div class="col-md-12">

	<div class="overlay" id="loading" style="display: none;">

	<div class="load">

		<img  src="images/clock.gif">
		
	</div>
		
	</div> 

		<div class="panel panel-default">

			<div class="panel-heading">Select Year Class and Batch Shift</div>

			<div class="main panel-body form-inline">

				<div class="form-group @if($errors->first('year')) has-error @endif">
					{!! Form::label('year', 'Year') !!}
					{!! Form::select('year',$years,null, ['id' => 'select_year', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Year']) !!}
					<small class="text-danger">{{ $errors->first('year') }}</small>
				</div>

				<div class="form-group @if($errors->first('class')) has-error @endif">
					{!! Form::label('class', 'Class') !!}
					{!! Form::select('class', $classes, null, ['id' => 'select_class', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Class']) !!}
					<small class="text-danger">{{ $errors->first('class') }}</small>
				</div>

				<div class="form-group @if($errors->first('batch')) has-error @endif">
					{!! Form::label('batch', 'Batch') !!}
					{!! Form::select('batch', $batches, null, ['id' => 'select_batch', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Batch']) !!}
					<small class="text-danger">{{ $errors->first('batch') }}</small>
				</div>

				<div class="form-group @if($errors->first('shift')) has-error @endif">
					{!! Form::label('shift', 'Shift') !!}
					{!! Form::select('shift',$shifts, null, ['id' => 'select_shift', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Shift']) !!}
					<small class="text-danger">{{ $errors->first('shift') }}</small>

				</div>

				<div class="form-group"></div>

				<div class="form-group @if($errors->first('search_result')) has-error @endif">
					{!! Form::label('search_result', 'Search') !!}
					{!! Form::text('search_result', null, ['id' => 'search' ,'class' => 'form-control', 'placeholder' => 'Search Here...']) !!}
					<small class="text-danger">{{ $errors->first('search_result') }}</small>
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

							<td></td>

							<td></td>

						</tr>

					</thead>

					<tbody>

						@foreach ($students as $key => $student)

						<tr>

							<td>{{ $key+1 }}</td>

							<td>{{ $student->name }}</td>
							<td>{{ $student->class }}</td>
							<td>{{ $student->roll }}</td>
							<td>{{ $student->batch }}</td>
							<td>{{ $student->shift }}</td>
							<td>{{ $student->year }}</td>

							<td >

								<a target="_blank" href="show_invivisual_result/{{ $student->id }}" class="showresult" data-id="{{ $student->id }}">Show Result</a>

							</td>

							<td >

								<a href="#" class="editClass" data-id="{{ $student->id }}">Edit</a>

							</td>

							<td >

								<a href="#" class="deleteClass" data-id="{{ $student->id }}">Delete</a>

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



