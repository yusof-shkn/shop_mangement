<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Salaries Page</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('ElaAdmin/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('ElaAdmin/assets/css/style.css')}}">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
       
.flash-confirm {
    display: none;
    animation: slideIn 0.5s; /* Apply the slide-in and slide-out animations with a delay of 4.5s */
}
.flash-message {
    display: none;
    animation: slideIn 0.5s,slideOut 0.5s 4.5s; /* Apply the slide-in and slide-out animations with a delay of 4.5s */
}

@keyframes slideIn {
    0% {
    transform: translate(-50%, -200%);
    opacity: 0;
    }
    100% {
    transform: translate(-50%, -50%);
    opacity: 1;
    }
}

@keyframes slideOut {
    0% {
    transform: translate(-50%, -50%);
    opacity: 1;
    }
    100% {
    transform: translate(-50%, 200%);
    opacity: 0;
    }
}
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    @if(session('message'))
        <div class="flash-message justify-content-center position-fixed" style="display:flex;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
        <div class="{{session('message.bootstrap_class')}}" role="alert">
            {{session('message.status')}}.
        </div>
        </div>
    @endif
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div class="container-lg">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-right">
                <div class="header-menu">
                    <div class="logo ml-2 mr-auto">
                        <a class="navbar-brand" href="./"><img style="height: 40px" src="{{asset('images/yusof-logo.png')}}" alt="Logo"><span class="main-color-text font-weight-bold">Yusof.Web</span></a>
                    </div>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="{{asset('images/yusof-logo.png')}}"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            
                            <a class="dropdown-item  nav-link" href="{{ route('admin.dashboard') }}"><i class='bx bxs-dashboard' ></i>Dashboard</a>
                            <a class="dropdown-item  nav-link" href="{{ route('profile.show') }}"><i class='bx bxs-user-account' ></i>My Profile</a>

                            <a class="dropdown-item  nav-link" href="#"><i class='bx bxs-notification' ></i>Notifications <span class="count">13</span></a>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="dropdown-item  nav-link" href="{{ route('logout') }}"><i class='bx bx-log-out'></i>Log out</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

        <div class="content border border">
            <div class="container">
                <form>
                    <div class="d-flex justify-content-end mr-5 mb-4 ">
                        <div class="input-group col-3">
                            <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn hover shadow-sm border" required data-mdb-ripple-init>search</button>
                        </div>
                    </div>
                </form>
                <div class="col-12 overflow-auto">
                    <div class="card shadow mb-5 text-capitalize" >
                        <div class="card-header border-0">
                          <h6 class="mb-0">
                            @php
                            $Date = $salaries->first()->created_at;
                            $newDate = \Carbon\Carbon::parse($Date)->diffForHumans();
                            echo "Last Updated: ".$newDate;
                            @endphp
                            </h6>
                        </div>
                        <div class="table-responsive">
                          <table class="table align-items-center table-flush" style="user-select: none">
                            <thead class="thead-light text-center">
                              <tr>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Salary Amount</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                             @foreach($salaries as $salary)
                              <tr class="row_customTable">
                                <td>
                                  {{$salary->employee->name}}
                                </td>
                                <td>
                                  {{$salary->start_date}}
                                </td>
                                <td>
                                  {{$salary->end_date}}
                                </td>
                                <td>
                                  ${{$salary->salary_amount}} USD
                                </td>
                                <td class="text-center">
                                  <a class="btn-sm main-color-bg text-white mr-1" href="{{route('admin.delete_salary',['id'=>$salary->id])}}" ><i class='bx bxs-trash'></i></a>
                              </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                   </div>
              </div>
    <script>  
        document.addEventListener('DOMContentLoaded', function() {
      var flashMessage = document.querySelector('.flash-message');
      if (flashMessage) {
        flashMessage.style.display = 'block';
        // Set a timeout to hide the flashed message after 5 seconds
        setTimeout(function() {
          flashMessage.style.display = 'none';
        }, 4900); // 5000 milliseconds = 5 seconds
      }
    });
    </script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{asset('ElaAdmin/assets/js/main.js')}}"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="{{asset('ElaAdmin/assets/js/init/weather-init.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="{{asset('ElaAdmin/assets/js/init/fullcalendar-init.js')}}"></script>

</body>
</html>
