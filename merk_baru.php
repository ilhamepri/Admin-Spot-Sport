<?php
		
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nama = $_REQUEST['nama'];
		$idmerk = $_REQUEST['idmerk'];

		
		$sql = mysql_query("INSERT INTO merk VALUES('$idmerk','$nama')");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=merk');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Merk</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=merk&aksi=baru" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="idmerk" class="col-sm-2 control-label">ID Merk</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idmerk" name="idmerk" placeholder="ID Merk" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Merk</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Merk" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=merk" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>