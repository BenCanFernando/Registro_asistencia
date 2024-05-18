@extends('estudiante.app')
@section('content')
<br><br><br><br>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link rel="stylesheet" type="text/css" href="{{asset('css/Stylecss.css')}}">
  <script src="assets/plugins/qrCode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <div class="row justify-content-center">
  <div class="container">
<div class="cont2">
</div>
    <div class="scan elevation-5">
      <h3 class="text-center">Escanear codigo QR</h3>
      <div class="cont row text-center">
        <a id="btn-scan-qr" href="#">
          <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center row mx-5 my-6" width="175">
        </a>
        <canvas hidden="" id="qr-canvas" class="img-fluid ml-3"></canvas>
        </div>
        <div class="row mx-5 my-3">
        <button class="btn btn-success btn-sm rounded-3 mx-lg-3" onclick="encenderCamara()">Encender camara</button>
        <button class="btn btn-danger btn-sm rounded-3 mx-lg-2" onclick="cerrarCamara()">Detener camara</button>
      </div>
    </div>
    <br><br><br><br><br><br><br>
  </div>
  <audio id="audioScaner" src="assets/sonido.mp3"></audio>
  <script>

// Crea elemento
const video = document.createElement("video");

// Crea canvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

// Div donde llega el canvas
const btnScanQR = document.getElementById("btn-scan-qr");

// Lectura desactivada
let scanning = false;

// Encender cámara
const encenderCamara = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function (stream) {
      scanning = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

// Iniciar las funiones de encendido de la cámara
function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

// Apagar cámara
const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop();
  });
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
};

const activarSonido = () => {
  var audio = document.getElementById('audioScaner');
  audio.play();
}

// Callback de lectura del código QR
qrcode.callback = (respuesta) => {
  if (respuesta) {
    var code = respuesta;
    var valores = code.split(',');
    var codigo = valores[1];
    var valid = new Date(valores[2]);
    var userId = document.body.dataset.userId;
    var token = " {{ csrf_token() }} ";

     //Validar QR
    var ahora = new Date();
    var tiempoTranscurrido = ahora - valid;
    var diferenciaSegundos = tiempoTranscurrido / 1000;
    console.log("id: "+tiempoTranscurrido)

    if (diferenciaSegundos <= 60) {
      // Crear un formulario oculto
      var form = document.createElement("form");
      form.method = "POST";
      form.action = "/guardar-asistencia";
  
      var csrfTokenInput = document.createElement("input");
      csrfTokenInput.type = "hidden";
      csrfTokenInput.name = "_token";
      csrfTokenInput.value = token;
  
      // Crear un campo oculto para el valor del código QR
      var qrValueInput = document.createElement("input");
      qrValueInput.type = "hidden";
      qrValueInput.name = "qr_value";
      qrValueInput.value = codigo;

      var userIdInput = document.createElement("input");
      userIdInput.type = "hidden";
      userIdInput.name = "user_id";
      userIdInput.value = userId;
      
      // Agregar el campo al formulario
      form.appendChild(csrfTokenInput);
      form.appendChild(qrValueInput);
      form.appendChild(userIdInput);
  
      // Agregar el formulario al cuerpo del documento
      document.body.appendChild(form);
  
      // Enviar el formulario automáticamente
      form.submit();
      
      Swal.fire('Asistencia registrada correctamente');
    }else {
      Swal.fire('El código QR no es válido');
  }
  }
 }

// Evento inicial 
window.addEventListener('load', (e) => {
  cerrarCamara();
})

  </script>

@endsection