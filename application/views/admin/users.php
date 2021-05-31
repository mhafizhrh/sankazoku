                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Daftar Pengguna</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-gray-900" id="as"><i class="fa fa-users"></i> Daftar Pengguna</h6>
                                </div>
                                <div class="card-body">
                                	<div class="form-group">
                                		<b class="alert alert-secondary">Total Pengguna : <?=$total_user?></b>
                                	</div>
                                	<div class="form-group">
                                		<?=$message?>
                                	</div>
                                    <div class="table-responsive">
	                                    <table class="table table-bordered table-striped">
	                                        <thead>
	                                            <tr>
	                                                <th>ID</th>
	                                                <th>Nama Lengkap</th>
	                                                <th>Nama Pengguna</th>
	                                                <th>Email</th>
	                                                <th>Saldo</th>
	                                                <th>Alamat IP</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                        	<?php foreach ($users->result() as $data => $value) { ?>
	                                        	
	                                        	<tr>
	                                        		<td><?=$value->user_id?></td>
	                                        		<td><?=$value->full_name?></td>
	                                        		<td><?=$value->username?></td>
	                                        		<td><?=$value->email?></td>
	                                        		<td><?=$value->balance?></td>
	                                        		<td><?=$value->ip_address?></td>
	                                        		<td>
	                                        			<a class="btn btn-danger btn-circle" href="<?=base_url('admin/users/'.$start.'/'.$value->user_id.'/delete')?>">
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
                    </div>

                </div>
                <!-- /.container-fluid -->