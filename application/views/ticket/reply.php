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
                        <h3 class="box-title">Subjek : <?=$reply->row()->subject?></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="overflow-y: auto; max-height: 400px; display: flex; flex-direction: column-reverse; padding: 10px;">
                            <?php 
                                foreach ($reply->result() as $data => $value) {
                                
                                if ($value->user_id == 0) {
                                
                                    $alert = 'bg-success';
                                    $label = '(Admin)';
                                
                                } else {
                                
                                    $alert = 'bg-gray';
                                    $label = null;
                                
                                }
                                
                                ?>
                            <div class="alert <?=$alert?>">
                                <p class="pull-right"><?=$value->datetime?></p>
                                <h4><b><?=$value->full_name?> <?=$label?></b></h4>
                                <p><?=$value->message?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label>Pesan :</label>
                                <textarea class="form-control" name="message" rows="5"></textarea>
                            </div>
                            <div hidden="">
                                <input type="text" name="ticket_id" value="<?=$ticket_id?>" readonly="" hidden="" disabled="">
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                <button type="submit" name="send" class="btn btn-primary btn-flat">Kirim</button>
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

<script>
$(document).ready(function() {
    $("#category").change(function() {
        var category = $("#category").val();
        $.ajax({
            url     : "<?=base_url();?>Page/services",
            type    : "POST",
            dataType: "html",
            data    : {"category" : category},
            success : function(data) {
                $("#services").html(data);
            },
            error   : function() {
                $("#services").html("<option>-- ERROR --</option>");
            }
        });
    });
});
</script>