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
            <span>Nomor: <?= $date['hari'] . '/' . $date['bulan_angka'] . '/' . $date['tahun'] . '/REKAP/PELAPOR/DIY/SEK-PA' ?></span>
        </div>
        <table width="100%" class="tablelist">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <!-- <th>E-KTP</th>
                    <th>KK</th> -->
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1;
                foreach ($listpelapor as $list) : ?>
                    <tr>
                        <td><?php echo $id++; ?></td>
                        <td><?php echo $list['nama']; ?></td>
                        <td><?php echo $list['jk']; ?></td>
                        <td><?php echo $list['email']; ?></td>
                        <td><?php echo $list['notelp']; ?></td>
                        <td><?php echo $list['alamat']; ?></td>
                        <!-- <td><?php echo $list['img_ktp'] == null ? 'Kosong' : 'Terlampir'; ?></td>
                        <td><?php echo $list['img_kk'] == null ? 'Kosong' : 'Terlampir'; ?></td> -->
                        <td><?php echo $list['active'] == 1 ? 'Aktif' : 'Non-Aktif'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>