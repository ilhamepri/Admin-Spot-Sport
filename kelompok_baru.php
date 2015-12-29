<?php
$a = "SELECT MAX(idkategori) FROM kelompok";
$b = mysql_query($a);
$c = mysql_fetch_array($b);
list($maks) = mysql_fetch_row($b);
		$max = $c[0];
		$idang = substr($max, 1, 4);
		$idang = $idang + 1;
		if($idang <= 9) $idhasil = "K000".$idang;
		if($idang <= 99 && $idang >9) $idhasil = "K00".$idang;
		if($idang <= 999 && $idang >99) $idhasil = "K0".$idang;
		if($idang <= 9999 && $idang >999) $idhasil = "K".$idang;
		
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nama = $_REQUEST['nama'];
		$idkategori = $_REQUEST['idkategori'];

		
		$sql = mysql_query("INSERT INTO kelompok VALUES('$idkategori','$nama')");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=kelompok');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Kategori</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=kelompok&aksi=baru" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="idkategori" class="col-sm-2 control-label">ID Kategori</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idkategori" name="idkategori" value="<?php echo $idhasil; ?>" readonly required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Kategori</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kategori" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=kelompok" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>