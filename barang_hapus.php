<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idbarang = $_REQUEST['idbarang'];
		$sql = mysql_query("DELETE FROM barang WHERE idbarang='$idbarang'");
		fclose($gambar);
		unlink($gambar);
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=barang');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		$idbarang = $_REQUEST['idbarang'];
		$sql = mysql_query("SELECT * FROM barang WHERE idbarang='$idbarang'");
		list($idbarang,$idmerk,$idkelompok,$barang,$harga,$gambar) = mysql_fetch_array($sql);
		
		echo '<div class="alert alert-danger">Yakin akan menghapus barang:';
		echo '<br>Nama Barang  : <strong>'.$barang.'</strong>';
		echo '<br>idbarang   : '.$idbarang;

		
		$qmerk = mysql_query("SELECT namamerk FROM merk,barang WHERE merk.idmerk=barang.idmerk and barang.idbarang='$idbarang'");
		list($merk) = mysql_fetch_array($qmerk);
		
		echo '<br>Merk : '.$merk.' ('.$idmerk.')<br><br>';
		echo '<a href="./admin.php?hlm=master&sub=barang&aksi=hapus&submit=ya&idbarang='.$idbarang.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=barang" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>