<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="posts_container black-font">
    <div class="row mb-3">
        <div class="col-md-6 white-font ">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary addpost">Add Post</a>
        </div>
    </div>
    <?php foreach ($data['posts'] as $post)  ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
            </div>
            <img class="posts_wall" src="<?php echo $post->image; ?>">
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
        </div>
    <?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>