<?php
	header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
?>
<?php
	$config =& get_config();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $config['title']; ?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo $config['base_url'] ?>assets/img/favicon.ico" />
		<link rel="icon" type="image/png" href="<?php echo $config['base_url'] ?>assets/img/favicon.png" />
		<link rel="icon" type="image/gif" href="<?php echo $config['base_url'] ?>assets/img/favicon.gif" />
		<link rel="stylesheet" type="text/css" href="<?php echo $config['base_url']; ?>assets/css/default.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $config['base_url']; ?>assets/css/themes/default/easyui.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $config['base_url']; ?>assets/css/themes/icon.css"/>
		<script type="text/javascript" src="<?php echo $config['base_url']; ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $config['base_url']; ?>assets/js/jquery.easyui.min.js"></script>
	</head>
	<body>
		<div id="win" class="easyui-dialog" title="<?php echo $config['title']; ?>" style="width:490px;height:360px;"
data-options="iconCls:'icon-login', minimizable: false, maximizable: false, closable: false, collapsible: false, modal:true" buttons="#window-button">
			<div class="x-window-body" style="height: 285px; width: 476px;">
				<div class="form-intro">
					<div class="form-intro-container">
						<div class="form-intro-label">404 Not Found</div>
						<div class="form-intro-outersep">
							<div class="form-intro-sepx"> </div>
						</div>
						<div class="form-intro-description">
							<p>Oops, maaf, Halaman yang anda cari tidak dapat kami temukan di server kami. Jika anda tetap ingin mencari halaman tersebut, silakan kembali lagi nanti disaat halaman yang anda butuhkan sudah tersedia.</p>
							<p><a class="easyui-linkbutton" iconCls="icon-home" href="<?php echo $config['base_url']; ?>">Kembali ke Beranda &raquo;</a></p>
						</div>
						<div class="x-form-copyright">
							&copy;2021 <a href="http://aom.my.id" target="_blank">aom.my.id</a>, Developed By TB
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
