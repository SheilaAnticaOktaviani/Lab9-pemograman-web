<?php
// query untuk menampilkan data
global $conn;
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<main>
    <h2>Data Barang</h2>
    <div class="main">
        <p><a class="btn" href="index.php?page=user/add">+ Tambah Barang</a></p>
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?php if(!empty($row['gambar'])): ?><img src="<?= $row['gambar'];?>" alt="<?= htmlspecialchars($row['nama']);?>" width="80"><?php endif; ?></td>
                <td><?= htmlspecialchars($row['nama']);?></td>
                <td><?= htmlspecialchars($row['kategori']);?></td>
                <td><?= htmlspecialchars($row['harga_jual']);?></td>
                <td><?= htmlspecialchars($row['harga_beli']);?></td>
                <td><?= htmlspecialchars($row['stok']);?></td>
                <td>
                    <a href="index.php?page=user/ubah&id=<?= $row['id_barang']; ?>">Ubah</a> |
                    <a href="index.php?page=user/hapus&id=<?= $row['id_barang']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="7">Belum ada data</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
</main>
