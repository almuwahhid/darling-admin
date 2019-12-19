<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link href="<?php echo base_url('assets/vendor/fonts/circular-std/style.css" rel="stylesheet')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/concept/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')?>">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="col-md-12 center">
          <img src="<?php echo base_url('assets/images/logo.png')?>" alt="" style="height:140px;width:315px;margin-top:-5px" class="user-avatar-md rounded-circle">
        </div>
        <div class="card ">
            <div class="card-header text-center"><span class="splash-description">LOGIN ADMIN</span></div>
            <div class="card-body">
                <form role="form" action="" method="post">
                  <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                      <?= validation_errors() ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($error) && $error) : ?>
                      <div class="alert alert-success" role="alert">
                        <?= $error ?>
                      </div>
                    <?php endif;?>
                    <div class="form-group">
                        <input name="username" required class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input name="password" required class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js')?>"></script>
</body>
</html>
