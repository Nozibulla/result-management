    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <title>Result by Date</title>

    <div class="row">

    	<div class="col-md-6 col-md-offset-3">

    		<div class="panel panel-default">

    			<div class="panel-heading"><h4 class="text-center">Show Result for Year: {{ $year }} | Month: {{ $month }} | Class: {{ $class }} | Shift: {{ $shift }} | Batch: {{ $batch }} </h4></div>

    		</div>

    		<div class="result_list">

    			@if (count($results)>0)

    			

    			<div class="table-responsive">

    				<table class="table" id="all_result_table">
    					<thead>

    						<tr class="success">

    							<td><strong>Name</strong></td>

    							<td><strong>Roll</strong></td>

    							<td><strong>{{ $date }}</strong></td>

    						</tr>

    					</thead>

                        @foreach ($results as $result)

    					<tr>

                            <td>{{ $result->name }}</td>
                            <td>{{ $result->roll }}</td>
    						<td>{{ $result->$date }}</td>

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



