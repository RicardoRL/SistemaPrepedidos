<div id="prepedido-detalle" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info text-white border-bottom-0">
        <h5 class="modal-title">Detalle de artículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="card">
        <div class="card-body">
          <p><strong>Folio:</strong> <span id="detalle-folio"></span></p>
          <p><strong>Correo:</strong> <span id="detalle-correo"></span></p>
          <p><strong>Fecha:</strong> <span id="detalle-fecha"></span></p>

          <div class="table-responsive">
            <table class="table table-sm table-scrollable table-bordered">
              <thead>
                <tr>
                  <th>Artículo</th>
                  <th>Descripción corta</th>
                  <th>Cantidad</th>
                  <th>Precio (MXN)</th>
                  <th>Precio (USD)</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody id="detalle-productos">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>