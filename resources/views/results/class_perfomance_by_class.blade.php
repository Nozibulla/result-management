    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Class Perfomance</title>
	<div class="row">
		<div class="col-md-12 ">

			<div class="panel panel-default">
				<div class="panel-heading"><h2 class="text-center">Class Perfomance Class:{{ $class }} Year: {{ $year }}</h2></div>

				<div class="panel panel-default">
					<div class="panel-heading">Class Perfomance by Class</div>
					<div class="main panel-body">

						<div class="book_list">

							<div class="table-responsive">

								<table class="table">

									<tr class="success">

										<td>Grade</td>

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

									<tr>

										<td>A++</td>

										<td>{{ round($january_grade_percentage['A++'], 3) }}@if($january_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['A++'], 3) }}@if($february_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['A++'], 3) }}@if($march_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['A++'], 3) }}@if($april_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['A++'], 3) }}@if($may_grade_percentage['A++']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['A++'], 3) }}@if($june_grade_percentage['A++']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['A++'], 3) }}@if($july_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['A++'], 3) }}@if($august_grade_percentage['A++'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['A++'], 3) }}@if($september_grade_percentage['A++']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['A++'], 3) }}@if($october_grade_percentage['A++']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['A++'], 3) }}@if($november_grade_percentage['A++']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['A++'], 3) }}@if($december_grade_percentage['A++']!= '-')% @endif</td>

									</tr>

									<tr>

										<td>A+</td>

										<td>{{ round($january_grade_percentage['A+'], 3) }}@if($january_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['A+'], 3) }}@if($february_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['A+'], 3) }}@if($march_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['A+'], 3) }}@if($april_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['A+'], 3) }}@if($may_grade_percentage['A+']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['A+'], 3) }}@if($june_grade_percentage['A+']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['A+'], 3) }}@if($july_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['A+'], 3) }}@if($august_grade_percentage['A+'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['A+'], 3) }}@if($september_grade_percentage['A+']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['A+'], 3) }}@if($october_grade_percentage['A+']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['A+'], 3) }}@if($november_grade_percentage['A+']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['A+'], 3) }}@if($december_grade_percentage['A+']!= '-')% @endif</td>

									</tr>

									<tr>

										<td>A</td>

										<td>{{ round($january_grade_percentage['A'], 3) }}@if($january_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['A'], 3) }}@if($february_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['A'], 3) }}@if($march_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['A'], 3) }}@if($april_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['A'], 3) }}@if($may_grade_percentage['A']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['A'], 3) }}@if($june_grade_percentage['A']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['A'], 3) }}@if($july_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['A'], 3) }}@if($august_grade_percentage['A'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['A'], 3) }}@if($september_grade_percentage['A']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['A'], 3) }}@if($october_grade_percentage['A']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['A'], 3) }}@if($november_grade_percentage['A']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['A'], 3) }}@if($december_grade_percentage['A']!= '-')% @endif</td>
									</tr>

									<tr>

										<td>A-</td>

										<td>{{ round($january_grade_percentage['A-'], 3) }}@if($january_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['A-'] , 3)}}@if($february_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['A-'] , 3)}}@if($march_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['A-'], 3) }}@if($april_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['A-'], 3) }}@if($may_grade_percentage['A-']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['A-'], 3) }}@if($june_grade_percentage['A-']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['A-'] , 3)}}@if($july_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['A-'], 3) }}@if($august_grade_percentage['A-'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['A-'], 3) }}@if($september_grade_percentage['A-']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['A-'], 3) }}@if($october_grade_percentage['A-']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['A-'] , 3)}}@if($november_grade_percentage['A-']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['A-'], 3) }}@if($december_grade_percentage['A-']!= '-')% @endif</td>
									</tr>

									

									<tr>

										<td>B</td>

										<td>{{ round($january_grade_percentage['B'], 3) }}@if($january_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['B'], 3) }}@if($february_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['B'] , 3)}}@if($march_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['B'], 3) }}@if($april_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['B'], 3) }}@if($may_grade_percentage['B']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['B'], 3) }}@if($june_grade_percentage['B']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['B'] , 3)}}@if($july_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['B'] , 3)}}@if($august_grade_percentage['B'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['B'], 3) }}@if($september_grade_percentage['B']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['B'] , 3)}}@if($october_grade_percentage['B']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['B'] , 3)}}@if($november_grade_percentage['B']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['B'], 3) }}@if($december_grade_percentage['B']!= '-')% @endif</td>
									</tr>

									<tr>

										<td>C</td>

										<td>{{ round($january_grade_percentage['C'], 3) }}@if($january_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($february_grade_percentage['C'], 3) }}@if($february_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($march_grade_percentage['C'], 3) }}@if($march_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($april_grade_percentage['C'], 3) }}@if($april_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($may_grade_percentage['C'] , 3)}}@if($may_grade_percentage['C']!= '-')% @endif</td>

										<td>{{ round($june_grade_percentage['C'] , 3)}}@if($june_grade_percentage['C']!= '-')% @endif</td>

										<td>{{ round($july_grade_percentage['C'] , 3)}}@if($july_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($august_grade_percentage['C'], 3) }}@if($august_grade_percentage['C'] != '-')% @endif</td>

										<td>{{ round($september_grade_percentage['C'], 3) }}@if($september_grade_percentage['C']!= '-')% @endif</td>

										<td>{{ round($october_grade_percentage['C'], 3) }}@if($october_grade_percentage['C']!= '-')% @endif</td>

										<td>{{ round($november_grade_percentage['C'] , 3)}}@if($november_grade_percentage['C']!= '-')% @endif</td>

										<td>{{ round($december_grade_percentage['C'] , 3)}}@if($december_grade_percentage['C']!= '-')% @endif</td>
									</tr>


								</div>

							</div>
						</div>

					</div>

				</div>
			</div>
