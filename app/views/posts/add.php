<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  <a href="<?php echo URLROOT; ?>/posts" class="btn_back btn btn-dark">Back</a>
  <label style="margin-right: 50px;" for="title"><b>Title:</b></label>
  <input class="new_post_inputs" type="text" placeholder="Enter the title of ur post" name="title" value="<?php echo $data['title']; ?>" required>
<div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton">Take photo</button>
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
  </div>
      <!-- <input name="image" type="hidden" value="<?php echo $data['image']; ?>" id="img64" required> -->
      <!-- <input type="submit"> -->
    <!-- </form> -->
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>