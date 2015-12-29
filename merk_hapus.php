<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idmerk = $_REQUEST['idmerk'];
		
		$sql = mysql_query("DELETE FROM merk WHERE idmerk='$idmerk'");
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=merk');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		//dialog untuk memastikan proses hapus dilakukan secara sadar
		$idmerk = $_REQUEST['idmerk'];
		
		echo '<div class="alert alert-danger">Yakin akan menghapus:';
		echo '<br>ID Merk  : <strong>'.$idmerk.'</strong>';
		$qmerk = mysql_query("SELECT namamerk FROM merk WHERE idmerk='$idmerk'");
		list($merk) = mysql_fetch_array($qmerk);
		
		echo '<br>Merk : '.$merk.'<br><br>';
		
		echo '<br><br>Aksi ini permanen!<br><br>';
		echo '<a href="./admin.php?hlm=master&sub=merk&aksi=hapus&submit=ya&idmerk='.$idmerk.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=merk" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>