<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="register-popup">
        <form method="POST" action="<?php echo URLROOT; ?>/users/register" class="register-container">
            <h1>New User</h1>
            <label for="login"><b>Display Name</b></label>
            <span class="error"><?php echo $data['display_name_err']; ?></span>
            <input type="text" placeholder="Display Name" name="display_name" value="<?php echo $data['display_name']; ?>" required>
            <label for="email"><b>Email</b></label>
            <span class="error"><?php echo $data['email_err']; ?></span>
            <input type="email" placeholder="Enter a Valide Email" name="email" value="<?php echo $data['email']; ?>" required>
            <label for="psw"><b>Password</b></label>
            <span class="error"><?php echo $data['password_err']; ?></span>
            <input type="password" placeholder="Enter Password" name="password" value="" required>
            <label for="password"><b>Repeat Password</b></label>
            <span class="error"> <?php echo $data['confirm_password_err']; ?></span>
            <input type="password" placeholder="Repeat The Password" name="confirm_password" value="" required>
            <input type="submit" name="create" value="Register" class="btn">
            <a class="links" style="margin-right:190px" href="<?php echo URLROOT; ?>/users/recover">Forget Password?</a>
            <a class="links" href="<?php echo URLROOT; ?>/users/login">Old Member?</a>
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>