<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('post_message'); ?>
    <div class="row justify-content-between mb-3 mt-5">

        <div class="col-md-6 col-offset-4">
            <h1>Posts (<?php echo $data['posts_total']; ?>)</h1>
            <h2>Current Page: <?php echo $data['current_page']; ?> Total Page: <?php echo $data['page_total']; ?></h2>
        </div>

        <div class="col-md-2">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
        
    </div>
    

    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <img src="<?php echo URLROOT; ?>/upload/<?php echo $post->post_image ?>" alt="">
            <div class="">
                Comments: <?php echo $post->post_comments_count; ?>
            </div>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
            </div>
            <p class="card-text"><?php echo $post->body; ?></p>
            <a 
                href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>"
                class="btn btn-dark"
            >
            More
            </a>
        </div>
    <?php endforeach; ?>
    <ul class="pagination">
    <?php 
        for ($i=1; $i <= $data['page_total'] ; $i++) {
            if($i == $data['current_page']) {
                echo "<li class='active page-item'><a class='page-link' href='posts?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='posts?page={$i}'>{$i}</a></li>";
            }
        }
    ?>
    </ul>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>