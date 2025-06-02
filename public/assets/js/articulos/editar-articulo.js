document.addEventListener('DOMContentLoaded', function () {
  const modal = new bootstrap.Modal(document.getElementById('articulos'));
  const form = document.getElementById('form_articulo');

  document.querySelectorAll('.btn-editar').forEach(button => {
    button.addEventListener('click', () => {
      // Cambia la acción del form
      const id = button.dataset.id;
      form.action = `/admin/articulos/${id}`;
      
      // Método PUT simulado
      if (!document.querySelector('input[name="_method"]')) {
        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
      } else {
        document.querySelector('input[name="_method"]').value = 'PUT';
      }

      // Rellenar los campos
      document.getElementById('articulo_sku').value = button.dataset.sku;
      document.getElementById('articulo_nombre').value = button.dataset.nombre;
      document.getElementById('articulo_desc_corta').value = button.dataset.descripcionCorta;
      document.getElementById('articulo_desc_larga').value = button.dataset.descripcionLarga;
      document.getElementById('articulo_pesos').value = button.dataset.precioPesos;
      document.getElementById('articulo_dolares').value = button.dataset.precioDolares;
      document.getElementById('articulo_stock').value = button.dataset.stock;
      document.getElementById('articulo_fech_vig').value = button.dataset.fechaVigencia;

      document.getElementById('articulo_img').required = false;
      console.log(document.getElementById('articulo_img'));

      // Cambiar texto del botón
      document.getElementById('btn-guardar').textContent = 'Actualizar';
    });
  });
});
