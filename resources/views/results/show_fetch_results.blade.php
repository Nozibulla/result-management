    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Result</title>

<div class="student_info">

	@foreach ($results as $result)

		<h3>
		<div class="text-center">

			<strong>Name: </strong>{{ $result->name }} |

			<strong>Roll: </strong> {{ $result->roll }} |

			<strong>Class: </strong>{{ $result->class }} |

			<strong>Batch: </strong>{{ $result->batch }} |

			<strong>Shift: </strong>{{ $result->shift }} |

			<strong>Month: </strong>{{ $result->month }} |

			<strong>Year: </strong>{{ $result->year }}
			</div>

		</h3>
		<p class="text-center">(শুন্য(০) মানে অনুপস্থিত অথবা ছুটির দিন অথবা ক্লাস হইনি।)</p>

	@endforeach

</div>


<div class="row">

	<div class="col-md-12">

		<div class="result_list">

			@if (count($results)>0)

			<div class="table-responsive">

				<table class="table">

					<tr class="success">

						@for ($date = 1; $date < 32; $date++)

						<td>{{ $date }}</td>

						@endfor

						<td>Total</td>
						<td>In Percent</td>
						<td>Grade</td>

					</tr>

					@foreach ($results as $result)

					<tr>

						<td>{{ $result->one }}</td>

						<td>{{ $result->two }}</td>

						<td>{{ $result->three }}</td>

						<td>{{ $result->four }}</td>

						<td>{{ $result->five }}</td>

						<td>{{ $result->six }}</td>

						<td>{{ $result->seven }}</td>

						<td>{{ $result->eight }}</td>

						<td>{{ $result->nine }}</td>

						<td>{{ $result->ten }}</td>

						<td>{{ $result->eleven }}</td>

						<td>{{ $result->twelve }}</td>

						<td>{{ $result->thirteen }}</td>

						<td>{{ $result->fourteen }}</td>

						<td>{{ $result->fifteen }}</td>

						<td>{{ $result->sixteen }}</td>

						<td>{{ $result->seventeen }}</td>

						<td>{{ $result->eighteen }}</td>

						<td>{{ $result->nineteen }}</td>

						<td>{{ $result->twenty }}</td>

						<td>{{ $result->twentyone }}</td>

						<td>{{ $result->twentytwo }}</td>

						<td>{{ $result->twentythree }}</td>

						<td>{{ $result->twentyfour }}</td>

						<td>{{ $result->twentyfive }}</td>

						<td>{{ $result->twentysix }}</td>

						<td>{{ $result->twentyseven }}</td>

						<td>{{ $result->twentyeight }}</td>

						<td>{{ $result->twentynine }}</td>

						<td>{{ $result->thirty }}</td>

						<td>{{ $result->thirtyone }}</td>

						<td>{{ $total_marks }}</td>

						<td>{{ round($in_percent, 3) }}</td>

						<td>{{ $grade }}</td>

					</tr>

					@endforeach

				</table>

			</div>

			@else

			<h5>Sorry No result available yet.</h5>

			@endif

		</div>
	</div>
</div>

