<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Layanan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Layanan Aktif</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <form method="get">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <select class="form-control" name="category">
                                                <option selected="" value="">-- Tampilkan berdasarkan kategori --</option>
                                                <?php foreach ($select_category->result() as $data => $value) {

                                                    if ($value->category == $category) {
                                                        
                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = NULL;

                                                    }
                                                ?>

                                                <option <?=$selected?>><?=$value->category?></option>

                                                <?php } ?>
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control" value="<?=$this->input->get('name')?>" placeholder="Cari nama layanan...">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kategori</th>
                                        <th>Nama Layanan</th>
                                        <th>Min</th>
                                        <th>Maks</th>
                                        <th>Harga/1000</th>
                                        <th>Laba 5%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($services->result() as $data => $value) { ?>

                                    <tr>
                                        <td><?=$value->id?></td>
                                        <td><?=$value->category?></td>
                                        <td><?=$value->name?></td>
                                        <td><?=$value->min?></td>
                                        <td><?=$value->max?></td>
                                        <td><?=$value->price?></td>
                                        <td><?=($value->price * 0.05)?></td>
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