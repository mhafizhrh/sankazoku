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
            <div class="col-lg-7 col-md-7 col-xs-12">
                <?=$message?>
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Deposit Otomatis</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" id="box">
                            <div class="form-group">
                                <label>Metode Deposit :</label>
                                <select class="form-control" id="method" name="method">
                                    <option value="0" selected="">Pilih metode deposit</option>
                                    <option value="1">TRANSFER PULSA TELKOMSEL</option>
                                </select>
                            </div>
                            <div id="form">
                                
                            </div>
                            <div class="form-group">
                                <label>Jumlah Deposit :</label>
                                <input type="number" id="total_transfer" name="total_transfer" class="form-control">
                            </div>
                            <div class="form-group" id="custom_link">
                                <label>Jumlah Saldo yang didapat :</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="number" class="form-control" id="total_get" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                <button type="submit" class="btn btn-primary btn-flat" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="box box-solid box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Informasi</h3>
                    </div>
                    <div class="box-body">
                        
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

<script>
$(document).ready(function() {
    $("#method").change(function() {
        var method = $("#method").val();
        $.ajax({
            url     : "<?=base_url();?>deposit/form",
            type    : "POST",
            dataType: "html",
            data    : {"method" : method},
            success : function(data) {
                $("#form").html(data);
            },
            error   : function() {
                $("#box").html("<div class='alert alert-danger'>Terjadi kesalahan, silahkan refresh halaman ini.</div>");
            }
        });
    });

    $("#total_transfer").on('keyup', function() {
        var total_transfer = $("#total_transfer").val();
        var method = $("#method").val();

        $.ajax({
            url     : "<?=base_url();?>deposit/total_get",
            type    : "POST",
            dataType: "html",
            data    : {"total_transfer" : total_transfer, "method" : method},
            success : function(data) {
                $("#total_get").val(data);
            },
            error   : function() {
                $("#box").html("<div class='alert alert-danger'>Terjadi kesalahan, silahkan refresh halaman ini.</div>");
            }
        });
    });
});
</script>