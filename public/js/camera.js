let width = 500,
  height = 0,
  filter = "none",
  streaming = false;

const video = document.getElementById("video"),
  canvas = document.getElementById("canvas"),
  photoButton = document.getElementById("photo-button"),
  uploadButton = document.getElementById("upload-pic"),
  clearButton = document.getElementById("clear-button"),
  submitPic = document.getElementById("img64"),
  filter1 = document.getElementById("filter-src"),
  filter2 = document.getElementById("filter-upload"),
  realFileBtn = document.getElementById("realFileBtn"),
  uploaded = document.getElementById("uploaded"),
  strip = document.getElementById("strip"),
  title = document.getElementById("title"),
  title1 = document.getElementById("title1"),
  takePictureForm = document.getElementById("takePictureForm");

navigator.mediaDevices
  .getUserMedia({ video: true, audio: false })
  .then(function(stream) {
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err) {
    console.log(`Error: ${err}`);
  });

video.addEventListener(
  "canplay",
  function(e) {
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute("width", width);
      video.setAttribute("height", height);
      canvas.setAttribute("width", width);
      canvas.setAttribute("height", height);
      streaming = true;
    }
  },
  false
);

/* function takePicture() {
  alert("dsdsdsdsd");
  var dat = getfilter();
  filter1.setAttribute("value", dat);
  filter2.setAttribute("value", dat);
  const context = canvas.getContext("2d");
  if (width && height) {
    canvas.width = width;
    canvas.height = height;
    context.drawImage(video, 0, 0, width, height);

    const imgUrl = canvas.toDataURL("image/png");

    const img = document.createElement("img");

    // img.style.filter = filter;
    img.setAttribute("src", imgUrl);
    submitPic.value = imgUrl;
    // submitPic.setAttribute("style", filter);
    // filter = setAttribute("value", dat);
    strip.insertBefore(imgUrl, strip.firstChild);
    strip.style.filter = filter;
    // photos.appendChild(img);
  }
} */

function takePicture() {
  alert("dsdfsfsfsfs");
  const context = canvas.getContext("2d");
  context.drawImage(video, 0, 0, width, height);
  canvas.style.display = "block";
  var dat = getfilter();
  filter1.setAttribute("value", dat);
  filter2.setAttribute("value", dat);
  submitPic.value = canvas.toDataURL("image/png");
  takePictureForm.submit();
}

photoButton.disabled = true;
function manage(title) {
  if (title.value != "") photoButton.disabled = false;
  else photoButton.disabled = true;
}

uploadButton.disabled = true;
function manage1(title1) {
  if (title1.value != "" && uploaded.value != "") uploadButton.disabled = false;
  else uploadButton.disabled = true;
}
photoButton.addEventListener(
  "click",
  function(e) {
    takePicture();

    e.preventDefault();
  },
  false
);

// photoFilter.addEventListener("change", function(e) {
//   filter = e.target.value;
//   video.style.filter = filter;

//   e.preventDefault();
// });

// clearButton.addEventListener("click", function(e) {
//   photos.innerHTML = "";
//   filter = "none";
//   video.style.filter = filter;
//   photoFilter.selectedIndex = 0;
// });
function getfilter() {
  radiobutton = document.querySelector('input[name="filter"]:checked').value;
  if (radiobutton == "1") return 1;
  else if (radiobutton == "2") return 2;
  else if (radiobutton == "3") return 3;
  else if (radiobutton == "4") return 4;
  else if (radiobutton == "5") return 5;
  else return 6;
}
function changeFormula() {
  var value = getfilter();

  var formula = document.getElementById("myicons");
  if (value == 2) {
    formula.src = "http://localhost/public/img/sup/2.png";
  } else if (value == 3) {
    formula.src = "http://localhost/public/img/sup/3.png";
  } else if (value == 4) {
    formula.src = "http://localhost/public/img/sup/4.png";
  } else if (value == 5) {
    formula.src = "http://localhost/public/img/sup/5.png";
  } else if (value == 6) {
    formula.src = "http://localhost/public/img/sup/6.png";
  } else if (value == 1) {
    formula.src = "http://localhost/public/img/sup/1.png";
  }
}
function uploadpicture(src) {
  var pic = new Image();
  pic.src = src;
  pic.onload = function() {
    canvas.width = 200;
    canvas.height = 500;
    canvas.getContext("2d").drawImage(pic, 0, 0, width, width);
    uploaded.setAttribute("value", src);
    data1 = getfilter();
    filter2.setAttribute("value", data1);
  };
}

realFileBtn.addEventListener("change", function() {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.addEventListener("load", function() {
      uploadpicture(this.result);
    });
    reader.readAsDataURL(file);
  } else alert("No file chosen, yet");
});
