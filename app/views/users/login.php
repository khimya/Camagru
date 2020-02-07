<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="box">
    <h2>Login</h2>
    <form method="POST" action="<?php echo URLROOT; ?>/users/login">
        <div class="inputBox">
            <?php if (empty($data['display_name_err'])) { ?>
                <label for="">Username</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['display_name_err']); ?></label>
            <?php } ?>
            <input type="text" name="display_name" value="<?php echo $data['display_name']; ?>" required>
        </div>
        <div class="inputBox">
            <?php if (empty($data['password_err'])) { ?>
                <label for="">Password</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['password_err']); ?></label>
            <?php } ?>
            <input type="password" name="password" value="" required>
        </div>
        <a style="float: left;" href="<?php echo URLROOT; ?>/users/recover">Forgot
            password?</a>
        <a style="float: right;" href="<?php echo URLROOT; ?>/users/register">Register?</a>
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>