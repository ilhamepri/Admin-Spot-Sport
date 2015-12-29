<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nama = $_REQUEST['nama'];
		$idkategori = $_REQUEST['idkategori'];
		
		$sql = mysql_query("UPDATE kelompok SET namakelompok='$nama' WHERE idkategori='$idkategori'");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=kelompok');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$idkategori = $_REQUEST['idkategori'];
		$sql = mysql_query("SELECT * FROM kelompok WHERE idkategori='$idkategori'");
		list($idkategori,$nama) = mysql_fetch_array($sql);
		echo $nama;
?>
<h2>Edit Data Barang</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=kelompok&aksi=edit" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="idkategori" class="col-sm-2 control-label">ID Kategori</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idkategori" name="idkategori" value="<?php echo $idkategori; ?> "readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Kategori</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
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