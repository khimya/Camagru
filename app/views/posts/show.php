<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="profile block">
    <a href="<?php echo URLROOT; ?>/posts"><button class="return">Back</button></a>
    <?php if ($_SESSION['user_id']  == $data['post']->user_id) : ?>
        <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input class="delete" type="submit" value="Delete">
        </form>
    <?php endif; ?>
    <div class="post_profile_pic">
        <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><img alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg"></a> </div>
    <!-- poste image -->
    <div class="profile_name_posts">

        <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><?php echo $post->display_name; ?></a>

    </div>
    <div class="post_title">
        <p><?php echo $data['post']->title; ?></p>
    </div>
    <div class="post_img">
        <img alt="post_picture" src="<?php echo $data['post']->image; ?>">
    </div>
    <div class="lmard">

        <form action="<?php echo URLROOT; ?>/posts/like/<?php echo $data['post']->id; ?>" method="POST">
            <div class="likes">
                <input type="submit" value="<?php echo $data['post']->like_count; ?>" />
            </div>
        </form>
        <div class="comments">
            <input type="submit" value="<?php echo $data['post']->cmnt_count; ?>" />
        </div>
    </div>
    <?php foreach ($data['cmnt'] as $cmnt ) : ?>
        <?php var_dump($data['cmnt']); ?>
            <div class="dialogbox">
                <div class="body">
                    <span style="color: black;"><?php echo $data['cmnt']->cmnt; ?></span>
                </div>
            </div>
    <?php endforeach; ?>
    <!-- <textarea name="blabla" id="commntarea" cols="50" rows="2"></textarea> -->
    </form>

    <div class="posts_info">
        <p>created on <?php echo $data['post']->created_at; ?></p>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>