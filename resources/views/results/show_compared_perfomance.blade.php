
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Compare Two Month</title>

	<div class="row">

		<div class="col-md-8 col-md-offset-2 ">

			<div class="panel panel-default">

				<div class="panel-heading text-center"><h2>Comparison between {{ $month1 }} and {{ $month2 }} </h2></div>

			</div>			

			<div class="panel panel-default">

				<div class="panel-heading"><strong>Month: {{ $month1 }} | Batch: {{ $batch }} | CLass: {{ $class }}</strong></div>

				<div class="main panel-body">

					<div class="table-responsive">

						<table class="table">

							<tr class="success">

								<td>A++</td>

								<td>A+</td>

								<td>A-</td>

								<td>A</td>

								<td>B</td>

								<td>C</td>

							</tr>
							<tr>
								@foreach($month1_grade_percentage as $grade_percentage)

								<td>{{ round($grade_percentage, 3) }}@if($grade_percentage != '-')% @endif</td>

								@endforeach
							</tr>

						</table>

					</div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading"><strong>Month: {{ $month2 }} | Batch: {{ $batch }} | CLass: {{ $class }}</strong></div>

				<div class="main panel-body">

					<div class="table-responsive">

						<table class="table">

							<tr class="success">

								<td>A++</td>

								<td>A+</td>

								<td>A-</td>

								<td>A</td>

								<td>B</td>

								<td>C</td>

							</tr>
							<tr>
								@foreach($month2_grade_percentage as $grade_percentage)

								<td>{{ round($grade_percentage, 3) }}@if($grade_percentage != '-')% @endif</td>

								@endforeach
							</tr>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>
