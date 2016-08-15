
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Successive Result</title>


	<div class="row">
		<div class="col-md-12 ">

			<div class="panel panel-default">
				<div class="panel-heading"><h2 class="text-center">Progressive Result Year: {{ $year }} of {{ $class }}({{ $batch }})</h2></div>

			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Progressive Class Perfomance</div>
				<div class="main panel-body">

					<div class="book_list">

						<div class="table-responsive">

							<table class="table">

								<tr class="success">

									<td>Name</td>

									<td>Roll</td>

									<td>January</td>

									<td>February</td>

									<td>March</td>

									<td>April</td>

									<td>May</td>

									<td>June</td>

									<td>July</td>

									<td>August</td>

									<td>September</td>

									<td>October</td>

									<td>November</td>

									<td>December</td>

								</tr>

								@foreach($students as $student)

								<tr>

									<td>{{$student->name}}</td>
									<td>{{$student->roll}}</td>
									<td>{{round($january_inpercent[$student->name], 3)}}@if($january_inpercent[$student->name] != '-')% @endif<br>{{$january_grade[$student->name]}} </td>
									<td>{{ round($february_inpercent[$student->name], 3)}}@if($february_inpercent[$student->name] != '-')% @endif<br>{{$february_grade[$student->name]}}</td>
									<td>{{ round($march_inpercent[$student->name], 3)}}@if($march_inpercent[$student->name] != '-')% @endif<br>{{$march_grade[$student->name]}}</td>
									<td>{{ round($april_inpercent[$student->name], 3)}}@if($april_inpercent[$student->name] != '-')% @endif<br>{{$april_grade[$student->name]}}</td>
									<td>{{ round($may_inpercent[$student->name], 3)}}@if($may_inpercent[$student->name] != '-')% @endif<br>{{$may_grade[$student->name]}}</td>
									<td>{{ round($june_inpercent[$student->name], 3)}}@if($june_inpercent[$student->name] != '-')% @endif<br>{{$june_grade[$student->name]}}</td>
									<td>{{ round($july_inpercent[$student->name], 3)}}@if($july_inpercent[$student->name] != '-')% @endif<br>{{$july_grade[$student->name]}}</td>
									<td>{{ round($august_inpercent[$student->name], 3)}}@if($august_inpercent[$student->name] != '-')% @endif<br>{{$august_grade[$student->name]}}</td>
									<td>{{ round($september_inpercent[$student->name], 3)}}@if($september_inpercent[$student->name] != '-')% @endif<br>{{$september_grade[$student->name]}}</td>
									<td>{{ round($october_inpercent[$student->name], 3)}}@if($october_inpercent[$student->name] != '-')% @endif<br>{{$october_grade[$student->name]}}</td>
									<td>{{ round($november_inpercent[$student->name], 3)}}@if($november_inpercent[$student->name] != '-')% @endif<br>{{$november_grade[$student->name]}}</td>
									<td>{{ round($december_inpercent[$student->name], 3)}}@if($december_inpercent[$student->name] != '-')% @endif<br>{{$december_grade[$student->name]}}</td>
								</tr>

								@endforeach

							</div>

						</div>
					</div>

				</div>
			</div>


