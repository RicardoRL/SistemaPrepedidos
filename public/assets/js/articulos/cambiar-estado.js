document.addEventListener('DOMContentLoaded', function () {
  const formToggle = document.getElementById('form-cambia-estado');

  document.querySelectorAll('.btn-estado').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.dataset.id;
      const nombre = this.dataset.nombre;

      const sweetAl2= swal.mixin({
              buttonsStyling: false,
              customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
              }
      });

      sweetAl2.fire({
        title: '¿Estás seguro?',
        text: `¿Quieres cambiar el estado del artículo "${nombre}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Cambiar',
        cancelButtonText: 'Cancelar',
        buttonsStyling: false,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-danger'
        }
      }).then(() => {
        formToggle.action = `/admin/articulos/${id}/estado`;
        formToggle.submit();
      });
    });
  });
});
