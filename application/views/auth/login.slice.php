<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TIPSEN | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ base_url() }}assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ base_url() }}assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ base_url() }}assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ base_url() }}assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <center>
                                    <h3>TIPSEN</h3>
                                </center>
                            </div>
                            <!-- BUAT MESSAGE ERROR <h6 class="font-weight-light"></h6> -->
                            <?php echo form_open("auth/login"); ?>
                            <form class="pt-3">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="identity">
                                </div>
                                <div class=" form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                                </div>
                                <div class="mt-3">
                                    <input type="submit" value="Masuk" name="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                </div>
                            </form>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ base_url() }}assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ base_url() }}assets/js/off-canvas.js"></script>
    <script src="{{ base_url() }}assets/js/hoverable-collapse.js"></script>
    <script src="{{ base_url() }}assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>