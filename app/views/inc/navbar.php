
<div id="navbar">
    <a href="<?php echo URLROOT; ?>">Home</a>
    <a href="<?php echo URLROOT; ?>/pages/about">About</a>
    <a href="javascript:void(0)">Contact</a>
    <?php if (isset($_SESSION['user_id'])) : ?>
        
        <div class="dropdown" style="float:right;">
            <button class="dropbtn">Right</button>
            <div class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/posts/me">My Profil</a>
                <a href="<?php echo URLROOT; ?>/users/setting">Setting</a>
                <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </div>
        </div>
        <?php else : ?>
            <a style="float:right" href="<?php echo URLROOT; ?>/users/register">Register</a>
            <a style="float:right" href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        <a style="float: right;" href="<?php echo URLROOT; ?>/posts/add">Add post</a>
</div>