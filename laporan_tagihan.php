<?php
if( empty( $_SESSION['iduser'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
   echo '<h2>Rekap Penjualan</h2><hr>';
   echo '<a href="./cetak_rekap.php?cetak_rekap"class="noprint pull-right btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>';
   $sql = mysql_query("SELECT * from detail_pembayaran");
   
   echo '<div class="row">';
   echo '<div class="col-md-7">';
   echo '<table class="table table-bordered">';
   echo '<tr class="info"><th width="50">#</th><th>ID Transaksi</th><th>ID Barang</th><th>Quantity</th><th>Harga</th><th>Jumlah</th></tr>';
   
   $no=1;
   while(list($idtransaksi,$idbarang,$quantity,$harga,$jumlah)=mysql_fetch_array($sql)){
      echo '<tr><td>'.$no.'</td><td>'.$idtransaksi.'</td><td>'.$idbarang.'</td><td>'.$quantity.'</td><td>'.$harga.'</td><td>'.$jumlah.'</td>';

      $no++;
   }
   echo '</table></div></div>';
}
?>