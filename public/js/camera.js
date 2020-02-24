let width = 500,
  height = 0,
  filter = "none",
  streaming = false;

const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const photos = document.getElementById("photos");
const photoButton = document.getElementById("photo-button");
const clearButton = document.getElementById("clear-button");
const photoFilter = document.getElementById("photo-filter");
const submitPic = document.getElementById("img64");
const filter1 = document.getElementById("filter-src");

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

function takePicture() {
  var dat = getfilter();
  filter1.setAttribute("value", dat);
  const context = canvas.getContext("2d");
  if (width && height) {
    // set canvas props
    canvas.width = width;
    canvas.height = height;
    // Draw an image of the video on the canvas
    context.drawImage(video, 0, 0, width, height);

    const imgUrl = canvas.toDataURL("image/png");

    const img = document.createElement("img");

    img.style.filter = filter;
    img.setAttribute("src", imgUrl);
    submitPic.value = imgUrl;
    submitPic.setAttribute("style", filter);
    filter = setAttribute("value", dat);
    strip.insertBefore(imgUrl, strip.firstChild);
    strip.style.filter = filter;
    photos.appendChild(img);
  }
}

photoButton.addEventListener(
  "click",
  function(e) {
    takePicture();

    e.preventDefault();
  },
  false
);

photoFilter.addEventListener("change", function(e) {
  filter = e.target.value;
  video.style.filter = filter;

  e.preventDefault();
});

clearButton.addEventListener("click", function(e) {
  photos.innerHTML = "";
  filter = "none";
  video.style.filter = filter;
  photoFilter.selectedIndex = 0;
});
function getfilter() {
  radiobutton = document.querySelector('input[name="filter"]:checked').value;
  if (radiobutton == "1") return 1;
  else if (radiobutton == "2") return 2;
  else if (radiobutton == "3") return 3;
  else if (radiobutton == "4") return 4;
  else if (radiobutton == "5") return 5;
  else return 6;
}
function changeFormula(){
  var value = getfilter();
  
   var formula = document.getElementById("myicons");
   if (value == 2) {
     formula.src = "http://localhost/public/img/sup/2.png";
  }
  else if (value == 3){
      formula.src = "http://localhost/public/img/sup/3.png";
  }
  else if  (value == 4){
      formula.src = "http://localhost/public/img/sup/4.png";
  }
  
  else if (value == 5){
      formula.src = "http://localhost/public/img/sup/5.png";
  }
  
  else if (value == 6){
      formula.src = "http://localhost/public/img/sup/6.png";
  }
  else if (value == 1){
      formula.src = "http://localhost/public/img/sup/1.png";
  }
}