<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAN Kazoku</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/320b01b5e8.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?=base_url();?>AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url();?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>K</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SAN</b> Kazoku</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url();?>AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?=$full_name?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=base_url();?>AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?=$full_name?> - Member
                                        <small>Member since Nov. 2012 <?=strlen('');?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=base_url('user/settings');?>" class="btn btn-default btn-flat">Pengaturan</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=base_url('logout');?>" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?=base_url();?>AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?=$full_name?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="<?=base_url();?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview <?php if ($this->uri->segment(1) == 'order') { echo "active"; }?>">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Pemesanan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=base_url('order/new');?>"><i class="fa fa-circle-o"></i> Pesan Baru</a></li>
                            <li><a href="<?=base_url('order/history');?>"><i class="fa fa-circle-o"></i> Riwayat Pemesanan</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php if ($this->uri->segment(1) == 'deposit') { echo "active"; }?>">
                        <a href="#">
                            <i class="fa fa-money"></i>
                            <span>Deposit</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=base_url('deposit/manual');?>"><i class="fa fa-circle-o"></i> Deposit Manual</a></li>
                            <li><a href="<?=base_url('deposit/auto');?>"><i class="fa fa-circle-o"></i> Deposit Otomatis</a></li>
                            <li><a href="<?=base_url('deposit/history');?>"><i class="fa fa-circle-o"></i> Riwayat Deposit</a></li>
                        </ul>
                    </li>
                    <li class="<?php if ($this->uri->segment(2) == 'services') { echo "active"; }?>">
                        <a href="<?=base_url('page/services')?>">
                            <i class="fa fa-list-alt"></i>
                            <span>Daftar Layanan</span>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(1) == 'ticket') { echo "active"; }?>">
                        <a href="<?=base_url('ticket')?>">
                            <i class="fa fa-envelope"></i>
                            <span>Tiket</span>
                        </a>
                    </li>
                    <!-- <li class="<?php if ($this->uri->segment(1) == 'api') { echo "active"; }?>">
                        <a href="<?=base_url('api')?>">
                            <i class="fa fa-globe"></i>
                            <span>API</span>
                        </a>
                    </li> -->
                    <li class="<?php if ($this->uri->segment(1) == 'user/user_guide') { echo "active"; }?>">
                        <a href="<?=base_url('user/user_guide')?>">
                            <i class="fa fa-question-circle"></i>
                            <span>Panduan Pengguna</span>
                        </a>
                    </li>
            </section>
            <!-- /.sidebar -->
        </aside>
