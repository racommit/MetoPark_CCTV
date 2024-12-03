    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Monitoring Uploads</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            .badge-new {
                background-color: #28a745;
                color: white;
                font-size: 0.8em;
            }
        </style>
    </head>

    <body>
        <div class="container mt-4">
            <button onclick="toast.show()">Tes Toast</button>

            <h1>Monitoring Uploads</h1>
            <table id="fileTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>URL</th>
                        <th>Ukuran (KB)</th>
                        <th>Waktu Upload</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="fileToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">File Baru</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-light text-success">
                    File baru diunggah! Periksa tabel untuk detailnya.
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let lastCheck = new Date().getTime();
            const toast = new bootstrap.Toast(document.getElementById('fileToast'));

            // Fungsi untuk fetch file dari server
            function fetchFiles() {
                fetch('api/monitoring/files') // Ganti dengan endpoint API Anda
                    .then(response => response.json())
                    .then(files => {
                        const tableBody = document.querySelector('#fileTable tbody');
                        tableBody.innerHTML = ''; // Bersihkan tabel sebelum mengisi data

                        if (files.length === 0) {
                            tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada file</td></tr>';
                            return;
                        }

                        const now = new Date();
                        let newFileDetected = false;

                        files.forEach((file, index) => {
                            const fileTime = new Date(file.modified);
                            const isNew = (now - fileTime) <= 3 * 60 * 1000; // File baru (dalam 3 menit)
                            console.log(fileTime);

                            // Membuat baris tabel untuk file
                            const row = document.createElement('tr');
                            row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${file.name} ${isNew ? '<span class="badge badge-new">New</span>' : ''}</td>
                    <td><a href="${file.url}" target="_blank">${file.url}</a></td>
                    <td>${(file.size / 1024).toFixed(2)}</td>
                    <td>${file.modified}</td>
                `;
                            tableBody.appendChild(row);

                            // Periksa apakah file ini lebih baru dari waktu terakhir dicek
                            if (fileTime.getTime() > lastCheck) {
                                newFileDetected = true;
                            }
                        });

                        // Tampilkan notifikasi jika ada file baru
                        if (newFileDetected) {
                            console.log('Traffic masuk terdeteksi, memunculkan toast...');
                            toast.show(); // Menampilkan toast

                            // Menyembunyikan toast setelah 3 detik
                            setTimeout(() => {
                                toast.hide(); // Menyembunyikan toast setelah 3 detik
                            }, 3000); // 3000 ms = 3 detik
                        }

                        // Perbarui waktu terakhir pengecekan
                        lastCheck = now.getTime();

                    })
                    .catch(err => {
                        console.error('Error fetching files:', err);
                    });
            }

            // Update daftar file setiap 3 detik
            setInterval(fetchFiles, 3000); // Memanggil fetchFiles setiap 3 detik
            fetchFiles(); // Panggil fungsi pertama kali saat halaman dimuat

            // Pastikan toast dikenali oleh Bootstrap
            const toastElement = document.getElementById('fileToast');
            if (toastElement) {
                console.log('Toast element ditemukan.');
            } else {
                console.error('Toast element tidak ditemukan.');
            }
        </script>
    </body>

    </html>