<?php
error_reporting(E_ALL);
include_once __DIR__ . '/../../config/database.php';

global $conn;
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'] ?? null;
    $gambar = null;

    if ($file_gambar && $file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destDir = dirname(__DIR__, 2) . '/gambar/';
        if (!is_dir($destDir)) { @mkdir($destDir, 0777, true); }
        $destination = $destDir . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar)) $sql .= ", gambar = '{$gambar}' ";
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);

    header('location: index.php?page=user/list');
    exit;
}

$id = $_GET['id'] ?? null;
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);

function is_select($val, $cur) { return $val == $cur ? 'selected="selected"' : ''; }
?>
<main>
    <h2>Ubah Barang</h2>
    <div class="main">
        <form method="post" action="index.php?page=user/ubah" enctype="multipart/form-data">
            <div class="input">
                <label>Nama Barang</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']);?>" />
            </div>
            <div class="input">
                <label>Kategori</label>
                <select name="kategori">
                    <option <?php echo is_select('Komputer', $data['kategori']);?> value="Komputer">Komputer</option>
                    <option <?php echo is_select('Elektronik', $data['kategori']);?> value="Elektronik">Elektronik</option>
                    <option <?php echo is_select('Hand Phone', $data['kategori']);?> value="Hand Phone">Hand Phone</option>
                </select>
            </div>
            <div class="input">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" value="<?php echo htmlspecialchars($data['harga_jual']);?>" />
            </div>
            <div class="input">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" value="<?php echo htmlspecialchars($data['harga_beli']);?>" />
            </div>
            <div class="input">
                <label>Stok</label>
                <input type="number" name="stok" value="<?php echo htmlspecialchars($data['stok']);?>" />
            </div>
            <div class="input">
                <label>File Gambar</label>
                <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
                <input type="hidden" name="id" value="<?php echo $data['id_barang'];?>" />
                <input type="submit" class="btn btn-brand btn-lg" name="submit" value="Simpan" />
            </div>
        </form>
    </div>
</main>
