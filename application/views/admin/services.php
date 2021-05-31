                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Daftar Layanan</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary" id="as"><i class="fa fa-list"></i> Daftar Layanan</h6>
                                </div>
                                <div class="card-body">
                                	<div class="form-group">
                                		<b class="alert alert-secondary">Total Layanan : <?=$total_service?></b>
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
	                                                <th>Catatan</th>
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
	                                        		<td><?=($value->price*1)?></td>
	                                        		<td><?=$value->note?></td>
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

                </div>
                <!-- /.container-fluid -->