<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		
		if($aksi == 'baru'){
			include 'merk_baru.php';
		}
		if($aksi == 'edit'){
			include 'merk_edit.php';
		}
		if($aksi == 'hapus'){
			include 'merk_hapus.php';
		}
		
	} else {

		$sql = mysql_query("SELECT * FROM merk ORDER BY idmerk");
		echo '<h2>Daftar Merk</h2><hr>';
		echo '<div class="row">';
		echo '<div class="col-md-7"><table class="table table-bordered">';
		echo '<tr class="info"><th width="50">#</th><th>ID Merk</th><th>Merk</th>';
		echo '<th width="100"><a href="./admin.php?hlm=master&sub=merk&aksi=baru" class="btn btn-success btn-xs">Tambah Data</a></th></tr>';
		
		if( mysql_num_rows($sql) > 0 ){
			$no = 1;
			while(list($idmerk,$merk) = mysql_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$idmerk.'</td>';
				echo '<td>'.$merk.'</td>';
				//echo '<td>'.$kelas.' <span class="badge pull-right">'.$jumlah.' siswa</span></td>';
				echo '<td><a href="./admin.php?hlm=master&sub=merk&aksi=edit&idmerk='.$idmerk.'" class="btn btn-info btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=merk&aksi=hapus&idmerk='.$idmerk.'" class="btn btn-danger btn-xs">Hapus</a></td>';
				echo '</tr>';
				$no++;
			}
		} else {
			echo '<tr><td colspan="4"><em>Belum ada data</em></td></tr>';
		}
		
		echo '</table></div></div>';
	}
}
?>