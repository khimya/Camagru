<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="profil_posts"> -->
    <div class="profile block">
        <a href="<?php echo URLROOT; ?>/posts"><button class="return" >Back</button></a>
        
        <?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
            <!-- <hr> -->
            <!-- <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>">Edit</a> -->
            <form  action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
                <input  class="delete" type="submit" value="Delete">
            </form>
        <?php endif; ?>
    <!-- <br> -->
    <div class="post_title">
                   <p><?php echo $data['post']->title; ?></p>
               </div>
               <div class="post_img">
               <img  alt="post_picture" src="<?php echo $data['post']->image; ?>" >
               </div>
               <div class="posts_info">
                        <p>created on <?php echo $data['post']->created_at; ?></p>
                </div>    
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>