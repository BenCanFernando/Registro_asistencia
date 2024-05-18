    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
    <!--<script src="resources/qrcodejs-master/qrcode.min.js"></script>-->
    <!--<script src="resources/js/app.js"></script>-->
    <h1 align='left'>Registrar asistencia</h1>
    <div id="codigo-qr" align='center' class="text-center">
    <script>
        $(document).ready(function () {
         // Cargar el código QR inicial
         obtenerNuevoCodigoQR();
        });

        function obtenerNuevoCodigoQR() {
         // Realizar una solicitud AJAX para obtener un nuevo valor del servidor
            $.get('/generar-qr', function (data) {
             if (data.codigo) {
            // Actualiza el código QR en el cliente con el nuevo valor
            generarCodigoQR(data.codigo);
            }

            // Vuelve a realizar la solicitud después de 3 segundos
            setTimeout(obtenerNuevoCodigoQR, 3000);
        });
        }

        function generarCodigoQR(codigo) {
            var fecha = new Date();
            var opciones = { weekday: 'short', month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', timeZoneName: 'short' };
            var fechaFormateada = fecha.toLocaleString('en-US', opciones);
            fechaFormateada = fechaFormateada.replace(/,/g, '');
            console.log(fechaFormateada);

            var codigoQRDiv = document.getElementById('codigo-qr');
            var nuevoCodigo = codigo + ',' + "{{ $datos->id }}" + ',' + fechaFormateada
            codigoQRDiv.innerHTML = ''; // Borra el contenido anterior del div del código QR

            // Crear una instancia de QRCode y coloca el nuevo código QR en el mismo div
            var qrcode = new QRCode(codigoQRDiv, {
            text: nuevoCodigo,
            width: 500,
            height: 500,
            correctLevel: QRCode.CorrectLevel.L,
        });
        }

    </script>
</div>
</div>