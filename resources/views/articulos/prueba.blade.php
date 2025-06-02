@extends('layouts.admin')

@section('title', 'Prepedidos')

@section('page-header')
  <h4 class="page-title mb-0">
    Listado de artículos
  </h4>
@endsection

@section('content')
  @foreach($articulos as $articulo)
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="card-img-actions">
              <a href="{{ asset('storage/' . $articulo->imagen) }}" data-bs-popup="lightbox">
                <img src="{{ asset('storage/' . $articulo->imagen) }}" class="card-img" width="90" alt="{{ $articulo->nombre }}">
                <span class="card-img-actions-overlay card-img">
                  <i class="ph-plus text-white ph-2x"></i>
                </span>
              </a>
            </div>
            <div class="card-body text-center">
              <div class="mb-2">
                <h6 class="mb-0">
                  <a href="#" class="text-body">{{ $articulo->nombre }}</a>
                </h6>
                <a href="#" class="text-muted">{{ $articulo->descripcion_corta }}</a>
              </div>
              <h4 class="mb-0">MXN {{ $articulo->precio_pesos }}</h4>
              <div class="text-muted mb-3">${{ $articulo->precio_dolares }}</div>
              <button type="button" class="btn btn-primary">
                <i class="ph-shopping-cart me-2"></i>
                Agregar al carrito
              </button>
            </div>

            <!--
            <div class="d-sm-flex align-items-lg-start text-center text-lg-start">
              <div class="me-lg-3 mb-3 mb-lg-0">
                <a href="#" data-bs-popup="lightbox">
                  <img src="{{ asset('storage/' . $articulo->imagen) }}" width="100" alt="{{ $articulo->nombre }}">
                </a>
              </div>
              <div class="flex-fill">
                <h6 class="mb-1">
                  <a href="#">{{ $articulo->nombre }}</a>
                </h6>

                <ul class="list-inline list-inline-bullet mb-3 mb-lg-2">
                  <li class="list-inline-item"><a href="#" class="text-muted">{{ $articulo->sku }}</a></li>
                  <li class="list-inline-item"><a href="#" class="text-muted">{{ $articulo->descripcion_corta }}</a></li>
                </ul>

                <p class="mb-3">{{ $articulo->descripcion_larga }}</p>
              </div>
              <div class="flex-shrink-0 text-center mt-3 mt-lg-0 ms-lg-3">
                <h5 class="mb-0">MXN {{ $articulo->precio_pesos }}</h5>

                <div class="text-muted">$ {{ $articulo->precio_dolares }}</div>

                <button type="button" class="btn btn-primary mt-3">
                  <i class="ph-shopping-cart me-2"></i>
                  Agregar al carrito
                </button>
              </div>
            </div>
            -->
          </div>
        </div>
      </div>
  @endforeach

  <div class="d-flex justify-content-center pt-1 mb-1">
    {{ $articulos->links('pagination::bootstrap-4') }}
  </div>
@endsection
