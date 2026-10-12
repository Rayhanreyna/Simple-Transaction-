<?php

$barang = [
    "Buku Tulis" => 5000,
    "Buku Tulis 1pack" => 45000,
    "Pulpen" => 3000,
    "Pulpen 1pack" => 27000,
    "Pensil" => 2500,
    "Pensil 1pack" => 23000,
    "Penghapus" => 2000,
    "Penghapus 1pack" => 17000,
    "Almamater" => 300000,
    "Penggaris" => 4000
];

$namaBarang = "";
$jumlah = 0;
$harga = 0;
$subtotal = 0;
$diskon = 0;
$total = 0;
$uangBayar = 0;
$kembalian = 0;

$transaksiBerhasil = false;
$pesan = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form
    $namaBarang = $_POST["barang"];
    $jumlah = (int) $_POST["jumlah"];
    $uangBayar = (int) $_POST["uang_bayar"];

    // Mengambil harga berdasarkan nama barang
    $harga = $barang[$namaBarang];

    // Menghitung subtotal
    $subtotal = $harga * $jumlah;


    if ($subtotal >= 100000) {

        $diskon = $subtotal * 0.10;

    } elseif ($subtotal >= 50000) {

        $diskon = $subtotal * 0.05;

    } else {

        $diskon = 0;
    }

    $total = $subtotal - $diskon;


    if ($uangBayar >= $total) {

        $kembalian = $uangBayar - $total;

        $pesan = "Transaksi berhasil!";
        $transaksiBerhasil = true;

    } else {

        $pesan = "Uang pembayaran tidak cukup!";
        $transaksiBerhasil = false;
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TRANSAKSI SEDERHANA</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(
                135deg,
                #80124e,
                #13036b
            );

            min-height: 100vh;
            padding: 40px 20px;
        }


        .container {
            width: 100%;
            max-width: 650px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }


        .header h1 {
            color: #f6f6fa;
            font-size: 32px;
            margin-bottom: 8px;
        }


        .header p {
            color: #ffffff;
            font-size: 15px;
        }

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 15px;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08);

            margin-bottom: 20px;
        }


        .card h2 {
            color: #1e40af;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            margin-top: 15px;

            font-weight: bold;
            color: #334155;
        }


        select,
        input {
            width: 100%;

            padding: 12px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            font-size: 15px;

            outline: none;
        }


        select:focus,
        input:focus {
            border-color: #2563eb;
        }

        button {
            width: 100%;

            padding: 13px;

            margin-top: 25px;

            border: none;

            border-radius: 8px;

            background-color: #2563eb;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;
        }


        button:hover {
            background-color: #1d4ed8;
        }


        .hasil {
            margin-top: 20px;
        }


        .hasil p {
            margin-bottom: 12px;

            color: #475569;
        }


        .total {
            font-size: 22px;

            font-weight: bold;

            color: #2563eb !important;

            padding: 15px 0;
        }


        hr {
            border: none;

            border-top: 1px solid #e2e8f0;

            margin: 15px 0;
        }

        .success {
            background-color: #dcfce7;

            color: #166534 !important;

            padding: 15px;

            border-radius: 8px;

            font-weight: bold;
        }


        .error {
            background-color: #fee2e2;

            color: #991b1b !important;

            padding: 15px;

            border-radius: 8px;

            font-weight: bold;
        }


        .kembalian {
            font-size: 20px;

            font-weight: bold;

            color: #16a34a !important;
        }


        .daftar-barang {
            margin-top: 20px;
        }


        .daftar-barang h3 {
            color: #334155;

            margin-bottom: 12px;
        }


        .barang {
            display: flex;

            justify-content: space-between;

            padding: 10px 0;

            border-bottom: 1px solid #e2e8f0;

            color: #475569;
        }

        .footer {
            text-align: center;

            color: #64748b;

            font-size: 13px;

            margin-top: 20px;
        }

        @media (max-width: 600px) {

            body {
                padding: 20px 10px;
            }

            .card {
                padding: 20px;
            }

            .header h1 {
                font-size: 26px;
            }

        }

    </style>

</head>


<body>


<div class="container">



    <div class="header">

        <h1>SIMPLE TRANSACTION</h1>

        <p>
            Sistem Kasir Sederhana
        </p>

    </div>



    <div class="card">

        <h2>Input Transaksi</h2>


        <form method="POST">


            <label for="barang">
                Pilih Barang
            </label>


            <select
                name="barang"
                id="barang"
                required
            >

                <option value="">
                    -- Pilih Barang --
                </option>


                <?php


                foreach ($barang as $nama => $hargaBarang) {

                ?>

                    <option
                        value="<?php echo $nama; ?>"
                    >

                        <?php echo $nama; ?>

                        -
                        
                        Rp <?php
                            echo number_format(
                                $hargaBarang,
                                0,
                                ',',
                                '.'
                            );
                        ?>

                    </option>


                <?php

                }

                ?>

            </select>

            <label for="jumlah">
                Jumlah Barang
            </label>


            <input
                type="number"
                name="jumlah"
                id="jumlah"
                min="1"
                placeholder="Masukkan jumlah barang"
                required
            >

            <label for="uang_bayar">
                Uang Pembayaran
            </label>


            <input
                type="number"
                name="uang_bayar"
                id="uang_bayar"
                min="0"
                placeholder="Masukkan uang pembayaran"
                required
            >

            <button type="submit">
                Hitung Transaksi
            </button>


        </form>

    </div>


    <div class="card daftar-barang">

        <h3>
            Daftar Harga Barang
        </h3>


        <?php


        foreach ($barang as $nama => $hargaBarang) {

        ?>

            <div class="barang">

                <span>
                    <?php echo $nama; ?>
                </span>

                <span>
                    Rp
                    <?php
                    echo number_format(
                        $hargaBarang,
                        0,
                        ',',
                        '.'
                    );
                    ?>
                </span>

            </div>


        <?php

        }

        ?>

    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    ?>

        <div class="card hasil">

            <h2>
                Hasil Transaksi
            </h2>


            <p>

                <strong>
                    Nama Barang:
                </strong>

                <?php
                echo htmlspecialchars($namaBarang);
                ?>

            </p>


            <p>

                <strong>
                    Harga Satuan:
                </strong>

                Rp
                <?php
                echo number_format(
                    $harga,
                    0,
                    ',',
                    '.'
                );
                ?>

            </p>


            <p>

                <strong>
                    Jumlah:
                </strong>

                <?php
                echo $jumlah;
                ?>

            </p>


            <p>

                <strong>
                    Subtotal:
                </strong>

                Rp
                <?php
                echo number_format(
                    $subtotal,
                    0,
                    ',',
                    '.'
                );
                ?>

            </p>


            <p>

                <strong>
                    Diskon:
                </strong>

                Rp
                <?php
                echo number_format(
                    $diskon,
                    0,
                    ',',
                    '.'
                );
                ?>

            </p>


            <hr>


            <p class="total">

                Total:

                Rp
                <?php
                echo number_format(
                    $total,
                    0,
                    ',',
                    '.'
                );
                ?>

            </p>


            <p>

                <strong>
                    Uang Bayar:
                </strong>

                Rp
                <?php
                echo number_format(
                    $uangBayar,
                    0,
                    ',',
                    '.'
                );
                ?>

            </p>

            <?php


            if ($transaksiBerhasil == true) {

            ?>

                <p class="success">

                    <?php
                    echo $pesan;
                    ?>

                </p>


                <p class="kembalian">

                    Kembalian:

                    Rp
                    <?php
                    echo number_format(
                        $kembalian,
                        0,
                        ',',
                        '.'
                    );
                    ?>

                </p>


            <?php

            } else {

            ?>

                <p class="error">

                    <?php
                    echo $pesan;
                    ?>

                </p>


            <?php

            }

            ?>

        </div>


    <?php

    }

    ?>

    <div class="footer">

        <p>
            Sistem Kasir Sederhana &copy; 2026
        </p>

    </div>


</div>


</body>

</html>