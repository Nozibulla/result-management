    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Show Result</title>

    <div class="row">

    	<div class="col-md-8 col-md-offset-2">

    		<div class="panel panel-default">

    			<div class="panel-heading"><h3 class="text-center">Show Alarming Student for Year: {{ $year }} | Month: {{ $month }} | Class: {{ $class }} | Shift: {{ $shift }} </h3></div>

    		</div>

    		<div class="result_list">

    			@if (count($student_postion)>0)

    			

    			<div class="table-responsive">

    				<table class="table" id="all_result_table">
    					<thead>

    						<tr class="success">

                                <td>Serial</td>

    							<td>Name</td>

    							<td>Roll</td>

    							<td>Total Marks</td>

    							<td>In Percent</td>

    							<td>Grade</td>


    						</tr>

    					</thead>

    					@foreach ($student_postion as $key => $position)

    					<tr>

                            <td>{{ $key+1 }}</td>

    						<td>{{ $position['name'] }}</td>

    						<td>{{ $position['roll'] }}</td>

    						<td>{{ $position['total_marks'] }}</td>

    						<td>{{ round($position['in_percent'], 3) }}</td>

    						<td>{{ $position['grade'] }}</td>

    					</tr>

    					@endforeach

    				</table>

    			</div>

    			@else

    			<h3 class="text-center">Sorry no Alarming Student Available</h3>

    			@endif

    		</div>

    	</div>



    </div>



