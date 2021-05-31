<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TIKET
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">TIket Saya</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <a class="btn btn-primary btn-flat" href="<?=base_url('ticket/new')?>"><i class="fa fa-envelope"></i> Buat Tiket Baru</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal | Waktu dibuat</th>
                                        <th>Subjek</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pagination->result() as $data => $value) {
                                        if ($value->status == 'RESPONDED') {
                                            
                                            $status = 'RESPONDED';
                                            $class = 'label bg-green';
                                        
                                        } else {
                                        
                                            $status = 'PENDING';
                                            $class = 'label bg-yellow';
                                        
                                        }
                                        
                                        ?>
                                    <tr>
                                        <td><?=$value->datetime?></td>
                                        <td><a href="<?=base_url('ticket/reply/'.$value->ticket_id)?>"><?=$value->subject?></a></td>
                                        <td><span class="<?=$class?>"><?=$status?></span></td>
                                    </tr>
                                    <?php } if ($pagination->num_rows() == 0) { echo "<tr><td colspan='3' align='center'>Belum ada tiket</td></tr>"; } ?>
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