@extends('layout.plantilla')
@section('contenido')
<div id="hero" class="hero section light-background">
          
    <img src="/plantilla/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container position-relative">

      <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
        <h2>BIENVENIDOS</h2>
      </div><!-- End Welcome -->

      <div class="content row gy-4">
        <div class="col-lg-4 d-flex align-items-stretch">
          <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
            <h3>Medilab</h3>
            <p>
              ¡Bienvenidos a Medilab! En nuestra plataforma, encontrarás herramientas avanzadas y 
              recursos detallados para predecir la anemia, identificar su tipo y evaluar su severidad. 
              Utilizando tecnología de vanguardia y análisis de datos, Medilab te proporciona información 
              precisa y recomendaciones personalizadas para ayudarte a comprender y manejar mejor la anemia,
              mejorando así tu salud y bienestar.
          </div>
        </div><!-- End Why Box -->

        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="d-flex flex-column justify-content-center">
            <div class="row gy-4">

              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                  <i class="bi bi-clipboard-data"></i>
                  <h4>Prediccion de Anemia</h4>
                  <p>Utiliza nuestro modelo de machine learning para predecir la presencia de anemia y observa los resultados de pruebas de laboratorio.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                  <i class="bi bi-gem"></i>
                  <h4>Tipo de Anemia</h4>
                  <p>Aprende sobre los diferentes tipos de anemia, anemia ferropénica, anemia perniciosa, y más. 
                    Nuestro sistema te ayudará a identificar el tipo específico de anemia que podrías tener.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                  <i class="bi bi-inboxes"></i>
                  <h4>Severidad de Anemia</h4>
                  <p>Conoce la severidad de la anemia y recibe recomendaciones personalizadas para el manejo y tratamiento basadas en tu perfil de salud</p>
                </div>
              </div><!-- End Icon Box -->

            </div>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection