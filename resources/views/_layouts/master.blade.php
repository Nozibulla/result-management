<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield ('title')

    <!-- Bootstrap Core CSS -->

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/fonts/css/font-awesome.min.css" rel="stylesheet">

    <link href="/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->

    <link href="/css/custom.css" rel="stylesheet">

    <link href="/css/app.css" rel="stylesheet">

    @yield ('cssSection')

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

      </head>


      <body class="nav-md">

        <div class="container body">


            <div class="main_container">

                <div class="col-md-3 left_col " style="z-index: 1;">

                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">

                            <a href="/" class="site_title">

                                <i class="fa fa-paw"></i>

                                <span>Notunkuri</span>

                            </a>

                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->

                        <div class="profile">

                            <div class="profile_pic">

                                <img src="images/user.png" alt="" class="img-circle profile_img">

                            </div>

                            <div class="profile_info">



                                <h2><!-- Welcome to NotunKuri Coaching Center --></h2>

                            </div>

                        </div>

                        <!-- /menu profile quick info -->

                        <br>




                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">

                                <!-- <h3>Admin</h3> -->


                                <ul class="nav side-menu">

                                    <li>

                                        <a href="/dashboard">

                                            <i class="fa fa-home"></i>

                                            Dashboard

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="add-student">

                                            <i class="fa fa-user"></i>

                                            Add Student

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="add_details">

                                            <i class="fa fa-plus"></i>

                                            Add Details

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="student-list">

                                            <i class="fa fa-list"></i>

                                            Student List

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="add_result">

                                            <i class="fa fa-plus"></i>

                                            Add Daily Result

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="result_category">

                                            <i class="fa fa-eye"></i>

                                            Total Result

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="result_by_date">

                                            <i class="fa fa-eye"></i>

                                            Review 

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="successive_class_perfomance_by_class_and_batch">

                                            <i class="fa fa-eye"></i>

                                            Progressive Class <span style="margin-left: 30px">Performance</span>

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>
                                        <a href="class_perfomance_by_batch">

                                            <i class="fa fa-eye"></i>

                                            Grade Performance in Percentage

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="compare_perfomance">

                                            <i class="fa fa-eye"></i>

                                            Compare Performance

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="show_position">

                                            <i class="fa fa-eye"></i>

                                            Show Position

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <a href="alarming_student">

                                            <i class="fa fa-eye"></i>

                                            Alarming Student

                                            {{-- <span class="fa fa-chevron-down"></span> --}}

                                        </a>

                                        <!-- footer content -->

                                        <footer>

                                            <div class="footer">

                                                <p class="">

                                                    A product of Zeroo

                                                    <a href="#">

                                                        <span class="lead">

                                                            <i class="fa fa-paw"></i>

                                                        </span>

                                                    </a>

                                                </p>

                                            </div>

                                            <div class="clearfix"></div>

                                        </footer>

                                        <!-- /footer content -->

                                       {{--  <ul class="nav child_menu" style="display: none">

                                            <li>

                                                <a href="#">Dashboard</a>

                                            </li>

                                            <li>

                                                <a href="#">Dashboard2</a>

                                            </li>

                                            <li>

                                                <a href="#">Dashboard3</a>

                                            </li>

                                        </ul> --}}

                                    </li>

                                </ul>

                            </div>

                        </div>

                        <!-- /sidebar menu -->



                    </div>




                </div>

                <!-- top navigation -->

                 <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">

                            <!-- Collapsed Hamburger -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Branding Image -->


                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav pull-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>



                <!-- <div class="top_nav">

                    <div class="nav_menu">

                        <nav class="" role="navigation">

                            <div class="nav navbar-nav navbar-laft">

                               <h3 class="col-lg-offset-2"> @yield ('page_name')</h3>


                           </div>



                           <ul class="nav navbar-nav navbar-right">

                            <li class="">

                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                    <img src="images/img.jpg" alt="">John Doe

                                    <span class=" fa fa-angle-down"></span>

                                </a>

                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">

                                    <li>

                                        <a href="javascript:;">  Profile</a>

                                    </li>

                                    <li>

                                        <a href="javascript:;">

                                            <span class="badge bg-red pull-right">50%</span>

                                            <span>Settings</span>

                                        </a>

                                    </li>

                                    <li>

                                        <a href="javascript:;">Help</a>

                                    </li>

                                    <li>

                                        <a href="#">

                                            <i class="fa fa-sign-out pull-right"></i> Log Out

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">

                                    <i class="fa fa-envelope-o"></i>

                                    <span class="badge bg-green">6</span>

                                </a>

                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">

                                    <li>

                                        <a>

                                            <span class="image">

                                                <img src="images/img.jpg" alt="Profile Image" />

                                            </span>

                                            <span>

                                                <span>John Smith</span>

                                                <span class="time">3 mins ago</span>

                                            </span>

                                            <span class="message">

                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>

                                        </a>

                                    </li>


                                    <li>

                                        <div class="text-center">

                                            <a>

                                                <strong>

                                                    <a href="#">See All Alerts</a>

                                                </strong>

                                                <i class="fa fa-angle-right"></i>

                                            </a>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </nav>

                </div>

            </div> -->

            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                @yield ('content')




            </div>

            <!-- /page content -->

        </div>

    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    {{-- // <script src="/js/custom.js"></script> --}}

    <!-- <script src="/js/ddtf.js"></script> -->

        <!-- <script src="js/react.min.js"></script>
        <script src="js/react-dom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>-->


        <script src="/js/student.js"></script>

        @yield ('jsSection')

    </body>

    </html>
