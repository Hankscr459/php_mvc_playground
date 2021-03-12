<?php require APPROOT . '/views/inc/admin_header.php'; ?>


    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-12 col-md-2 d-md-block bg-light sidebar height100vh">
          <?php require APPROOT . '/views/inc/side_nav.php'; ?>
        </nav>

        <main role="main" class="col-sm-12 col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <h1><?php echo $data['title']; ?></h1>
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Created_At</th>
                    <th scope="col">PostViews</th>
                    <th scope="col">manage</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['posts'] as $post) : ?>
                    <tr>

                        <th width='5%' scope="row">
                            <?php echo $post->postId; ?>
                        </th>

                        <td width='8%'>
                            <img class="table__img" src="<?php echo URLROOT; ?>/upload/<?php echo $post->post_image ?>" alt="">
                        </td>

                        <td width='20%'>
                            <a 
                                href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>"
                                class=""
                            >
                                <?php echo $post->title; ?>
                            </a>
                        </td>

                        <td width='8%'>
                            <?php echo $post->name; ?>
                        </td>

                        <td width='15%'>
                            <?php echo $post->postCreated; ?>
                        </td>
                        
                        <td width='5%' class="text-center">
                            <?php echo $post->post_views_count; ?>
                        </td>

                        <td width='7%' class="text-center">
                            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->postId; ?>" class="btn btn-dark">Edit</a>
                            <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->postId; ?>" method="post">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


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
          
        </main>
      </div>
    </div>
<?php require APPROOT . '/views/inc/admin_footer.php'; ?>