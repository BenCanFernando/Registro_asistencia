
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
    var valid = valores[2];
    
    var token = " {{ csrf_token() }} ";

    // Validar QR
      var ahora = new Date();
      var tiempoTranscurrido = ahora - new Date(valid);
  
      if (tiempoTranscurrido <= 60000) {
       // console.log("Hora local del QR: " + tiempoTranscurrido);
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
  
      // Agregar el campo al formulario
      form.appendChild(csrfTokenInput);
      form.appendChild(qrValueInput);
  
      // Agregar el formulario al cuerpo del documento
      document.body.appendChild(form);
  
      // Enviar el formulario automáticamente
      form.submit();
      Swal.fire('Asistencia registrada correctamente');
    }else {
      Swal.fire('El código QR ya no es válido');
  }
  }
};

// Evento inicial 
window.addEventListener('load', (e) => {
  cerrarCamara();
})