document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('articulos');
  const form = document.getElementById('form_articulo');
  const btnGuardar = document.getElementById('btn-guardar');

  // Evento para reiniciar el formulario cuando se abre en modo "Agregar"
  document.getElementById('btn-agregar-articulos').addEventListener('click', function () {
    form.reset();
    form.action = '/admin/articulos'; // acción para guardar nuevo
    btnGuardar.textContent = 'Guardar';

    document.getElementById('articulo_img').required = true;
    document.getElementById('articulo_img').value = null;
    document.getElementById('img-preview').src = '';

    const imgPreview = document.getElementById('img-preview');
    if (imgPreview) {
      imgPreview.closest('.row').style.display = 'none';
    }

    // Elimina input _method si existe (solo se necesita para editar)
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
      methodInput.remove();
    }
  });
});