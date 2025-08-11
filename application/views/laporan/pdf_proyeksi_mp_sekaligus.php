<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
</head>

<body style="font-size: 12px; font-family: helvetica;">

    <table>
        <tr>
            <td><b>Lampiran Surat Nomor&emsp;&emsp;&emsp;</b></td>
            <td>:</td>
            <td>DPK-BPJSTK/&emsp;&emsp;&emsp;/DK/&emsp;&emsp;&emsp;<?= date('Y'); ?></td>
        </tr>
        <tr>
            <td><b>Tanggal</b></td>
            <td>:</td>
            <td><?= date('d/m/Y'); ?></td>
        </tr>
        <tr>
            <td><b>Perihal</b></td>
            <td>:</td>
            <td>Pengurusan Hak Pensiun</td>
        </tr>
    </table>
    <br>
    <div style="text-align: center;">
        <b>PROYEKSI PERHITUNGAN MANFAAT PENSIUN</b>
        <hr style="height: 3px; color: black;">
    </div>

    <table>
        <tr>
            <td><b>1.</b></td>
            <td><b>Data Pegawai</b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; NPK</td>
            <td>&nbsp;=</td>
            <td><?= $npk; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Nama</td>
            <td>&nbsp;=</td>
            <td><?= $nama_pes; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>2.</b></td>
            <td><b>Dasar Perhitungan Manfaat Pensiun &emsp;&emsp;</b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; PhDP</td>
            <td>&nbsp;=</td>
            <td><?= $p_phdp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Status Pajak</td>
            <td>&nbsp;=</td>
            <td><?= $st_kwn; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Tanggal Pensiun</td>
            <td>&nbsp;=</td>
            <td><?= date('d/m/Y', strtotime($tgl_brnt)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp; Masa Bekerja</td>
            <td>&nbsp;=</td>
            <td><?= $p_mk; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>3.</b></td>
            <td><b>Perhitungan Manfaat Pensiun(MP)</b></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td>&emsp; <b>3.1 Pilihan Pertama (Bila Manfaat Pensiun Dibayarkan Berkala Penuh)</b></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Manfaat Pensiun&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</td>
            <td>=</td>
            <td>
                Nilai Sekarang x Masa Kerja x Faktor Penghargaan x PhDP
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td>=</td>
            <td>
                <?= $ns; ?> x <?= $s_mk; ?> x 2,50% x <?= $p_phdp; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>=</td>
            <td><?= $p_mp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" style="font-size: 9px; padding: 3px;">
                <div style="display: 
                <?php
                $a = $s_mk * 0.025 * $phdp_1;
                $b = 0.8 * $phdp_1;
                if ($a >= $b) {
                } else {
                    echo ("none");
                }
                ?>
                ;">
                    &emsp;&emsp;&emsp;&nbsp;&nbsp;Sesuai Peraturan Dana Pensiun Pasal 31 ayat (3) besarnya Manfaat Pensiun Maksimal 80% dari PhDP / Masa Kerja 32 Tahun
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp;
                <?php
                $bl = substr($tgl_brnt, 5, 2);
                switch ($bl) {
                    case '01':
                        $namaBulan = 'Jan';
                        break;
                    case '02':
                        $namaBulan = 'Feb';
                        break;
                    case '03':
                        $namaBulan = 'Mar';
                        break;
                    case '04':
                        $namaBulan = 'Apr';
                        break;
                    case '05':
                        $namaBulan = 'Mei';
                        break;
                    case '06':
                        $namaBulan = 'Jun';
                        break;
                    case '07':
                        $namaBulan = 'Jul';
                        break;
                    case '08':
                        $namaBulan = 'Agts';
                        break;
                    case '09':
                        $namaBulan = 'Sep';
                        break;
                    case '10':
                        $namaBulan = 'Okt';
                        break;
                    case '11':
                        $namaBulan = 'Nov';
                        break;
                    case '12':
                        $namaBulan = 'Des';
                        break;
                    default:
                        $namaBulan = 'Bulan tidak valid';
                        break;
                }
                if ($namaBulan == 'Nov') {
                    echo ("PPh Nov");
                } else {
                    echo ("PPh " . $namaBulan . "-Nov");
                }
                ?>

            </td>
            <td>=</td>
            <td><?= $ter_jan_nov_p1; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; PPh Des</td>
            <td>=</td>
            <td><?= $ter_des_p1; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp;
                <?php
                if ($namaBulan == 'Nov') {
                    echo ("Penerimaan MP Perbulan (Nov)");
                } else {
                    echo ("Penerimaan MP Perbulan (" . $namaBulan . "-Nov)");
                }
                ?>
            </td>
            <td>=</td>
            <td><?= $mp_jan_nov_p1; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Penerimaan MP Perbulan (Des)</td>
            <td>=</td>
            <td><?= $mp_des_p1; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <table>
        <tr>
            <td></td>
            <td>&emsp; <b>3.2 Pilihan Kedua (Bila Dibayarkan Sekaligus 20% dan Berkala 80%)</b></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Nilai Sekarang Manfaat Pensiun&emsp;&emsp;&emsp;&emsp;&emsp;</td>
            <td>=</td>
            <td>Faktor Sekaligus x MP Bulanan</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td>=</td>
            <td> <?= $fgus; ?> x <?= $p_mp; ?> </td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;</td>
            <td>=</td>
            <td><?= $p_mpsek; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; <b>Manfaat Pensiun Sekaligus 20%</b></td>
            <td>=</td>
            <td>20% x <?= $p_mpsek; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; MP Sekaligus 20%</td>
            <td>=</td>
            <td><?= $p_mpsek20; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; PPh 21 atas MP Sekaligus 20%</td>
            <td>=</td>
            <td><u><?= $p_pph2120; ?> &emsp;&emsp;-</u></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Penerimaan MP Sekaligus</td>
            <td>=</td>
            <td><?= $p_mp20; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; <b>Manfaat Pensiun Berkala 80%</b></td>
            <td>=</td>
            <td>80% x <?= $p_mp; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; </td>
            <td>=</td>
            <td><?= $p_mp80; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp;
                <?php if ($namaBulan == 'Nov') {
                    echo ("PPh Nov");
                } else {
                    echo ("PPh " . $namaBulan . "-Nov");
                }
                ?>
            </td>
            <td>=</td>
            <td><?= $ter_jan_nov; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; PPh Des</td>
            <td>=</td>
            <td><?= $ter_des; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp;
                <?php
                if ($namaBulan == 'Nov') {
                    echo ("Penerimaan MP Perbulan (Nov)");
                } else {
                    echo ("Penerimaan MP Perbulan (" . $namaBulan . "-Nov)");
                }
                ?>
            </td>
            <td>=</td>
            <td><?= $mp_jan_nov; ?> &emsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&emsp;&emsp;&emsp; Penerimaan MP Perbulan (Des)</td>
            <td>=</td>
            <td><?= $mp_des; ?> &emsp;</td>
        </tr>
    </table>
    <hr style="height: 2px; color: black;">
    <table style="margin-bottom: 8px;">
        <tr>
            <td>Keterangan :</td>
            <td></td>
        </tr>
        <tr>
            <td style="font-size: 10px;">
                Perhitungan Pajak sesuai Peraturan Pemerintah Nomor 58 Tahun 2023 tentang Tarif Pemotongan Pajak Penghasilan Pasal 21 atas Penghasilan sehubungan dengan Pekerjaan, Jasa atau Kegiatan Wajib Pajak Orang Pribadi. <br><br>
                *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Setiap Masa : Penghasilan Bruto x Tarif efektif Rata-Rata (TER) bulanan. <br>
                **&emsp; Masa Pajak Terakhir : <br>
                &emsp;&emsp;&emsp;&emsp; 1. PPh Pasal 21 Masa Pajak Terakhir: PPh Pasal 21 setahun - PPh Pasal 21 yang sudah dipotong selain Masa Pajak Terakhir. <br>
                &emsp;&emsp;&emsp;&emsp; 2. PPh Pasal 21 setahun : (Penghsilan Bruto setahun - Biaya Pensiun - PTKP) x Tarif Pasal 17. <br>
                &emsp;&emsp;&emsp;&emsp; 3. Penghasilan Bruto setahun : Penghasilan dari Dana Pensiun.
            </td>
        </tr> <br>
    </table>
    <b>PENGURUS</b>
    <br><br><br><br><br>
    <b>Ahmad Sulintang</b><br>
    Direktur
</body>

</html>