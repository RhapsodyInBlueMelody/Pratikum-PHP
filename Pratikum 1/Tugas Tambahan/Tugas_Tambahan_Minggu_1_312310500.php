<?php
session_start();

function prosesPembelian($idProduk, $jumlah) {
    $ditemukan = false;
    $diskon = 0;

    if ($jumlah <= 0) {
        return "Jumlah pembelian harus lebih dari 0<br/>";
    }

    foreach ($_SESSION['produk'] as $key => &$item) {
        if ($item['IdProduk'] == $idProduk) {
            $ditemukan = true;
            
            if ($item['Stok'] <= 0) {
                return "Maaf, Stok untuk " . $item['NamaProduk'] . " sudah habis <br/>";
            } elseif ($item['Stok'] < $jumlah) {
                return "Maaf, Stok untuk " . $item['NamaProduk'] . " tidak mencukupi. Stok tersedia: " . $item['Stok'] . "<br/>";
            }
            
            $totalharga = $item['Harga'] * $jumlah;
            $pajak = $totalharga * 0.10;

            $_SESSION['produk'][$key]['Stok'] -= $jumlah;
            
            $output = "<h3>Pembelian Berhasil</h3><br/>";
            $output .= "STRUK TRANSAKSI<br/>";
            $output .= "=================<br/>";
            $output .= "Nama Produk: " . $item['NamaProduk'] . "<br/>";
            $output .= "Jumlah: " . $jumlah . "<br/>";
            $output .= "Total Harga: Rp." . number_format($totalharga, 0, ',', '.') . "<br/>";

            if ($totalharga >= 250000 && $totalharga <= 500000) {
                $diskon = $totalharga * 0.05;
                $output .= "Diskon: Rp." . number_format($diskon, 0, ',', '.') . "<br/>";
            } elseif ($totalharga > 500000) {
                $diskon = $totalharga * 0.10;
                $output .= "Diskon: Rp." . number_format($diskon, 0, ',', '.') . "<br/>";
            }

            $output .= "Pajak: Rp." . number_format($pajak, 0, ',', '.') . " <br/>";
            $output .= "__________________________<br/>";
            $output .= "Total yang Harus dibayar: Rp." . number_format(($totalharga + $pajak - $diskon), 0, ',', '.') . "<br/>";
            $output .= "==========================<br/>";
            
            return $output;
        }
    }
    
    return "Produk tidak ditemukan.<br/>";
}

$default_produk = [
    [
        'IdProduk' => "P001",
        'NamaProduk' => "Kemeja",
        'Harga' => 15000,
        'Stok' => 10,
    ],
    [
        'IdProduk' => "P002",
        'NamaProduk' => "Celana",
        'Harga' => 200000,
        'Stok' => 5,
    ],
    [
        'IdProduk' => "P003",
        'NamaProduk' => "Sepatu",
        'Harga' => 500000,
        'Stok' => 7,
    ],
];

if (!isset($_SESSION['produk'])) {
    $_SESSION['produk'] = $default_produk;
}

if (isset($_POST['reset_stock'])) {
    $_SESSION['produk'] = $default_produk;
}

$StrukPembelian = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['IdProduk']) && isset($_POST['jumlah'])) {
    $idProduk = htmlspecialchars($_POST['IdProduk']);
    $jumlah = intval($_POST['jumlah']);
    $StrukPembelian = prosesPembelian($idProduk, $jumlah);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
</head>
<body>
    <?php
    $mahasiswa = [
        "Nama" => "Syeddinul Faiz Caniggia",
        "Kelas" => "Kelas",
        "NIM" => "312310500",
    ];

    echo "Nama: " . $mahasiswa['Nama'] . "<br/>";
    echo "Kelas: " . $mahasiswa['Kelas'] . "<br/>";
    echo "NIM: " . $mahasiswa['NIM'] . "<br/>";
    echo "<hr/>";

    if ($StrukPembelian) {
        echo $StrukPembelian;
    }

    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
          </tr>";

    foreach ($_SESSION['produk'] as $item) {
        echo "<tr>
                <td>" . $item['IdProduk'] . "</td>
                <td>" . $item['NamaProduk'] . "</td>
                <td>Rp." . number_format($item['Harga'], 0, ',', '.') . "</td>
                <td>" . $item['Stok'] . "</td>
              </tr>";
    }
    echo "</table>";
    ?>

    <h2>Pembelian</h2>
    <form action="" method="post">
        <label for="IdProduk">Id Produk</label>
        <input type="text" id="IdProduk" name="IdProduk" required>
        <label for="jumlah">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" required>
        <br>
        <input type="submit" value="Beli">
    </form>

    <form action="" method="post" style="margin-top: 20px;">
        <input type="submit" name="reset_stock" value="Atur Ulang Kembali Stock">
    </form>
</body>
</html>
