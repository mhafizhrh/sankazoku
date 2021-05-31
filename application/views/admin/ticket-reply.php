                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tiket</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        	<?=$message?>
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-ticket-alt"></i> <?=$reply->row()->subject?></h6>
                                </div>
                                <div class="card-body">
                                	<div class="form-group" style="overflow-y: auto; max-height: 400px; display: flex; flex-direction: column-reverse; padding: 10px;">
	                                    <?php 

	                                    	foreach ($reply->result() as $data => $value) {

	                                    	if ($value->user_id == 0) {

												$alert = 'alert-success';
                                                $label = NULL;

											} else {

												$alert = 'alert-primary';
                                                $label = '(Pengguna)';

											}

	                                    ?>

	                                    <div class="alert <?=$alert?>">
	                                    	<p class="float-right"><?=$value->datetime?></p>
	                                    	<p>
	                                    		<b><?=$value->full_name?> <?=$label?></b>
	                                    	</p>
	                                    	
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
                                		<button type="reset" class="btn btn-danger">Reset</button>
                                		<button type="submit" name="send" class="btn btn-primary">Kirim</button>
                                	</div>
                                	</form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->