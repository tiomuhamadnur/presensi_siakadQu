<!doctype html>
<html lang="en">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>WEB CHARITY </title>

    <!-- Styles -->
    <link rel='stylesheet' href="{{ asset('runcharity/theme/assets/css/bootstrap.min.css') }}">
    <link rel='stylesheet' href="{{ asset('runcharity/theme/assets/css/animate.min.css') }}">
    <link rel='stylesheet' href="{{ asset('runcharity/theme/assets/css/font-awesome.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('runcharity/theme/assets/css/style.css') }}" />

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800' rel='stylesheet'
        type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
 <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
</head>

<body>
    <!-- Begin Hero Bg -->
    <div id="parallax">
    </div>
    <!-- End Hero Bg
 ================================================== -->
    <!-- Start Header
 ================================================== -->
    <header id="header" class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Your Logo -->
                <a href="#hero" class="navbar-brand">WEB CHARITY <span class="lighter">LITE</span></a>
            </div>
            <!-- Start Navigation -->
            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#hero">Home</a>
                    </li>
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                        <a href="#gallery">Gallery</a>
                    </li>
                    <li>
                        <a href="#slider">Testimonials</a>
                    </li>
                    <li>
                        <a href="#faq">FAQ</a>
                    </li>
                    <li>
                        <a href="#contactarea">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    {{-- CONTENT --}}
    @yield('content')
    {{-- END CONTENT --}}
    <!-- Credits
=============================================== -->
    <section id="credits" class="text-center">
        <span class="social wow zoomIn">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-skype"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
        </span><br />
        Copyright &copy; <a href="#">Yadana</a>
        {{-- <br />Template By <i class="fa fa-heart"></i> WowThemes.Net --}}
    </section>
    <!-- Bootstrap core JavaScript
 ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/runcharity/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/jquery.localScroll.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/validate.js') }}"></script>
    <script src="{{ asset('assets/runcharity/assets/js/common.js') }}"></script>
</body>

</html>
