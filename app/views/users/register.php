<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="box">
    <h2>Register</h2>
    <p style="color: white;">Fill in your informations to register</p>
    <form method="POST" action="<?php echo URLROOT; ?>/users/register">



        <div class="inputBox">
        <input name="display_name" type="text" value="<?php echo $data['display_name']; ?>" required>
            <?php if(empty($data['display_name_err'])){ ?>
                <label for="">Username</label>
                <?php } else { ?>
                    <label style="width: 100%; color:red;" for=""><?php echo ($data['display_name_err']); ?></label>
                    <?php } ?>
        </div>



        <div class="inputBox">
        <input type="email"  name="email" value="<?php echo $data['email']; ?>" required>
            <?php if(empty($data['email_err'])){ ?>
                <label for="">Email</label>
                <?php } else { ?>
                    <label style="width: 100%; color:red;" for=""><?php echo ($data['email_err']); ?></label>
                    <?php } ?>
        </div>



        <div class="inputBox">
            <input type="password" name="password" value="<?php echo $data['']; ?>" required>
            <?php if(empty($data['password_err'])){ ?>
                <label for="">Password</label>
                <?php } else { ?>
                    <label style="width: 100%; color:red;" for=""><?php echo ($data['password_err']); ?></label>
                    <?php } ?>
        </div>
        
        

        <div class="inputBox">
            <input type="password" name="confirm_password" value="<?php echo $data['']; ?>" required>
            <?php if(empty($data['confirm_password_err'])){ ?>
                <label style="width: 100%" for="">Repeat Password</label>
                <?php } else { ?>
                    <label style="width: 100%; color:red;" for=""><?php echo $data['confirm_password_err']; ?></label>
                    <?php } ?>
        </div>


        <a  style="float:right;"  href="<?php echo URLROOT; ?>/users/login">Login</a>
        <a style="float:left;"  href="<?php echo URLROOT; ?>/users/recover">Forgot
                password?</a>
        <br>
        <br>
        <input type="submit" value="Register">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>