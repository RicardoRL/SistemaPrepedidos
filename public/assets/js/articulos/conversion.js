document.addEventListener('DOMContentLoaded', function () {
    const pesosInput = document.getElementById('articulo_pesos');
    const dolaresInput = document.getElementById('articulo_dolares');

    pesosInput.addEventListener('change', function () {
        const valorPesos = parseFloat(this.value);

        if (isNaN(valorPesos) || valorPesos <= 0) {
            dolaresInput.value = '';
            return;
        }

        fetch('/tipo-cambio')
            .then(response => response.json())
            .then(data => {
                const tipoCambio = parseFloat(data.tipo_cambio);
                if (!isNaN(tipoCambio) && tipoCambio > 0) {
                    const dolares = valorPesos / tipoCambio;
                    dolaresInput.value = dolares.toFixed(2);
                }
            })
            .catch(error => {
                console.error('Error al obtener el tipo de cambio:', error);
                dolaresInput.value = '';
            });
    });
});
