<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/rekap.css') ?>">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <title>Document</title>
</head>

<body>
    <div class="heading">
        <img src="<?= base_url('assets/img/lambang.png') ?>" alt="lambang" id="lambang">
        <h4>KEPOLISIAN DAERAH ISTIMEWA YOGYAKARTA <br> RESOR KOTA YOGYAKARTA <br>SEKTOR PAKUALAMAN</h4>
        <span>Jalan Purwanggan No. 53 Yogyakarta 55112 Telp.(0274)513178</span>
    </div>
    <div class="badan">
        <div class="kop">
            <span style="font-weight: bold;">Rekap Data Pelapor</span><br>
            <span>Nomor: <?= $date['hari'] . '/' . $date['bulan_angka'] . '/' . $date['tahun'] . '/REKAP/STTLP/DIY/SEK-PA' ?></span>
        </div>
        <table width="100%" class="tablelist">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th>Nomor</th>
                    <th>Petugas</th>
                    <th>Pelapor</th>
                    <th>Berkas</th>
                    <th>Tgl Kejadian</th>
                    <th>Tgl Kirim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1;
                foreach ($listbalasan as $list) : ?>
                    <tr>
                        <td><?php echo $id++; ?></td>
                        <td><?php echo $list['no_lp']; ?></td>
                        <td><?php echo $petugas; ?></td>
                        <td><?php echo $list['pengguna']; ?></td>
                        <td><?php echo $list['nama_berkas']; ?></td>
                        <td><?php echo $list['tgl_kejadian']; ?></td>
                        <td><?php echo $list['tanggal']; ?></td>
                        <td><?php echo $list['proses']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <div class="col" align="left" style="width: 50%;float: left;">
            <div class="ttd">
                <div>MENGETAHUI <br>KAPOLSEK SEKTOR PAKUALAMAN</div>
                <div id="nama-petugas">SIGIT ARIYANTO ADI,S,ST,.M.M</div>
                <div>KOMISARIS POLISI NRP. 76120071</div>
            </div>
        </div>
        <div class="col" align="left" style="width: 50%;float: left;">
            <div class="ttd">
                <div>MENGETAHUI <br>PETUGAS SEKTOR PAKUALAMAN</div>
                <div id="nama-petugas"><?= strtoupper($petugas) ?></div>
                <div>ANGGOTA POLISI NRP. <?= $nopetugas ?></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>