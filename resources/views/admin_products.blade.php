<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('ElaAdmin/assets/css/cs-skin-elastic.css')}}">
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

<body class="bg-light">

    <div id="markup" class="flash-confirm justify-content-center position-fixed" style="display:none;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
        <form action="{{route('admin.update_Product_markup')}}" method="POST">
            @csrf
            <div class="alert alert-primary rounded p-4 d-flex justify-content-center flex-column position-relative" role="alert">
                <a onclick="markupHide()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                    <i class='bx bx-x'></i>
                </a>
                <input type="text" class=" form-control mt-2 mr-1" name="confirmation" required placeholder="Type `confirm` to change!">
                <input type="number" max="100" min="0" class=" form-control mt-2 mr-1" value="{{$product->markup}}" name="markup" required placeholder="set New Markup">
                <input type="hidden" name="id" value="{{$product->id}}">
                <button class="btn btn-sm text-white main-color-bg mt-2" type="submit">
                    Set
                </button>
            </div>
        </form>
    </div>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand text-capitalize" href="#">Product Name: {{$product->name}}</a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="{{asset('ElaAdmin/images/avatar/1.jpg')}}"></span>
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
                            <img class="user-avatar rounded-circle" src="{{asset('ElaAdmin/images/admin.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('profile.show') }}"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="dropdown-item" href="{{ route('logout') }}">Log out</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
    </div>

    <div class="container-lg">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="row justify-content-center">
                    <div class="col-2 bg-white shadow-sm mr-5 d-flex justify-content-center align-items-center" style="height: 5rem;" ><i class="fa-solid fa-cart-shopping main-color-text " style="font-size:2.5rem"></i><div class="d-flex flex-column ml-3"><span>{{$total_purchases}}$</span><span style="color:gray;font-size:.7rem">Total Purchase</span></div></div>

                    <div class="col-2 bg-white shadow-sm mx-5 d-flex justify-content-center align-items-center" style="height: 5rem;" ><i class="fa-solid fa-list-ol main-color-text " style="font-size:2.5rem"></i><div class="d-flex flex-column ml-3"><span>{{$total_purchases_quantity}} Unit</span><span style="color:gray;font-size:.7rem">Product Purchase Quantity</span></div></div>
                    
                    <div class="col-2 bg-white shadow-sm mx-5 d-flex justify-content-center align-items-center" style="height: 5rem;" ><i class="fa-solid fa-money-bill-wave main-color-text " style="font-size:2.5rem"></i><div class="d-flex flex-column ml-3"><span>{{$total_sales}}$</span><span style="color:gray;font-size:.7rem">Total Sales</span></div></div>
                    
                    <div class="col-2 bg-white shadow-sm ml-5 d-flex justify-content-center align-items-center" style="height: 5rem;" ><i class="fa-solid fa-list-ol main-color-text " style="font-size:2.5rem"></i><div class="d-flex flex-column ml-3"><span>{{$total_sales_quantity}} Unit</span><span style="color:gray;font-size:.7rem">Product Sales Quantity </span></div></div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="row justify-content-start mx-2 px-4">
                    <div class="col-5 text-black  ml-5" style="height:20rem">
                        <div id="purchaseChart" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="col-5 text-black  ml-auto mr-5" style="height:20rem">
                        <div id="salesChart" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 justify-content-center d-flex" style="margin-top:6rem">
                <a href="#" onclick="markup()" class="btn btn-sm btn-primary main-color-bg text-white shadow-sm d-flex justify-content-center align-items-center" style="height: 3rem;" >Change Markup </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function () {
        
        let PurchaseData = {!! json_encode($PurchasedChartData) !!};

        // Create an array to store the data points for the chart
        let PurchasedataPoints = [];

        // Iterate through the sales data and create the data points
        PurchaseData.forEach(function(sale, index) {
            PurchasedataPoints.push({ x: index + 1, y: sale.y }); // Assuming x values are 1, 2, 3, ...
        });

        // Create the chart using the modified dataPoints array
        var purchaseChart = new CanvasJS.Chart("purchaseChart", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "{{$product->name}} Purchase History"
            },
            data: [{
                type: "line",
                indexLabelFontSize: 16,
                dataPoints: PurchasedataPoints // Set the dataPoints array created dynamically
            }]
        });
        purchaseChart.render();


        
        // Extract the product sales data (chartData) from the backend (passed from the controller)
        let chartData = {!! json_encode($chartData) !!};

        // Create an array to store the data points for the chart
        let dataPoints = [];

        // Iterate through the sales data and create the data points
        chartData.forEach(function(sale, index) {
            dataPoints.push({ x: index + 1, y: sale.y }); // Assuming x values are 1, 2, 3, ...
        });

        // Create the chart using the modified dataPoints array
        var salesChart = new CanvasJS.Chart("salesChart", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "{{$product->name}} Sales History"
            },
            data: [{
                type: "line",
                indexLabelFontSize: 16,
                dataPoints: dataPoints // Set the dataPoints array created dynamically
            }]
        });
        salesChart.render();
        
        }
        </script>
   <script>
    function markup(){
        var markup = document.getElementById('markup');
        markup.style.display = 'block';
    }
    function markupHide(){
        var markup = document.getElementById('markup');
        markup.style.display = 'none';
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
    <script src="https://kit.fontawesome.com/efdf57bf14.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{asset('ElaAdmin/assets/js/main.js')}}"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

</body>
</html>
