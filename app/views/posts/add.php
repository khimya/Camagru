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
        <div class="bg-secondary text-white  text-center my-3 py-4 rounded-pill">
            <div class="row">
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="1" checked><img src="/camagru/public/img/sup/1.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="2"><img src="/camagru/public/img/sup/2.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="3"><img src="/camagru/public/img/sup/3.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="4"><img src="/camagru/public/img/sup/4.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="5"><img src="/camagru/public/img/sup/5.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input onclick="changeFormula()" type="radio" name="filter" value="6"><img src="/camagru/public/img/sup/6.png" width="50px" height="50px">
                </div>
            </div>
        </div>
        <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
        <div class="post_title_input">
            <input type="text" placeholder="Enter the title of ur post" name="title" value="" required>

        </div>

            <div class="top-container">
                <div class="test">
                    <img id="myicons" src="/public/img/sup/1.png"  alt="dd">
                    <video id="video">Stream not available...</video>
                </div>
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
            <div class="col-sm-5 mt-2">
                        <input type="file" id="real-file" hidden="hidden" accept="image/*">
                        <button type="button" id="custom-button" class="btn btn-primary">CHOOSE AN IMAGE</button>
                        <span id="custom-text">No file chosen, yet</span>
                </div>
        </form>
        <!-- <form method="post" enctype="multipart/form-data">
      <input type="file" name="files[]" multiple />
      <input type="submit" value="Upload File" name="submit" />
    </form> -->
        
    </div>
    <script src="<?php echo URLROOT; ?>/js/camera.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>