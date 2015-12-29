<!-- Tampil jam -->
<!-- ilhamepri -->
<script type="text/javascript">
    //set timezone
    <?php ob_start(); date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, h, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<body onload="setInterval('displayServerTime()', 1000);">
</body>
<!-- Request session -->
<!-- ilhamepri -->
<?php
if( !empty( $_SESSION['iduser'] ) ){
?>
<!-- Fixed top navbar -->
<!-- ilhamepri -->
<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
  <div class="container">
	<div class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">
		<li><a href="./admin.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    <!-- Request user level -->
    <!-- ilhamepri -->
    <?php
			if( $_SESSION['admin'] == 0 ){
		?>
		<li><a href="./admin.php?hlm=bayar"><span class="glyphicon glyphicon-scale"></span> Pembayaran</a></li>
		<?php
			}
		?>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-align-left"></span> Laporan <b class="caret"></b></a>
		  <ul class="dropdown-menu">
			<li><a href="./admin.php?hlm=laporan">Data Penjualan</a></li>
			<li><a href="./admin.php?hlm=laporan&sub=tagihan">Rekap Penjualan</a></li>
		  </ul>
		</li>
    <!-- Request user level -->
    <!-- ilhamepri -->
		<?php
			if( $_SESSION['admin'] == 1 ){
		?>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-briefcase"></span> Data Master <b class="caret"></b></a>
		  <ul class="dropdown-menu">
			<li><a href="./admin.php?hlm=master&sub=barang">Barang</a></li>
			<li><a href="./admin.php?hlm=master&sub=merk">Merk</a></li>
			<li><a href="./admin.php?hlm=master&sub=kelompok">Kelompok</a></li>
			<li class="divider"></li>
			<li><a href="./admin.php?hlm=master">User</a></li>
			<?php
			}
			?>
		  </ul>
		</li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li class="dropdown active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
			<?php echo $_SESSION['fullname']; ?> <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
			<li><a href="./admin.php?hlm=user">Profil</a></li>
			<li><a href="./admin.php?hlm=user&sub=pass">Ganti Password</a></li>
			<li class="divider"></li>
			<li><a href="logout.php">Logout</a></li>
		  </ul>
		</li>
	  </ul>
	</div>
  </div>
</div>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-leaf"></span> Spot-Sport</a>
	</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#">Pukul  <span id="clock"><?php print date('h:i:s'); ?> </span> WIB</a></li>
			</ul>
		</div>
	</div>
</div>
<?php
} else {
	header("Location: ./");
	die();
}
?>
