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
<!-- <!DOCTYPE html> -->
<html lang="en">
	<head>
		<title>404 - <?php echo $config['title']; ?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo $config['base_url'] ?>assets/img/logo.jpg" />

		<link rel="stylesheet" type="text/css" href="<?php echo $config['base_url']; ?>assets/error/css/style.css"/>
		<link href="<?php echo $config['base_url'] ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	</head>

	<body>

		<div class="container">
      <div class="error">
        <h1>404</h1>
        <h2>Not Found</h2>
        <p>
					Oops, maaf, Halaman yang anda cari tidak dapat kami temukan di server kami. Jika anda tetap ingin mencari halaman tersebut, silakan kembali lagi nanti disaat halaman yang anda butuhkan sudah tersedia.
				</p>
				<a class="a-home" href="<?php echo $config['base_url'] ?>">
					<i class="fa fa-home"> Kembali Ke Beranda </i>
				</a>
      </div>
      <div class="stack-container">
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 125px; --scaledist: .75; --vertdist: -25px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 100px; --scaledist: .8; --vertdist: -20px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist:75px; --scaledist: .85; --vertdist: -15px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 50px; --scaledist: .9; --vertdist: -10px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 25px; --scaledist: .95; --vertdist: -5px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 0px; --scaledist: 1; --vertdist: 0px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

	</body>
</html>

<script type="text/javascript" src="<?php echo $config['base_url']; ?>assets/error/js/style.js"></script>
