<footer class="text-light pt-5 pb-4" style="background-color: var(--azul-oscuro-1);">
  <div class="container">
    <div class="row gy-4">

      <!-- Logo y descripción -->
      <div class="col-md-4">
        <h5 class="fw-bold" style="color: var(--verde-1);">DigiPassQr</h5>
        <p class="small text-secondary">
          DigiPassQr es una plataforma inteligente para la gestión y venta de entradas digitales con códigos QR.
          Simplificamos el acceso a eventos con seguridad, rapidez y tecnología moderna.
        </p>
        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-secondary hover-link"><i class="bi bi-facebook fs-5"></i></a>
          <a href="#" class="text-secondary hover-link"><i class="bi bi-instagram fs-5"></i></a>
          <a href="#" class="text-secondary hover-link"><i class="bi bi-linkedin fs-5"></i></a>
          <a href="#" class="text-secondary hover-link"><i class="bi bi-twitter fs-5"></i></a>
        </div>
      </div>

      <!-- Enlaces útiles -->
      <div class="col-md-2 col-6">
        <h6 class="fw-semibold text-uppercase mb-3" style="color: var(--verde-1);">Enlaces</h6>
        <ul class="list-unstyled">
          <li><a href="{{ route('home') }}" class="footer-link">Inicio</a></li>
          <li><a href="#" class="footer-link">Eventos</a></li>
          <li><a href="#" class="footer-link">Organizadores</a></li>
          <li><a href="#" class="footer-link">Contacto</a></li>
        </ul>
      </div>

      <!-- Recursos -->
      <div class="col-md-3 col-6">
        <h6 class="fw-semibold text-uppercase mb-3" style="color: var(--verde-1);">Recursos</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="footer-link">Guía para compradores</a></li>
          <li><a href="#" class="footer-link">Registro de organizadores</a></li>
          <li><a href="#" class="footer-link">Soporte técnico</a></li>
          <li><a href="#" class="footer-link">Centro de ayuda</a></li>
        </ul>
      </div>

      <!-- Contacto -->
      <div class="col-md-3">
        <h6 class="fw-semibold text-uppercase mb-3" style="color: var(--verde-1);">Contacto</h6>
        <ul class="list-unstyled small">
          <li><i class="bi bi-geo-alt-fill text-secondary me-2"></i>Av. Tecnológica 245, Formosa, Argentina</li>
          <li><i class="bi bi-envelope-fill text-secondary me-2"></i> soporte@digipassqr.com</li>
          <li><i class="bi bi-telephone-fill text-secondary me-2"></i> +51 987 654 321</li>
        </ul>
      </div>
    </div>

    <hr class="mt-5 mb-3" style="border-color: var(--azul-oscuro-3);">

    <!-- Copyright -->
    <div class="text-center small text-secondary">
      © {{ date('Y') }} <span style="color: var(--verde-1);">DigiPassQr</span>. Todos los derechos reservados.  
      <span class="d-block d-md-inline mt-2 mt-md-0">Tu acceso digital, más fácil y seguro.</span>
    </div>
  </div>
</footer>

<!-- Estilos del footer -->
<style>
  .footer-link {
    color: var(--gris-medio);
    text-decoration: none;
    transition: color 0.3s ease;
  }
  .footer-link:hover {
    color: var(--verde-1);
  }
  .hover-link:hover {
    color: var(--verde-1) !important;
  }
</style>
