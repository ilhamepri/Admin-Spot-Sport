<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'barang_baru.php';
				break;
			case 'edit':
				include 'barang_edit.php';
				break;
			case 'hapus':
				include 'barang_hapus.php';
				break;
		}
	} else {
		$sql = mysql_query("SELECT * FROM barang ORDER BY idbarang");
		echo '<h2>Daftar Barang</h2><hr>';
      echo '<div class="row">';
		echo '<div class="col-md-9"><table class="table table-hover">';
		echo '<tr class="danger"><th>#</th><th width="100">ID Barang</th><th>Nama Barang</th><th>Merk</th><th>Kelompok</th><th width="100">Harga@</th><th>Gambar</th>';
		echo '<th width="100"><a href="./admin.php?hlm=master&sub=barang&aksi=baru" class="btn btn-success btn-xs">Tambah Item</a></th></tr>';
		
		if( mysql_num_rows($sql) > 0 ){
			$no = 1;
			while(list($idbarang,$nama,$idmerk) = mysql_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$idbarang.'</td>';
				$qbarang = mysql_query("SELECT namabarang FROM barang WHERE idbarang='$idbarang'");
				list($nama) = mysql_fetch_array($qbarang);
				echo '<td>'.$nama.'</td>';
				$qmerk = mysql_query("SELECT namamerk FROM merk,barang WHERE merk.idmerk=barang.idmerk and barang.idbarang='$idbarang'");
				list($merk) = mysql_fetch_array($qmerk);
				echo '<td>'.$merk.'</td>';
				$qkelompok = mysql_query("SELECT namakelompok FROM kelompok,barang WHERE kelompok.idkategori=barang.idkelompok and barang.idbarang='$idbarang'");
				list($kelompok) = mysql_fetch_array($qkelompok);
				echo '<td>'.$kelompok.'</td>';
				$qharga = mysql_query("SELECT hargasatuan FROM barang WHERE idbarang='$idbarang'");
				list($harga) = mysql_fetch_array($qharga);
				echo '<td>Rp. '.$harga.',-</td>';
				$qgambar = mysql_query("SELECT gambar FROM barang WHERE idbarang='$idbarang'");
				list($gambar) = mysql_fetch_array($qgambar);
				
				echo '<td><img src="'.$gambar.'"  class="img-circle" height="150" width="150"></td>';
				echo '<td><div class="btn-group"><a href="./admin.php?hlm=master&sub=barang&aksi=edit&idbarang='.$idbarang.'" class="btn btn-info btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=barang&aksi=hapus&idbarang='.$idbarang.'" class="btn btn-danger btn-xs">Hapus</a></div></td>';
				echo '</tr>';
				$no++;
			}
		} else {
			echo '<tr><td colspan="9"><em>Belum ada data barang</em></td></tr>';
		}
		
		echo '</table></div></div>';
	}
}
?>