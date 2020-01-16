<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="login-popup">
    <?php flash('register_success'); ?>
        <form method="POST" action="<?php echo URLROOT; ?>/users/login" class="login-container">
            <h1>Login</h1>
            <p>Please fill in with your informations to login</p>
            <label for="email"><b>Email</b></label>
            <span class="error"><?php echo ($data['email_err']); ?></span>
            <input type="email" placeholder="Enter Email" name="email" value="<?php echo $data['email']; ?>" required>
            <label for="password"><b>Password</b></label>
            <span class="error"><?php echo $data['password_err']; ?></span>
            <input type="password" placeholder="Enter Password" name="password" value="<?php echo $data['']; ?>" required>
            <input type="submit" class="btn"  value="Login">
            <a class="links" href="<?php echo URLROOT; ?>/users/register">No account? Register</a>
            <a class="links" style="margin-left:140px;" href="<?php echo URLROOT; ?>/users/recover">Forget Password?</a>
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>