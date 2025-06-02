@extends('layouts.admin')

@section('title', 'Artículos')

@section('page-header')
  <h4 class="page-title mb-0">
    Gestión de artículos
  </h4>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="navbar navbar-expand-lg shadow rounded py-1 mb-3">
        <div class="container-fluid">
          <div class="d-flex order-1 order-lg-2 ms-auto">
            <button type="button" class="btn btn-primary btn-labeled btn-labeled-start"
                    data-bs-toggle="modal" data-bs-target="#articulos" id="btn-agregar-articulos">
              <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-plus-circle"></i>
              </span>
              Agregar articulos
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(!isset($articulos)){
      $articulos = collect();
    }
  ?>
  @if ($articulos->isEmpty())
    <div class="row" id="no-articulos">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body justify-content-center text-center">
            <div>
              <i class="ph-x ph-2x text-danger border border-width-3 border-danger rounded-pill p-2 mb-3"></i>
              <h5 class="card-title">No se encontraron registros</h5>
              <p class="mb-3">Agrega artículos para actualizar el listado</p>
              <a href="#" class="btn btn-danger">Actualizar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="row" id="lista-articulos">
      <div class="col-lg-12">
        <div class="card">
          <table class="table datatable-basic">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio en dólares</th>
                <th>Precio en pesos</th>
                <th>Activo</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($articulos as $articulo)
                <tr>
                  <td>{{ $articulo->sku }}</td>
                  <td>{{ $articulo->nombre }}</td>
                  <td>${{ number_format($articulo->precio_dolares, 2) }}</td>
                  <td>${{ number_format($articulo->precio_pesos, 2) }}</td>
                  <td>
                      @if($articulo->activo)
                          <span class="badge bg-success bg-opacity-10 text-success">Activo</span>
                      @else
                          <span class="badge bg-danger bg-opacity-10 text-danger">Inactivo</span>
                      @endif
                  </td>
                  <td>
                    <div class="d-inline-flex">
                      <div class="dropdown">
                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                          <i class="ph-list"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="#" class="dropdown-item">
                            <i class="ph-eye me-2"></i>
                            Ver detalle
                          </a>
                          <a href="#" class="dropdown-item btn-editar"
                            id="editar-articulo"
                            data-id="{{ $articulo->id }}"
                            data-sku="{{ $articulo->sku }}"
                            data-nombre="{{ $articulo->nombre }}"
                            data-descripcion-corta="{{ $articulo->descripcion_corta }}"
                            data-descripcion-larga="{{ $articulo->descripcion_larga }}"
                            data-precio-pesos="{{ $articulo->precio_pesos }}"
                            data-precio-dolares="{{ $articulo->precio_dolares }}"
                            data-stock="{{ $articulo->stock }}"
                            data-fecha-vigencia="{{ $articulo->fecha_vigencia }}"
                            data-imagen="{{ asset('storage/' . $articulo->imagen) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#articulos"
                          >
                            <i class="ph-pencil-line me-2"></i>
                            Editar
                          </a>
                          <a href="#" class="dropdown-item">
                            <i class="ph-power me-2"></i>
                            Activar/Inactivar
                          </a>
                          <a class="dropdown-item btn-eliminar" data-id="{{ $articulo->id }}">
                            <i class="ph-x me-2"></i>
                            Eliminar
                          </a>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data" id="form-eliminar">
      @csrf
      @method('DELETE')
    </form>
  @endif
@endsection

@include('components.modals.articulo-form')

@push('scripts')
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/articulos/conversion.js')}}"></script>
  <script src="{{asset('assets/js/articulos/editar-articulo.js')}}"></script>
  <script src="{{asset('assets/js/articulos/guardar-articulo.js')}}"></script>
  <script src="{{asset('assets/js/articulos/eliminar-articulo.js')}}"></script>
  <script src="{{asset('assets/js/vendor/datatables/datatables_basic.js')}}"></script>
	<script src="{{asset('assets/js/vendor/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/notifications/noty.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/notifications/sweet_alert.min.js')}}"></script>
  @if(session('success'))
    <script>
      new Noty({
        text: '{{ session('success') }}',
        type: 'success',
        layout: 'topRight',
        timeout: 3000,
        theme: 'limitless'
      }).show();
    </script>
  @endif
  @if ($errors->any())
    <script>

      const swalInit = swal.mixin({
                        buttonsStyling: false,
                        customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light',
                        denyButton: 'btn btn-light',
                        input: 'form-control'
                      }
                  });

      document.addEventListener('DOMContentLoaded', function () {
        let mensaje = '';

        @foreach ($errors->all() as $error)
          mensaje += `• {{ $error }}\n`;
        @endforeach

        swalInit.fire({
          title: 'Errores de validación',
          text: mensaje,
          icon: 'error'
        });
      });
    </script>
  @endif
@endpush
