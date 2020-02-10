<?php require APPROOT . '/views/inc/header.php'; ?>
<?php if (!isLoggedIn()) redirect('users/login'); ?>

<div class="box">
    <h2>Change Settings</h2>
    <p style="color: white;">Fill in just the informations you want to change</p>
    <form method="POST" action="<?php echo URLROOT; ?>/users/changes">



        <div class="inputBox">
            <?php if (empty($data['display_name_err'])) { ?>
                <label for="">Username</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['display_name_err']); ?></label>
            <?php } ?>
            <input name="display_name" type="text" value="">
        </div>



        <div class="inputBox">
            <?php if (empty($data['email_err'])) { ?>
                <label for="">Email</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['email_err']); ?></label>
            <?php } ?>
            <input type="email" name="email" value="">
        </div>



        <div class="inputBox">
            <?php if (empty($data['currentPassword_err'])) { ?>
                <label for="">CurrentPassword</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo ($data['currentPassword_err']); ?></label>
            <?php } ?>
            <input type="password" name="currentPassword" value="" >
        </div>



        <div class="inputBox">
            <?php if (empty($data['newPassword_err'])) { ?>
                <label style="width: 100%" for="">New Password</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo $data['newPassword_err']; ?></label>
            <?php } ?>
            <input type="password" name="newPassword" value="" >
        </div>
        <div class="inputBox">
            <?php if (empty($data['confirmNewPassword_err'])) { ?>
                <label style="width: 100%" for="">Confirm New Password</label>
            <?php } else { ?>
                <label style="width: 100%; color:red;" for=""><?php echo $data['confirmNewPassword_err']; ?></label>
            <?php } ?>
            <input type="password" name="confirmNewPassword" value="" >
        </div>

        <br>
        <input type="submit" value="apply">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>