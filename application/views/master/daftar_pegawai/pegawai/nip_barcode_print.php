<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Barcode NIP <?=$row->nip?></title>
</head>
<body>
	<?php
	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->nip, $generator::TYPE_CODE_128)) . '" style="width: 300px">';
	?>
	<br>
	<?=$row->nip?>
</body>
</html>