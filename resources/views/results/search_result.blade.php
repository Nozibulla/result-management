<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/fonts/css/font-awesome.min.css" rel="stylesheet">

    <link href="/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->

    <!-- <link href="/css/custom.css" rel="stylesheet"> -->

    <link href="/css/app.css" rel="stylesheet">
    <title>Notunkuri</title>
</head>
<body>
    <div class="container jumbotron">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                <p class="text-center">To show Results per day Click on Result Per Day Tab <br> To show monthly Result click on Show Result by Month </p>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-primary">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            <h4 class="panel-title">
                                Show Result by Month
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">

                                {!! Form::open(['method' => 'POST', 'url' => '/', 'class' => 'form-horizontal']) !!}

                                <div class="form-group @if($errors->first('year')) has-error @endif">
                                    {!! Form::label('year', 'Select Year') !!}
                                    {!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('year') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('month')) has-error @endif">
                                    {!! Form::label('month', 'Select Second Month') !!}
                                    {!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('month') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('class')) has-error @endif">
                                    {!! Form::label('class', 'Select Class') !!}
                                    {!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('class') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('batch')) has-error @endif">
                                    {!! Form::label('batch', 'Select Batch') !!}
                                    {!! Form::select('batch', $batches, null, ['id' => 'batch', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('batch') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('shift')) has-error @endif">
                                    {!! Form::label('shift', 'Select Shift') !!}
                                    {!! Form::select('shift',$shifts, null, ['id' => 'shift', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('shift') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('roll')) has-error @endif">
                                    {!! Form::label('roll', 'Roll') !!}
                                    {!! Form::text('roll', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('roll') }}</small>
                                </div>

                                <div class="btn-group pull-right">

                                    {!! Form::submit("Search", ['class' => 'btn btn-success']) !!}
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading"  data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <h4 class="panel-title">

                                Show Result Per Day
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                {!! Form::open(['method' => 'POST', 'url' => '/single_result', 'class' => 'form-horizontal']) !!}

                                <div class="form-group @if($errors->first('year')) has-error @endif">
                                    {!! Form::label('year', 'Select Year') !!}
                                    {!! Form::select('year',$years, date('Y'), ['id' => 'year', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('year') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('month')) has-error @endif">
                                    {!! Form::label('month', 'Select Second Month') !!}
                                    {!! Form::select('month',$months, null, ['id' => 'month', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('month') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('class')) has-error @endif">
                                    {!! Form::label('class', 'Select Class') !!}
                                    {!! Form::select('class', $classes, null, ['id' => 'class', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('class') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('batch')) has-error @endif">
                                    {!! Form::label('batch', 'Select Batch') !!}
                                    {!! Form::select('batch', $batches, null, ['id' => 'batch', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('batch') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('shift')) has-error @endif">
                                    {!! Form::label('shift', 'Select Shift') !!}
                                    {!! Form::select('shift',$shifts, null, ['id' => 'shift', 'class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('shift') }}</small>
                                </div>

                                <div class="form-group @if($errors->first('roll')) has-error @endif">
                                    {!! Form::label('roll', 'Roll') !!}
                                    {!! Form::text('roll', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('roll') }}</small>
                                </div>

                                <div class="btn-group pull-right">

                                    {!! Form::submit("Search", ['class' => 'btn btn-success']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/student.js"></script>

</body>
</html>
