<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'config/functions.php';

$template = getTemplate();

if(isset($_GET["id_pasien"]) && is_numeric($_GET["id_pasien"])){
    $id = (int)$_GET["id_pasien"];

    $p = query("SELECT * FROM pasien WHERE id_pasien = $id")[0];

}

if(isset($_POST["submit"])){
    if(editpasien2($_POST, $id) > 0 ){
        echo "<script> alert('Input Hasil Pemeriksaan Berhasil'); location.href= 'pemeriksaan.php'; </script>";
    }else {
        echo "<script> alert('Input Hasil Pemeriksaan Gagal'); location.href= 'pemeriksaan.php'; </script>";
    }
}

?>

<!DOCTYPE html>s
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Medical Check-Up</title>
</head>
<body>
    <main>
        <?php include($template); ?>
        <h1>Edit Data Pasien</h1>
        <section>
            <form action="" method="POST">
                <!-- Biodata -->
                <fieldset>
                    <legend>A. Data Pasien</legend>

                    <input type="hidden" name="id_pasien">

                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($p["nama"]); ?>"> 

                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($p["tgl_lahir"]); ?>"> 
                    
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="P" <?= htmlspecialchars($p["jk"] == "P") ? "selected" : ""; ?>>Perempuan</option>
                        <option value="L" <?= htmlspecialchars($p["jk"] == "L") ? "selected" : ""; ?>>Laki-Laki</option>
                    </select>

                    <label for="no_tlp">Nomor Telepon</label>
                    <input type="number" name="no_tlp" value="<?= htmlspecialchars($p["no_tlp"]); ?>">

                    <label for="alamat">Alamat Lengkap</label>
                    <input type="text" name="alamat" value="<?= htmlspecialchars($p["alamat"]); ?>">

                    <label for="jadwal_pemeriksaan">Jadwal Pemeriksaan</label>
                    <input type="date" name="jadwal_pemeriksaan" value="<?= htmlspecialchars($p["jadwal_pemeriksaan"]); ?>">
                </fieldset>

                <fieldset>
                    <!-- Hasil Pemeriksaan -->
                    <legend>B. Hasil Pemeriksaan (Riwayat Kesehatan)</legend>

                    <label for="tekanan_darah">Tekanan Darah</label>
                    <input type="text" name="tekanan_darah" value="<?= htmlspecialchars($p["tekanan_darah"]); ?>"> 

                    <label for="denyut_nadi">Denyut Nadi</label>
                    <input type="text" name="denyut_nadi" value="<?= htmlspecialchars($p["denyut_nadi"]); ?>"> 

                    <label for="suhu_tubuh">Suhu Tubuh</label>
                    <input type="text" name="suhu_tubuh" value="<?= htmlspecialchars($p["suhu_tubuh"]); ?>"> 

                    <label for="tinggi_badan">Tinggi Badan</label>
                    <input type="text" name="tinggi_badan" value="<?= htmlspecialchars($p["tinggi_badan"]); ?>"> 

                    <label for="berat_badan">Berat Badan</label>
                    <input type="text" name="berat_badan" value="<?= htmlspecialchars($p["berat_badan"]); ?>"> 
                </fieldset>

                <fieldset>
                    <legend>C. Kondisi Saat Ini</legend>

                    <label for="keluhan">Apakah ada keluhan saat ini?</label>
                    <select name="keluhan">
                        <option value="">-- Pilih Keluhan --</option>
                        <option value="Tidak Ada" <?= htmlspecialchars($p["keluhan"] == "Tidak Ada") ? "selected" : ""; ?>>Tidak Ada</option>
                        <option value="Ya (Pilek)" <?= htmlspecialchars($p["keluhan"] == "Ya (Pilek)") ? "selected" : ""; ?>>Ya (Pilek)</option>
                        <option value="Ya (Batuk Ringan)" <?= htmlspecialchars($p["keluhan"] == "Ya (Batuk Ringan)") ? "selected" : ""; ?>>Ya (Batuk Ringan)</option>
                        <option value="Ya (Pusing)" <?= htmlspecialchars($p["keluhan"] == "Ya (Pusing)") ? "selected" : ""; ?>>Ya (Pusing)</option>
                        <option value="Ya (Pilek, Batuk Ringan, Sedikit Pusing)" <?= htmlspecialchars($p["keluhan"] == "Ya (Pilek, Batuk Ringan, Sedikit Pusing)") ? "selected" : ""; ?>>Ya (Pilek, Batuk Ringan, Sedikit Pusing)</option>
                    </select>
                </fieldset>

                <fieldset>
                    <legend>D. Riwayat Penyakit</legend>

                    <label for="riwayat">Apakah pernah memiliki riwayat penyakit serius?</label>
                    <select name="riwayat">
                        <option value="">-- Ya/Tidak --</option>
                        <option value="Ya" <?= htmlspecialchars($p["riwayat"] == "Ya") ? "selected" : ""; ?>>Ya</option>
                        <option value="Tidak Ada" <?= htmlspecialchars($p["riwayat"] == "Tidak Ada") ? "selected" : ""; ?>>Tidak Ada</option>
                    </select>

                    <label for="riwayat2">Apakah ada alergi?</label>
                    <select name="riwayat2">
                        <option value="">-- Ya/Tidak --</option>
                        <option value="Ya" <?= htmlspecialchars($p["riwayat2"] == "Ya") ? "selected" : ""; ?>>Ya</option>
                        <option value="Tidak Ada" <?= htmlspecialchars($p["riwayat2"] == "Tidak Ada") ? "selected" : ""; ?>>Tidak Ada</option>
                    </select>
                </fieldset>

                <fieldset>
                    <legend>E. Kebiasaan</legend>

                    <label for="kebiasaan">Apakah anda merokok?</label>
                    <select name="kebiasaan">
                        <option value="">-- Ya/Tidak --</option>
                        <option value="Ya" <?= htmlspecialchars($p["kebiasaan"] == "Ya") ? "selected" : ""; ?>>Ya</option>
                        <option value="Tidak" <?= htmlspecialchars($p["kebiasaan"] == "Tidak") ? "selected" : ""; ?>>Tidak</option>
                    </select>
                </fieldset>

                <fieldset>
                    <legend>F. Dokter</legend>
                    <label for="dokter">Dokter yang memeriksa</label>
                    <select name="dokter">
                        <option value="">-- Pilih Dokter --</option>
                        <option value="Dr. Ardhan Yunanda, Sp.A" <?= htmlspecialchars($p["dokter"] == "Dr. Ardhan Yunanda, Sp.A") ? "selected" : ""; ?>>Dr. Ardhan Yunanda, Sp.A</option>
                        <option value="Dr. Wina Juwita, Sp.D" <?= htmlspecialchars($p["dokter"] == "Dr. Wina Juwita, Sp.D") ? "selected" : ""; ?>>Dr. Wina Juwita, Sp.D</option>
                        <option value="Dr. Rifky Wijaya, Sp.P" <?= htmlspecialchars($p["dokter"] == "Dr. Rifky Wijaya, Sp.P") ? "selected" : ""; ?>>Dr. Rifky Wijaya, Sp.P</option>
                        <option value="Dr. Nina Kania, Sp.J" <?= htmlspecialchars($p["dokter"] == "Dr. Nina Kania, Sp.J") ? "selected" : ""; ?>>Dr. Nina Kania, Sp.J</option>
                    </select>

                    <label for="poli">Dokter yang memeriksa</label>
                    <select name="poli">
                        <option value="">-- Pilih Poli --</option>
                        <option value="Poli Anak" <?= htmlspecialchars($p["poli"] == "Poli Anak") ? "selected" : ""; ?>>Poli Anak</option>
                        <option value="Poli Penyakit Dalam" <?= htmlspecialchars($p["poli"] == "Poli Penyakit Dalam") ? "selected" : ""; ?>>Poli Penyakit Dalam</option>
                        <option value="Poli Paru" <?= htmlspecialchars($p["poli"] == "Poli Paru") ? "selected" : ""; ?>>Poli Paru</option>
                        <option value="Poli Jantung" <?= htmlspecialchars($p["poli"] == "Poli Jantung") ? "selected" : ""; ?>>Poli Jantung</option>
                    </select>
                </fieldset>

                <fieldset>
                    <legend>G. Keterangan Pemeriksaan</legend>
                    <label for="status_pemeriksaan">Apakah sudah di periksan / belum</label>
                    <select name="status_pemeriksaan">
                        <option value="">-- sudah / belum --</option>
                        <option value="Sudah Diperiksa" <?= htmlspecialchars($p["status_pemeriksaan"] == "Sudah Diperiksa") ? "selected" : ""; ?>>Sudah Diperiksa</option>
                        <option value="Belum Diperiksa" <?= htmlspecialchars($p["status_pemeriksaan"] == "Belum Diperiksa") ? "selected" : ""; ?>>Belum Diperiksa</option>
                    </select>
                </fieldset>

                <button type="submit" name="submit">Edit Pasien</button>
            </form>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>