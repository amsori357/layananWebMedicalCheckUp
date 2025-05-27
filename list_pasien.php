<?php
include '../controllers/pasien.php';
$pasien = getAllPasien();
?>
<h2>Daftar Pasien</h2>
<table border="1">
    <tr><th>Nama</th><th>Tanggal Lahir</th></tr>
    <?php foreach ($pasien as $p): ?>
    <tr>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['tanggal_lahir'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
