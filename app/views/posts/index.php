<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="posts_container">
    <?php foreach ($data['posts'] as $post) : ?>

        <div class="profile block">
            <!-- <a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a> -->
            <div class="post_profile_pic">
                <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><img alt="userico" src="/camagru/public/img/user_ico/user_ico.jpg"></a> </div>
            <!-- poste image -->
            <div class="profile_name_posts">

                <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><?php echo $post->display_name; ?></a>

            </div>
            <div class="post_title">
                <p><?php echo $post->title; ?></p>
            </div>
            <div class="post_img">
                <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>"><img href alt="Anne Hathaway picture" src="<?php echo $post->image; ?>"></a>
            </div>
            <div class="showcomments">
                <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>">Show All Comments</a>
            </div>
            <div class="blabla">
                <form action="<?php echo URLROOT; ?>/posts/cmnt/<?php echo $post->postId; ?>" method="post">
                    <input name="blabla" type="text" placeholder="enter your comment here...">
                    <button class="publish" type="submit">Publish</button>
                </form>
            </div>

            <div class="lmard">

                <form action="<?php echo URLROOT; ?>/posts/like/<?php echo $post->postId; ?>" method="POST">
                    <div class="likes">
                        <input type="submit" value="<?php echo $post->like_count; ?>" />
                    </div>
                </form>
                <form action="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" method="POST">
                    <div class="comments">
                        <input type="submit" value="<?php echo $post->cmnt_count; ?>" />
                    </div>
                </form>
            </div>

            <div class="posts_info">
                <p>
                    Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<form action="<?php echo URLROOT; ?>/posts/page ?>" method="POST">

  <div class="pagination">
  <a href="?page=<?php echo $data['page'] - 1; ?>">Page précédente</a>  
    <a href="?page=<?php echo $data['page'] + 1; ?>">Page suivante</a>
  
  </div>
  
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>