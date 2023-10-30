<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('dpa/'.$this->uri->segment(2).'/belanja/anggaran_kas/'.$belanja->belanja_id),' class="form-horizontal"');
?>
<section class="content-header">
      <h1>Anggaran Kas Belanja Sub Kegiatan
        <small>Data Anggaran Kas Belanja Sub Kegiatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>Penganggaran</li>
        <li>DPA</li>
        <li>Sub Kegiatan</li>
        <li class="active">Anggaran Kas Belanja Sub Kegiatan</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">

    <div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=ucfirst($page) ?> Anggaran Kas Belanja Sub Kegiatan</h3>
        <div class="pull-right">
            <a href="<?=site_url('dpa/'.$this->uri->segment(2).'/belanja') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                    
                    <div class="form-group">
                      <label>Belanja *</label>
                      <input type="hidden" name="sub_rincian_objek_id" value="<?=$belanja->sub_rincian_objek_id ?>">
                      <textarea name="" class="form-control" required readonly><?=$belanja->nama_sub_rincian_objek ?></textarea>
                    </div>
                    <div class="form-group">
                        <table class="table table-striped">
                            <thead>
                          <tr>
                              <th class="font-bold" width="150" style="vertical-align: middle;">Pagu</th>
                              <th class="font-bold" width="150" style="vertical-align: middle;">Rencana</th>
                              <th class="font-bold" width="150" style="vertical-align: middle;">Selisih</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td><input type='text' name="pagu_belanja_murni" id="pagu" class='form-control' value="<?=indo_currency($belanja->pagu_belanja_murni) ?>" data-id="$belanja->pagu_belanja_murni" readonly /></td>
                              <td><input type='text' name="rencana_anggaran_kas" id="rencana" class='form-control' readonly /></td>
                              <td><input type='text' name="selisih" id="selisih" class='form-control' readonly /></td>
                          </tr>
                        </tbody>
                        </table>
                    <table class="table table-striped" id="">
                          <thead>
                          <tr>
                              <th class="font-bold" width="70" style="vertical-align: middle;">Bulan</th>
                              <th class="font-bold" width="100" style="vertical-align: middle;">Anggaran</th>
                              <th class="font-bold" width="100" style="vertical-align: middle;">Bulan</th>
                              <th class="font-bold" width="100" style="vertical-align: middle;">Anggaran</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>Januari</td>
                              <td><input type='text' class='form-control' name="bulan1" id="bulan1" value="<?=$belanja->bulan1 ?>" /></td>
                              <td>Februari</td>
                              <td><input type='text' class='form-control' name="bulan2" id="bulan2" value="<?=$belanja->bulan2 ?>" /></td>
                          </tr>
                          <tr>
                              <td>Maret</td>
                              <td><input type='text' class='form-control' name="bulan3" id="bulan3" value="<?=$belanja->bulan3 ?>" /></td>
                              <td>April</td>
                              <td><input type='text' class='form-control' name="bulan4" id="bulan4" value="<?=$belanja->bulan4 ?>" /></td>
                          </tr>
                          <tr>
                              <td>Mei</td>
                              <td><input type='text' class='form-control' name="bulan5" id="bulan5" value="<?=$belanja->bulan5 ?>" /></td>
                              <td>Juni</td>
                              <td><input type='text' class='form-control' name="bulan6" id="bulan6" value="<?=$belanja->bulan6 ?>" /></td>
                          </tr>
                          <tr>
                              <td>Juli</td>
                              <td><input type='text' class='form-control' name="bulan7" id="bulan7" value="<?=$belanja->bulan7 ?>" /></td>
                              <td>Agustus</td>
                              <td><input type='text' class='form-control' name="bulan8" id="bulan8" value="<?=$belanja->bulan8 ?>" /></td>
                          </tr>
                          <tr>
                              <td>September</td>
                              <td><input type='text' class='form-control' name="bulan9" id="bulan9" value="<?=$belanja->bulan9 ?>" /></td>
                              <td>Oktober</td>
                              <td><input type='text' class='form-control' name="bulan10" id="bulan10" value="<?=$belanja->bulan10 ?>" /></td>
                          </tr>
                          <tr>
                              <td>November</td>
                              <td><input type='text' class='form-control' name="bulan11" id="bulan11" value="<?=$belanja->bulan11 ?>" /></td>
                              <td>Desember</td>
                              <td><input type='text' class='form-control' name="bulan12" id="bulan12" value="<?=$belanja->bulan12 ?>" /></td>
                          </tr>
                          </tbody>
                      </table>
                  </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i> Save</button>
                    <button type="reset" class="btn btn-default">
                        <i class="fa fa-refresh"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
   
</section>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#pagu, #rencana, #selisih, #bulan1, #bulan2, #bulan3, #bulan4, #bulan5, #bulan6, #bulan7, #bulan8, #bulan9, #bulan10, #bulan11, #bulan12").keyup(function() {
            var rencana  = parseFloat($('#rencana').val()) || 0;
            var bulan1 = parseFloat($('#bulan1').val()) || 0;
            var bulan2 = parseFloat($('#bulan2').val()) || 0;
            var bulan3 = parseFloat($('#bulan3').val()) || 0;
            var bulan4 = parseFloat($('#bulan4').val()) || 0;
            var bulan5 = parseFloat($('#bulan5').val()) || 0;
            var bulan6 = parseFloat($('#bulan6').val()) || 0;
            var bulan7 = parseFloat($('#bulan7').val()) || 0;
            var bulan8 = parseFloat($('#bulan8').val()) || 0;
            var bulan9 = parseFloat($('#bulan9').val()) || 0;
            var bulan10 = parseFloat($('#bulan10').val()) || 0;
            var bulan11 = parseFloat($('#bulan11').val()) || 0;
            var bulan12 = parseFloat($('#bulan12').val()) || 0;
            var pagu = parseFloat($('#pagu').val()) || 0;
            var selisih = parseFloat($('#selisih').val()) || 0;

            rencana = parseInt(bulan1) + parseInt(bulan2) + parseInt(bulan3) + parseInt(bulan4) + parseInt(bulan5) + parseInt(bulan6) + parseInt(bulan7) + parseInt(bulan8) + parseInt(bulan9) + parseInt(bulan10) + parseInt(bulan11) + parseInt(bulan12);
            $('#rencana').val(rencana);

            // pagu = parseFloat(pagu);
            // $('#pagu').val(pagu);

            selisih = rencana - pagu
            $('#selisih').val(selisih)
        });
    });
</script>