<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="posts_container">
    <?php foreach ($data['posts'] as $post) : ?>

        <div class="profile block">
            <!-- <a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a> -->
            <div class="post_profile_pic">
                <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><img alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg"></a>
            </div>
            <!-- poste image -->
            <div class="profile_name_posts">

                <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><?php echo $post->display_name; ?></a>

            </div>
            <div class="post_title">
                <p><?php echo $post->title; ?></p>
            </div>
            <div class="post_img">
                <img href alt="Anne Hathaway picture" src="<?php echo $post->image; ?>">
            </div>
            <div class="reaction">
                <div class="likes">
                    <a href="">150</a>
                </div>

                <div class="comments">
                    <a href="">150</a>
                </div>
            </div>
            <div class="posts_info">
                <p>
                    Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>