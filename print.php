<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require('library/fpdf.php');
require 'config/functions.php';

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil id_pasien dari URL, validasi dulu
if (!isset($_GET['id_pasien']) || !is_numeric($_GET['id_pasien'])) {
    die("ID Pasien tidak valid");
}
$id_pasien = (int)$_GET['id_pasien'];

// Query data pasien berdasar id_pasien
$pasien_list = query("SELECT * FROM pasien WHERE id_pasien = $id_pasien");
if (count($pasien_list) === 0) {
    die("Data pasien tidak ditemukan");
}
$pasien = $pasien_list[0];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,6,'Hasil Pemeriksaan Medical Check-Up',0,1,'L');

        $this->SetFont('Arial','',12);
        $this->Cell(0,6,'RS. Rizal Diki Sejahtera',0,1,'L');

        $this->SetFont('Arial','',10);
        $this->Cell(0,5,'Jl. RE. Martadinata, No. 306 Baregbeg Ciamis',0,1,'L');
        $this->Cell(0,5,'Tlp. (0265) 789564  |  email: rsrizaldikisejahtera@gmail.com',0,1,'L');

        $this->Ln(2);
        $this->Line(10, $this->GetY(), 287, $this->GetY());
        $this->Ln(5);
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Data Hasil Medical Check - Up',0,1,'C');
$pdf->Ln(2);

$pdf->SetFont('Arial','',11);
$pdf->SetXY(10, 55);

// Kolom kiri
$pdf->Cell(50,7,'Tanggal Pemeriksaan',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["jadwal_pemeriksaan"],0,1);

$pdf->Cell(50,7,'Nama',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["nama"],0,1);

$pdf->Cell(50,7,'Jenis Kelamin',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,($pasien["jk"]=='L'?'Laki-Laki':'Perempuan'),0,1);

$pdf->Cell(50,7,'Tanggal Lahir',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["tgl_lahir"],0,1);

// Kolom kanan
$pdf->SetXY(160,55);
$pdf->Cell(30,7,'Alamat',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["alamat"],0,1);

$pdf->SetX(160);
$pdf->Cell(30,7,'Nama Dokter',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["dokter"],0,1);

$pdf->SetX(160);
$pdf->Cell(30,7,'Poli',0,0);
$pdf->Cell(5,7,':',0,0);
$pdf->Cell(80,7,$pasien["poli"],0,1);

// Pemeriksaan Fisik
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,7,'PEMERIKSAAN FISIK :',0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,7,'ANAMNESA:',0,1);

// Kolom Riwayat dan Kondisi
$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,7,'Riwayat Kesehatan',0,0);
$pdf->Cell(90,7,'Kondisi Saat ini',0,1);
$pdf->SetFont('Arial','',11);

$pdf->Cell(50,6,'Tekanan Darah',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6,$pasien["tekanan_darah"],0,0);

$pdf->Cell(90,6,'Keluhan',0,0);
$pdf->Cell(0,6,$pasien["keluhan"],0,1);

$pdf->Cell(50,6,'Denyut Nadi',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6,$pasien["denyut_nadi"],0,0);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,6,'Riwayat Penyakit',0,1);
$pdf->SetFont('Arial','',11);

$pdf->Cell(50,6,'Suhu Tubuh',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6,$pasien["suhu_tubuh"],0,0);

$pdf->Cell(90,6,'Pernah Memiliki Penyakit Serius',0,0);
$pdf->Cell(0,6,$pasien["riwayat"],0,1);

$pdf->Cell(50,6,'Tinggi Badan',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6,$pasien["tinggi_badan"],0,0);

$pdf->Cell(90,6,'Ada Alergi',0,0);
$pdf->Cell(0,6,$pasien["riwayat2"],0,1);

$pdf->Cell(50,6,'Berat Badan',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6,$pasien["berat_badan"],0,0);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(90,6,'Kebiasaan',0,1);
$pdf->SetFont('Arial','',11);

$pdf->Cell(90,6,'',0,0);
$pdf->Cell(90,6,'Merokok',0,0);
$pdf->Cell(0,6,$pasien["kebiasaan"],0,1);

$pdf->Output();

?>