<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idkategori = $_REQUEST['idkategori'];
		
		$sql = mysql_query("DELETE FROM kelompok WHERE idkategori='$idkategori'");
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=kelompok');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		//dialog untuk memastikan proses hapus dilakukan secara sadar
		$idkategori = $_REQUEST['idkategori'];
		
		echo '<div class="alert alert-danger">Yakin akan menghapus:';
		echo '<br>ID Kategori  : <strong>'.$idkategori.'</strong>';
		$qkelompok = mysql_query("SELECT namakelompok FROM kelompok WHERE idkategori='$idkategori'");
		list($kelompok) = mysql_fetch_array($qkelompok);
		
		echo '<br>Kategori : '.$kelompok.'<br><br>';
		
		echo '<br><br>Aksi ini permanen!<br><br>';
		echo '<a href="./admin.php?hlm=master&sub=kelompok&aksi=hapus&submit=ya&idkategori='.$idkategori.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=kelompok" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>