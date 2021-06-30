<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIPK | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/admin/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/admin/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style type="text/css">
  img{
      width: 80px;
      border-radius: 100%;
      position: relative;
      margin-top: -60px;

  }
</style>
<body class="hold-transition login-page" style="background-image: url(assets/img/bg1.png);background-size: 100% 130%">
<div class="login-box"><br>
 <!--  <div class="login-logo">
    <a href="assets/admin/index2.html"><b>Admin</b>LTE</a>
  </div> -->
  <!-- /.login-logo -->
  <div class="card" style="border-radius: 20px;background: rgba(0,0,0,0.4);color: white;">
    <div class="card-body login-card-body">
      <center>
          <img src="assets/img/keris.jpg" alt="">
      </center>
      <br>
      <p class="login-box-msg">masuk untuk memulai sesimu</p>
        <?php if(Session::get('error')){ ?>
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                 Username dan Password Tidak Cocok
            </div>
        <?php }?>
      <form action="/logaction">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="user" placeholder="Username" style="border-radius: 20px;padding: 10px;" autocomplete="off">
          <!-- <span class="fa fa-envelope form-control-feedback"></span> -->
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="pass" placeholder="Password" style="border-radius: 20px;padding: 10px;">
          <!-- <span class="fa fa-lock form-control-feedback"></span> -->
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 30px;padding: 10px"><b>Masuk</b></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!--  <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

     <!--  <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
