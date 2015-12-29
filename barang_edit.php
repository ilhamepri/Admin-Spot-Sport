<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idbarang = $_REQUEST['idbarang'];
		$nama = $_REQUEST['nama'];
		$idmerk = $_REQUEST['idmerk'];
		$idkelompok = $_REQUEST['idkelompok'];
		$hargasatuan = $_REQUEST['hargasatuan'];
			if (($_FILES['image']['type']=='image/jpg')||($_FILES['image']['type']=='image/jpeg')||($_FILES['image']['type']=='image/png')&($_FILES['image']['size']< 50000)){
				$temp = explode(".", $_FILES["image"]["name"]);
				$newfilename = $idbarang . '.' . end($temp);
				move_uploaded_file($_FILES["image"]["tmp_name"], "data/" . $newfilename);
			}

		$sql = mysql_query("UPDATE barang SET namabarang='$nama', idmerk='$idmerk',idkelompok='$idkelompok',hargasatuan='$hargasatuan' WHERE idbarang='$idbarang'");

		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=barang');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$idbarang = $_REQUEST['idbarang'];
		$sql = mysql_query("SELECT * FROM barang WHERE idbarang='$idbarang'");
		list($idbarang,$idmerk,$idkelompok,$nama,$hargasatuan) = mysql_fetch_array($sql);
?>
<h2>Edit Data Barang</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=barang&aksi=edit" class="form-horizontal" enctype="multipart/form-data" role="form">
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">ID Barang</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idbarang" name="idbarang" value="<?php echo $idbarang; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Barang</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="merk" class="col-sm-2 control-label">Merk</label>
		<div class="col-sm-4">
			<select name="idmerk" class="form-control">
			<?php
			$qmerk = mysql_query("SELECT * FROM merk ORDER BY idmerk");
			while(list($id,$merk)=mysql_fetch_array($qmerk)){
				echo '<option value="'.$id.'"';
				echo ($id==$idmerk) ? 'selected' : '';
				echo '>'.$merk.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="kelompok" class="col-sm-2 control-label">Kelompok</label>
		<div class="col-sm-4">
			<select name="idkelompok" class="form-control">
			<?php
			$qkelompok= mysql_query("SELECT * FROM kelompok ORDER BY idkategori");
			while(list($id,$kelompok)=mysql_fetch_array($qkelompok)){
				echo '<option value="'.$id.'"';
				echo ($id==$idkelompok) ? 'selected' : '';
				echo '>'.$kelompok.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="hargasatuan" class="col-sm-2 control-label">Harga Satuan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="hargasatuan" name="hargasatuan" value="<?php echo $hargasatuan; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="image" class="col-sm-2 control-label">Gambar</label>
		<div class="col-sm-4">
			<img id="uploadPreview" style="width: 150px; height: 150px;" />
			<input id="uploadImage" type="file" name="image" onchange="PreviewImage();" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=barang" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php

	}
}
?>
<script type="text/javascript">
				function PreviewImage() {
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				oFReader.onload = function (oFREvent) {
				document.getElementById("uploadPreview").src = oFREvent.target.result;
				};
				};
</script>
