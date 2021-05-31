                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Buat Informasi Baru</h1>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <?=$message?>
                            <div class="card shadow md-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-gray-900"><i class="fa fa-newspaper"></i> Buat Informasi</h6>
                                </div>
                                <div class="card-body">
                                	<form method="post">
	                                    <div class="form-group">
	                                    	<label>KATEGORI :</label>
	                                    	<input type="text" name="category" class="form-control" maxlength="30">
	                                    </div>
	                                    <div class="form-group">
	                                    	<label>ISI :</label>
	                                    	<textarea class="form-control" name="contents" maxlength="10000" rows="8"></textarea>
	                                    </div>
	                                    <div class="form-group">
	                                    	<button type="reset" class="btn btn-danger">Reset</button>
	                                    	<button type="submit" class="btn btn-primary" name="BtnNew">Buat</button>
	                                    </div>
	                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->