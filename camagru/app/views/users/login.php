<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="login-popup">
    <?php flash('register_success'); ?>
        <form method="POST" action="<?php echo URLROOT; ?>/users/login" class="login-container">
            <h1>Login</h1>
            <p>Please fill in with your informations to login</p>
            <label for="display Name"><b>display name :</b></label>
            <span class="error"><?php echo ($data['display_name_err']); ?></span>
            <input type="text" placeholder="enter ur display name" name="display_name" value="<?php echo $data['display_name']; ?>" required>
            <label for="password"><b>Password :</b></label>
            <span class="error"><?php echo $data['password_err']; ?></span>
            <input type="password" placeholder="Enter Password" name="password" value="<?php echo $data['']; ?>" required>
            <input type="submit" class="forms_buttons"  value="Login">
            <a class="links" href="<?php echo URLROOT; ?>/users/register">No account? Register</a>
            <a class="links" style="margin-left:140px;" href="<?php echo URLROOT; ?>/users/recover">Forget Password?</a>
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>