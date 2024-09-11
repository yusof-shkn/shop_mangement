<?php
session()->start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">

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
  <title>Service Manager Page</title>
  <style>
    
    .flash-message {
        display: none;
        animation: slideIn 0.5s, slideOut 0.5s 4.5s; /* Apply the slide-in and slide-out animations with a delay of 4.5s */
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
     @if(session('message'))
      <div class="flash-message justify-content-center position-fixed" style="display:flex;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
        <div class="{{session('message.bootstrap_class')}}" role="alert">
          {{session('message.status')}}.
        </div>
      </div>
      @endif
    <div class="container-lg mx-5">
        <div class="row justify-content-center">
          <!-- Main content -->
          <div class="col-lg-8 my-3">
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
                            @foreach ( $category as $categoryButton)
                                <a href='{{url("service_manager/dashboard/?category=$categoryButton->name")}}'>{{$categoryButton->name}}</a>
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
                        <span class="text-truncate">@if(Auth::user()->role == 3)Service Manager @endif</span>
                      </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                      <a class="dropdown-item" href="{{ route('service_manager.dashboard') }}"><span class="mr-2"><i class='bx bxs-dashboard' ></i></span>My Dashboard</a>
                      <a class="dropdown-item" href="{{ route('profile.show') }}"><span class="icon icon-cog mr-2"></span>Profile Settings</a>
                      <a class="dropdown-item" href="{{ route('service_manager.records') }}"><span class="mr-2"><i class='bx bx-history'></i></span>My Sales records</a>
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
                    @if(isset($products))
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
                                    <th scope="col">status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ( $products as $product)
                                  <tr id="{{$product->id}}selectedBg" @if($product->quantity > 0) onclick="showItemInfo('{{$product->name}}','{{$product->price}}','{{$product->id}}','{{$product->quantity}}')"@endif @if($product->quantity == 0)style="background-color: #b3cee5; color: black" @endif>
                                    <th scope="row">
                                      <div class="media align-items-center">
                                        <a href="#" >
                                          <img class="avatar rounded-circle mr-3" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">{{$product->name}}</span>
                                        </div>
                                      </div>
                                    </th>
                                    <td>
                                      ${{$product->price}} USD
                                    </td>
                                    <td>
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
                                    <td>
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
                                    <td id="{{$product->id}}selectedIcon" @if($product->quantity == 0) onclick="showItemInfo2('{{$product->name}}','{{$product->price}}','   {{$product->id}}','{{$product->quantity}}')" @endif style="font-size: 0,5rem;">
                                      @if($product->quantity == 0)<a href="#" onMouseOver="this.style.color='#0F0'"
                                      onMouseOut="this.style.color='black'" style="color:black;">Call Back<i class='bx bx-revision'></i></a>
                                      @else<span style="color:black;">Click Able<i class='bx bx-mouse-alt' ></i></span>@endif
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
                                    <th scope="col">status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ( $category->products as $product)
                                  <tr class="row_customTable" id="{{$product->id}}selectedBg" @if($product->quantity > 0) onclick="showItemInfo('{{$product->name}}','{{$product->price}}','{{$product->id}}','{{$product->quantity}}')"@endif @if($product->quantity == 0)style="background-color: #b3cee5; color: black" @endif>
                                    <th scope="row">
                                      <div class="media align-items-center">
                                        <a href="#" >
                                          <img class="avatar rounded-circle mr-3" alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">{{$product->name}}</span>
                                        </div>
                                      </div>
                                    </th>
                                    <td>
                                      ${{$product->price}} USD
                                    </td>
                                    <td>
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
                                    <td>
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
                                    <td id="{{$product->id}}selectedIcon" @if($product->quantity == 0) onclick="showItemInfo2('{{$product->name}}','{{$product->price}}','   {{$product->id}}','{{$product->quantity}}')" @endif style="font-size: 0,5rem;">
                                      @if($product->quantity == 0)<a href="#" onMouseOver="this.style.color='#0F0'"
                                      onMouseOut="this.style.color='black'" style="color:black;">Call Back<i class='bx bx-revision'></i></a>
                                      @else<span style="color:black;">Click Able<i class='bx bx-mouse-alt' ></i></span>@endif
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
              <form action="{{url('service_manager/dashboard')}}" method="POST">
                @csrf
				      <div class="text-center text-white ">
                <div class="custom-table-responsivee table-overflow">
                  <table class="table custom-tablee" style="user-select: none;">
                    <thead class="text-white">
                      <tr>
                        <th scope="col" class="px-0 shadow">Product</th>
                        <th scope="col" class="px-0 shadow">Price</th>
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
							<div id="totalProducts" class="col-sm-6 flex-ew text-center py-3 mx-0 text-light" style="border-right:solid 1px rgb(113, 113, 247)"> <a class="d-block lead font-weight-bold text-white" href="#" >0</a> Total Products </div>
							<div id="totalPrice" class="col-sm-6 flex-ew text-center py-3 mx-0 text-light"> <a class="d-block lead font-weight-bold text-white" href="#" >0$</a> Total Price </div>
						</div>
					</div>
					<button type="submit" class="btn btn-lg btn-block successButton text-white rounded-0 roboto-bold">Done</button>
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
    var quantityElements = document.querySelectorAll('.quantity'); // Get all quantity elements
    var priceElements = document.querySelectorAll('.price'); // Get all price elements
    var totalProducts = 0;
    var totalPrice = 0;

    quantityElements.forEach(function(element, index) {
      var quantity = parseInt(element.value);
      
      if (!isNaN(quantity)) {
        totalProducts += quantity;
        totalPrice += quantity * parseFloat(priceElements[index].innerText.replace('$', ''));
      }
    });

    document.getElementById('totalProducts').innerHTML =`<a class="d-block lead font-weight-bold text-white" href="#" >${totalProducts}</a> Total Products`;
    document.getElementById('totalPrice').innerHTML = `
    <a class="d-block lead font-weight-bold text-white" href="#" >${totalPrice.toFixed(2)}$</a> Total Price`;
  }

  function updateTotal(name, price, quantity) {
    const total = price * quantity;
    document.getElementById(`${name}Total`).innerText = `${total}$`;
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
    var selected = document.getElementById(`${id}selectedBg`);
    selected.style.backgroundColor = 'white';
    document.getElementById(`${id}selectedIcon`).innerHTML = `<span style="color:black;">Click Able<i class='bx bx-mouse-alt' ></i></span>`;
    updateTotals();
  }
  var addedItems = [];

  function showItemInfo2(price,id,quantity) {
    if(addedItems.includes(id)){
      return;
    }else{
    addedItems.push(id);
  document.getElementById('sidebar').innerHTML += `
  <tr scope="row" class="shadow ${id}">
    <td class="text-truncate px-0">
      <button onclick="removeItem('${id}')" type="button" class="border-0 rounded shadow-sm ml-0 mr-2 btn-danger">
        <i class='bx bx-x'></i>
      </button>
      ${name}</td>
    <td class="px-0 price">
      ${price}$
    </td>
    <td class="px-0">
      <div class="input-group w-auto justify-content-center px-0">
          <input type="number" step="1" max="${quantity}" value="0" name="quantity[${id}]" class=" text-center rounded quantity" style="width: 4em; id="${id}Quantity" oninput="updateTotal('${id}', ${price}, this.value)">
          <input type="hidden" name="product_id[${id}]" value="${id}">
      </div>
    </td>
    <td class="px-0" id="${id}Total">
      ${price}$
    </td>
  </tr>
  <tr class="spacer"><td colspan="100"></td></tr>
  `;
  var selected = document.getElementById(`${id}selectedBg`);
  selected.style.backgroundColor = '#6699CC';
  document.getElementById(`${id}selectedIcon`).innerHTML = `<a href="#" onMouseOver="this.style.color='#0F0'" onMouseOut="this.style.color='black'" style="color:black;">Selected<i class='bx bx-select-multiple' ></i></a>`;
  updateTotals();
  }}


  function showItemInfo(name, price,id,quantity) {
    if(quantity == 0 ){
      return
    }
    if(addedItems.includes(id)){
      return;
    }else{
    addedItems.push(id);
  document.getElementById('sidebar').innerHTML += `
  <tr scope="row" class="shadow ${id}">
    <td class="text-truncate px-0">
      <button onclick="removeItem('${id}')" type="button" class="border-0 rounded shadow-sm ml-0 mr-2 btn-danger">
        <i class='bx bx-x'></i>
      </button>
      ${name}</td>
    <td class="px-0 price">
      ${price}$
    </td>
    <td class="px-0">
      <div class="input-group w-auto justify-content-center px-0">
          <input type="number" step="1" max="${quantity}" value="1" name="quantity[${id}]" class=" text-center rounded quantity" style="width: 4em; id="${id}Quantity" oninput="updateTotal('${id}', ${price}, this.value)">
          <input type="hidden" name="product_id[${id}]" value="${id}">
      </div>
    </td>
    <td class="px-0" id="${id}Total">
      ${price}$
    </td>
  </tr>
  <tr class="spacer ><td colspan="100"></td></tr>
  `;
  var selected = document.getElementById(`${id}selectedBg`);
  selected.style.backgroundColor = '#6699CC';
  document.getElementById(`${id}selectedIcon`).innerHTML = `<span href="#" style="color:black;">Selected<i class='bx bx-select-multiple' ></i></span>`;
  updateTotals();
  }}
  $('#search').on('keyup',function(){
    $value = $(this).val();
    if($value.trim() === '' ){
      $('#content').empty();
    }else{
    $.ajax({
      type:'get',
      url:'{{URL::to('service_manager/search')}}',
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