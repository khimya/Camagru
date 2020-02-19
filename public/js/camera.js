// Global Vars
let width = 500,
    height = 0,
    filter = 'none',
    streaming = false;

// DOM Elements
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const photoButton = document.getElementById('photo-button');
const clearButton = document.getElementById('clear-button');
const photoFilter = document.getElementById('photo-filter');
const submitPic = document.getElementById('img64');

// Get media stream
navigator.mediaDevices.getUserMedia({video: true, audio: false})
  .then(function(stream) {
    // Link to the video source
    video.srcObject = stream;
    // Play video
    video.play();
  })
  .catch(function(err) {
    console.log(`Error: ${err}`);
  });

  // Play when ready
  video.addEventListener('canplay', function(e) {
    if(!streaming) {
      // Set video / canvas height
      height = video.videoHeight / (video.videoWidth / width);

      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);

      streaming = true;
    }
  }, false);

  // Photo button event
  photoButton.addEventListener('click', function(e) {
    takePicture();

    e.preventDefault();
  }, false);

  // Filter event
  photoFilter.addEventListener('change', function(e) {
    // Set filter to chosen option
    filter = e.target.value;
    // Set filter to video
    video.style.filter = filter;

    e.preventDefault(); 
  });

  // Clear event
  clearButton.addEventListener('click', function(e) {
    // Clear photos
    photos.innerHTML = '';
    // Change filter back to none
    filter = 'none';
    // Set video filter
    video.style.filter = filter;
    // Reset select list
    photoFilter.selectedIndex = 0;
  });

  // Take picture from canvas
  function takepicture() {
    photo.setAttribute('value', data);
    data = getfilter();
    filter.setAttribute('value', data);
    realFileBtn.value = "";
    customTxt.innerHTML = "No file chosen, yet";
  }
  function takePicture() {
    // Create canvas
    const context = canvas.getContext('2d');
    if(width && height) {
      // set canvas props
      canvas.width = width;
      canvas.height = height;
      // Draw an image of the video on the canvas
      context.drawImage(video, 0, 0, width, height);

      // Create image from the canvas
      const imgUrl = canvas.toDataURL('image/png');

      // Create img element
      const img = document.createElement('img');
      
      img.style.filter = filter;
      // Set img src
      img.setAttribute('src', imgUrl);
      submitPic.value = imgUrl;
      submitPic.setAttribute('style',filter);
      filter = setAttribute('value', data);
  strip.insertBefore(imgUrl, strip.firstChild);
  strip.style.filter = filter

      // Set image filter

      // Add image to photos
      photos.appendChild(img);
    }
  }
  function getfilter()
{
  radiobutton = document.querySelector('input[name="filter"]:checked').value;
  if (radiobutton == "imoji")
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/1.png');
    return 1;
  }
  else if (radiobutton == "dog")
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/2.png');
    return 2;
  }
  else if (radiobutton == "pokemon")
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/3.png');
    return 3;
  }
  else if (radiobutton == "loki")
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/4.png');
    return 4;
  }
  else if (radiobutton == "ndader")
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/5.png');
    return 5;
  }
  else
  {
    document.getElementById('snap').setAttribute('src', 'public/img/sup/6.png');
    return 6;
  }
}