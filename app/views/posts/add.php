<?php require APPROOT . '/views/inc/header.php'; ?>

    <a href="<?php echo URLROOT; ?>" class="btn btn-light mt-5"><i class="fa fa-backward"></i> Back</a>
    <div class="row">
            <div class="card card-body bg-light mt-5">
                <h2>Add Post</h2>
                <p>Create a post with this form</p>
                <form action="<?php echo URLROOT; ?>/posts/add" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="title">Title: <sup>*</sup></label>
                        <input 
                            type="text" 
                            name="title" 
                            class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $data['title']; ?>"
                            
                        >
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="post_image">Image: <sup>*</sup></label>
                        <input 
                            type="file" 
                            class="form-control-file <?php echo (!empty($data['post_image_err'])) ? 'is-invalid' : ''; ?>" 
                            name="post_image" 
                            value="<?php echo $data['post_image']; ?>"
                        >
                            <span class="invalid-feedback"><?php echo $data['post_image_err']; ?></span>
                    </div>

                    <?php
                        if(isset($data['post_image_err'])) {
                            echo $data['post_image_err'];
                        }
                    ?>

                    <div class="form-group">
                        <label for="body">body: <sup>*</sup></label>
                        <textarea 
                            name="body" 
                            class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $data['body']; ?>"
                            
                        ></textarea>
                        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit" name="submit">

                </form>
            </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
