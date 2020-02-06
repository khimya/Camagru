<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="create_posts_container">

    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">Back</a>
    <form method="POST" action="<?php echo URLROOT; ?>/posts/edit/<?php $data['id']; ?>" class="login-container">
        <h1>Edit post</h1>
        <p>Create a post with this form</p>
        <label for="title"><b>Title:</b></label>
        <span class="error"><?php echo ($data['title_err']); ?></span>
        <input class="new_post_inputs" type="text" placeholder="Enter the title of ur post" name="title" value="<?php echo $data['title']; ?>" required>
        <label for="Body"><b>Body</b></label>
        <span class="error"><?php echo $data['body_err']; ?></span>
        <textarea name="body" type=" text" placeholder="Enter the body of ur post" value="<?php echo $data['body']; ?>" required></textarea>
        <input type="submit" class="btn btn-success" value="submit">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>