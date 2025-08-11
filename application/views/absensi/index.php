<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Proses Absensi Karyawan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="absensiForm" action="<?= base_url('absensi/proses_absen'); ?>" method="post">
                <div class="form-group">
                    <label for="nama_karyawan">Nama Karyawan</label>
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi Anda</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" readonly>
                </div>

                <!-- Hidden input untuk latitude dan longitude -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <input type="hidden" id="jarak" name="jarak">

                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="btnAbsen" onclick="prosesAbsensi()" disabled>Proses Absensi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tombol untuk meminta izin akses lokasi -->
    <button type="button" class="btn btn-info" id="btnAksesLokasi" onclick="mintaAksesLokasi()">Akses Lokasi</button>

    <!-- Error message -->
    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
</div>

<script>
    // Koordinat kantor (contoh: lat: -6.200000, lng: 106.816666 Jakarta)
    var kantorLatitude = -6.200000;
    var kantorLongitude = 106.816666;
    var maxDistance = 50; // Jarak maksimal 50 meter

    // Fungsi untuk meminta akses lokasi
    function mintaAksesLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation tidak didukung oleh browser Anda.");
        }
    }

    // Fungsi untuk mendapatkan lokasi user
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById("error-message").innerText = "Geolocation tidak didukung oleh browser Anda.";
            document.getElementById("error-message").style.display = "block";
        }
    }

    function showPosition(position) {
        var userLatitude = position.coords.latitude;
        var userLongitude = position.coords.longitude;

        // Hitung jarak antara lokasi user dan kantor
        var jarak = calculateDistance(userLatitude, userLongitude, kantorLatitude, kantorLongitude);

        // Isi field latitude, longitude, dan jarak
        document.getElementById("latitude").value = userLatitude;
        document.getElementById("longitude").value = userLongitude;
        document.getElementById("jarak").value = jarak;

        // Menampilkan lokasi dalam input field
        document.getElementById("lokasi").value = "Lat: " + userLatitude + ", Long: " + userLongitude;

        // Periksa apakah user berada dalam jarak yang diperbolehkan
        if (jarak <= maxDistance) {
            document.getElementById("btnAbsen").disabled = false;
            alert('Lokasi terdeteksi. Anda berada dalam jangkauan untuk absen.');
        } else {
            document.getElementById("error-message").innerText = "Anda berada di luar jangkauan absensi (lebih dari 50 meter dari kantor).";
            document.getElementById("error-message").style.display = "block";
            document.getElementById("btnAbsen").disabled = true;
        }
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Izin geolocation telah ditolak. Silakan izinkan akses lokasi untuk melanjutkan.");
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("error-message").innerText = "Lokasi tidak tersedia.";
                break;
            case error.TIMEOUT:
                document.getElementById("error-message").innerText = "Permintaan lokasi habis waktu.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("error-message").innerText = "Terjadi kesalahan tidak dikenal.";
                break;
        }
        document.getElementById("error-message").style.display = "block";
    }

    // Fungsi untuk menghitung jarak antara dua koordinat (dalam meter)
    function calculateDistance(lat1, lon1, lat2, lon2) {
        var R = 6371e3; // Jari-jari bumi dalam meter
        var φ1 = lat1 * Math.PI / 180;
        var φ2 = lat2 * Math.PI / 180;
        var Δφ = (lat2 - lat1) * Math.PI / 180;
        var Δλ = (lon2 - lon1) * Math.PI / 180;

        var a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        var d = R * c; // Jarak dalam meter
        return d;
    }

    function prosesAbsensi() {
        getLocation();
    }
</script>