<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; I-Kept <?= date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Klik "Logout" jika anda ingin mengakhiri session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>


<script>
  $(window).on("load", function() {
    if ($(window).width() < 768) {
      // console.log("Lebarnya : " + $(window).width());
      $('.sidebar .collapse').collapse('hide');
      $("#accordionSidebar").addClass("toggled");
    };
  });

  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();

    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });


  $('.form-check-input').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changeaccess'); ?>",
      type: 'post',
      data: {
        menuId: menuId,
        roleId: roleId
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
      }
    })
  });


  $('.simadu').on('click', function() {
    const nopen = $(this).data('nopen');
    const simadu = $(this).data('simadu');
    document.location.href = "<?= base_url('datul/updateSimadu/'); ?>" + nopen;

    $.ajax({
      url: "<?= base_url('datul/updateSimadu'); ?>",
      method: 'POST',
      data: {
        nopen: nopen,
        simadu: simadu
      },

      success: function() {
        document.location.href = "<?= base_url('datul/detail/'); ?>" + nopen;
      }
    })
  });
</script>

<script>
  function updateDateTime() {
    var now = new Date();

    // Array hari dalam bahasa Indonesia
    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    // Mendapatkan hari, tanggal, bulan, dan tahun
    var dayName = days[now.getDay()];
    var day = now.getDate();
    var month = now.getMonth() + 1; // Karena bulan dimulai dari 0
    var year = now.getFullYear();

    // Mendapatkan jam, menit, dan detik
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    // Format tanggal dan waktu agar selalu dua digit
    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    // Format tanggal dan jam
    var dateString = dayName + ', ' + day + '/' + month + '/' + year;
    var timeString = hours + ':' + minutes + ':' + seconds;

    // Gabungkan tanggal dan waktu
    var dateTimeString = dateString + ' | ' + timeString;

    // Tampilkan pada elemen dengan id 'dateTime'
    document.getElementById('dateTime').textContent = dateTimeString;
  }

  // Memperbarui tanggal dan waktu setiap detik
  setInterval(updateDateTime, 1000);

  // Memanggil fungsi pertama kali
  updateDateTime();
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTableUser').DataTable();
  });
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $(".add-more").click(function() {
      var html = $(".copy").html();
      $(".after-add-more").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click", ".remove", function() {
      $(this).parents(".control-group").remove();
    });
  });
</script>

<!-- JavaScript: Real-time Notification -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch notifications
    function fetchNotifications() {
      const url = '<?= base_url('notifications/get_notifications'); ?>'; // Update with actual endpoint
      const baseUrl = '<?= base_url(); ?>';

      fetch(url)
        .then(response => response.json())
        .then(data => {
          const notificationsList = document.getElementById('notificationsList');
          notificationsList.innerHTML = '';

          data.forEach(notification => {
            const notificationItem = document.createElement('a');
            const date = new Date(notification.date_created * 1000);
            notificationItem.className = `dropdown-item d-flex align-items-center`;
            notificationItem.href = `${baseUrl}${notification.link}`;
            notificationItem.dataset.id = notification.id;
            notificationItem.innerHTML = `
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">
                                  ${date.toLocaleDateString()} ${date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                                </div>
                                <div class="row">
                                  <div class="col-10">
                                    <span class="font-weight-bold">${notification.message}</span>
                                  </div>
                                  ${notification.is_read == 1 ? '' : `<div class="col">
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-primary rounded-circle">
                                    </span>
                                  </div>`}
                                  
                                </div>
                            </>
                        `;
            notificationItem.addEventListener('click', function() {
              markAsRead(notification.id);
            });
            notificationsList.appendChild(notificationItem);
          });

          // Update notification counter
          const notificationCount = document.getElementById('notificationCount');
          const unreadCount = data.filter(n => n.is_read == 0).length;
          if (unreadCount <= 0) {
            notificationCount.innerHTML = '';
          } else {
            notificationCount.innerHTML = unreadCount;
          }

        })
        .catch(error => console.error('Error fetching notifications:', error));
    }

    // Function to mark notification as read
    function markAsRead(notification_id) {
      const url = '<?= base_url('notifications/mark_as_read/'); ?>' + notification_id; // Update with actual endpoint

      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            fetchNotifications(); // Refresh notifications
          }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }

    // Fetch notifications initially
    fetchNotifications();

    // Set interval to fetch notifications every 10 seconds
    setInterval(fetchNotifications, 10000);
  });
</script>


<!-- INSTASCAN -->
<!-- <script type="text/javascript">
  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
  });
  scanner.addListener('scan', function(content) {
    //alert(content);
    $("#scan").val(content);
  });

  Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No Camera Found');
    }
  }).catch(function(e) {
    console.error(e);
  });
</script> -->


<!-- QRCODE SCAN HTML -->

<!-- <script type="text/javascript">
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
      fps: 10,
      qrbox: 250
    });

  function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
    $("#npk").val(`${decodedText}`, decodedResult);
    document.getElementById("pilih").removeAttribute("disabled", 0);
  }

  function onScanError(errorMessage) {
    // handle on error condition, with error message
  }

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
      fps: 10,
      qrbox: 250
    });
  html5QrcodeScanner.render(onScanSuccess, onScanError);

  const html5QrCode = new Html5Qrcode( /* element id */ "reader");
  // File based scanning
  const fileinput = document.getElementById('qr-input-file');
  fileinput.addEventListener('change', e => {
    if (e.target.files.length == 0) {
      // No file selected, ignore 
      return;
    }

    const imageFile = e.target.files[0];
    // Scan QR Code
    html5QrCode.scanFile(imageFile, true)
      .then(decodedText => {
        // success, use decodedText
        console.log(decodedText);
      })
      .catch(err => {
        // failure, handle it.
        console.log(`Error scanning file. Reason: ${err}`)
      });
  });
</script> -->

<style type="text/css">
  .wrapper {
    background-color: pink;
  }
</style>

</body>

</html>