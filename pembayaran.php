<?php
$a = "SELECT MAX(idtransaksi) FROM transaksi";
$b = mysql_query($a);
$c = mysql_fetch_array($b);
list($maks) = mysql_fetch_row($b);
		$max = $c[0];
		$idang = substr($max, 1, 4);
		$idang = $idang + 1;
		if($idang <= 9) $idhasil = "T000".$idang;
		if($idang <= 99 && $idang >9) $idhasil = "T00".$idang;
		if($idang <= 999 && $idang >99) $idhasil = "T0".$idang;
		if($idang <= 9999 && $idang >999) $idhasil = "T".$idang;
date_default_timezone_set("Asia/Jakarta");
$date=date("Y-m-d");

		
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	$idaktif=$_SESSION['iduser'];
	if( isset( $_REQUEST['submit'] )){
		$idtransaksi = $_REQUEST['idtransaksi'];
		$idbarang = $_REQUEST['idbarang'];
		$tanggal = $_REQUEST['tanggal'];
		$jumlah = $_REQUEST['jumlah'];
		$sql = mysql_query("SELECT hargasatuan FROM barang WHERE idbarang='$idbarang'");
		list($hargasatuan) = mysql_fetch_array($sql);
		$sql2=mysql_query("SELECT idtransaksi FROM transaksi WHERE idtransaksi='$idtransaksi'");
		list($cekid) = mysql_fetch_array($sql2);
		$total=($hargasatuan*$jumlah);

		
			if($cekid!=$idtransaksi){
				$sql = mysql_query("INSERT INTO transaksi VALUES('$idtransaksi','$idaktif','$tanggal','$total')");
				$sql = mysql_query("INSERT INTO detail_pembayaran VALUES('$idtransaksi','$idbarang','$jumlah','$hargasatuan','$total')");
			} else if ($cekid==$idtransaksi){
				$sql = mysql_query("INSERT INTO detail_pembayaran VALUES('$idtransaksi','$idbarang','$jumlah','$hargasatuan','$total')");
				$sql3=mysql_query("select idtransaksi,sum(subtotal) from detail_pembayaran group by idtransaksi desc" );
				list($idtransaksi,$subtotal) = mysql_fetch_array($sql3);
				$total=$subtotal;
				$sql = mysql_query("UPDATE transaksi SET total='$total' WHERE idtransaksi='$idtransaksi' ");
			}
			
		if($sql > 0){
			header('Location: ./admin.php?hlm=bayar');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Pembayaran</h2>
<hr>
<form method="post" action="admin.php?hlm=bayar" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">ID Transaksi</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idtransaksi" name="idtransaksi" value="<?php echo $idhasil; ?>" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">ID Barang</label>
		<div class="col-sm-4">
			<select name="idbarang" class="form-control">
			<?php
			$qbarang = mysql_query("SELECT * FROM barang ORDER BY idbarang");
			while(list($idbarang,$idmerk,$idkelompok,$nama)=mysql_fetch_array($qbarang)){
				echo '<option value="'.$idbarang.'">'.$nama.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">Tanggal</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $date; ?>" readonly required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">Jumlah Item</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="0" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=bayar" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>