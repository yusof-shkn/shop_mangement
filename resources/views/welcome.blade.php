<!DOCTYPE html>
<html class="no-js')}}" lang="en">
  <head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>Shop Management</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-ico" href="{{asset('images/yusof-logo.png')}}">

    <!--====== Favicon Icon ======-->
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
  </head>

  <body>
    <!--[if IE]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!--====== PRELOADER PART START ======-->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    <header class="header-area">
      <div
        id="home"
        class="header-hero bg_cover"
        style="background-image: url({{asset('assets/images/header/banner-bg.svg')}}"
      >
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="header-hero-content text-center pt-5">
                <h2
                  class="header-title wow fadeInUp"
                  data-wow-duration="1.3s"
                  data-wow-delay="0.5s"
                >
                Shop Management
                </h2>
                <h3
                  class="header-sub-title wow fadeInUp"
                  data-wow-duration="1.3s"
                  data-wow-delay="0.2s"
                >
                  Welcome to our Website!
                </h3>
                
                <p
                  class="text wow fadeInUp"
                  data-wow-duration="1.3s"
                  data-wow-delay="0.8s"
                >
                Simply your business operations with our user-friendly platform. Sign up for a free trial today!
                </p>
              </div>
              <!-- header hero content -->
            </div>
          </div>
          <!-- row -->
          <div class="row">
            <div class="col-lg-12 text-center">
              <div
                class="header-hero-image text-center wow fadeIn"
                data-wow-duration="1.3s"
                data-wow-delay="1.4s"
              >
                <img src="{{asset('assets/images/header/header-hero.png')}}" alt="hero" />
              </div>
              <a
                  href="{{url('/login')}}"
                  class="main-btn wow fadeInUp"
                  data-wow-duration="1.3s"
                  data-wow-delay="1.1s"
                >
                  LOGIN
              </a>
              <a
                  href="{{url('/register')}}"
                  class="main-btn wow fadeInUp"
                  data-wow-duration="1.3s"
                  data-wow-delay="1.1s"
                >
                  REGISTER
              </a>
            </div>
          </div>
      </div>
      <!-- header hero -->
    </header>
    <!--====== HEADER PART ENDS ======-->
    <!--====== Javascript Files ======-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
</html>
