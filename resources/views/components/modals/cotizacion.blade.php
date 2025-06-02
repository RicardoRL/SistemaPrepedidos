<div id="cotizacion" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header bg-info text-white border-bottom-0">
        <h5 class="modal-title">Resumen de cotización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive table-scrollable border-top">
            <table class="table">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio (MXN)</th>
                  <th>Precio (USD)</th>
                  <th>Subtotal (MXN)</th>
                  <th>Subtotal (USD)</th>
                </tr>
              </thead>
              <tbody id="resumen-cotizacion">
              </tbody>
            </table>
          </div>
          <div class="mt-4 text-end me-4">
            <p><strong>Subtotal:</strong> <span id="cotizacion-subtotal-mxn">$0.00</span></p>
            <p><strong>IVA (16%):</strong> <span id="cotizacion-iva-mxn">$0.00</span></p>
            <p><strong>Total (MXN):</strong> <span id="cotizacion-total-mxn">$0.00</span></p>
            <p><strong>Total (USD):</strong> <span id="cotizacion-total-usd">$0.00</span></p>
          </div>
          <div class="mt-4">
            <div class="col-lg-4 mb-2">
              <label for="correo-prepedido" class="form-label">Correo del comprador</label>
              <input type="email" class="form-control" id="correo-prepedido" placeholder="ejemplo@correo.com" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn-confirmar-prepedido">Confirmar pedido</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>