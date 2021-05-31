<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SAN Kazoku | Masuk</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url();?>AdminLTE/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?=base_url();?>AdminLTE/plugins/iCheck/square/blue.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?=base_url();?>"><b>SAN</b> Kazoku</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><?=$message?></p>
                <form method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Nama Pengguna">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="BtnLogin">Masuk</button>
                    </div>
                </form>
                <hr>
                <div class="form-group">
                	<a class="btn btn-default btn-flat btn-block" href="<?=base_url('auth/register')?>">DAFTAR</a>
                	<a class="btn btn-default btn-flat btn-block" href="<?=base_url('auth/forgot_password')?>">LUPA PASSWORD</a>
                </div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="<?=base_url();?>AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?=base_url();?>AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?=base_url();?>AdminLTE/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
              });
            });
        </script>
    </body>
</html>