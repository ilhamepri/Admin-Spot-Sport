<?php
// Request session
// ilhamepri
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
}else {
	// Request Item Menu
	// ilhamepri
	if( isset( $_REQUEST['sub'] )){
		$sub = $_REQUEST['sub'];
		switch($sub){
			case 'barang':
				include 'barang.php';
				break;
			case 'merk':
				include 'merk.php';
				break;
			case 'kelompok':
				include 'kelompok.php';
				break;
		}
	}else {
		// Request User Menu
		// ilhamepri
		if(isset($_REQUEST['aksi'])){
			$aksi = $_REQUEST['aksi'];
			switch($aksi){
				case 'baru':
					include 'user_baru.php';
					break;
				case 'edit':
					include 'user_edit.php';
					break;
				case 'hapus':
					include 'user_hapus.php';
					break;
			}
		}else {
			echo '<h2>Daftar User</h2><hr>';
			// Query ambil user
			// ilhamepri
			$sql = mysql_query("SELECT iduser,username,admin,fullname FROM user ORDER BY iduser");
			$no = 1;
      echo '<div class="row">';
    	echo '<div class="col-md-6">';
			echo '<table class="table table-bordered">';
			echo '<tr class="info"><th width="30">No.</th><th>Username</th><th>Nama Lengkap</th><th width="50">Admin</th>';
			echo '<th><a href="admin.php?hlm=master&aksi=baru" class="btn btn-default btn-xs">Tambah</a></th></tr>';
			// Loop Daftar User
			// ilhamepri
			while(list($id,$username,$admin,$fullname) = mysql_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$username.'</td>';
				echo '<td>'.$fullname.'</td>';
				echo '<td>';
				echo ($admin == 1) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '';
				echo '</td>';
				echo '<td><a href="admin.php?hlm=master&aksi=edit&id='.$id.'" class="btn btn-success btn-xs">Edit</a> ';
				echo '<a href="admin.php?hlm=master&aksi=hapus&id='.$id.'" class="btn btn-danger btn-xs">Hapus</a></td></tr>';
				$no++;
			}
			echo '</table>';
      echo '</div></div>';
		}
	}
}
?>
