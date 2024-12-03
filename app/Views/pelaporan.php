<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelaporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #0d1117;
            color: #ffff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            background-color: #161b22;
        }

        .card-header {
            background: #21262d;
            color: #c9d1d9;
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
            font-weight: 600;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .card-body {
            padding: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        .table th {
            background-color: #30363d;
            color: #c9d1d9;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            color: #ffff;
        }

        .table-hover tbody tr:hover {
            background-color: #ffff;
            cursor: pointer;
            transition: 0.5s;

        }

        .table td a {
            transition: color 0.2s ease;

        }

        .btn-view {
            color: #58a6ff;
        }

        .btn-view:hover {
            color: #3182ce;
        }

        .btn-delete {
            color: #f85149;
        }

        .btn-delete:hover {
            color: #c53030;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .search-bar {
            width: 70%;
            padding: 10px;
            border: 1px solid #30363d;
            border-radius: 8px;
            background-color: #161b22;
            color: #c9d1d9;
        }

        .pagination {
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: #58a6ff;
            border-color: #58a6ff;
        }

        .page-link {
            color: #c9d1d9;
            background-color: #21262d;
            border: 1px solid #30363d;
        }

        .page-link:hover {
            color: #58a6ff;
        }



        .modal-table td {
            text-align: left;
            color: black;
        }

        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: 300px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .alert {
            margin-bottom: 0;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Efek Loading untuk flash message */
        .flash-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(0, 123, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%);
            animation: loading 2s infinite;
            border-radius: 4px 4px 0 0;
        }

        @keyframes loading {
            0% {
                background-position: -200%;
            }

            100% {
                background-position: 200%;
            }
        }

        /* Efek Fade out setelah 3 detik */
        .fade-out {
            opacity: 0 !important;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }
        }

        .bouncing-icon {
            font-size: 50px;
            animation: bounce 1s infinite;
        }
    </style>
    <script src="https://pixijs.download/release/pixi.js"></script>

</head>

<body>
    <?= view('layout/navbar'); ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div id="flash-success" class="alert alert-success flash-message">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div id="flash-error" class="alert alert-danger flash-message">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>


    <div class="container" style="padding-top: 100px;padding-bottom :100px;">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-file-earmark-text"></i> <strong>Data Pelaporan</strong>
            </div>
            <div class="card-body">
                <div class="search-container" style="color: white;">
                    <input type="text" class="search-bar" id="searchInput" placeholder="Cari laporan...">
                    <span class="" style="line-height:50px">Total Laporan: <?= count($pelaporan); ?></span>
                </div>
                <div class="table-responsive">
                    <?php
                    $dir = FCPATH . 'uploads/'; // Path folder fisik untuk membaca file
                    $baseUrl = base_url('uploads'); // Base URL untuk file
                    $image_extensions = array("png", "jpg", "jpeg", "gif");
                    $images = [];

                    // Mendapatkan daftar file dalam folder
                    if (is_dir($dir)) {
                        $files = scandir($dir);
                        foreach ($files as $file) {
                            $file_parts = pathinfo($file);
                            if (in_array(strtolower($file_parts['extension']), $image_extensions)) {
                                $images[] = $file; // Simpan seluruh nama file dalam array
                            }
                        }
                    }

                    function isImageMatched($imageName, $imageId)
                    {
                        // Pencocokan yang lebih tepat: Cek apakah ID gambar ada dalam nama file
                        return strpos($imageName, $imageId) !== false;
                    }

                    ?>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Gambar</th>
                                <th>ID Laporan</th>
                                <th>Gambar</th>
                                <th>Status Pelanggaran</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Pelapor</th>
                                <th>Status</th>
                                <?php if (!in_groups('user')): ?> <!-- Cek jika user tidak memiliki role 'user' -->
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody id="tableBody" data-role="<?= in_groups('user') ? 'user' : 'admin'; ?>">
                            <?php if (empty($pelaporan)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="no-data-message" style="padding-top: 50px;">
                                            <div class="bouncing-icon">🏐</div>
                                            <p>Maaf, tidak ada laporan yang tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pelaporan as $index => $laporan): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= esc($laporan['image_id']); ?></td>
                                        <td><?= esc($laporan['id']); ?></td>
                                        <td>
                                            <?php
                                            $matchedImage = null;
                                            foreach ($images as $image) {
                                                if (isImageMatched($image, $laporan['image_id'])) {
                                                    $matchedImage = $image;
                                                    break;
                                                }
                                            }

                                            if ($matchedImage): ?>
                                                <img src="<?= $baseUrl . '/' . $matchedImage; ?>" alt="<?= esc($laporan['image_id']); ?>"
                                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak Ada Gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($laporan['violation_status']); ?></td>
                                        <td><?= esc($laporan['description']); ?></td>
                                        <td><?= esc($laporan['created_at']); ?></td>
                                        <td><?= esc($laporan['user_name']); ?></td>
                                        <td>
                                            <?php
                                            $status = esc($laporan['status']);
                                            $badgeClass = '';

                                            if ($status === 'pending') {
                                                $badgeClass = 'badge bg-warning text-dark'; // Kuning untuk pending
                                            } elseif ($status === 'diterima') {
                                                $badgeClass = 'badge bg-success'; // Hijau untuk diterima
                                            } elseif ($status === 'ditolak') {
                                                $badgeClass = 'badge bg-danger'; // Merah untuk ditolak
                                            }
                                            ?>
                                            <span class="<?= $badgeClass; ?>"><?= $status; ?></span>
                                        </td>

                                        <?php if (!in_groups('user')): ?> <!-- Cek jika user tidak memiliki role 'user' -->
                                            <td>
                                                <a href="<?= site_url('report/delete/' . esc($laporan['id'])); ?>"
                                                    class="btn-delete btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination">
                        <!-- Example pagination, you can add dynamic functionality as needed -->
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel" style="color: black;">Detail Pelaporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateStatusForm">
                        <input type="hidden" id="reportId" name="reportId">
                        <table class="table modal-table">
                            <tr>
                                <th>No</th>
                                <td id="modalNo"></td>
                            </tr>
                            <tr>
                                <th>ID Gambar</th>
                                <td id="modalImageId"></td>
                            </tr>
                            <!-- <tr>
                                <th>ID Laporan</th>
                                <td id="idLaporan">
                                </td>
                            </tr> -->
                            <tr>
                                <th>Gambar</th>
                                <td id="modalImage"></td>
                            </tr>
                            <tr>
                                <th>Status Pelanggaran</th>
                                <td id="modalViolationStatus"></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td id="modalDescription"></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td id="modalDate"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <select id="modalStatus" name="status">
                                        <option value="pending">Pending</option>
                                        <option value="diterima">Diterima</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="updateStatusBtn" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Enlarged Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel" style="color: black;">Gambar Pelaporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImageView" src="" alt="" class="img-fluid" style="max-width: 100%; max-height: 80vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>



    <?= view('layout/footer'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for image click to show in modal
            const imageElements = document.querySelectorAll('.table img');

            imageElements.forEach(image => {
                image.addEventListener('click', function() {
                    const imageUrl = image.src;
                    const modalImage = document.getElementById('modalImageView');

                    // Set the source of the modal image
                    modalImage.src = imageUrl;

                    // Show the modal
                    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                    imageModal.show();
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const tableBody = document.getElementById('tableBody');
            const updateStatusBtn = document.getElementById('updateStatusBtn');
            const updateStatusForm = document.getElementById('updateStatusForm');

            const userRole = tableBody.getAttribute('data-role'); // Mendapatkan 'user' atau 'admin'

            // Tangani klik pada baris tabel
            tableBody.addEventListener('click', function(event) {
                // Cek apakah yang diklik adalah tombol delete
                if (event.target.closest('.btn-delete')) {
                    return; // Jika tombol delete, abaikan tampilan modal
                }

                // Cek apakah level role adalah 'user'
                if (userRole === 'user') {
                    console.log('Modal tidak ditampilkan karena level role adalah user');
                    return; // Jika role adalah user, modal tidak akan tampil
                }

                const row = event.target.closest('tr');
                if (!row) return;

                const no = row.cells[0].innerText;
                const imageId = row.cells[1].innerText;
                const reportId2 = row.cells[2].innerText;
                console.log(reportId2);
                const violationStatus = row.cells[4].innerText;
                const description = row.cells[5].innerText;
                const date = row.cells[6].innerText;
                const status = row.cells[7].innerText;



                let imageHTML = 'Tidak Ada Gambar';
                const imageCell = row.cells[3];
                const imageElement = imageCell.querySelector('img');
                if (imageElement) {
                    imageHTML = `<img src="${imageElement.src}" alt="${imageId}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">`;
                }

                // Isi modal dengan data
                document.getElementById('modalNo').innerText = no;
                document.getElementById('modalImageId').innerText = imageId;
                document.getElementById('reportId').value = reportId2; // Menyimpan ID laporan
                document.getElementById('modalImage').innerHTML = imageHTML;
                document.getElementById('modalViolationStatus').innerText = violationStatus;
                document.getElementById('modalDescription').innerText = description;
                document.getElementById('modalDate').innerText = date;
                document.getElementById('modalStatus').value = status; // Menampilkan status di dropdown

                // Tampilkan modal
                const myModal = new bootstrap.Modal(document.getElementById('detailsModal'));
                myModal.show();

            });

            // Update status ketika tombol di klik
            updateStatusBtn.addEventListener('click', function() {
                const formData = new FormData(updateStatusForm);

                // Kirim data dengan AJAX ke controller CodeIgniter
                fetch('<?= base_url('report/updateStatus'); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Status berhasil diperbarui');
                            window.location.reload(); // Reload halaman untuk melihat perubahan
                        } else {
                            alert('Terjadi kesalahan, coba lagi');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, coba lagi');
                    });
            });
        });

        // Simple search function
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        searchInput.addEventListener('input', () => {
            const filter = searchInput.value.toLowerCase();
            const rows = tableBody.getElementsByTagName('tr');
            Array.from(rows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                Array.from(cells).forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                    }
                });
                row.style.display = match ? '' : 'none';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua pesan flash
            const flashMessages = document.querySelectorAll('.flash-message');

            flashMessages.forEach(function(message) {
                // Setelah 3 detik, beri efek fade out
                setTimeout(function() {
                    message.classList.add('fade-out');
                    // Hapus elemen setelah animasi selesai
                    setTimeout(function() {
                        message.remove();
                    }, 500); // Durasi animasi fade out
                }, 3000); // Tampilkan selama 3 detik
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>