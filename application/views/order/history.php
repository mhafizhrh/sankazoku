<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemesanan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Riwayat Pemesanan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TANGGAL | WAKTU</th>
                                        <th>Layanan</th>
                                        <th>Target</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($history->result() as $data => $value) { ?>

                                    <?php

                                        if ($value->status == 'Success') {

                                            $class = 'label bg-green';

                                        } else if ($value->status == 'Processing') {

                                            $class = 'label bg-teal';

                                        } else if ($value->status == 'Pending') {

                                            $class = 'label bg-yellow';

                                        } else {

                                        	$class = 'label bg-red';

                                        }

                                    ?>

                                    <tr>
                                        <td><?=$value->order_id?></td>
                                        <td><?=$value->datetime?></td>
                                        <td><?=$value->name?></td>
                                        <td><input class="form-control" value="<?=$value->target?>" readonly></td>
                                        <td><?=$value->quantity?></td>
                                        <td><?=$value->price?></td>
                                        <td><span class="<?=$class?>"><?=strtoupper($value->status)?></span></td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-details-<?=$value->order_id?>"><i class="fa fa-list"></i></button>
                                            <div class="modal fade" id="modal-details-<?=$value->order_id?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Detail Pemesanan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>Order ID</b></td>
                                                                    <td><?=$value->order_id?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Jumlah Awal</b></td>
                                                                    <td><?=$value->start_count?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Jumlah Sisa</b></td>
                                                                    <td><?=$value->remains?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Link/Url Khusus</b></td>
                                                                    <td><input type="text" value="<?=$value->custom_link?>" class="form-control" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Komentar Khusus</b></td>
                                                                    <td><textarea class="form-control" rows="10" readonly><?=str_replace('\r\n', '&#013', $value->custom_comments)?></textarea></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                              <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
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
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>