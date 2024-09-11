<!doctype html>
@php
    $income = $incomes->sum('amount');
    $expense = $expenses->sum('amount');
@endphp
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
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
    @if ($errors->any())
        <div class="flash-message justify-content-center position-fixed" style="display:flex;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
            <div class="alert alert-danger" role="alert">
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    {{-- <li class="active">
                        <a onclick="main()"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li> --}}
                    <li class="menu-item-has-children dropdown">
                        <a onclick="main()" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a onclick="employees()" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon pe-7s-users"></i>Employees</a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a onclick="products()" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Products</a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a onclick="salaries()" href="{{route('admin.salaries')}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='menu-icon bx bx-credit-card'></i>Salaries</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img style="height: 40px" src="{{asset('images/yusof-logo.png')}}" alt="Logo"><span class="main-color-text font-weight-bold">Yusof.Web</span></a>
                    <a class="navbar-brand hidden" href="./"><img style="height: 40px" src="{{asset('images/yusof-logo.png')}}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
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

        <!-- dashboard -->
        <div id="mainPage" style="display: none" class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a class="card-body hover">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div>${{number_format($income - $expense,2)}} USD</div>
                                            <div class="stat-heading">Profit</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{route('admin.sales')}}" class="card-body hover">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div>{{number_format($sales)}} Unit</div>
                                            <div class="stat-heading">Sales</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{route('admin.purchase')}}" class="card-body hover">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div>{{number_format($purchases)}} Unit</div>
                                            <div class="stat-heading">Purchases</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="#" onclick="employees()" class="card-body hover">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4 ">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div>{{$employees->count()}} Person </div>
                                            <div class="stat-heading">Employees</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Traffic </h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card-body">
                                        <!-- <canvas id="TrafficChart"></canvas>   -->
                                        <div id="traffic-chart" class="traffic-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-body">
                                        <div class="col-12 mt-3">
                                            <div class="card">
                                                <a class="card-body hover">
                                                    <div class="stat-widget-five">
                                                        <div class="stat-icon flat-color-1">
                                                            <i class='bx bx-dollar'></i>
                                                        </div>
                                                        <div class="stat-content">
                                                            <div class="text-left dib p-0">
                                                                <div>$ {{number_format($income)}} USD</div>
                                                                <div class="stat-heading">Income</div>
                                                            </div>
                                                        </div>
                                                        <div class="stat-icon ml-4 pl-2 flat-color-1">
                                                            <i class='bx bx-plus'></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                    
                                        <div class="col-12 ">
                                            <div class="card">
                                                <a href="#" class="card-body hover">
                                                    <div class="stat-widget-five">
                                                        <div class="stat-icon dib text-danger">
                                                            <i class='bx bx-dollar'></i>
                                                        </div>
                                                        <div class="stat-content">
                                                            <div class="text-left dib">
                                                                <div>$ {{number_format($expense)}}USD</div>
                                                                <div class="stat-heading">Expenses</div>
                                                            </div>
                                                        </div>
                                                        <div class="stat-icon dib ml-3 pl-3 text-danger">
                                                            <i class='bx bx-minus'></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">#</th>
                                                    <th class="avatar">Avatar</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="serial">1.</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('ElaAdmin/images/avatar/1.jpg')}}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td> #5469 </td>
                                                    <td>  <span class="name">Louis Stanley</span> </td>
                                                    <td> <span class="product">iMax</span> </td>
                                                    <td><span class="count">231</span></td>
                                                    <td>
                                                        <span class="badge badge-complete">Complete</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="serial">2.</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('ElaAdmin/images/avatar/2.jpg')}}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td> #5468 </td>
                                                    <td>  <span class="name">Gregory Dixon</span> </td>
                                                    <td> <span class="product">iPad</span> </td>
                                                    <td><span class="count">250</span></td>
                                                    <td>
                                                        <span class="badge badge-complete">Complete</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="serial">3.</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('ElaAdmin/images/avatar/3.jpg')}}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td> #5467 </td>
                                                    <td>  <span class="name">Catherine Dixon</span> </td>
                                                    <td> <span class="product">SSD</span> </td>
                                                    <td><span class="count">250</span></td>
                                                    <td>
                                                        <span class="badge badge-complete">Complete</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="serial">4.</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('ElaAdmin/images/avatar/4.jpg')}}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td> #5466 </td>
                                                    <td>  <span class="name">Mary Silva</span> </td>
                                                    <td> <span class="product">Magic Mouse</span> </td>
                                                    <td><span class="count">250</span></td>
                                                    <td>
                                                        <span class="badge badge-pending">Pending</span>
                                                    </td>
                                                </tr>
                                                <tr class=" pb-0">
                                                    <td class="serial">5.</td>
                                                    <td class="avatar pb-0">
                                                        <div class="round-img">
                                                            <a href="#"><img class="rounded-circle" src="{{asset('ElaAdmin/images/avatar/6.jpg')}}" alt=""></a>
                                                        </div>
                                                    </td>
                                                    <td> #5465 </td>
                                                    <td>  <span class="name">Johnny Stephens</span> </td>
                                                    <td> <span class="product">Monitor</span> </td>
                                                    <td><span class="count">250</span></td>
                                                    <td>
                                                        <span class="badge badge-complete">Complete</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="card br-0">
                                        <div class="card-body">
                                            <div class="chart-container ov-h">
                                                <div id="flotPie1" class="float-chart"></div>
                                            </div>
                                        </div>
                                    </div><!-- /.card -->
                                </div>

                                <div class="col-lg-6 col-xl-12">
                                    <div class="card bg-flat-color-3  ">
                                        <div class="card-body">
                                            <h4 class="card-title m-0  white-color ">August 2018</h4>
                                        </div>
                                         <div class="card-body">
                                             <div id="flotLine5" class="flot-line"></div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.col-md-4 -->
                    </div>
                </div>
                <!-- /.orders -->
                <!-- Calender Chart Weather  -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card ov-h">
                            <div class="card-body bg-flat-color-2">
                                <div id="flotBarChart" class="float-chart ml-4 mr-4"></div>
                            </div>
                            <div id="cellPaiChart" class="float-chart"></div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /Calender Chart Weather -->
            </div>
        </div>
        <!-- employee -->
        <div id="employeesPage" style="display: none" class="content border border">

            <div class=" successButton position-fixed d-flex justify-content-center text-center align-items-center pt-4 p-2 shadow-lg" style="font-size:5rem;bottom: 2rem; right:1%;height:4rem ;width:4rem;z-index:99999; border-radius:0.6rem;">
                <a class="text-white" onclick="createEmployee()"><i class='bx bx-plus'></i></a>
            </div>


             @foreach($employees as $employee)
             <div id="{{$employee->id}}editEmployee"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.update_employee')}}" method="POST">
                @csrf
                <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                    <a onclick="editEmployeeHide({{$employee->id}})" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                    <i class='bx bx-x'></i>
                    </a>
                    <div class="mt-4 mb-4 d-flex justify-content-center flex-column">
                        <select class="rounded-3 form-control" name="role" required >
                            @foreach($roles as $role)
                            <option @if($employee->role == $role->id) selected @endif  value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            @foreach($roles2 as $role)
                            <option @if($employee->role == $role->id) selected @endif  value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class=" form-control mt-2" value="{{$employee->name}}" required name="name" placeholder="Name">
                    <input type="text" class=" form-control mt-2" value="{{$employee->phone_number}}" required name="phone_number" placeholder="Phone Number">
                    <input type="number" class=" form-control mt-2" value="{{$employee->hourly_rate}}" required name="hourly_rate" placeholder="Hourly Rate">
                    <input type="hidden" name="id" required value="{{$employee->id}}" >
                    <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
                        Update
                    </button>
                </div>
                </form>
            </div>

            <div id="{{$employee->id}}deleteEmployee" class="flash-confirm justify-content-center position-fixed" style="display:none;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.delete_employee')}}" method="POST">
                    @csrf
                    <div class="alert alert-primary rounded p-4 d-flex justify-content-center position-relative" role="alert">
                        <a onclick="deleteEmployeeHide('{{$employee->id}}')" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                            <i class='bx bx-x'></i>
                        </a>
                        <input type="text" class=" form-control mr-1" required name="confirmation" placeholder="Type `confirm` to delete!">
                        <input type="hidden" name="id" required value="{{$employee->id}}">
                        <button class="btn btn-sm text-white main-color-bg" type="submit">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>

            <div id="{{$employee->id}}accountEmployee" class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999;">
                <form action="{{route('admin.account_employee')}}" method="POST">
                    @csrf
                    <div class="alert alert-primary rounded p-4 d-flex justify-content-center position-relative flex-column" role="alert">
                        <a onclick="accountEmployeeHide('{{$employee->id}}')" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                            <i class='bx bx-x'></i>
                        </a>
                        <h6 class="text-center">Create Account</h6>
                        <input type="text" class=" form-control mt-2" required name="confirmation" placeholder="Type `confirm`">
                        <input type="text" class=" form-control mt-2" required name="username" placeholder="username">
                        <input type="password" class=" form-control mt-2" required name="password" placeholder="password">
                        <input type="password" class=" form-control mt-2" required name="password_confirmation" placeholder="Confirm password">
                        <input type="hidden" name="id" required value="{{$employee->id}}">
                        <button class="btn btn-sm text-white main-color-bg mt-3" type="submit">
                            Create
                        </button>
                    </div>
                </form>
            </div>

            @endforeach
            <div class="container-lg mx-5">


                <div id="createEmployee"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                    <form action="{{route('admin.create_employee')}}" method="POST">
                    @csrf
                    <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                        <a onclick="createEmployeeHide()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                        <i class='bx bx-x'></i>
                        </a>
                        <div class="mt-4 mb-4 d-flex justify-content-center flex-column">
                            <select class="rounded-3 form-control" name="role" >
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}"  >{{$role->name}}</option>
                                @endforeach
                                @foreach($roles2 as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <span class=" text-center rounded-3">or</span>
                            <a onclick="showRole();" id="newRole" class="border btn bg-white rounded-3">New Role</a>
                        </div>
                        <div id="showRole" class="mt-4 justify-content-center flex-column" style="position:relative;display: none">
                            <a onclick="hideRole()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                                <i class='bx bx-x'></i>
                            </a>
                            <input type="text" class=" form-control mt-2" name="newRole" placeholder="Role Name">
                        </div>
                        <input type="text" class=" form-control mt-2" required name="name" placeholder="Name">
                        <input type="text" class=" form-control mt-2" required name="phone_number" placeholder="Phone Number">
                        <input type="number" class=" form-control mt-2" required name="hourly_rate" placeholder="Hourly Rate">
                        <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
                            Create
                        </button>
                    </div>
                    </form>
                </div>
                <div class="col-12 overflow-auto">
                      <div class="card shadow mb-5 text-capitalize" >
                          <div class="card-header border-0">
                            <h3 class="mb-0">Employees</h3>
                          </div>
                          <div class="table-responsive">
                            <table class="table align-items-center table-flush" style="user-select: none">
                              <thead class="thead-light text-center">
                                <tr>
                                  <th scope="col">Image</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Hourly Rate</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">Phone Number</th>
                                  <th scope="col">Actions</th>
                                </tr>
                              </thead>
                              <tbody class="text-center">
                                @foreach ( $employees as $employee )
                                <tr class="row_customTable">
                                  <td scope="row">
                                        <img class="rounded-circle mr-0" style="height: 30px;width:30px" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                  </td>
                                  <td>
                                    {{$employee->name}}
                                  </td>
                                  <td>
                                    ${{$employee->hourly_rate}} USD
                                  </td>
                                    <td class="text-black">
                                        @if($employee->role == 2) 
                                            Service Manager
                                        @elseif($employee->role == 3) 
                                            Inventory Manager
                                        @else 
                                            @php
                                                $role = $roles2->where('id', $employee->role)->first();
                                            @endphp
                                            @if($role)
                                                {{$role->name}}
                                            @endif
                                        @endif
                                    </td>
                                  <td>
                                    {{$employee->phone_number}}
                                  </td>
                                  <td class=" d-flex">
                                    <a href='{{url("admin/employee-shifts/$employee->id")}}' class="btn-sm main-color-bg text-white mr-1" title="Shifts">Shifts</a>
                                    <a href="#" class="btn-sm main-color-bg text-white mr-1" title="Edit" onclick="editEmployee('{{$employee->id}}')"><i class='bx bxs-edit-alt' ></i></a>
                                    <a href="#" class="btn-sm dangerButton text-white mr-1" title="Delete" onclick="deleteEmployee('{{$employee->id}}')"><i class='bx bxs-trash'></i></a>
                                    <?php
                                    if($users->contains('manager_id',"$employee->id")){
                                        ?>
                                        <a href="#" class="btn-sm successButton text-white" title="Account created" ><i class='bx bxs-user-check'></i></a>
                                        <?php
                                    }else{
                                        if($roles->contains('id',"$employee->role")){
                                        ?>
                                        <a href="#" class="btn-sm btn-info text-white" title="Create Account" onclick="accountEmployee('{{$employee->id}}')"><i class='bx bxs-user-account' ></i></a>
                                        <?php
                                        }
                                    } 
                                    ?>
                                </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                  </div>
            </div>
        </div>
        <!-- products -->
        <div id="productPage" style="display: none" class="content border border">
            <form>
                <div class="d-flex justify-content-end mr-5 mb-4 ">
                    <div class="input-group col-3">
                        <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn hover shadow-sm border" required data-mdb-ripple-init>search</button>
                    </div>
                </div>
            </form>

            <div class=" successButton position-fixed d-flex justify-content-center text-center align-items-center pt-4 p-2 shadow-lg" style="font-size:5rem;bottom: 2rem; right:1%;height:4rem ;width:4rem;z-index:99999; border-radius:0.6rem;">
                <a class="text-white" onclick="createProduct()"><i class='bx bx-plus'></i></a>
            </div>

            @foreach ( $categories as $category)
            @foreach ( $category->products as $product)
             <div id="{{$product->id}}editProduct"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.update_product')}}" method="POST">
                @csrf
                <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                    <a onclick="editProductHide({{$product->id}})" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                    <i class='bx bx-x'></i>
                    </a>
                    <div class="mt-4 mb-4 d-flex justify-content-center flex-column">
                        <select class="rounded-3 form-control" name="category" required >
                            @foreach($categories as $category)
                            <option @if($product->category_id == $category->id) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class=" form-control mt-2" value="{{$product->name}}" required name="name" placeholder="Name">
                    <input type="text" class=" form-control mt-2" value="{{$product->price}}" required name="price" placeholder="price">
                    <input type="number" class=" form-control mt-2" value="{{$product->quantity}}" required name="quantity" placeholder="quantity">
                    <input type="hidden" name="id" required value="{{$product->id}}" >
                    <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
                        Update
                    </button>
                </div>
                </form>
            </div>

            <div id="{{$product->id}}deleteProduct" class="flash-confirm justify-content-center position-fixed" style="display:none;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.delete_product')}}" method="POST">
                    @csrf
                    <div class="alert alert-primary rounded p-4 d-flex justify-content-center position-relative" role="alert">
                        <a onclick="deleteProductHide('{{$product->id}}')" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                            <i class='bx bx-x'></i>
                        </a>
                        <input type="text" class=" form-control mr-1" name="confirmation" placeholder="Type `confirm` to delete!">
                        <input type="hidden" name="id" required value="{{$product->id}}">
                        <button class="btn btn-sm text-white main-color-bg" type="submit">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>

            
            @endforeach
            @endforeach


            <div id="createProduct"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.create_product')}}" method="POST">
                @csrf
                <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                    <a onclick="createProductHide()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                    <i class='bx bx-x'></i>
                    </a>
                    <div id="oldCategory" style="display: block" class="mt-4 mb-4 d-flex justify-content-center flex-column">
                        <select class="rounded-3 form-control" name="category" >
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class=" text-center rounded-3">or</span>
                        <a onclick="toggleCategory()"   class="border btn bg-white rounded-3">New Category</a>
                    </div>
                    <div id="newCategory" class="mt-4 justify-content-center flex-column" style="position:relative;display: none">
                        <a onclick="toggleCategory()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                            <i class='bx bx-x'></i>
                        </a>
                        <input type="text" class=" form-control mt-2" name="newCategory" placeholder="category Name">
                    </div>
                    <input type="text" class=" form-control mt-2" required name="name" placeholder="Product name">
                    <input type="number" class=" form-control mt-2" required name="price" placeholder="Product Price">
                    <input type="number" class=" form-control mt-2" required name="quantity" placeholder="Product Quantity">
                    <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
                        Create
                    </button>
                </div>
                </form>
            </div>


            <div class="container-lg mx-5">

                @if(is_null($products))
                @else
                <div class="col-12 overflow-auto">
                    <div class="card shadow mb-5 text-capitalize" >
                        <div class="card-header border-0 ">
                          <h3 class="mb-0">search result</h3>
                        </div>
                        <div class="table-responsive">
                          <table class="table align-items-center table-flush" style="user-select: none">
                            <thead class="thead-light text-center">
                              <tr>
                                  <th scope="col">Product</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Usage</th>
                                  <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              @foreach ( $products as $product)
                              <tr class="row_customTable">
                                <td>
                                  {{$product->name}}
                                </td>
                                <td>
                                  ${{$product->price}} USD
                                </td>
                                <td>
                                  {{$product->quantity}}
                                </td>
                                <td>
                                  {{$product->usage}}
                                </td>
                                <td class="text-center">
                                  <a href="#" class="btn-sm main-color-bg text-white mr-1" title="Edit" onclick="editProduct('{{$product->id}}')"><i class='bx bxs-edit-alt' ></i></a>
                                  <a class="btn-sm main-color-bg text-white mr-1" href="#" onclick="deleteProduct('{{$product->id}}')"><i class='bx bxs-trash'></i></a>
                              </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                   </div>
              </div>
              @endif

                @foreach ( $categories as $category)
                <div class="col-12 overflow-auto">
                      <div class="card shadow mb-5 text-capitalize" >
                          <div class="card-header border-0 d-flex ">
                            <h3 class="mb-0 mt-1">{{$category->name}}</h3>
                          </div>
                          <div class="table-responsive">
                            <table class="table align-items-center table-flush" style="user-select: none">
                              <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Usage</th>
                                    <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody class="text-center">
                                @foreach ( $category->products as $product)
                                <tr class="row_customTable">
                                  <td>
                                    {{$product->name}}
                                  </td>
                                  <td>
                                    ${{$product->price}} USD
                                  </td>
                                  <td>
                                    {{$product->quantity}}
                                  </td>
                                  <td>
                                    {{$product->usage}}
                                  </td>
                                  <td class="text-center">
                                    <a href="#" class="btn-sm main-color-bg text-white mr-1" title="Edit" onclick="editProduct('{{$product->id}}')"><i class='bx bxs-edit-alt' ></i></a>
                                    <a class="btn-sm main-color-bg text-white mr-1" href="#" onclick="deleteProduct('{{$product->id}}')"><i class='bx bxs-trash'></i></a>
                                    <a class="btn-sm main-color-bg text-white mr-1" href="{{route('admin.show_products',['id'=>$product->id])}}"><i class="menu-icon fa fa-bar-chart"></i></a>
                                </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                     </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- salaries --}}
        <div id="salariesPage" style="display: none" class="content border border">
            
             {{-- @foreach($employees as $employee)
             <div id="{{$employee->id}}editEmployee"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                <form action="{{route('admin.update_employee')}}" method="POST">
                @csrf
                <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                    <a onclick="editEmployeeHide({{$employee->id}})" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                    <i class='bx bx-x'></i>
                    </a>
                    <div class="mt-4 mb-4 d-flex justify-content-center flex-column">
                        <select class="rounded-3 form-control" name="role" required >
                            @foreach($roles as $role)
                            <option @if($employee->role == $role->id) selected @endif  value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            @foreach($roles2 as $role)
                            <option @if($employee->role == $role->id) selected @endif  value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class=" form-control mt-2" value="{{$employee->name}}" required name="name" placeholder="Name">
                    <input type="text" class=" form-control mt-2" value="{{$employee->phone_number}}" required name="phone_number" placeholder="Phone Number">
                    <input type="number" class=" form-control mt-2" value="{{$employee->hourly_rate}}" required name="hourly_rate" placeholder="Hourly Rate">
                    <input type="hidden" name="id" required value="{{$employee->id}}" >
                    <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
                        Update
                    </button>
                </div>
                </form>
            </div> --}}

            @foreach ( $employees as $employee )
                <div id="{{$employee->id}}employeeSalary" class="flash-confirm justify-content-center position-fixed" style="display:none;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
                    <form action="{{route('admin.employee_salary')}}" method="POST">
                        @csrf
                        <div class="alert alert-primary rounded p-4 d-flex justify-content-center position-relative" role="alert">
                            <a onclick="employeeSalaryHide('{{$employee->id}}')" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                                <i class='bx bx-x'></i>
                            </a>
                            <input type="text" class=" form-control mr-1" required name="confirmation" placeholder="Type `confirm` to delete!">
                            <input type="hidden" name="id" required value="{{$employee->id}}">
                            <input type="hidden" name="totalAmount" required value="{{$employee->shifts->sum('totalAmount')}}">
                            <button class="btn btn-sm text-white main-color-bg" type="submit">
                                Confirm
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach

            <div class="container-lg mx-5">
                <div class="row">
                    <div class="col-12 overflow-auto">
                        <div class="card shadow mb-5 text-capitalize" >
                            <div class="card-header border-0">
                            <h3 class="mb-0">Unpaid Employees
                            </h3>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush" style="user-select: none">
                                <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Hourly Rate</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Salary Amount</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach ( $employees as $employee )
                                    @if(is_null($employee->salaries->last()) || $employee->salaries->last()->end_date <= $employee->shifts->last()->created_at)
                                    <tr class="row_customTable">
                                        <td>
                                        {{$employee->name}}
                                        </td>
                                        <td>
                                        ${{$employee->hourly_rate}} USD
                                        </td>
                                        <td class="text-black">
                                            @if($employee->role == 2) 
                                                Service Manager
                                            @elseif($employee->role == 3) 
                                                Inventory Manager
                                            @else 
                                                @php
                                                    $role = $roles2->where('id', $employee->role)->first();
                                                @endphp
                                                @if($role)
                                                    {{$role->name}}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                        ${{$employee->shifts->sum('totalAmount')}} USD
                                        </td>
                                        <td class="">
                                        <a href="#" onclick="employeeSalary({{$employee->id}})" class="btn-sm main-color-bg text-white mr-1" title="Shifts">Submit</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-end">
                        <a href="{{route('admin.salaries')}}" class="btn hover shadow">
                            Salary Records
                        </a>
                    </div>
                </div>
            </div>
        </div>


    <script>
        // Function to show the products
        function salaries() {
        var salary = document.getElementById('salariesPage');
        var product = document.getElementById('productPage');
        var employee = document.getElementById('employeesPage');
        var main = document.getElementById('mainPage');
        salary.style.display = 'block';
        product.style.display = 'none';
        employee.style.display = 'none';
        main.style.display = 'none';
        localStorage.setItem('currentPage', 'salaries');
        }
        function products() {
        var salary = document.getElementById('salariesPage');
        var product = document.getElementById('productPage');
        var employee = document.getElementById('employeesPage');
        var main = document.getElementById('mainPage');
        salary.style.display = 'none';
        product.style.display = 'block';
        employee.style.display = 'none';
        main.style.display = 'none';
        localStorage.setItem('currentPage', 'products');
        }

        // Function to show the employees
        function employees() {
        var salary = document.getElementById('salariesPage');
        var employee = document.getElementById('employeesPage');
        var product = document.getElementById('productPage');
        var main = document.getElementById('mainPage');
        salary.style.display = 'none';
        product.style.display = 'none';
        employee.style.display = 'block';
        main.style.display = 'none';
        localStorage.setItem('currentPage', 'employees');
        }

        // Function to show the main page
        function main() {
        var salary = document.getElementById('salariesPage');
        var employee = document.getElementById('employeesPage');
        var product = document.getElementById('productPage');
        var main = document.getElementById('mainPage');
        salary.style.display = 'none';
        product.style.display = 'none';
        employee.style.display = 'none';
        main.style.display = 'block';
        localStorage.setItem('currentPage', 'main');
        }

        // Function to handle page load
        document.addEventListener("DOMContentLoaded", function(event) {
        var currentPage = localStorage.getItem('currentPage') || 'main';
        if (currentPage === "products") {
            products();
        } else if (currentPage === "employees") {
            employees();
        } else if (currentPage === "salaries") {
            salaries();
        } else {
            main();
        }
        });

        function createEmployee() {
            var div = document.getElementById('createEmployee');
            div.style.display = 'flex';
        }
        function createEmployeeHide() {
            var div = document.getElementById('createEmployee');
            div.style.display = 'none';
        }
        function editEmployee(id) {
            var div = document.getElementById(`${id}editEmployee`);
            div.style.display = 'flex';
        }
        function editEmployeeHide(id){
            var role = document.getElementById(`${id}editEmployee`);
            role.style.display = 'none';
        }
        function deleteEmployee(id){
            var role = document.getElementById(`${id}deleteEmployee`);
            role.style.display = 'flex';
        }
        function deleteEmployeeHide(id) {
            var div = document.getElementById(`${id}deleteEmployee`);
            div.style.display = 'none';
        }
        function accountEmployee(id) {
            var div = document.getElementById(`${id}accountEmployee`);
            div.style.display = 'flex';
        }
        function accountEmployeeHide(id) {
            var div = document.getElementById(`${id}accountEmployee`);
            div.style.display = 'none';
        }
        
        
        function showRole(){
            var role = document.getElementById('showRole');
            role.style.display = 'block';
        }
        function hideRole(){
            var role = document.getElementById('showRole');
            role.style.display = 'none';
        }

        // product functions

        function createProduct(){
            var product = document.getElementById('createProduct');
            product.style.display = 'block';
        }
        function createProductHide(){
            var product = document.getElementById('createProduct');
            product.style.display = 'none';
        }
        function toggleCategory() {
            var newCategory = document.getElementById('newCategory');
            var oldCategory = document.getElementById('oldCategory');

            if (newCategory.style.display === 'none') {
                newCategory.style.display = 'block';
                oldCategory.style.display = 'none';
            } else {
                newCategory.style.display = 'none';
                oldCategory.style.display = 'block';
            }
        }

        function editProduct(id){
            var product = document.getElementById(`${id}editProduct`);
            product.style.display = 'block';
        }
        function editProductHide(id){
            var product = document.getElementById(`${id}editProduct`);
            product.style.display = 'none';
        }
        function deleteProduct(id){
            var product = document.getElementById(`${id}deleteProduct`);
            product.style.display = 'block';
        }
        function deleteProductHide(id){
            var product = document.getElementById(`${id}deleteProduct`);
            product.style.display = 'none';
        }
        function employeeSalary(id){
            var product = document.getElementById(`${id}employeeSalary`);
            product.style.display = 'block';
        }
        function employeeSalaryHide(id){
            var product = document.getElementById(`${id}employeeSalary`);
            product.style.display = 'none';
        }
        






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

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            var incomes = @php echo json_encode($chartIncomes); @endphp;
            var expenses = @php echo json_encode($chartExpenses); @endphp;

            var labels = Array.from({length: 30}, (_, i) => (i));
            var incomeSeries = labels.map((label, index) => incomes[index + 1] ? incomes[index + 1] : 0);
            var expenseSeries = labels.map((label, index) => expenses[index + 1] ? expenses[index + 1] : 0);
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                    labels: labels,
                    series: [
                        incomeSeries,
                        expenseSeries,
                    ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
</body>
</html>
