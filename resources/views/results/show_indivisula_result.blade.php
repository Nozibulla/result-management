<!DOCTYPE html>
<html>
<head>
	<link href="/css/bootstrap.min.css" rel="stylesheet">

	<link href="/fonts/css/font-awesome.min.css" rel="stylesheet">

	<link href="/css/animate.min.css" rel="stylesheet">

	<!-- Custom styling plus plugins -->

	<!-- <link href="/css/custom.css" rel="stylesheet"> -->

	<link href="/css/app.css" rel="stylesheet">
	<title>Indivisual Result</title>
</head>
<body>



	<div class="indivisual_results">

		<div class="student_info">

			<h2><strong>Name: </strong>{{ $student->name }} |
				<strong>Roll: </strong> {{ $student->roll }} |
				<strong>Class: </strong>{{ $student->class }} |
				<strong>Batch: </strong>{{ $student->batch }} |
				<strong>Shift: </strong>{{ $student->shift }} |
				<strong>Month: </strong>{{ $month }}</h2>

			</div>



			<div class="row">

				@include('modals.editResultModal')
				@include('modals.deleteResult')

				<div class="col-md-12">

					<div class="result_list">

						@if (count($indivisual_results)>0)

						<div class="table-responsive">

							<table class="table">

								<tr class="success">
									<td></td>

									<td></td>

									<td>Month</td>

									<!-- <td>Subject</td> -->

									@for ($date = 1; $date < 32; $date++)

									<td>{{ $date }}</td>

									@endfor

									<td>Inpercent</td>

									<td>Grade</td>

								</tr>

								@foreach ($total_indivisual_results as $result)

								<?php 

								$counter =0;

								if($result->one!=0)$counter++;
								if($result->two!=0)$counter++;
								if($result->three!=0)$counter++;
								if($result->four!=0)$counter++;
								if($result->five!=0)$counter++;
								if($result->six!=0)$counter++;
								if($result->seven!=0)$counter++;
								if($result->eight!=0)$counter++;
								if($result->nine!=0)$counter++;
								if($result->ten!=0)$counter++;
								if($result->eleven!=0)$counter++;
								if($result->twelve!=0)$counter++;
								if($result->thirteen!=0)$counter++;
								if($result->fourteen!=0)$counter++;
								if($result->fifteen!=0)$counter++;
								if($result->sixteen!=0)$counter++;
								if($result->seventeen!=0)$counter++;
								if($result->eighteen!=0)$counter++;
								if($result->nineteen!=0)$counter++;
								if($result->twenty!=0)$counter++;
								if($result->twentyone!=0)$counter++;
								if($result->twentytwo!=0)$counter++;
								if($result->twentythree!=0)$counter++;
								if($result->twentyfour!=0)$counter++;
								if($result->twentyfive!=0)$counter++;
								if($result->twentysix!=0)$counter++;
								if($result->twentyseven!=0)$counter++;
								if($result->twentyeight!=0)$counter++;
								if($result->twentynine!=0)$counter++;
								if($result->thirty!=0)$counter++;
								if($result->thirtyone!=0)$counter++;


								$total_marks = $result->one +
								$result->two +
								$result->three +
								$result->four +
								$result->five +
								$result->six +
								$result->seven +
								$result->eight +
								$result->nine +
								$result->ten +
								$result->eleven +
								$result->twelve +
								$result->thirteen +
								$result->fourteen +
								$result->fifteen +
								$result->sixteen +
								$result->seventeen +
								$result->eighteen +
								$result->nineteen +
								$result->twenty +
								$result->twentyone +
								$result->twentytwo +
								$result->twentythree +
								$result->twentyfour +
								$result->twentyfive +
								$result->twentysix +
								$result->twentyseven +
								$result->twentyeight +
								$result->twentynine +
								$result->thirty +
								$result->thirtyone;

								$gross_marks = $result->total_sUbject * 4;

								$in_percent = $total_marks * 100 / $gross_marks;

								if ($in_percent>=91 && $in_percent<=100) {

		                            $grade = 'A++';
		                        }elseif ($in_percent>=81 && $in_percent<91) {
		                           $grade = 'A+';
		                        }elseif ($in_percent>=71 && $in_percent<81) {
		                            $grade = 'A';
		                        }elseif ($in_percent>=61 && $in_percent<71) {
		                           $grade = 'A-';
		                        }elseif ($in_percent>=51 && $in_percent<61) {
		                            $grade = 'B';
		                        }elseif ($in_percent>=0 && $in_percent<51) {
		                           $grade = 'C';
		                        }else{
		                            $grade = 'w/g';
		                        }


								/*$gradecalc = $in_percent / 10;

								settype($gradecalc, "integer");

								switch ($gradecalc) {

									case 10:
									$grade = 'A++';
									break;

									case 9:
									$grade = 'A++';
									break;

									case 8:
									$grade = 'A+';
									break;

									case 7:
									$grade = 'A';
									break;

									case 6:
									$grade = 'A-';
									break;

									case 5:
									$grade = 'B';
									break;

									case 4:
									$grade = 'C';
									break;

									case 3:
									$grade = 'C';
									break;

									case 2:
									$grade = 'C';
									break;

									case 1:
									$grade = 'C';
									break;

									default:
									$grade = 'w/g';
									break;
								}

*/


								?>

								<tr>

									<td >
										<a href="#" class="edit_result" data-id="{{ $student->id }}" data-month="{{ $result->month }}"data-subject="{{ $result->subject }}">Edit</a>
									</td>

									<td >
										<a href="#" class="delete_result" data-id="{{ $student->id }}" data-month="{{ $result->month }}" data-subject="{{ $result->subject }}">Delete</a>
									</td>

									<td>{{ $result->month }}</td>

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

									<td>{{ round($in_percent, 3) }}</td>

									<td>{{ $grade }}</td>

								</tr>

								@endforeach

							</table>

						</div>

						@else

						<h5>Sorry No result available yet.</h5>

						@endif

						<br>
						<h2>Gradesheet by Date</h2>

						<div class="table-responsive" >

							<table class="table table-striped">

								<tr class="success">

									<td></td>

									@for ($date = 1; $date < 32; $date++)

									<td>{{ $date }}</td>

									@endfor

								</tr>

								<tr>

									<td>Total</td>

									<td>{{ $totalone }}</td>
									<td>{{ $totaltwo }}</td>
									<td>{{ $totalthree }}</td>
									<td>{{ $totalfour }}</td>
									<td>{{ $totalfive }}</td>
									<td>{{ $totalsix }}</td>
									<td>{{ $totalseven }}</td>
									<td>{{ $totaleight }}</td>
									<td>{{ $totalnine }}</td>
									<td>{{ $totalten }}</td>
									<td>{{ $totaleleven }}</td>
									<td>{{ $totaltwelve }}</td>
									<td>{{ $totalthirteen }}</td>
									<td>{{ $totalfourteen }}</td>
									<td>{{ $totalfifteen }}</td>
									<td>{{ $totalsixteen }}</td>
									<td>{{ $totalseventeen }}</td>
									<td>{{ $totaleighteen }}</td>
									<td>{{ $totalnineteen }}</td>
									<td>{{ $totaltwenty }}</td>
									<td>{{ $totaltwentyone }}</td>
									<td>{{ $totaltwentytwo }}</td>
									<td>{{ $totaltwentythree }}</td>
									<td>{{ $totaltwentyfour }}</td>
									<td>{{ $totaltwentyfive }}</td>
									<td>{{ $totaltwentysix }}</td>
									<td>{{ $totaltwentyseven }}</td>
									<td>{{ $totaltwentyeight }}</td>
									<td>{{ $totaltwentynine }}</td>
									<td>{{ $totalthirty }}</td>
									<td>{{ $totalthirtyone }}</td>

								</tr>

								<tr>

									<td>InPercent</td>

									<td>{{ round($inpercentone, 3) }}</td>
									<td>{{ round($inpercenttwo, 3) }}</td>
									<td>{{ round($inpercentthree, 3) }}</td>
									<td>{{ round($inpercentfour, 3) }}</td>
									<td>{{ round($inpercentfive, 3) }}</td>
									<td>{{ round($inpercentsix , 3)}}</td>
									<td>{{ round($inpercentseven, 3) }}</td>
									<td>{{ round($inpercenteight, 3) }}</td>
									<td>{{ round($inpercentnine, 3) }}</td>
									<td>{{ round($inpercentten, 3) }}</td>
									<td>{{ round($inpercenteleven, 3) }}</td>
									<td>{{ round($inpercenttwelve, 3) }}</td>
									<td>{{ round($inpercentthirteen, 3) }}</td>
									<td>{{ round($inpercentfourteen, 3) }}</td>
									<td>{{ round($inpercentfifteen, 3) }}</td>
									<td>{{ round($inpercentsixteen, 3) }}</td>
									<td>{{ round($inpercentseventeen, 3) }}</td>
									<td>{{ round($inpercenteighteen, 3) }}</td>
									<td>{{ round($inpercentnineteen, 3) }}</td>
									<td>{{ round($inpercenttwenty, 3) }}</td>
									<td>{{ round($inpercenttwentyone, 3) }}</td>
									<td>{{ round($inpercenttwentytwo, 3) }}</td>
									<td>{{ round($inpercenttwentythree, 3) }}</td>
									<td>{{ round($inpercenttwentyfour, 3) }}</td>
									<td>{{ round($inpercenttwentyfive, 3) }}</td>
									<td>{{ round($inpercenttwentysix, 3) }}</td>
									<td>{{ round($inpercenttwentyseven, 3) }}</td>
									<td>{{ round($inpercenttwentyeight, 3) }}</td>
									<td>{{ round($inpercenttwentynine, 3) }}</td>
									<td>{{ round($inpercentthirty, 3) }}</td>
									<td>{{ round($inpercentthirtyone, 3) }}</td>

								</tr><tr>

								<td>Grade</td>

								<td>{{ $gradeone }}</td>
								<td>{{ $gradetwo }}</td>
								<td>{{ $gradethree }}</td>
								<td>{{ $gradefour }}</td>
								<td>{{ $gradefive }}</td>
								<td>{{ $gradesix }}</td>
								<td>{{ $gradeseven }}</td>
								<td>{{ $gradeeight }}</td>
								<td>{{ $gradenine }}</td>
								<td>{{ $gradeten }}</td>
								<td>{{ $gradeeleven }}</td>
								<td>{{ $gradetwelve }}</td>
								<td>{{ $gradethirteen }}</td>
								<td>{{ $gradefourteen }}</td>
								<td>{{ $gradefifteen }}</td>
								<td>{{ $gradesixteen }}</td>
								<td>{{ $gradeseventeen }}</td>
								<td>{{ $gradeeighteen }}</td>
								<td>{{ $gradenineteen }}</td>
								<td>{{ $gradetwenty }}</td>
								<td>{{ $gradetwentyone }}</td>
								<td>{{ $gradetwentytwo }}</td>
								<td>{{ $gradetwentythree }}</td>
								<td>{{ $gradetwentyfour }}</td>
								<td>{{ $gradetwentyfive }}</td>
								<td>{{ $gradetwentysix }}</td>
								<td>{{ $gradetwentyseven }}</td>
								<td>{{ $gradetwentyeight }}</td>
								<td>{{ $gradetwentynine }}</td>
								<td>{{ $gradethirty }}</td>
								<td>{{ $gradethirtyone }}</td>

							</tr>


						</table>
					</div>





				</div>

			</div>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

			<!-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
			<script src="/js/bootstrap.min.js"></script>
			<script src="/js/student.js"></script>

		</div>

	</body>
	</html>




