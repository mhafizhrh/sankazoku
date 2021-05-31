<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>Rp. </h3>

                        <p>Saldo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="<?=base_url('user/balance_usage')?>" class="small-box-footer">Lihat Pemakaian Saldo <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53</h3>

                        <p>Total Pemesanan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="<?=base_url('order/history')?>" class="small-box-footer">Lihat Riwayat Pemesanan <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Total Deposit</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <a href="<?=base_url('deposit/history')?>" class="small-box-footer">Lihat Rimawat Deposit <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Informasi</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                                        <a class="btn btn-primary" href="<?=base_url('admin/information/new')?>"><i class="fa fa-plus"></i> Buat informasi Baru</a>
                                    </div>
                                    <div class="form-group">
                                        <?=$message?>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="230">TANGGAL | WAKTU</th>
                                                    <th width="180">KATEGORI</th>
                                                    <th>ISI</th>
                                                </tr>    
                                            </thead>
                                            <tbody>
                                                <?php foreach ($info->result() as $data => $value) { ?>

                                                <tr>
                                                    <td><?=$value->date_time?></td>
                                                    <td><?=$value->category?></td>
                                                    <td><?=$value->contents?></td>
                                                    <td>
                                                        <a class="btn btn-danger btn-circle" href="<?=base_url('admin/information/'.$start.'/'.$value->id.'/delete')?>">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php echo $this->pagination->create_links()?>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Buat Informasi Baru</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-gray-900"> Informasi Terbaru</h6>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->