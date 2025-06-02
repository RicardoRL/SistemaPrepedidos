<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

  <!-- Sidebar header -->
  <div class="sidebar-section bg-black bg-opacity-10 border-bottom border-bottom-white border-opacity-10">
    <div class="sidebar-logo d-flex justify-content-center align-items-center">
      <a href="index.html" class="d-inline-flex align-items-center py-2">
        <img src="../../../assets/images/logo_icon.svg" class="sidebar-logo-icon" alt="">
        <img src="../../../assets/images/logo_text_light.svg" class="sidebar-resize-hide ms-3" height="14" alt="">
      </a>

      <div class="sidebar-resize-hide ms-auto">
        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
          <i class="ph-arrows-left-right"></i>
        </button>

        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
          <i class="ph-x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- /sidebar header -->


  <!-- Sidebar content -->
  <div class="sidebar-content">
    <!-- Main navigation -->
    <div class="sidebar-section">
      <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->
        <li class="nav-item-header">
          <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
          <i class="ph-dots-three sidebar-resize-show"></i>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link">
            <i class="ph-house"></i>
            <span>
              Dashboard
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('articulos.index') }}" class="nav-link">
            <i class="ph-package"></i>
            <span>
              Artículos
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('prepedidos.index') }}" class="nav-link">
            <i class="ph-list-bullets"></i>
            <span>
              Prepedidos  
            </span>
          </a>
        </li>
      </ul>
    </div>
    <!-- /main navigation -->

  </div>
  <!-- /sidebar content -->

</div>
<!-- /main sidebar -->