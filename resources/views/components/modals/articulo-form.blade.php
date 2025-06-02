<div id="articulos" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white border-bottom-0">
        <h5 class="modal-title">Agregar artículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data" id="form_articulo">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label" for="articulo_sku">SKU:</label>
                  <input type="text" id="articulo_sku" name="sku" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label" for="articulo_nombre">Nombre:</label>
                  <input type="text" id="articulo_nombre" name="nombre" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label" for="articulo_desc_corta">Descripción corta:</label>
                  <input type="text" id="articulo_desc_corta" name="descripcion_corta" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label" for="articulo_desc_larga">Descripción larga:</label>
                  <textarea type="text" id="articulo_desc_larga" name="descripcion_larga" rows="4" cols="4" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label" for="articulo_pesos">Precio en pesos:</label>
                  <input class="form-control" id="articulo_pesos" name="precio_pesos" type="number" name="number" value="0" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label" for="articulo_dolares">Precio en dólares:</label>
                  <input class="form-control" id="articulo_dolares" name="precio_dolares" type="number" name="number" readonly value="0">
                </div>
              </div>
            </div>
            @if (isset($articulo) && $articulo->imagen)
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label d-block">Imagen actual:</label>
                    <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="Imagen actual" class="img-thumbnail" id="img-preview" width="150">
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label" for="articulo_img">Imagen</label>
                  <input type="file" id="articulo_img" name="imagen" class="form-control" accept="image/*" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label" for="articulo_stock">Stock:</label>
                  <input class="form-control" id="articulo_stock" name="stock" type="number" name="number" value="0" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label" for="articulo_fech_vig">Fecha de vigencia:</label>
                  <input class="form-control" id="articulo_fech_vig" name="fecha_vigencia" type="date" required>
                </div>
              </div>
            </div>
            <div class="text-end">
              <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" id="btn-guardar">Guardar<i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>