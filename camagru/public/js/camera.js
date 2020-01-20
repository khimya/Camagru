const canvas = document.querySelector("canvas"),
  ctx = canvas.getContext("2d"),
  fileChooser = document.querySelector(".file-chooser"),
  gsButton = document.querySelector(".green-screen"),
  photobooth = document.querySelector(".photobooth"),
  reset = document.querySelector(".reset-green-screen"),
  snap = document.querySelector(".snap"),
  strip = document.querySelector(".strip"),
  video = document.querySelector("video");

let greenScreenColor = false,
  isPickingColor = false;

function getVideo() {
  navigator.mediaDevices
    .getUserMedia({ video: true, audio: false })
    .then(localMediaStream => {
      video.srcObject = localMediaStream;
      video.play();
    })
    .catch(err => console.error(err));
}

function paintToCanvas() {
  const width = video.videoWidth,
    height = video.videoHeight;
  canvas.width = width;
  canvas.height = height;

  return setInterval(() => {
    ctx.drawImage(video, 0, 0, canvas.offsetWidth, canvas.offsetHeight);
    let pixels = ctx.getImageData(
      0,
      0,
      canvas.offsetWidth,
      canvas.offsetHeight
    );
    // pixels = greenScreen(pixels);
    ctx.putImageData(pixels, 0, 0);
  }, 16);
}

// function getColor(e) {
//   isPickingColor = false;
//   greenScreenColor = false;
//   gsButton.classList.remove('green-screen-active');
//   canvas.style.cursor = 'default';
//   canvas.removeEventListener('click', getColor);
//   greenScreenColor = ctx.getImageData(e.offsetX, e.offsetY, 1, 1);
//   // document.querySelector('body').style.background = `rgba(${greenScreenColor.data[0]}, ${greenScreenColor.data[1]}, ${greenScreenColor.data[2]})`;
// }

function takePhoto() {
  const data = canvas.toDataURL("image/jpeg"),
    link = document.createElement("a");
  snap.currentTime = 0;
  // snap.play();
  link.href = data;
  link.setAttribute("download", "handsome");
  link.innerHTML = `<img src="${data}" alt="Handsome Man" />`;
  // alert(link);
  document.getElementById("img64").value = link;
  strip.insertBefore(link, strip.firstChild);
}

// function greenScreen(pixels) {
//   if (!greenScreenColor) return pixels;

//   const levels = {}
//   document.querySelectorAll('.rgb input').forEach(input => levels[input.name] = input.value);

//   for (i = 0; i < pixels.data.length; i = i + 4) {
//     const red   = pixels.data[i + 0],
//           green = pixels.data[i + 1],
//           blue  = pixels.data[i + 2];
//     if (red >= greenScreenColor.data[0] - levels.red && red <= greenScreenColor.data[0] + levels.red  &&
//         green >= greenScreenColor.data[1] - levels.green && green <= greenScreenColor.data[1] + levels.green  &&
//         blue >= greenScreenColor.data[2] - levels.blue && blue <= greenScreenColor.data[2] + levels.blue ) {
//           pixels.data[i + 3] = 0;
//     }
//   }

//   return pixels
// }

function activateColorPicker() {
  gsButton.classList.add('green-screen-active');
  canvas.style.cursor = 'crosshair';
  canvas.addEventListener('click', getColor);
}

function deactiveColorPicker() {
  isPickingColor = false;
  canvas.style.cursor = 'default';
  gsButton.classList.remove('green-screen-active');
  canvas.removeEventListener('click', getColor);
}

function toggleColorPicker() {
  isPickingColor = !isPickingColor;
  isPickingColor ? activateColorPicker() : deactiveColorPicker();
}

function resetGreenScreen() {
  deactiveColorPicker();
  greenScreenColor = false;
  document.querySelectorAll('.rgb input').forEach(input => input.value = 20);
  // document.querySelector('body').style.backgroundColor = 'none';
}

function selectFile() {
  const file = this.files[0];
  const fileUrl = URL.createObjectURL(file);
  canvas.style.backgroundImage = `url(${fileUrl})`;
  console.log(this.files);
}

getVideo();

fileChooser.addEventListener("change", selectFile);
video.addEventListener("canplay", paintToCanvas);
