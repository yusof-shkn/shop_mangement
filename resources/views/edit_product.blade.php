<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>shop management</title>
        <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link
        rel="shortcut icon"
        href="{{asset('assets/images/favicon.png')}}"
        type="image/png"
        />

        <!--====== css'}} Files LinkUp ======-->
        <link rel="stylesheet" href="{{asset('assets/css/glightbox.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/lineIcons.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
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
    <body style="background: url({{asset('assets/images/header/banner-bg.svg')}})">
        @if(session('message'))
      <div class="flash-message justify-content-center position-fixed" style="display:flex;top:15%;left:50% ;transform:translate(-50%,-50%);z-index: 999999">
        <div class="{{session('message.bootstrap_class')}}" role="alert">
          {{session('message.status')}}.
        </div>
      </div>
      @endif
    <div class="container bg-light w-25 p-4 position-fixed" style="border-radius: 1rem; top:50%;left:50%;transform:translate(-50%,-50%)">
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('inventory_manager.update') }}">
            @csrf

            <select class="mb-5 rounded-3" name="category" >
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <div>
                <x-label for="Product Name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required autofocus autocomplete="name" />
                <x-input type="hidden" name="id" value="{{$product->id}}" required />
            </div>

            <div class="mt-4 adminsInput" >
                <x-label for="Price" value="{{ __('Product Price ') }}" />
                <x-input id="price" class="block mt-1 w-full" type="number"  name="price" value="{{$product->price}}" required autocomplete="off" />
            </div>
            <div class="mt-4 adminsInput">
                <x-label for="quantity" value="{{ __('Product Quantity') }}" />
                <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" value="{{$product->quantity}}" required autocomplete="off" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{route('inventory_manager.dashboard')}}" class="ms-4 'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                <a>
                <x-button class="ms-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </div>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>





