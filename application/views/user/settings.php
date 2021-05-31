<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?=$profile;?>
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Profil</h3>
                    </div>
                    <div class="box-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="text" class="form-control" value="<?=$email?>" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Nama Pengguna :</label>
                                <input type="text" class="form-control" value="<?=$username?>" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap :</label>
                                <input type="text" class="form-control" name="full_name" value="<?=html_escape($full_name)?>" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi Saat Ini:</label>
                                <input type="password" name="currentpass" class="form-control">
                                <p>* Verifikasi Kata Sandi untuk pembaruan Nama Lengkap.</p>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                <button type="submit" name="profile" class="btn btn-primary btn-flat">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?=$change_password;?>
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">Ubah Kata Sandi</h3>
                    </div>
                    <div class="box-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Kata Sandi Baru :</label>
                                <input type="password" name="newpass" class="form-control">
                                <p>* Minimal 8 karakter</p>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Kata Sandi Baru :</label>
                                <input type="password" name="newpass_verify" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi Saat Ini :</label>
                                <input type="password" name="currentpass" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                <button type="submit" name="change_password" class="btn btn-primary btn-flat">Submit</button>
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