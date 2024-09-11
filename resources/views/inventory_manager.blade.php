<?php
session()->start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/messages.css')}}">
    
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
  
  <title>Inventory Manager Page</title>
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
  </style>
</head>
<body>
  <div id="createProduct"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
    <form action="{{route('inventory_manager.create_product')}}" method="POST">
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
            <a onclick="toggleCategory()" class="border btn bg-white rounded-3">New Category</a>
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
    @if(session('edit_product'))
    <div id="editDiv"  class="flash-confirm justify-content-center position-fixed" style="display:flex;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
      <form action="{{route('inventory_manager.update')}}" method="POST">
        @csrf
        <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
          <a onclick="editDiv()" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
            <i class='bx bx-x'></i>
          </a>
          <select class="mb-4 mt-3 rounded-3 form-control" name="category" >
            @foreach($category as $cate)
                <option value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
          </select>
          <input type="text" value="{{session('edit_product.product')->name}}" class=" form-control mt-2" required name="name" placeholder="Product Name">
          <input type="number" value="{{session('edit_product.product')->price}}" class=" form-control mt-2" required name="price" placeholder="Product Price">
          <input type="number" value="{{session('edit_product.product')->quantity}}" class="form-control mt-2" required name="quantity" placeholder="Product Quantity">
          <input type="hidden" value="{{session('edit_product.product')->id}}" name="id" required>
          <button class="btn btn text-white main-color-bg mt-2 mb-2" type="submit">
              Update
          </button>
        </div>
      </form>
    </div>
    @endif
    <div class="container-lg mx-5">
      @if(session('message'))
      <div class="flash-message justify-content-center position-fixed" style="display:flex;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
        <div class="{{session('message.bootstrap_class')}}" role="alert">
          {{session('message.status')}}.
        </div>
      </div>
      @endif

      @if(!is_null($products))
        @foreach ( $products as $product)
          <div id="{{$product->id}}editProduct"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
            <form action="{{route('inventory_manager.update_product')}}" method="POST">
            @csrf
            <div class="alert alert-primary rounded p-3 d-flex justify-content-center flex-column position-relative" role="alert">
                <a onclick="editProductHide({{$product->id}})" type="button" style="position:absolute;top:1px;right:1px;width:1.5rem" class=" text-center border-0 text-white rounded shadow-sm  btn-danger">
                <i class='bx bx-x'></i>
                </a>
                <div class="mt-4 mb-4 d-flex justify-content-center flex-column">
                    <select class="rounded-3 form-control" name="category" required >
                        @foreach($category as $cate)
                        <option @if($product->category_id == $cate->id) selected @endif  value="{{$cate->id}}">{{$cate->name}}</option>
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
        @endforeach
      @endif

      @if(!is_null($categories))
      @foreach ( $categories as $category)
        @foreach ( $category->products as $product)
          <div id="{{$product->id}}editProduct"  class="flash-confirm justify-content-center position-fixed" style="display:none;top:40%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
            <form action="{{route('inventory_manager.update_product')}}" method="POST">
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
        @endforeach
      @endforeach
      @endif
      
        <div class="row justify-content-center">
          <!-- Main content -->
          <div class="col-lg-8 my-3 position-relative">
            <div class=" successButton position-fixed d-flex justify-content-center text-center align-items-center pt-4 p-2 shadow-lg" style="font-size:5rem;bottom: 2rem; right:33%;height:4rem ;width:4rem;z-index:99999; border-radius:0.6rem;">
              <a class="text-white" onclick="createProduct()"><i class='bx bx-plus'></i></a>
            </div>
            <div class="row text-left mb-5 navbarr border-bottom pb-4">
              <div class="col-lg-4 mb-3 mb-sm-0 ml-auto">
                <div class="main-search-input fl-wrap border position-relative" >
                    <form>
                        <div class="main-search-input-item">
                            <input id="search" type="text" name="search" value="{{$search}}" autocomplete="off" placeholder="Search Products...">
                        </div>
                        <button type="submit" class="main-search-button">Search</button>
                    </form>
                    <div class="text-capitalize text-center text-justify position-fixed rounded px-1 py-2" style="z-index: 9999;top:4.5rem;font-size:13px;" id="content"></div>
                </div>
              </div>
              <div class="col-lg-4  col-sm-2 mb-3 mb-sm-0">
                <div class=" bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
                    <div class="form-control justify-content-center text-center form-control-lg pt-3 btn h-100 bg-white" style="z-index: 99999">
                      <div class="dropdown custom-dropdown" >
                        <a href="#" data-toggle="dropdown" class="dropdown-link" aria-haspopup="true" aria-expanded="false">
                        <h6><span class="main-color-text"><i class='bx bxs-category' ></i></span>
                          CATEGORIES <span class="icon-keyboard_arrow_down arrow"></span></h6>
                        </a>
                        <div class="dropdown-menu dropdown-menu2 d-flex  row" aria-labelledby="dropdownMenuButton" >
                          <div class="col-lg-3 col-5 py-2">
                            @foreach ( $categories as $cate)
                                <a href='{{url("inventory_manager/dashboard/?categoryButton=$cate->id")}}'>{{$cate->name}}</a>
                            @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
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
                        <span class="text-truncate">Inventory Manager</span>
                      </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                      <a class="dropdown-item" href="{{ route('inventory_manager.dashboard') }}"><span class="mr-2"><i class='bx bxs-dashboard' ></i></span>My Dashboard</a>
                      <a class="dropdown-item" href="{{ route('profile.show') }}"><span class="icon icon-cog mr-2"></span>Profile Settings</a>
                      <a class="dropdown-item" href="{{ route('inventory_manager.records') }}"><span class="mr-2"><i class='bx bx-history'></i></span>My Purchases records</a>
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
                    @if(!is_null($products))
                    <div class="col-12 overflow-auto">
                        <div class="card shadow mb-5 text-capitalize">
                            <div class="card-header border-0">
                              <h3 class="mb-0">Search Result</h3>
                            </div>
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush table-hover" style="user-select: none">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Usage</th>
                                    <th scope="col">action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ( $products as $product)
                                  <tr @if($product->quantity == 0)style="background-color: rgba(159, 4, 7, 0.5); color: black" @endif>
                                    <th onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');" scope="row">
                                      <div class="media align-items-center">
                                        <a href="#" >
                                          <img class="avatar rounded-circle mr-3" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">{{$product->name}}</span>
                                        </div>
                                      </div>
                                    </th>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      ${{$product->price}} USD
                                    </td>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      <span class="badge badge-dot mr-4">
                                        <i style="height: 6px; width;5px; border-radius: 50%; background-color:
                                        <?php
                                              $usage = (int)$product->quantity;
                                              
                                              if ($usage >= 61){
                                                echo 'green';
                                              }
                                              if ($usage < 61 && $usage >= 31){
                                                echo 'blue';
                                              }
                                              if ($usage < 31 && $usage >= 21){
                                                echo 'yellow';
                                              }
                                              if ($usage < 21 && $usage > 0){
                                                echo 'red';
                                              }
                                              if ($usage == 0){
                                                echo 'black';
                                              }
                                            ?>
                                         " ></i> {{$product->quantity}} unit
                                      </span>
                                    </td>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      <div class="d-flex align-items-center">
                                        <span class="mr-2">{{$product->usage}}%</span>
                                        <div>
                                          <div class="progress">
                                            <div class="progress-bar 
                                            <?php
                                              $usage = (int)$product->usage;
                                              
                                              if ($usage > 60){
                                                echo 'bg-success';
                                              }
                                              if ($usage < 60 && $usage > 41){
                                                echo 'bg-info';
                                              }
                                              if ($usage < 41 && $usage > 21){
                                                echo 'bg-warning';
                                              }
                                              if ($usage < 21 && $usage > 0){
                                                echo 'bg-danger';
                                              }
                                              if ($usage = 0){
                                                echo 'bg-secondary';
                                              }
                                            ?> 
                                            " role="progressbar" aria-valuenow="{{$product->usage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$product->usage}}%;"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td class="text-right">
                                      <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light main-color-bg" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bxs-left-arrow-circle' style='color:#f4f4f4'  ></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="#" onclick="editProduct('{{$product->id}}')">Edit</a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                    </div>
                    @else
                    <div class="col-12 overflow-auto">
                      @foreach ( $categories as $category)
                        <div class="card shadow mb-5 text-capitalize" >
                            <div class="card-header border-0">
                              <h3 class="mb-0">{{$category->name}} category</h3>
                            </div>
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush" style="user-select: none">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Usage</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ( $category->products as $product)
                                  <tr class="row_customTable"  @if($product->quantity == 0)style="background-color: #b3cee5; color: black" @endif>
                                    <th onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');" scope="row">
                                      <div class="media align-items-center">
                                        <a href="#" >
                                          <img class="avatar rounded-circle mr-3" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">{{$product->name}}</span>
                                        </div>
                                      </div>
                                    </th>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      ${{$product->price}} USD
                                    </td>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      <span class="badge badge-dot mr-4">
                                        <i style="height: 6px; width;5px; border-radius: 50%; background-color:
                                        <?php
                                              $usage = (int)$product->quantity;
                                              
                                              if ($usage >= 61){
                                                echo 'green';
                                              }
                                              if ($usage < 61 && $usage >= 31){
                                                echo 'blue';
                                              }
                                              if ($usage < 31 && $usage >= 21){
                                                echo 'yellow';
                                              }
                                              if ($usage < 21 && $usage > 0){
                                                echo 'red';
                                              }
                                              if ($usage == 0){
                                                echo 'black';
                                              }
                                            ?>
                                         " ></i> {{$product->quantity}} unit
                                      </span>
                                    </td>
                                    <td onclick="showItemInfo('{{$product->name}}', '{{$product->price}}','{{$product->id}}','{{$product->quantity}}');">
                                      <div class="d-flex align-items-center">
                                        <span class="mr-2">{{$product->usage}}%</span>
                                        <div>
                                          <div class="progress">
                                            <div class="progress-bar 
                                            <?php
                                              $usage = (int)$product->usage;
                                              
                                              if ($usage > 60){
                                                echo 'bg-success';
                                              }
                                              if ($usage < 60 && $usage > 41){
                                                echo 'bg-info';
                                              }
                                              if ($usage < 41 && $usage > 21){
                                                echo 'bg-warning';
                                              }
                                              if ($usage < 21 && $usage > 0){
                                                echo 'bg-danger';
                                              }
                                              if ($usage = 0){
                                                echo 'bg-secondary';
                                              }
                                            ?> 
                                            " role="progressbar" aria-valuenow="{{$product->usage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$product->usage}}%;"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                    <td class="text-right">
                                      <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light main-color-bg" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bxs-left-arrow-circle' style='color:#f4f4f4'  ></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="#" onclick="editProduct('{{$product->id}}')">Edit</a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
          </div>
          <!-- sticky-sidebar -->
          <div class="col-lg-4 mb-3 h-100 position-relative">
            <div class="sidebar main-color-bg rounded shadow-lg" >
              <form action="{{url('inventory_manager/dashboard')}}" method="POST">
                @csrf
				      <div class="text-center text-white ">
                <div class="custom-table-responsivee table-overflow">
                  <table class="table custom-tablee" style="user-select: none;">
                    <thead class="text-white">
                      <tr>
                        <th scope="col" class="px-0 shadow">Product</th>
                        <th scope="col" class="px-0 shadow">Old Price</th>
                        <th scope="col" class="px-0 shadow">New Price</th>
                        <th scope="col" class="px-0 shadow">Quantity</th>
                        <th scope="col" class="px-0 pr-4">Total</th>
                      </tr>
                    </thead>
                    <tbody id="sidebar">
                    </tbody>
                  </table>
                </div>
					    </div> 
					<div class="text-sm">
						<hr class="my-0" style="background-color:rgb(113, 113, 247)">
						<div class="row d-flex flex-row op-7">
							<div class="col-sm-6 flex-ew text-center py-3 mx-0 text-light" style="border-right:solid 1px rgb(113, 113, 247)"> <a class="d-block lead font-weight-bold text-white" id="totalProducts"  href="#" >0</a> Total Products </div>
							<div class="col-sm-6 flex-ew text-center py-3 mx-0 text-light"> <a class="d-block lead font-weight-bold text-white" id="totalPrice" href="#" >0.00$</a> Total Price </div>
						</div>
					</div>
					<button type="submit" class="btn btn-lg btn-block text-white successButton rounded-0 roboto-bold">Done</button>
          </form>
					<a class="btn btn-lg btn-block dangerButton text-white rounded-0 roboto-bold" onclick="clearAllItems()" href="#">Cancel</a>
				</div> 
          </div>  
        </div>
    </div>
</div>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  <script>
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

    function confirmDiv() {
      var div = document.getElementById('confirmDiv');
      div.style.display = 'none';
    }
    function editDiv() {
      var div = document.getElementById('editDiv');
      div.style.display = 'none';
    }
    function editProduct(id){
        var product = document.getElementById(`${id}editProduct`);
        product.style.display = 'block';
    }
    function editProductHide(id){
        var product = document.getElementById(`${id}editProduct`);
        product.style.display = 'none';
    }

    // Show the flashed message
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
  <script type="text/javascript">
  function updateTotals() {
  var quantityElements = document.querySelectorAll('.quantity');
  var priceElements = document.querySelectorAll('.price');
  var totalProducts = 0;
  var totalPrice = 0;

  for (var i = 0; i < quantityElements.length; i++) {
    var quantity = parseInt(quantityElements[i].value);
    var price = parseFloat(priceElements[i].value);
    var productTotalPrice = quantity * price;
    totalProducts += quantity;
    totalPrice += productTotalPrice;
  }

  document.getElementById('totalProducts').innerText = `${totalProducts}`;
  document.getElementById('totalPrice').innerText = `${totalPrice.toFixed(2)}$`;
}

  function updateTotal(id, quantity, newPrice) {
    const total = newPrice * quantity;
    document.getElementById(`${id}Total`).innerText = `${total}$`;
    updateTotals();
  }
  function clearAllItems() {
    addedItems = [];
    window.location.reload();
  }
  function removeItem(id) {
    var elements = document.getElementsByClassName(id);
    while (elements.length > 0){
      elements[0].remove();
    }
    addedItems = addedItems.filter(item => item != id);
    updateTotals();
  }
  function showItemInfo(name, price, id, quantity) {
  if (addedItems.includes(id)) {
    return;
  } else {
    addedItems.push(id);
    let sidebar = document.getElementById('sidebar');
    let newRow = document.createElement('tr');
    newRow.className = "shadow "+id;

    let newContent = `
      <td class="text-truncate px-0 ">
        <button onclick="removeItem('${id}')" type="button" class="border-0 rounded shadow-sm ml-0 mr-2 btn-danger">
          <i class='bx bx-x'></i>
        </button>
        ${name}
      </td>
      <td class="px-0">
        ${price}$
      </td>
      <td class="px-0">
        <div class="input-group w-auto justify-content-center px-0">
          <input type="number" class="text-center rounded price" style="width: 4em;" step="10" value="0" name="NewPrice[${id}]" id="${id}NewPrice" oninput="updateTotal('${id}', this.value, document.getElementById('${id}quantity').value)">
          <input type="hidden" name="product_id[${id}]" value="${id}">
        </div>
      </td>
      <td class="px-0">
        <input type="number" class="text-center rounded quantity" style="width: 4em;" step="10" value="0" name="quantity[${id}]" id="${id}quantity" oninput="updateTotal('${id}', this.value, document.getElementById('${id}NewPrice').value)">
      </td>
      <td class="px-0" id="${id}Total">
        0$
      </td>
    `;

    newRow.innerHTML = newContent;
    sidebar.appendChild(newRow);
    updateTotals();

  }
}
  var addedItems = [];

  $('#search').on('keyup',function(){
    $value = $(this).val();
    if($value.trim() === '' ){
      $('#content').empty();
    }else{
    $.ajax({
      type:'get',
      url:'{{URL::to('inventory_manager/search')}}',
      data:{'search':$value},
      success:function(data){
        console.log(data);
        $('#content').html(data);
      }
    });}
  })
</script>
  <script>function incrementValue(e) {
      e.preventDefault();
      var fieldName = $(e.target).data('field');
      var parent = $(e.target).closest('div');
      var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

      if (!isNaN(currentVal)) {
          parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
      } else {
          parent.find('input[name=' + fieldName + ']').val(0);
      }
  }

  function decrementValue(e) {
      e.preventDefault();
      var fieldName = $(e.target).data('field');
      var parent = $(e.target).closest('div');
      var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

      if (!isNaN(currentVal) && currentVal > 0) {
          parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
      } else {
          parent.find('input[name=' + fieldName + ']').val(0);
      }
  }

  $('.input-group').on('click', '.button-plus', function(e) {
      incrementValue(e);
  });

  $('.input-group').on('click', '.button-minus', function(e) {
      decrementValue(e);
  });
</script>
</body>
</html>