<section class="content-header">
      <h1>Pegawai
        <small>Data Pegawai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Pegawai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Barcode Generator <i class="fa fa-barcode"></i></h3>
    			<div class="pull-right">
    				<a href="<?=site_url('pegawai') ?>" class="btn btn-warning btn-flat btn-sm">
    					<i class="fa fa-undo"></i> Back
    				</a>
    			</div>
    		</div>
    		<div class="box-body">
    			<?php
    			$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
				echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->nip, $generator::TYPE_CODE_128)) . '" style="width: 200px">';
				?>
				<br>
				<?=$row->nip?>
				<br><br>
				<a href="<?=site_url('pegawai/nip_barcode_print/'.$row->pegawai_id) ?>" target="_blank" class="btn btn-default btn-sm">
					<i class="fa fa-print"></i> Print
				</a>
    		</div>
    	</div>

    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">QR-code Generator <i class="fa fa-qrcode"></i></h3>
    		</div>
    		<div class="box-body">
    			<?php
    			$qrCode = new Endroid\QrCode\QrCode($row->nip);
				$qrCode->writeFile('uploads/qr-code/pegawai-'.$row->nip.'.png');
				?>
				<img src="<?=base_url('uploads/qr-code/pegawai-'.$row->nip.'.png')?>" style="width: 200px">
				<br>
				<?=$row->nip?>
				<br><br>
				<a href="<?=site_url('pegawai/nip_qrcode_print/'.$row->pegawai_id) ?>" target="_blank" class="btn btn-default btn-sm">
					<i class="fa fa-print"></i> Print
				</a>
    		</div>
    	</div>
    </section>