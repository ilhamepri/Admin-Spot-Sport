<?php
// Request session
// ilhamepri
session_start();
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sport-Spot</title>
		<!-- ilhamepri -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	body {
	  min-height: 200px;
	  padding-top: 70px;
	  background-color: #eee;
	}
   @media print {
      .noprint {
         display: none;
      }
   }
	</style>
  </head>
  <body>
    <?php include "menu.php"; ?>
    <div class="container">
	<?php
	// Request halaman
	// ilhamepri
	if( isset($_REQUEST['hlm'] )){
		$hlm = $_REQUEST['hlm'];
		switch( $hlm ){
			case 'bayar':
				include "pembayaran.php";
				break;
			case 'laporan':
				include "laporan.php";
				break;
			case 'master':
				include "master.php";
				break;
			case 'user':
				include "profil.php";
				break;
		}
	} else {
		// Request user login
		// ilhamepri
		if( $_SESSION['admin'] == 0 ){
				$pengguna='kasir';
			}
			if( $_SESSION['admin'] == 1 ){
				$pengguna='admin';
			}
	?>
      <div class="jumbotron">
        <h2>Selamat Datang di Sport-Spot</h2>
        <p>Anda login sebagai <strong><?php echo $_SESSION['fullname']; ?></strong> dengan hak akses <i><?php echo $pengguna; ?><i>.</p>
      </div>
	<?php
	}
	?>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
		$(".force-logout").alert().delay(3000).slideUp('slow', function(){
			window.location = "./logout.php";
		});
      function fnCetak() {
         window.print();
      }
	</script>
  </body>
</html>
<?php
}
?>
