<?php
session()->start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">
    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/code.css')}}">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<!-- font links  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200&display=swap" rel="stylesheet">
  <title>Admin Purchases Page</title>
</head>
<body>
    <div class="container-lg">
        <div class="row justify-content-center">
          <!-- Main content -->
          <div class="col-lg-10 justify-content-center my-3">
            <div class="row text-left mb-5 navbarr border-bottom pb-4">
              <div class="col-lg-4  col-sm-2 mb-3 mb-sm-0">
                <div class="bg-op-9 text-sm w-lg-50" style="width: 100%;">
                  <form >
                  <div class="form-group d-flex">
                    <button type="submit" class="btn btn-white d-flex align-items-center" style="height: 2.5rem"> Search</button>
                    <div id="filterDate2" class="w-50">
                      <input id="datepicker" name="date" width="276" required placeholder="Select date and Type time" autocomplete="off" />
                    </div>  
                  </div>
                </form>  
                </div>
              </div>
              <div class="col-lg-2  col-sm-2 mb-3 mb-sm-0 ml-auto">
                <div class="dropdown custom-dropdown">
                    <a href="#" data-toggle="dropdown" class="d-flex justify-content-end align-items-center dropdown-link text-left" aria-haspopup="true" aria-expanded="false" data-offset="0, 20">
                      <div class="profile-pic mr-3 textt">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Image">
                      </div>
                      <div class="profile-info text-capitalize">
                        <h3>{{ Auth::user()->name }}</h3>
                        <span class="text-truncate">Admin</span>
                      </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                      <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><span class="mr-2"><i class='bx bxs-dashboard' ></i></span>My Dashboard</a>
                      <a class="dropdown-item" href="{{ route('profile.show') }}"><span class="icon icon-cog mr-2"></span>Profile Settings</a>
                      <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="dropdown-item" href="{{ route('logout') }}"><span class="icon icon-sign-out mr-2"></span>Log out</button>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
            <!-- End of post 1 -->
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 overflow-auto">
                      @foreach($groupedPurchasesWithTotal as $date => $groupData)
                        <div class="card shadow mb-5 text-capitalize" >
                            <div class="card-header border-0">
                              <h6 class="mb-0">Record Data: {{$date}} </h6>
                            </div>
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush table-hover" style="user-select: none">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Manager</th>
                                    <th scope="col">Old Price</th>
                                    <th scope="col">Markup</th>
                                    <th scope="col">Purchased Price</th>
                                    <th scope="col">Selling Price</th>
                                    <th scope="col">Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($groupData['purchases'] as $product)
                                  <tr>
                                    <th scope="row">
                                      <div class="media align-items-center">
                                        <a href="#" >
                                          <img class="avatar rounded-circle mr-3" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">
                                            {{$product->product->name}}
                                          </span>
                                        </div>
                                      </div>
                                    </th>
                                    <td>
                                      {{$product->employee->name}}
                                    <td>
                                      ${{$product->oldPrice}} USD
                                    </td>
                                    <td>
                                      {{$product->markup}} Percent
                                    </td>
                                    <td>
                                      ${{$product->oldPrice + ($product->oldPrice*$product->markup / 100) }} USD
                                    </td>
                                    <td>
                                      ${{$product->price }} USD
                                    </td>
                                    <td>
                                      <span  class="text-black mr-4">
                                        {{$product->quantity}} unit
                                      </span>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Total Amount: {{$groupData['total_amount']}}$</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>
<script>
  $('#datepicker').datepicker({
    format: "yyyy-mm-dd",
    uiLibrary: 'bootstrap5',
  });
</script>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
  
</body>
</html>