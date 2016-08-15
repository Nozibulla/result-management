    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Show Result</title>

    <div class="row">

    	<div class="col-md-12">

    		<div class="panel panel-default">

    			<div class="panel-heading"><h2 class="text-center">Show Result for Year: {{ $year }} | Month: {{ $month }} | Class: {{ $class }} </h2></div>

    		</div>

    		<div class="result_list">

            <?php
                $ADoublePlus = 0;
                $APlus = 0;
                $AMinus = 0;
                $A = 0;
                $B = 0;
                $C = 0;

                ?>

    			@if (count($results)>0)

    			

    			<div class="table-responsive">

    				<table class="table" id="all_result_table">
    					<thead>

    						<tr class="success">

    							<td>Name</td>

    							<td>Roll</td>

    							@for ($date = 1; $date < 32; $date++)

    							<td>{{ $date }}</td>

    							@endfor

    							<td>Total Marks</td>

    							<td>In Percent</td>

    							<td>Grade</td>


    						</tr>

    					</thead>

    					@foreach ($results as $result)

    					<?php $total_marks = $result->one +
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

                        //calculating grade and In percent

    					$gross_marks = $result->total_subject * 4;

    					$in_percent = ($total_marks * 100) / $gross_marks;

                        if ($in_percent>=91 && $in_percent<=100) {

                            $grade = 'A++';
                            $ADoublePlus++;
                        }elseif ($in_percent>=81 && $in_percent<91) {
                           $grade = 'A+';
                            $APlus++;
                        }elseif ($in_percent>=71 && $in_percent<81) {
                            $grade = 'A';
                            $A++;
                        }elseif ($in_percent>=61 && $in_percent<71) {
                           $grade = 'A-';
                            $AMinus++;
                        }elseif ($in_percent>=51 && $in_percent<61) {
                            $grade = 'B';
                            $B++;
                        }elseif ($in_percent>=0 && $in_percent<51) {
                           $grade = 'C';
                            $C++;
                        }else{
                            $grade = 'w/g';
                        }


    					/*$gradecalc = $in_percent / 10;

    					settype($gradecalc, "integer");

    					switch ($gradecalc) {

    						case 10:
    						$grade = 'A++';
    						$ADoublePlus++;
    						break;

    						case 9:
    						$grade = 'A++';
    						$ADoublePlus++;
    						break;

    						case 8:
    						$grade = 'A+';
    						$APlus++;
    						break;

    						case 7:
    						$grade = 'A';
    						$A++;
    						break;

    						case 6:
    						$grade = 'A-';
    						$AMinus++;
    						break;

    						case 5:
    						$grade = 'B';
    						$B++;
    						break;

    						case 4:
    						$grade = 'C';
    						$C++;
    						break;

    						case 3:
    						$grade = 'C';
    						$C++;
    						break;

    						case 2:
    						$grade = 'C';
    						$C++;
    						break;

    						case 1:
    						$grade = 'C';
    						$C++;
    						break;

    						default:
    						$grade = 'w/g';
    						break;
    					}
*/
    					?>




    					<tr>

    						<td>{{ $result->name }}</td>

    						<td>{{ $result->roll }}</td>

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

    			<br>
    			<div class="col-lg-6 col-lg-offset-3">

    				<table class="table table-striped" id="grade_counter">

    					<tr class="success">

    						<td>A++</td>

    						<td>A+</td>

    						<td>A</td>

    						<td>A-</td>

    						<td>B</td>

    						<td>C</td>

    					</tr>

    					<tr>

    						<td>{{ $ADoublePlus }}</td>

    						<td>{{ $APlus }}</td>

    						<td>{{ $A }}</td>

    						<td>{{ $AMinus }}</td>

    						<td>{{ $B }}</td>

    						<td>{{ $C }}</td>

    					</tr>


    				</table>
    			</div>

    		</div>

    	</div>



    </div>



