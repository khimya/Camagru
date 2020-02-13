<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
        <a href="<?php echo URLROOT; ?>/posts" class="btn_back btn btn-dark">Back</a>
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
        <input type="submit">
    </form>
</div>
<script src="<?php echo URLROOT; ?>/js/camera.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>