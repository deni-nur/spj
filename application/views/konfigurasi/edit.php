<?php
// Error Warning
echo validation_errors('<div class="alert alert-warning">','</div>');

//error upload
if(isset($error_upload)) {
    echo '<div class="alert alert-warning">'.$errors_upload.'</div>';
}

// form open
echo form_open_multipart(base_url('konfigurasi/edit/'.$konfigurasi->konfigurasi_id));
?>
<section class="content-header">
    <h1>Konfigurasi
    <small>Konfigurasi</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Perencanaan</li>
    <li class="active">Konfigurasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page) ?> Konfigurasi</h3>
            <div class="pull-right">
                <a href="<?=site_url('konfigurasi') ?>" class="btn btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <label>Nama Website *</label>
                            <input type="text" name="namaweb" value="<?=$konfigurasi->namaweb ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tag Line *</label>
                            <input type="text" name="tagline" value="<?=$konfigurasi->tagline ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Email *</label>
                            <input type="email" name="email" value="<?=$konfigurasi->email ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Website *</label>
                            <input type="text" name="website" value="<?=$konfigurasi->website ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Telepon *</label>
                            <input type="number" name="telepon" value="<?=$konfigurasi->telepon ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Alamat *</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?=$konfigurasi->alamat ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Facebook *</label>
                            <input type="text" name="facebook" value="<?=$konfigurasi->facebook ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Instagram *</label>
                            <input type="text" name="instagram" value="<?=$konfigurasi->instagram ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Twitter *</label>
                            <input type="text" name="twitter" value="<?=$konfigurasi->twitter ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Youtube *</label>
                            <input type="text" name="youtube" value="<?=$konfigurasi->youtube ?>" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Logo *</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-success">
                                <i class="fa fa-paper-plane"></i> Save</button>
                            <button type="reset" class="btn btn-flat">
                                <i class="fa fa-refresh"></i> Reset</button>
                        </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<?php echo form_close(); ?>