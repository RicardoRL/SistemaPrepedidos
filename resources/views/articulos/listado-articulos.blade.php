@extends('layouts.admin')

@section('title', 'Listado de artículos')

@section('page-header')
  <h4 class="page-title mb-0">
    Listado de artículos
  </h4>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="navbar navbar-expand-lg shadow rounded py-1 mb-3">
        <div class="container-fluid">
          <div class="d-flex order-1 order-lg-2 ms-auto">
            <div class="me-2">
              <button type="button" class="btn btn-primary btn-labeled btn-labeled-start"
                      data-bs-toggle="modal" data-bs-target="#carrito-compras" id="btn-carrito">
                <span class="btn-labeled-icon bg-black bg-opacity-20">
                  <i class="ph-shopping-cart"></i>
                </span>
                Ver prepedido
              </button>
            </div>
            <div class="me-2">
              <button type="button" class="btn btn-primary btn-labeled btn-labeled-start"
                      data-bs-toggle="modal" data-bs-target="#carrito-compras" id="btn-carrito">
                <span class="btn-labeled-icon bg-black bg-opacity-20">
                  <i class="ph-shopping-cart"></i>
                </span>
                Ver carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
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
              <button type="button" class="btn btn-primary mb-2 btn-detalle"
                data-bs-toggle="modal"
                data-bs-target="#articulo-detalle"
                data-id="{{ $articulo->id }}"
                data-sku="{{ $articulo->sku }}"
                data-nombre="{{ $articulo->nombre }}"
                data-descripcion-corta="{{ $articulo->descripcion_corta }}"
                data-descripcion-larga="{{ $articulo->descripcion_larga }}"
                data-precio-pesos="{{ $articulo->precio_pesos }}"
                data-precio-dolares="{{ $articulo->precio_dolares }}"
                data-stock="{{ $articulo->stock }}"
                data-fecha-vigencia="{{ $articulo->fecha_vigencia }}"
                data-activo="{{ $articulo->activo }}"
                data-imagen="{{ $articulo->imagen }}"
              >
                <i class="ph-eye me-2"></i>
                Ver detalle
              </button>
              <button type="button" class="btn btn-primary btn-agregar-carrito"
                data-id="{{ $articulo->id }}"
                data-sku="{{ $articulo->sku }}"
                data-nombre="{{ $articulo->nombre }}"
                data-descripcion-corta="{{ $articulo->descripcion_corta }}"
                data-descripcion-larga="{{ $articulo->descripcion_larga }}"
                data-precio-pesos="{{ $articulo->precio_pesos }}"
                data-precio-dolares="{{ $articulo->precio_dolares }}"
                data-stock="{{ $articulo->stock }}"
                data-fecha-vigencia="{{ $articulo->fecha_vigencia }}"
                data-activo="{{ $articulo->activo }}"
                data-imagen="{{ $articulo->imagen }}"
              >
                <i class="ph-shopping-cart me-2"></i>
                Agregar al carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="d-flex justify-content-center pt-1 mb-1">
    {{ $articulos->links('pagination::bootstrap-4') }}
  </div>
@endsection

@include('components.modals.carrito-compras')
@include('components.modals.articulo-detalle')
@include('components.modals.cotizacion')
@vite(['resources/js/app.js'])

@push('scripts')
  <script src="{{asset('assets/js/articulos/detalle-articulo.js')}}"></script>
@endpush
