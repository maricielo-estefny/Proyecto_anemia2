<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Medilab Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/plantilla/assets/img/favicon.png" rel="icon">
  <link href="/plantilla/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/plantilla/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/plantilla/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/plantilla/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/plantilla/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/plantilla/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/plantilla/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/plantilla/assets/css/main.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oP9pkoWZ5LYVrMZT+FxI7z8OVHItcwa7h9kDA3yC6jBy9U0TTdXUr3XpL4fEny6z" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto">

          <h1 class="sitename">Medilab</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ route('home') }}" class="{{ Route::currentRouteNamed('home') ? 'active' : '' }}">Inicio<br></a></li>
            <li><a href="{{ route('anemia.index') }}" class="{{ Route::currentRouteNamed('anemia.index') ? 'active' : '' }}">Anemia</a></li>
            <li><a href="{{ route('tipo.index') }}" class="{{ Route::currentRouteNamed('tipo.index') ? 'active' : '' }}">Tipo</a></li>
            <li><a href="{{ route('severidad.index') }}" class="{{ Route::currentRouteNamed('severidad.index') ? 'active' : '' }}">Severidad</a></li>
            <li><a href="{{ route('registros.index') }}" class="{{ Route::currentRouteNamed('registros.index') ? 'active' : '' }}">Registro</a></li>
            {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
              </ul>
            </li> --}}
            <li><a href="{{route('contacto.index')}}">Contacto</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        
        <a class="cta-btn d-none d-sm-block" href="#appointment">Haga una Cita</a>

      </div>

    </div>
    

  </header>

  <section class="conten">

    <!-- Hero Section -->
    
      @yield('contenido')
      @yield('scripts')
  </section>



  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-2">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Medilab</span>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <p>Jr Cesar Vallejo 1605</p>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <p>Trujillo,Perú</p>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <p><strong>Celular:</strong> <span>948747520</span></p>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <p><strong>Email:</strong> <span>info@medilab.com</span></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/plantilla/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/plantilla/assets/vendor/php-email-form/validate.js"></script>
  <script src="/plantilla/assets/vendor/aos/aos.js"></script>
  <script src="/plantilla/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/plantilla/assets/vendor/purecounter/purecounter_vanilla.js"></script>w3
  <script src="/plantilla/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Main JS File -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/plantilla/assets/js/main.js"></script>

</body>

</html>