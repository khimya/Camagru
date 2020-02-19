let width = 500,
    height = 0,
    filter = 'none',
    streaming = false;

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const photoButton = document.getElementById('photo-button');
const clearButton = document.getElementById('clear-button');
const photoFilter = document.getElementById('photo-filter');
const submitPic = document.getElementById('img64');
const filter1 = document.getElementById('filter-src');

navigator.mediaDevices.getUserMedia({video: true, audio: false})
  .then(function(stream) {
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err) {
    console.log(`Error: ${err}`);
  });

  video.addEventListener('canplay', function(e) {
    if(!streaming) {
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);
  photoButton.addEventListener('click', function(e) {
    takePicture();

    e.preventDefault();
  }, false);
  photoFilter.addEventListener('change', function(e) {
    filter = e.target.value;
    video.style.filter = filter;

    e.preventDefault(); 
  });
  clearButton.addEventListener('click', function(e) {
    photos.innerHTML = '';
    filter = 'none';
    video.style.filter = filter;
    photoFilter.selectedIndex = 0;
  });
  function getfilter()
{
  radiobutton = document.querySelector('input[name="filter"]:checked').value;
  if (radiobutton == "imoji")
    return 1;
  else if (radiobutton == "dog")
    return 2;
  else if (radiobutton == "pokemon")
    return 3;
  else if (radiobutton == "loki")
    return 4;
  else if (radiobutton == "ndader")
    return 5;
  else
    return 6;
}

  function takePicture() {
  filter1.setAttribute('value', dat);
    const context = canvas.getContext('2d');
    if(width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      const imgUrl = canvas.toDataURL('image/png');
      const img = document.createElement('img');
      img.style.filter = filter;
      img.setAttribute('src', imgUrl);
      submitPic.value = imgUrl;
      submitPic.setAttribute('style',filter);
      filter = setAttribute('value', data);
      strip.insertBefore(imgUrl, strip.firstChild);
      strip.style.filter = filter
      photos.appendChild(img);
    }
  }