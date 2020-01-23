<ul class="navbar_ul">
    <li class="navbar_li"><a class="icon" href="<?php echo URLROOT; ?>"><img class="img_icon" src="/camagru/public/img/15701.svg" alt="website_icon"></a></li>
    <li class="navbar_li"><a href="<?php echo URLROOT; ?>">Home</a></li>
    <li class="navbar_li"><a href="<?php echo URLROOT; ?>/pages/about">About</a></li>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <li style="float:right"><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
    <?php else : ?>
        <li class="navbar_li" style="float:right"><a href="<?php echo URLROOT; ?>/users/register">Register</a></li>
        <li class="navbar_li" style="float:right"><a href="<?php echo URLROOT; ?>/users/login">Login</a></li>
    <?php endif; ?>
</ul>
