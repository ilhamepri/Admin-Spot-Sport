<?php
$a = "SELECT MAX(idbarang) FROM barang";
$b = mysql_query($a);
$c = mysql_fetch_array($b);
list($maks) = mysql_fetch_row($b);
		$max = $c[0];
		$idang = substr($max, 1, 4);
		$idang = $idang + 1;
		if($idang <= 9) $idhasil = "B000".$idang;
		if($idang <= 99 && $idang >9) $idhasil = "B00".$idang;
		if($idang <= 999 && $idang >99) $idhasil = "B0".$idang;
		if($idang <= 9999 && $idang >999) $idhasil = "B".$idang;
		
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idbarang = $_REQUEST['idbarang'];
		$_SESSION['idbarang'] = $_REQUEST['idbarang'];
		$nama = $_REQUEST['nama'];
		$idmerk = $_REQUEST['idmerk'];
		$idkelompok = $_REQUEST['idkelompok'];
		$hargasatuan = $_REQUEST['hargasatuan'];		
		//$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			if (($_FILES['image']['type']=='image/jpg')||($_FILES['image']['type']=='image/jpeg')||($_FILES['image']['type']=='image/png')&&($_FILES['image']['size']< 50000)){
				$temp = explode(".", $_FILES["image"]["name"]);
				$newfilename = $idbarang . '.' . end($temp);
				move_uploaded_file($_FILES["image"]["tmp_name"], "data/" . $newfilename);				
			}
		
		$sql = mysql_query("INSERT INTO barang VALUES('$idbarang','$idmerk','$idkelompok','$nama','$hargasatuan','data/$newfilename')");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=barang');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah barang</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=barang&aksi=baru" class="form-horizontal" enctype="multipart/form-data" role="form">
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">ID Barang</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="idbarang" name="idbarang" value="<?php echo $idhasil ?>" placeholder="ID Barang" readonly required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Barang</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" required>
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">Merk</label>
		<div class="col-sm-4">
			<select name="idmerk" class="form-control">
			<?php
			$qmerk = mysql_query("SELECT * FROM merk ORDER BY idmerk");
			while(list($idmerk,$merk)=mysql_fetch_array($qmerk)){
				echo '<option value="'.$idmerk.'">'.$merk.'</option>';
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
			$qkelompok = mysql_query("SELECT * FROM kelompok ORDER BY idkategori");
			while(list($idkelompok,$kelompok)=mysql_fetch_array($qkelompok)){
				echo '<option value="'.$idkelompok.'">'.$kelompok.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="idbarang" class="col-sm-2 control-label">Harga Satuan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="hargasatuan" name="hargasatuan" placeholder="0" required autofocus>
		</div>
	</div>
	<div class="form-group">
		<label for="image" class="col-sm-2 control-label">Gambar</label>
		<div class="col-sm-4">
			<img id="uploadPreview" style="width: 150px; height: 150px;" />
			<input accept=".jpg,.jpeg,.png" id="uploadImage" type="file" name="image" onchange="PreviewImage();" />
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