<?php
session_start();

include "koneksi.php";

#ambil data di tabel dan masukkan ke array
	$query = "SELECT dt.idtransaksi,dt.idbarang,t.tanggal,dt.qty,dt.harga,dt.subtotal FROM transaksi t,detail_pembayaran dt WHERE dt.idtransaksi=t.idtransaksi";
	$sql = mysql_query ($query);
	$data = array();
	while ($row = mysql_fetch_assoc($sql)) {
		array_push($data, $row);
	}
	 
	#setting judul laporan dan header tabel
	$judul = "Rekap Pembayaran";
	$header = array(
			array("label"=>"ID Transaksi", "length"=>30, "align"=>"L"),
			array("label"=>"ID Barang", "length"=>30, "align"=>"L"),
			array("label"=>"Tanggal", "length"=>30, "align"=>"L"),
			array("label"=>"Quantity", "length"=>30, "align"=>"L"),
			array("label"=>"Harga", "length"=>30, "align"=>"L"),
			array("label"=>"Subtotal", "length"=>30, "align"=>"L"),
		);
		
#sertakan library FPDF dan bentuk objek
	require_once ("assets/fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	 
	#tampilkan judul laporan
	$pdf->SetFont('Arial','B','16');
	$pdf->Cell(0,20, $judul, '0', 1, 'C');
	 
	#buat header tabel
	$pdf->SetFont('Arial','','10');
	$pdf->SetFillColor(355,0,0);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(128,0,0);

	foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
	}
	$pdf->Ln();
	 
	#tampilkan data tabelnya
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');
	$fill=false;
	foreach ($data as $baris) {
		$i = 0;
		foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
			$i++;
		}
		$fill = !$fill;
		$pdf->Ln();
}
#output file PDF
$pdf->Output();
?>
