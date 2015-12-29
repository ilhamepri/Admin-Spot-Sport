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
			include 'kelompok_baru.php';
		}
		if($aksi == 'edit'){
			include 'kelompok_edit.php';
		}
		if($aksi == 'hapus'){
			include 'kelompok_hapus.php';
		}
		
	} else {

		$sql = mysql_query("SELECT * FROM kelompok ORDER BY idkategori");
		echo '<h2>Daftar Kategori</h2><hr>';
		echo '<div class="row">';
		echo '<div class="col-md-7"><table class="table table-bordered">';
		echo '<tr class="info"><th width="50">#</th><th>ID Kategori</th><th>Kategori</th>';
		echo '<th width="100"><a href="./admin.php?hlm=master&sub=kelompok&aksi=baru" class="btn btn-success btn-xs">Tambah Data</a></th></tr>';
		
		if( mysql_num_rows($sql) > 0 ){
			$no = 1;
			while(list($idkategori,$nama) = mysql_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$idkategori.'</td>';
				echo '<td>'.$nama.'</td>';
				//echo '<td>'.$kelas.' <span class="badge pull-right">'.$jumlah.' siswa</span></td>';
				echo '<td><a href="./admin.php?hlm=master&sub=kelompok&aksi=edit&idkategori='.$idkategori.'" class="btn btn-info btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=kelompok&aksi=hapus&idkategori='.$idkategori.'" class="btn btn-danger btn-xs">Hapus</a></td>';
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