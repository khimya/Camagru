<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="box">
        <h2>Recover Account</h2>
    <form method="POST" action="<?php echo URLROOT; ?>/users/recover">
        <div class="inputBox">
            <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
            <?php if(empty($data['email_err'])){ ?>
                <label for="">Email</label>
                <?php } else { ?>
                    <label style="width: 100%; color:red;" for=""><?php echo ($data['email_err']); ?></label>
                    <?php } ?>
        </div>
        <a style="float: left;"  href="<?php echo URLROOT; ?>/users/login">Login</a>
        <a  style="float: right;"  href="<?php echo URLROOT; ?>/users/register">Register?</a>
        <br>
        <br>
        <input type="submit" value="Recover">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>