<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="profile block">
    <a href="<?php echo URLROOT; ?>/posts"><button class="return">Back</button></a>
    <?php if ($_SESSION['user_id']  == $data['post']->user_id) : ?>
        <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input class="delete" type="submit" value="Delete">
        </form>
    <?php endif; ?>
    <div class="post_profile_pic">
    <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><img alt="userico" src="/camagru/public/img/user_ico/user_ico.jpg"></a> </div>
    <!-- poste image -->
    <div class="profile_name_posts">

        <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $data['post']->user_id; ?>"><?php echo $data['user']->display_name; ?></a>

    </div>
    <div class="post_title">
        <p><?php echo $data['post']->title; ?></p>
    </div>
    <div class="post_img">
        <img alt="post_picture" src="<?php echo "/camagru/public/" . $data['post']->image; ?>">
    </div>
    <div class=" lmard">

        <form action="<?php echo URLROOT; ?>/posts/like/<?php echo $data['post']->id; ?>" method="POST">
            <div class="likes">
                <input type="submit" value="<?php echo $data['post']->like_count; ?>" />
            </div>
        </form>
        <div class="comments">
            <input type="submit" value="<?php echo $data['post']->cmnt_count; ?>" />
        </div>

    </div>
    <div class="blabla">
        <form action="<?php echo URLROOT; ?>/posts/cmnt/<?php echo $data['post']->id; ?>" method="post">
            <input id="commntarea" name="blabla" type="text" placeholder="enter your comment here...">
            <!-- <textarea name="blabla" id="commntarea" cols="50" rows="2"></textarea> -->
            <button class="publish" type="submit">Publish</button>
        </form>
    </div>
    <?php foreach ($data['cmnt'] as $cmnt) : ?>
        <div class="dialogbox">
            <div class="body">
                <span style="color: black;"><?php echo $cmnt->cmnt; ?></span>
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