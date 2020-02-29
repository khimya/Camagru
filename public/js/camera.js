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
const realFileBtn = document.getElementById("realFileBtn");
const uploaded = document.getElementById("uploaded");

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
    canvas.width = width;
    canvas.height = height;
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

function uploadpicture(src)
{
    var pic = new Image();
    pic.src = src;
    pic.onload = function()
    {
      // alert(src);
      canvas.width = 200;
      canvas.height = 500;
      canvas.getContext('2d').drawImage(pic, 0, 0, 500, 500);
      uploaded.setAttribute('value', src);
      data = getfilter();
      filter1.setAttribute('value', data);
    }
}

realFileBtn.addEventListener("change", function(){
  var file = this.files[0];
  if (file)
  {
    var reader = new FileReader();
    reader.addEventListener("load", function(){
      uploadpicture(this.result);
    });
    reader.readAsDataURL(file);
    // customTxt.innerHTML = "choosen";
  }
  else
    alert("No file chosen, yet");
});
// window.addEventListener('load', function() {
//   document.querySelector('input[type="file"]').addEventListener('change', function() {
//       if (this.files && this.files[0]) {
//         // var img =   document.getElementById("myImg");
//         //   // var img = document.querySelector('img');  // $('img')[0]
//         //   img.src = URL.createObjectURL(this.files[0]); // set src to blob url
//         //   img.onload = imageIsLoaded;
//         uploadpicture(this.files[0]);
//       }
//   });
// });



// function imageIsLoaded() { 
//   alert(this.src);  // blob url
//   // update width and height ...
// }
