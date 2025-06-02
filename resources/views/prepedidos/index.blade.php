@extends('layouts.admin')

@section('title', 'Prepedidos')

@section('page-header')
  <h4 class="page-title mb-0">
    Historial de prepedidos
  </h4>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="navbar navbar-expand-lg shadow rounded py-1 mb-3">
        <div class="container-fluid">
          <form class="d-flex order-1 order-lg-2 ms-auto" method="GET" action="{{ route('prepedidos.index') }}">
            <div class="d-flex order-1 order-lg-2 ms-auto">
              <div class="me-2 d-flex">
                <label class="form-label me-2 mt-2" for="desde">Desde</label>
                <input class="form-control" id="desde" name="desde" type="date">
              </div>
              <div class="me-2 d-flex">
                <label class="form-label me-2 mt-2" for="hasta">Hasta</label>
                <input class="form-control" id="hasta" name="hasta" type="date">
              </div>
              <div class="me-2">
                <button type="submit" class="btn btn-primary btn-labeled btn-labeled-start"
                        data-bs-toggle="modal" data-bs-target="#articulos" id="btn-agregar-articulos">
                  <span class="btn-labeled-icon bg-black bg-opacity-20">
                    <i class="ph-funnel"></i>
                  </span>
                  Filtrar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if ($prepedidos->isEmpty())
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
              <th>#</th>
              <th>Folio</th>
              <th>Correo</th>
              <th>Fecha</th>
              <th>Subtotal</th>
              <th>Impuestos</th>
              <th>Total</th>
              <th>Productos</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($prepedidos as $pedido)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pedido->folio }}</td>
                <td>{{ $pedido->correo }}</td>
                <td>{{ $pedido->fecha }}</td>
                <td>${{ number_format($pedido->subtotal, 2) }}</td>
                <td>${{ number_format($pedido->impuestos, 2) }}</td>
                <td>${{ number_format($pedido->total, 2) }}</td>
                <td>{{ $pedido->detalles->count() }}</td>
                <td>
                  <button type="button" class="btn btn-primary mb-2 btn-detalle-prepedidos"
                    onclick="verDetallePrepedido({{ $pedido->id }})"
                  >
                    <i class="ph-eye me-2"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted">No hay prepedidos en el rango seleccionado.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection

@include('components.modals.prepedido-detalle')

@push('scripts')
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/vendor/datatables/datatables_basic.js')}}"></script>
	<script src="{{asset('assets/js/vendor/datatables/datatables.min.js')}}"></script>
  <script>
    //Función para ver detalle de prepedidos
    async function verDetallePrepedido(prepedidoId) {
      try {
        const response = await fetch(`/admin/prepedidos/${prepedidoId}`);
        const data = await response.json();

        document.getElementById('detalle-folio').textContent = data.folio;
        document.getElementById('detalle-correo').textContent = data.correo;
        document.getElementById('detalle-fecha').textContent = data.fecha;

        const tbody = document.getElementById('detalle-productos');
        tbody.innerHTML = '';

        data.detalles.forEach(det => {
          const row = document.createElement('tr');
          console.log(det);
          row.innerHTML = `
            <td>${det.articulo.nombre}</td>
            <td>${det.articulo.descripcion_corta}</td>
            <td>${det.cantidad}</td>
            <td>$${parseFloat(det.articulo.precio_pesos).toFixed(2)}</td>
            <td>$${parseFloat(det.articulo.precio_dolares).toFixed(2)}</td>
            <td>$${(det.cantidad * det.articulo.precio_pesos).toFixed(2)}</td>
          `;
          tbody.appendChild(row);
        });

        new bootstrap.Modal(document.getElementById('prepedido-detalle')).show();

      } catch (error) {
        console.error(error);
        alert('Error al cargar detalle del prepedido');
      }
    }
  </script>
@endpush