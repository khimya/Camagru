<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="main">


    <div class="container">
        <center>
            <div class="middle">
                <div id="login">
                    <form method="POST" action="<?php echo URLROOT; ?>/users/recover">
                        <h1 style="color: black">Recover Password</h1>
                        <p style="color: black">Please fill in with your informations to login</p>

                        <fieldset class="clearfix">


                            <span class="error"><?php echo $data['email_err']; ?></span>
                            <p><input type="email" Placeholder="email" name="email" value="<?php echo $data['email']; ?>" required></p>

                            <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="<?php echo URLROOT; ?>/users/recover">login</a></span>
                                <span style="width:48%; text-align:right;  display: inline-block;"><a class="small-text" href="<?php echo URLROOT; ?>/users/register">Register?</a></span>
                                <span style="width:50%; margin:5px; text-align:right;  display: inline-block;">
                                    <input style="margin-right:20px;" type="submit" value="Recover"></span>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> end login
                <div class="logo">
                    <img src="/camagru/public/img/15701.svg" alt="42">

                    <div class="clearfix"></div>
                </div>

            </div>
        </center>
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>