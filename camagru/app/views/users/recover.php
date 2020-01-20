<?php require APPROOT . '/views/inc/header.php'; ?>
<div id="myRecoverForm">
    <div class="recover-popup">
        <form method="POST" action="<?php echo URLROOT; ?>/users/recover" class="recover-container">
            <h1>Recover Password</h1>
            <label for="email"><b>Enter Your Email</b></label>
            <span class="error"> <?php echo (!empty($data['email_err'])); ?></span>
            <input type="email" placeholder="Enter Your Email Here" name="email" value="" required>
            <input type="submit" class="forms_buttons" name="Submit" value="Submit">
            <a id="backlogin_btn" class="forms_buttons cancel" href="<?php echo URLROOT; ?>/users/login">Back To Login</a>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>