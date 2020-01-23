<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <br>

<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary addpost">Add Post</a>

<div class="posts_container black-font">
    <div class="row mb-3">
        <div class="col-md-6 white-font ">
                    </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
        </div>
        <img class="posts_wall" src="<?php echo $post->image; ?>" alt="">
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
</div> -->    
<div class="posts_container">
    <?php foreach ($data['posts'] as $post) : ?>
        
        <div class="container">
            <div class="profile block">
                <!-- <a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a> -->
                <div class="profile-picture big-profile-picture clear">
                    <img  alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg" >
                </div>
                <!-- poste image -->
               <div class="profile_name_posts" >
                   <?php echo $post->display_name; ?>

               </div> 
               <div class="post_img">

                   <img  alt="Anne Hathaway picture" src="<?php echo $post->image; ?>" >
                </div>
                  
                <ul class="profile-options">
                    <li style="background-color: red;"><a href="#42"><p>49</li></p></a>
                    <li style="background-color: pink;"><a href="#40"><p>120</li></p></a>
                </ul>
                    
                    <div class="profile-description">
                        Written by <?php echo $post->display_name; ?> on <?php echo $post->created_at; ?>
                    <p class="scnd-font-color"><?php echo $post->title; ?></p>
                </div>
                
                
                
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>