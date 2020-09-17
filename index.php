<?php
include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">

    <meta name="Description" content="Deskripsi Singkat Situs" />
<!-- Mendeklarasikan warna yang muncul pada address bar Chrome versi seluler -->
<meta name="theme-color" content="#414f57" />
<!-- Mendeklarasikan ikon untuk iOS -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-title" content="Nama Situs" />
<link rel="apple-touch-icon" href="path/to/icons/128x128.png" />
<!-- Mendeklarasikan ikon untuk Windows -->
<meta name="msapplication-TileImage" content="path/to/icons/128x128.png" />
<meta name="msapplication-TileColor" content="#000000" />
</head>
	<body>
		<!-- Subtitle -->
		<div class="col-12 center">
			<div class="col-1">&nbsp;</div>
			<div style="height: 335px" class="col-10">
				<h3><b>DESCRIPTION</b></h3>
				<span align="justify" style="font-size: 18px ">Welcome to the Inventory System for Information Technology Website at Tarlac Agricultural University. This website aims to service IT CENTER TAU facilities, various facilities that have been provided by the IT Center student of the Faculty of Engineering and Technology. Starting from academic and non-academic facilities. Infrastructure is one of the objects that is very vital in supporting the achievement of education in the process learning and teaching. With this website to make it easier to find out the facilities and infrastructure available at the IT Center online.</span>
			</div>
			<div class="col-1">&nbsp;</div>
	</div>
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/sw.js').then(swReg=>{}).catch(err=>{
      	console.error('Service Worker Error', err);
      });
    });
  }
</script>
	</body>
	<?php
	include 'footer.php';
	?>
</html>