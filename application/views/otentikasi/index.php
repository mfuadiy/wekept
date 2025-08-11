<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Otentikasi</h6>
        </div>
        <div class="card-body" id="atribut">
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <div id="reader"></div>
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <tr>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                    <!-- Loop through months -->
                    <?php foreach ($months as $month) :
                        $uploaded = false;
                        foreach ($otentikasi as $data) {
                            if ($data['bln'] == $month['id']) {
                                $uploaded = true;
                                break;
                            }
                        }
                    ?>

                        <tr>
                            <td>
                                <div class="mb-2">
                                    <?php echo $month['name']; ?>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="alert alert-danger">
                                    <form action="<?= base_url('otentikasi/do_upload/' . $month['id']) ?>" method="post" enctype="multipart/form-data" class="upload-form">
                                        <div class="">
                                            <input type="file" accept="image/*" capture="camera" name="userfile" id="cameraInput_<?php echo $month['id']; ?>" class="camera-input" style="display: none;">
                                            <div id="preview_<?php echo $month['id']; ?>"></div>
                                            <button class="btn btn-primary upload-btn" type="button" data-index="<?php echo $month['id']; ?>" id="btnCamera_<?php echo $month['id']; ?>" <?= $uploaded ? 'disabled' : ''; ?>><i class=" fas fa-camera"></i></button>
                                            <button type="submit" class="btn btn-success" id="submitCamera_<?php echo $month['id']; ?>" <?= $uploaded ? 'disabled' : ''; ?>><i class="fas fa-upload"></i></button>
                                            <div class="loading-bar" id="loadingBar_<?php echo $month['id']; ?>" style="display: none;">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="progressBar_<?php echo $month['id']; ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p id="device" hidden></p>
            </div>
        </div>

    </div>

</div>
</div>

<script>
    const UserAgent = navigator.userAgent
    const device = {
        iPad: /iPad/.test(UserAgent),
        iPhone: /iPhone/.test(UserAgent),
        Android: /Android/.test(UserAgent),
        Windows: /Windows/.test(UserAgent),
        Linux: /Linux/.test(UserAgent),
        Mac: /Macintosh/.test(UserAgent) || /Mac OS X/.test(UserAgent)
    }
    for (dev in device) {
        if (device[dev]) {
            document.getElementById('device').innerHTML = dev;
            document.getElementById('device').value = dev;
            if (dev == "Windows") {
                console.log(dev)
                var myDiv = document.getElementById("atribut")
                myDiv.setAttribute("style", "display: none")
                alert('Anda terdeteksi menggunakan perangkat ' + dev + '. Halaman ini hanya dapat diakses menggunakan Perangkat Android atau IoS!')
                window.location.href = '<?= base_url('user'); ?>'
            } else {
                console.log("bukan windows")
                console.log(dev)
            }
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Loop through all the upload buttons and add event listeners
        document.querySelectorAll('.upload-btn').forEach(button => {
            button.addEventListener('click', function() {
                let index = this.getAttribute('data-index');
                document.getElementById('cameraInput_' + index).click();
            });
        });

        // Loop through all the file inputs and add event listeners
        document.querySelectorAll('.camera-input').forEach(input => {
            input.addEventListener('change', function(event) {
                let index = this.id.split('_')[1];
                const preview = document.getElementById('preview_' + index);
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid" width="100" height="100">`;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });

        // Loop through all the forms and add event listeners
        document.querySelectorAll('.upload-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let index = form.querySelector('.camera-input').id.split('_')[1];
                document.getElementById('loadingBar_' + index).style.display = 'block';

                const formData = new FormData(form);
                const url = form.action;

                const xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);

                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;
                        const progressBar = document.getElementById('progressBar_' + index);
                        progressBar.style.width = percentComplete + '%';
                        progressBar.setAttribute('aria-valuenow', percentComplete);
                    }
                };

                xhr.onloadstart = function() {
                    document.getElementById('loadingBar_' + index).style.display = 'block';
                };

                xhr.onloadend = function() {
                    document.getElementById('loadingBar_' + index).style.display = 'none';
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            alert(response.message);
                            document.getElementById('btnCamera_' + index).setAttribute('disabled', 'disabled');
                            document.getElementById('submitCamera_' + index).setAttribute('disabled', 'disabled');
                            document.getElementById('preview_' + index).innerHTML = '';
                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert('Upload failed.');
                    }
                };

                xhr.onerror = function() {
                    document.getElementById('loadingBar_' + index).style.display = 'none';
                    alert('An error occurred. Please try again.');
                };

                xhr.send(formData);
            });
        });
    });
</script>