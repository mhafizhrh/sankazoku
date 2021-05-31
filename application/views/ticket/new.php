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
                <?=$message?>
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Tiket Baru</h3>
                    </div>
                    <div class="box-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Subjek :</label>
                                <input type="text" name="subject" class="form-control" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label>Pesan :</label>
                                <textarea class="form-control" name="message" maxlength="1000" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary" name="new">Buat</button>
                            </div>
                        </form>
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