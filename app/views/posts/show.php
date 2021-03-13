<?php require APPROOT . '/views/inc/header.php'; ?>

    <a href="<?php echo URLROOT; ?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

    <h1><?php echo $data['post']->title; ?></h1>
    <img src="<?php echo URLROOT; ?>/upload/<?php echo $data['post']->post_image ?>" alt="">
    <div class="bg-secondary text-white p-2 mb-3">
        Written by  <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?> 
    </div>
    <div class="div"><?php echo $data['post']->post_views_count; ?> views</div>
    <p><?php echo $data['post']->body; ?></p>
    <?php if($data['post']->user_id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin') : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
        <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <?php endif; ?>
 
    <hr class="mt-5 mb-5">

    <!-- Comments Form -->
    <div class="well mt-5">
        <h4>Leave a Comment:</h4>
        <form role="form" action="<?php echo URLROOT; ?>/comments/add/<?php echo $data['post']->id; ?>" method="post">
            <div class="form-group">
                <textarea class="form-control" rows="3" name="body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>


    <h2>Comments(<?php echo count($data['comments']); ?>)</h2>

    <!-- Comment -->
    <?php foreach($data['comments'] as $comment) : ?>
        <div class="media mb-5 mt-5">
            
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <div class="d-flex justify-content-between ml-3">
                        <h4 class="media-heading"><?php echo $comment->author; ?></h4>
                        
                            <div class="d-inline">

                                <?php if($comment->user_id == $_SESSION['user_id']) : ?>
                                    <span id="<?php echo $comment->id; ?>" href="" class="btn btn-outline-primary edit_comment">Edit</span>
                                <?php endif; ?>

                                <?php if($data['post']->user_id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin' || $comment->user_id == $_SESSION['user_id']) : ?>
                                    <a href="" class="btn btn-outline-danger">Delete</a>
                                <?php endif; ?>

                            </div>
                        
                    </div>
                    <div class="display-flex justify-content-between ml-3">
                    <?php if($comment->user_id == $_SESSION['user_id']) : ?>
                        <form id="input_reply_<?php echo $comment->id; ?>" class="display-none" action="<?php echo URLROOT; ?>/comments/edit/<?php echo $comment->id; ?>/<?php echo $data['post']->id; ?>" method="post">
                            <input class="form-control" type="text" name="body" value="<?php echo $comment->body; ?>">
                            <button type="submit" class="btn btn-primary ml-3 display-flex" >Update</button>
                            <span id="edit_cancel_<?php echo $comment->id; ?>" class="btn btn-secondary ml-3 cancel_comment">Cancel</span>
                        </form>
                        <span id="reply_<?php echo $comment->id; ?>" class="display-flex"><?php echo $comment->body; ?></span>
                    <?php endif; ?>
                    <?php if($comment->user_id !== $_SESSION['user_id']) : ?>
                        <span><?php echo $comment->body; ?></span>
                    <?php endif; ?>
                        <span>Created_at: <?php echo $comment->created_at; ?></span>
                    </div>
                </div>
            
        </div>
    <?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>