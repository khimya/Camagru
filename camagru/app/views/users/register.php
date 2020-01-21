<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="main">


    <div class="container">
        <center>
            <div class="middle">
                <div id="login">

                <form method="POST" action="<?php echo URLROOT; ?>/users/register">
                        <h1 style="color: black">Register</h1>
                        <p style="color: black">Please fill in with your informations to Register</p>

                        <fieldset class="clearfix">

                            <span class="error"><?php echo $data['display_name_err']; ?></span>
                            <p><input name="display_name" type="text" Placeholder="Username" value="<?php echo $data['display_name']; ?>" required></p>
                            
                            <span class="error"><?php echo $data['email_err']; ?></span>
                            <p><input type="email" Placeholder="email" name="email" value="<?php echo $data['email']; ?>" required></p>


                            <span class="error"><?php echo $data['password_err']; ?></span>
                            <p><input type="password" Placeholder="Password" name="password" value="" required></p>
    

                            <span class="error"> <?php echo $data['confirm_password_err']; ?></span>
                            <p><input type="password" Placeholder="Password" name="confirm_password" value="" required></p>

                            <div>





                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="<?php echo URLROOT; ?>/users/login">back to login</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" name="create" value="Register"></span>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> <!-- end login -->
                <div class="logo">
                    <img src="/camagru/public/img/15701.svg" alt="42">

                    <div class="clearfix"></div>
                </div>

            </div>
        </center>
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>