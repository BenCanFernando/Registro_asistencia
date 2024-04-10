@extends('docente.app')

@section('content')
<div class="container">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="resources/qrcodejs-master/qrcode.min.js"></script>
    <script src="/js/app.js"></script>
    <h1>Registrar asistencia</h1>
    <div id="codigo-qr" class="text-center"></div>

    <script>
        var codigoQRDiv = document.getElementById('codigo-qr'); // Referencia al div del código QR

        function generarCodigoAleatorio() {
            // Genera un código aleatorio de 5 dígitos
            var codigoAleatorio = Math.floor(10000 + Math.random() * 90000);
            return codigoAleatorio;
        }

        function generarCodigoQR(codigo) {
            var nuevoCodigo = codigo + " " + generarCodigoAleatorio(); // Genera el contenido del código QR
            codigoQRDiv.innerHTML = ''; // Borra el contenido anterior del div del código QR

            // Crea una instancia de QRCode y coloca el nuevo código QR en el mismo div
            var qrcode = new QRCode(codigoQRDiv, {
                text: nuevoCodigo,
                width: 300,
                height: 300,
                correctLevel: QRCode.CorrectLevel.L
            });
        }

        function actualizarCodigoQR() {
            var codigo = "{{ $registro }}"; // Obtener el valor del registro
            generarCodigoQR(codigo);
        }

        // Genera el primer código QR inicialmente
        actualizarCodigoQR();

        // Llama a la función para actualizar el código QR cada tres segundos
        setInterval(function () {
            actualizarCodigoQR();
        }, 3000);
    </script>
</div>

@endsection