                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Kelola Tiket</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-gray-900"><i class="fa fa-ticket-alt"></i> Tiket</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
	                                    <table class="table table-bordered table-striped">
	                                        <thead>
	                                            <tr>
	                                            	<th>ID Tiket</th>
	                                                <th>Tanggal | Waktu</th>
	                                                <th>Nama Pengguna</th>
	                                                <th>Subjek</th>
	                                                <th>Status</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                        	<?php foreach ($pagination->result() as $data => $value) {
	                                        	
	                                        		if ($value->status == 'RESPONDED') {
	                                        			
	                                        			$status = 'PENDING';
	                                        			$class = 'badge badge-secondary';

	                                        		} else {

	                                        			$status = 'RESPONDED';
	                                        			$class = 'badge badge-success';

	                                        		}

	                                        	?>
	                                        	<tr>
	                                        		<td><?=$value->ticket_id?></td>
	                                        		<td><?=$value->datetime?></td>
	                                        		<td><?=$value->username?></td>
	                                        		<td><a href="<?=base_url('admin/ticket/reply/'.$value->ticket_id)?>"><?=$value->subject?></a></td>
	                                        		<td><span class="<?=$class?>"><?=$status?></span></td>
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