<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Deposit
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Riwayat Deposit</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TANGGAL | WAKTU</th>
                                        <th>Metode Deposit</th>
                                        <th>Jumlah Deposit</th>
                                        <th>Jumlah Saldo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($deposit->result() as $data => $value) { ?>

                                    <?php

                                        if ($value->status == 'SUCCESS') {

                                            $class = 'label bg-success';

                                        } else {

                                            $class = 'label bg-yellow';

                                        }

                                    ?>

                                    <tr>
                                        <td><?=$value->deposit_id?></td>
                                        <td><?=$value->datetime?></td>
                                        <td><?=$value->method?></td>
                                        <td><?=$value->total_deposit?></td>
                                        <td><?=$value->total_balance?></td>
                                        <td><span class="<?=$class?>"><?=$value->status?></span></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $this->pagination->create_links()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>