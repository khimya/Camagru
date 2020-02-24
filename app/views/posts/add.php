<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container_galerie">
<?php foreach ($data['posts'] as $post) : ?>
    <div class="galerie">
    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->id; ?>"><img href alt="Anne Hathaway picture" src="<?php echo "/camagru/public/" . $post->image; ?>">
    </div>
    
  
    <?php endforeach; ?>
</div>
<div class="container">
    <a href="<?php echo URLROOT; ?>/posts" class="btn_back btn btn-dark">Back</a>
    <div class="main">
        <div class="container bg-secondary text-white  text-center my-3 py-4 rounded-pill">
            <div class="row">
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="imoji" checked><img src="/camagru/public/img/sup/1.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="dog"><img src="/camagru/public/img/sup/2.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="pokemon"><img src="/camagru/public/img/sup/3.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="loki"><img src="/camagru/public/img/sup/4.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="ndader"><img src="/camagru/public/img/sup/5.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="jwan"><img src="/camagru/public/img/sup/6.png" width="50px" height="50px">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
            <label style="margin-right: 50px;" for="title"><b>Title:</b></label>
            <input class="new_post_inputs" type="text" placeholder="Enter the title of ur post" name="title" value="<?php echo $data['title']; ?>" required>

            <div class="top-container">
                <video id="video">Stream not available...</video>
                <button id="photo-button" class="btn btn-dark">
                    Take Photo
                </button>
                <select id="photo-filter" class="select">
                    <option value="none">Normal</option>
                    <option value="grayscale(100%)">Grayscale</option>
                    <option value="sepia(100%)">Sepia</option>
                    <option value="invert(100%)">Invert</option>
                    <option value="hue-rotate(90deg)">Hue</option>
                    <option value="blur(10px)">Blur</option>
                    <option value="contrast(200%)">Contrast</option>
                </select>
                <button id="clear-button" class="btn btn-light">Clear</button>
                <canvas id="canvas"></canvas>
            </div>
            <div class="bottom-container">
                <div id="photos"></div>
            </div>
            <input name="image" type="hidden" value="<?php echo $data['image']; ?>" id="img64" required>
            <input id="filter-src" type="hidden" name="num-fil" class="filter-tag">
        </form>
        <!-- <form method="post" enctype="multipart/form-data">
      <input type="file" name="files[]" multiple />
      <input type="submit" value="Upload File" name="submit" />
    </form> -->
        
    </div>
    <script src="<?php echo URLROOT; ?>/js/camera.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>