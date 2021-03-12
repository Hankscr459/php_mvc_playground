<?php require APPROOT . '/views/inc/admin_header.php'; ?>


    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-12 col-md-2 d-md-block bg-light sidebar height100vh">
          <?php require APPROOT . '/views/inc/side_nav.php'; ?>
        </nav>

        <main role="main" class="col-sm-12 col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>

          <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

          
        </main>
      </div>
    </div>
<?php require APPROOT . '/views/inc/admin_footer.php'; ?>