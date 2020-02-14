<?php require APPROOT . '/views/inc/header.php'; ?>
<?php if (isLoggedIn()) redirect('posts'); ?>

<div class="box">
    <h2>Register</h2>
    <p style="color: white;">Fill in your informations to register</p>
    <form method="POST" action="<?php echo URLROOT; ?>/users/register">



        <div class="inputBox">
            <?php if (empty($data['display_name_err'])) { ?>
                <label for="">Username</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['display_name_err']); ?></label>
            <?php } ?>
            <input name="display_name" type="text" value="<?php echo $data['display_name']; ?>" required>
        </div>



        <div class="inputBox">
            <?php if (empty($data['email_err'])) { ?>
                <label for="">Email</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['email_err']); ?></label>
            <?php } ?>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
        </div>



        <div class="inputBox">
            <?php if (empty($data['password_err'])) { ?>
                <label for="">Password</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['password_err']); ?></label>
            <?php } ?>
            <input type="password" name="password" value="" required>
        </div>



        <div class="inputBox">
            <?php if (empty($data['confirm_password_err'])) { ?>
                <label style="width: 100%" for="">Confirm Password</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo $data['confirm_password_err']; ?></label>
            <?php } ?>
            <input type="password" name="confirm_password" value="" required>
        </div>


        <a style="float:right;" href="<?php echo URLROOT; ?>/users/login">Login</a>
        <a style="float:left;" href="<?php echo URLROOT; ?>/users/recover">Forgot
            password?</a>
        <br>
        <br>
        <input type="submit" value="Register">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>