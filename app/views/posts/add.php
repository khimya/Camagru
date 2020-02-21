<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="posts_container">
        <?php foreach ($data as $post) : ?>

        <div class="profile block">
            <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->id; ?>" method="post">
                <input type="submit" value="Delete" class="delete">
            </form>
            <!-- <a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a> -->
            <div class="post_profile_pic">
            <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><img alt="userico" src="/camagru/public/img/user_ico/user_ico.jpg"></a> </div>
            <!-- poste image -->
            <div class="profile_name_posts">

                <a href="<?php echo URLROOT; ?>/posts/snitch/<?php echo $post->user_id; ?>"><?php echo $post->display_name; ?></a>

            </div>
            <div class="post_title">
                <p><?php echo $post->title; ?></p>
            </div>
            <div class="post_img">
                <img href alt="Anne Hathaway picture" src="<?php echo "/camagru/public/" . $post->image; ?>">
            </div>
            <div class="lmard">

                <form action="<?php echo URLROOT; ?>/posts/like/<?php echo $post->id; ?>" method="POST">
                    <div class="likes">
                        <input type="submit" value="<?php echo $post->like_count; ?>" />
                    </div>
                </form>
                <div class="comments">
                    <input type="submit" value="<?php echo $post->cmnt_count; ?>" />
                </div>

            </div>
            <div class="blabla">
                <form action="<?php echo URLROOT; ?>/posts/cmnt/<?php echo $post->id; ?>" method="post">
                    <input  name="blabla" type="text" placeholder="enter your comment here...">
                    <!-- <textarea name="blabla" id="commntarea" cols="50" rows="2"></textarea> -->
                    <button class="publish" type="submit">Publish</button>
                </form>
            </div>
            <!-- <textarea name="blabla" id="commntarea" cols="50" rows="2"></textarea> -->
            </form>
            <div class="posts_info">
                <p>
                    Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
    <p>locale_accept_from_http</p>
</div>
    
</div>
<div class="container">
    <a href="<?php echo URLROOT; ?>/posts" class="btn_back btn btn-dark">Back</a>
    <div class="main">
        <div class="container bg-secondary text-white  text-center my-3 py-4 rounded-pill">
            <div class="row">
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="imoji" checked><img src="/camagru/public/img/sup/1.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="dog"><img src="/camagru/public/img/sup/2.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="pokemon"><img src="/camagru/public/img/sup/3.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="loki"><img src="/camagru/public/img/sup/4.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="ndader"><img src="/camagru/public/img/sup/5.png" width="50px" height="50px">
                </div>
                <div class="col-sm-2">
                    <input type="radio" name="filter" value="jwan"><img src="/camagru/public/img/sup/6.png" width="50px" height="50px">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
            <label style="margin-right: 50px;" for="title"><b>Title:</b></label>
            <input class="new_post_inputs" type="text" placeholder="Enter the title of ur post" name="title" value="<?php echo $data['title']; ?>" required>

            <div class="top-container">
                <video id="video">Stream not available...</video>
                <button id="photo-button" class="btn btn-dark">
                    Take Photo
                </button>
                <select id="photo-filter" class="select">
                    <option value="none">Normal</option>
                    <option value="grayscale(100%)">Grayscale</option>
                    <option value="sepia(100%)">Sepia</option>
                    <option value="invert(100%)">Invert</option>
                    <option value="hue-rotate(90deg)">Hue</option>
                    <option value="blur(10px)">Blur</option>
                    <option value="contrast(200%)">Contrast</option>
                </select>
                <button id="clear-button" class="btn btn-light">Clear</button>
                <canvas id="canvas"></canvas>
            </div>
            <div class="bottom-container">
                <div id="photos"></div>
            </div>
            <input name="image" type="hidden" value="<?php echo $data['image']; ?>" id="img64" required>
            <input id="filter-src" type="hidden" name="num-fil" class="filter-tag">
            <input type="submit">
        </form>
    </div>
    <script src="<?php echo URLROOT; ?>/js/camera.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>