<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <center>
                <div class="card mt-2 mb-4 col-8">
                    <div class="card-body">
                        <form action="<?= base_url('surat/updatesurat'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="date" class="form-control ready" id="tgl_agenda" name="tgl_agenda" placeholder="Tanggal Agenda" value="<?= $surat['tgl_agenda']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pengirim" name="pengirim" placeholder="Pengirim" value="<?= $surat['pengirim']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $surat['no_surat']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control ready" id="tgl_surat" name="tgl_surat" placeholder="Tanggal Surat" value="<?= $surat['tgl_surat']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="no_agenda" name="no_agenda" placeholder="Nomor Agenda" value="<?= $surat['no_agenda']; ?>">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <b><label for="file" style="margin-right: 930px; margin-bottom: 0px;">Tujuan</label></b>
                                        <!-- <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Tujuan"> -->
                                        <div class="form-check" style="margin-right: 810px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="dirut" value="Direktur Utama," id="dirut" <?php if (preg_match("/Direktur Utama/i", $surat['tujuan'])) {
                                                                                                                                                echo "checked";
                                                                                                                                            }
                                                                                                                                            ?>>
                                            <label class="form-check-label" for="file">
                                                1. Direktur Utama
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-right: 862px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="direktur" value="Direktur," id="direktur" <?php if (preg_match("/Direktur,/i", $surat['tujuan'])) {
                                                                                                                                                echo "checked";
                                                                                                                                            }
                                                                                                                                            ?>>
                                            <label class="form-check-label" for="file">
                                                2. Direktur
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-right: 781px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="menku" value="Manager Keuangan," id="menku" <?php if (preg_match("/Manager Keuangan/i", $surat['tujuan'])) {
                                                                                                                                                    echo "checked";
                                                                                                                                                }
                                                                                                                                                ?>>
                                            <label class="form-check-label" for="file">
                                                3. Manager Keuangan
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-right: 754px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="menkep" value="Manager Kepesertaan," id="menkep" <?php if (preg_match("/Manager Kepesertaan/i", $surat['tujuan'])) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                            <label class="form-check-label" for="file">
                                                4. Manager Keepesertaan
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-right: 732px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="menum" value="Manager SDM Umum & TI" id="menum" <?php if (preg_match("/Manager SDM Umum & TI/i", $surat['tujuan'])) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }
                                                                                                                                                    ?>>
                                            <label class="form-check-label" for="file">
                                                5. Manager SDM Umum & TI
                                            </label>
                                        </div>
                                        <div class="form-check" style="margin-right: 732px; margin-bottom: 0px;">
                                            <input class="form-check-input" type="checkbox" name="audit" value="Audit" id="audit" <?php if (preg_match("/Audit/i", $surat['tujuan'])) {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                    ?>>
                                            <label class="form-check-label" for="file">
                                                6. Audit
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal" value="<?= $surat['perihal']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="status" name="status" placeholder="Status" value="<?= $surat['status']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="salur" name="salur" placeholder="Salur" value="<?= $surat['salur']; ?>">
                                </div>
                                <div class="form-group" style="text-align:justify;">
                                    <div class="form-group">
                                        <b><label>Berkas Sebelumnya</label></b>
                                        <br>
                                        <input type="text" style="width: 100%;" value="<?= $surat['berkas']; ?>" readonly>
                                    </div>
                                    <div class=" form-group">
                                        <b><label>Berkas Baru</label></b>
                                        <input type="file" class="form-control-file" id="berkas" name="berkas" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control invisible" id="id" name="id" value="<?= $surat['id']; ?>">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-danger" onclick="history.back()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
</div>