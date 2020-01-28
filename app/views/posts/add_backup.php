<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="photobooth">
  <a href="<?php echo URLROOT; ?>/posts" class="btn_back btn btn-dark">Back</a>
  <div class="controls">
    <button class="btn btn-primary" type="submit" onClick="takePhoto()">Take Photo</button>
  </div>

  <canvas id="strip_js" class="photo"></canvas>
  <video class="player"></video>
  <div class="strip"></div>
  <input type="file" class="file-chooser">
  <!-- image : -->
  <form method="POST">
    <h1>add Post</h1>
    <p>Create a post with this form</p>
    <label for="title"><b>Title:</b>
    <br>
    <label style="width: 100%; color:red;" for=""><?php echo ($data['title_err']); ?></label>
    <input class="new_post_inputs" type="text" placeholder="Enter the title of ur post" name="title" value="<?php echo $data['title']; ?>" required>
    <input name="image" type="hidden" value="<?php echo $data['image']; ?>" id="img64" required>
    <input type="submit">
  </form>
  <!-- sticker : -->
  <!-- <input type=" text" id="sticker" value="1"> -->
</div>

<audio class="snap" src="http://wesbos.com/demos/photobooth/snap.mp3" hidden></audio>
<?php require APPROOT . '/views/inc/footer.php'; ?>