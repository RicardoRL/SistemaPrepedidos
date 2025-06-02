import swal from 'sweetalert2';

let carrito = [];

// Función para agregar al carrito
function agregarAlCarrito(producto) {
  const existe = carrito.find(p => p.id === producto.id);
  if (existe) {
    if (existe.cantidad + 1 <= producto.stock) {
      existe.cantidad++;
    }
  } else {
    producto.cantidad = 1;
    carrito.push(producto);
  }

  actualizarCarritoModal();
}

// Función para actualizar el contenido del carrito en el modal
function actualizarCarritoModal() {
  const tbody = document.getElementById('lista-carrito');
  tbody.innerHTML = '';

  carrito.forEach(producto => {
    const subtotal = producto.cantidad * producto.precio_pesos;

    const fila = document.createElement('tr');
    fila.id = `fila-${producto.id}`;
    fila.innerHTML = `
      <td colspan="2">${producto.nombre}</td>
      <td>
        <input type="number"
               value="${producto.cantidad}"
               min="1"
               max="${producto.stock}"
               class="form-control form-control-sm cantidad-input">
      </td>
      <td>$${producto.precio_pesos.toFixed(2)}</td>
      <td>$${producto.precio_dolares.toFixed(2)}</td>
      <td class="subtotal">$${subtotal.toFixed(2)}</td>
      <td>
        <button class="btn btn-sm btn-danger btn-eliminar" data-id="${producto.id}">
          <i class="ph-trash"></i>
        </button>
      </td>
    `;

    tbody.appendChild(fila);

    fila.querySelector('.btn-eliminar').addEventListener('click', () => {
      eliminarDelCarrito(producto.id);
    });

    const inputCantidad = fila.querySelector('.cantidad-input');
    inputCantidad.addEventListener('input', () => {
      cambiarCantidad(producto.id, inputCantidad.value);
    });
  });

  actualizarTotales();
}

function cambiarCantidad(id, nuevaCantidad) {
  const producto = carrito.find(p => p.id === id);
  if (!producto) return;

  const cantidad = Math.max(1, Math.min(producto.stock, parseInt(nuevaCantidad) || 1));
  producto.cantidad = cantidad;

  // Actualizar el subtotal de ese producto
  const fila = document.getElementById(`fila-${id}`);
  if (fila) {
    const celdaSubtotal = fila.querySelector('.subtotal');
    if (celdaSubtotal) {
      const nuevoSubtotal = cantidad * producto.precio_pesos;
      celdaSubtotal.textContent = `$${nuevoSubtotal.toFixed(2)}`;
    }
  }

  actualizarTotales();
}


function actualizarTotales() {
  let subtotal = 0;
  let totalDolares = 0;

  carrito.forEach(p => {
    subtotal += p.precio_pesos * p.cantidad;
    totalDolares += p.precio_dolares * p.cantidad;
  });

  document.getElementById('carrito-subtotal').textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById('carrito-total-dolares').textContent = `$${totalDolares.toFixed(2)}`;
}

function eliminarDelCarrito(id) {
  const index = carrito.findIndex(p => p.id === id);
  if (index !== -1) {
    carrito.splice(index, 1);
    actualizarCarritoModal();
  }
}

function mostrarResumenCotizacion() {
  const tbody = document.getElementById('resumen-cotizacion');
  const subtotalMXNEl = document.getElementById('cotizacion-subtotal-mxn');
  const ivaMXNEl = document.getElementById('cotizacion-iva-mxn');
  const totalMXNEl = document.getElementById('cotizacion-total-mxn');
  const totalUSDEl = document.getElementById('cotizacion-total-usd');

  tbody.innerHTML = '';

  let subtotalMXN = 0;
  let totalUSD = 0;

  carrito.forEach(producto => {
    const subMXN = producto.precio_pesos * producto.cantidad;
    const subUSD = producto.precio_dolares * producto.cantidad;

    subtotalMXN += subMXN;
    totalUSD += subUSD;

    const fila = document.createElement('tr');
    fila.innerHTML = `
      <td>${producto.nombre}</td>
      <td>${producto.cantidad}</td>
      <td>$${producto.precio_pesos.toFixed(2)}</td>
      <td>$${producto.precio_dolares.toFixed(2)}</td>
      <td>$${subMXN.toFixed(2)}</td>
      <td>$${subUSD.toFixed(2)}</td>
    `;

    tbody.appendChild(fila);
  });

  const ivaMXN = subtotalMXN * 0.16;
  const totalMXN = subtotalMXN + ivaMXN;

  subtotalMXNEl.textContent = `$${subtotalMXN.toFixed(2)}`;
  ivaMXNEl.textContent = `$${ivaMXN.toFixed(2)}`;
  totalMXNEl.textContent = `$${totalMXN.toFixed(2)}`;
  totalUSDEl.textContent = `$${totalUSD.toFixed(2)}`;
}

// Vincular botones "Agregar al carrito"
document.addEventListener('DOMContentLoaded', function () {
  const botones = document.querySelectorAll('.btn-agregar-carrito');

  botones.forEach(btn => {
    btn.addEventListener('click', () => {
      const producto = {
        id: parseInt(btn.dataset.id),
        nombre: btn.dataset.nombre,
        descripcion_corta: btn.dataset.descripcionCorta,
        descripcion_larga: btn.dataset.descripcionLarga,
        precio_pesos: parseFloat(btn.dataset.precioPesos),
        precio_dolares: parseFloat(btn.dataset.precioDolares),
        stock: parseInt(btn.dataset.stock)
      };

      agregarAlCarrito(producto);
    });
  });
});

document.getElementById('btn-finalizar-pedido').addEventListener('click', async function () {
  const sweetAl4= swal.mixin({
      buttonsStyling: false,
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
      }
  });

  if (carrito.length === 0) {
    sweetAl4.fire({
      title: 'El carrito está vacío',
      text: `Agrega productos para finalizar tu pedido`,
      icon: 'warning',
      confirmButtonText: 'Ok',
      buttonsStyling: false,
      customClass: {
      confirmButton: 'btn btn-primary',
      }
    })
    return;
  }

  const modalCarrito = bootstrap.Modal.getInstance(document.getElementById('carrito-compras'));
  modalCarrito.hide();

  const modalCotizacion = new bootstrap.Modal(document.getElementById('cotizacion'));
  modalCotizacion.show();

});

document.getElementById('btn-finalizar-pedido').addEventListener('click', function () {

  const sweetAl4= swal.mixin({
      buttonsStyling: false,
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
      }
  });

  if (carrito.length === 0) {
    sweetAl4.fire({
      title: 'Carrito vacío',
      text: 'Agrega productos antes de finalizar el pedido',
      icon: 'warning',
      confirmButtonText: 'Ok'
    });
    return;
  }

  // Ocultar modal del carrito si está abierto
  const modalCarrito = bootstrap.Modal.getInstance(document.getElementById('carrito-compras'));
  if (modalCarrito) modalCarrito.hide();

  // Llenar tabla de cotización y mostrar modal
  mostrarResumenCotizacion();

  const modalCotizacion = new bootstrap.Modal(document.getElementById('cotizacion'));
  modalCotizacion.show();
});

document.getElementById('btn-confirmar-prepedido').addEventListener('click', async function () {
  const correo = document.getElementById('correo-prepedido').value.trim();

  const sweetAl = swal.mixin({
    buttonsStyling: false,
    customClass: {
      confirmButton: 'btn btn-primary',
    }
  });

  // Validar si está vacío
  if (!correo) {
    return sweetAl.fire({
      title: 'Campo requerido',
      text: 'Por favor, ingresa un correo electrónico.',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }

  // Validar formato de correo
  const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regexCorreo.test(correo)) {
    return sweetAl.fire({
      title: 'Correo inválido',
      text: 'Ingresa un correo electrónico válido.',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }

  try {
    const response = await fetch('/admin/prepedidos', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({
        correo,
        carrito
      })
    });

    const data = await response.json();

    if (response.ok) {
      const modal = bootstrap.Modal.getInstance(document.getElementById('cotizacion'));
      if (modal) modal.hide();

      setTimeout(() => {
        sweetAl.fire({
          title: 'Prepedido creado',
          text: 'El prepedido se ha registrado correctamente.',
          icon: 'success',
          confirmButtonText: 'Aceptar'
        });
      }, 300);
      

      carrito = [];
      actualizarCarritoModal();
      document.getElementById('correo-prepedido').value = '';

    } else {
      throw new Error(data.message || 'Ocurrió un error al guardar.');
    }

  } catch (error) {
    sweetAl.fire({
      title: 'Error',
      text: error.message,
      icon: 'error',
      confirmButtonText: 'Cerrar'
    });
  }
});



