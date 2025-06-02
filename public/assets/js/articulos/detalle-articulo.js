document.addEventListener('DOMContentLoaded', function () {
  const modalDetalle = new bootstrap.Modal(document.getElementById('articulo-detalle'));

  document.querySelectorAll('.btn-detalle').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      // Obtener los datos del botón
      console.log(btn.dataset);
      const sku = btn.dataset.sku || '';
      const nombre = btn.dataset.nombre || '';
      const descCorta = btn.dataset.descripcionCorta || '';
      const descLarga = btn.dataset.descripcionLarga || '';
      const precioPesos = btn.dataset.precioPesos || 0.0;
      const precioDolares = btn.dataset.precioDolares || 0.0;
      const stock = btn.dataset.stock || '';
      const vigencia = btn.dataset.fechaVigencia || '';
      const estado = btn.dataset.activo ? "Activo" : "Inactivo";
      const imagen = btn.dataset.imagen || '';

      // Insertar los valores en el modal
      document.getElementById('detalle-sku').textContent = sku;
      document.getElementById('detalle-nombre').textContent = nombre;
      document.getElementById('detalle-desc-cor').textContent = descCorta;
      document.getElementById('detalle-desc-lar').textContent = descLarga;
      document.getElementById('detalle-estado').textContent = estado;
      document.getElementById('detalle-pesos').textContent = precioPesos;
      document.getElementById('detalle-dolares').textContent = precioDolares;
      document.getElementById('detalle-img').textContent = imagen;
      document.getElementById('detalle-stock').textContent = stock;
      document.getElementById('detalle-vigencia').textContent = vigencia;

      // Imagen
      const divImagen = document.getElementById('detalle-img');
      if (imagen) {
        divImagen.innerHTML = `<img src="/storage/${imagen}" class="img-thumbnail" width="120">`;
      } else {
        divImagen.textContent = '';
      }

      // Mostrar el modal
      modalDetalle.show();
    });
  });
});
