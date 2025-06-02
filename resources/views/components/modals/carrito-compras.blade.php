<div id="carrito-compras" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header bg-info text-white border-bottom-0">
        <h5 class="modal-title">Artículos del carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="card">
        <div class="table-responsive table-scrollable border-top">
          <table class="table">
            <thead>
              <tr>
                <th colspan="2">Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario (pesos)</th>
                <th>Precio unitario (dólares)</th>
                <th>Subtotal</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="lista-carrito">
            </tbody>
          </table>
        </div>
        <div class="mt-3 text-end me-4">
          <p><strong>Subtotal (MXN):</strong> <span id="carrito-subtotal">$0.00</span></p>
          <p><strong>Total (USD):</strong> <span id="carrito-total-dolares">$0.00</span></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-finalizar-pedido">Finalizar pedido</button>
      </div>
    </div>
  </div>
</div>