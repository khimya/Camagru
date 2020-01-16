<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="pages">
    <h1><?php echo $data['title']; ?></h1>
    <p><?php echo $data['description']; ?></p>
    <p>Version: <strong><?php echo APPVERSION; ?></strong></p>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>