<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="<?= base_url('public/images/favicon.ico'); ?>" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url('public/images/favicon.ico'); ?>" type="image/x-icon">

  <!-- Menambahkan favicon untuk perangkat mobile -->
  <link rel="apple-touch-icon" href="<?= base_url('public/images/favicon.ico'); ?>">
  <title>Metopark</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom, #2c3e50, #34495e);
      /* Gradasi gelap */
      color: #ecf0f1;
      /* Teks putih cerah untuk kontras yang baik */
    }

    .gallery-item {
      text-align: center;
      margin-bottom: 20px;
    }

    .gallery-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .gallery-container img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }


    .gallery-section {
      margin-top: 30px;
    }

    /* Gradient background for navbar */
    .bg-gradient-custom {
      background: linear-gradient(90deg, #0062E6, #33AEFF);
    }



    /* Add a soft shadow to the navbar */
    .shadow-lg {
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    }



    /* General styles for footer */
    .footer {
      background-color: #343a40;
      color: #ffffff;
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .footer a {
      color: #f8f9fa;
      transition: color 0.3s ease;
    }

    .footer a:hover {
      color: #ff7e5f;
      /* Slightly orange on hover */
    }

    .text-md-end {
      text-align: right;
    }

    /* Responsive footer adjustment */
    @media (max-width: 768px) {
      .footer .row {
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <?= view('layout/navbar'); ?>

  <div class="container my-4" style="padding-top: 100px; background: linear-gradient(to bottom, #2c3e50, #34495e);height:100%;padding-bottom:100px">
    <!-- Pesan Informasi -->
    <div class="alert alert-info" role="alert">
      <strong>Selamat datang!</strong> Di sini Anda dapat melihat galeri gambar yang dikategorikan berdasarkan waktu. Gunakan filter dan pencarian untuk menemukan gambar dengan cepat.
    </div>

    <!-- Pencarian -->
    <div class="mb-3">
      <input type="text" class="form-control" id="searchInput" placeholder="Cari berdasarkan nama gambar...">
    </div>

    <!-- Filter Berdasarkan Tanggal -->
    <div class="mb-3">
      <label for="filter-date-start" class="form-label">Filter Berdasarkan Tanggal:</label>
      <div class="d-flex">
        <input type="date" id="filter-date-start" class="form-control me-2" onchange="applyFilter()">
        <span class="me-2">sampai</span>
        <input type="date" id="filter-date-end" class="form-control" onchange="applyFilter()">
      </div>
    </div>

    <!-- Gallery Container -->
    <div class="accordion" id="galleryAccordion">
      <?php
      $dir = FCPATH . 'uploads/'; // Path folder fisik
      $baseUrl = base_url('uploads'); // URL folder
      $image_extensions = ["png", "jpg", "jpeg", "gif"];
      $images = [];

      if (is_dir($dir)) {
        $files = scandir($dir);
        rsort($files); // Urutkan file terbaru ke terlama

        // Ambil informasi file gambar
        foreach ($files as $file) {
          $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
          if ($file != '.' && $file != '..' && in_array($file_ext, $image_extensions)) {
            $filename_parts = explode('_', pathinfo($file, PATHINFO_FILENAME));
            $date = $filename_parts[0] ?? ''; // Format: YYYY-MM-DD
            $time = $filename_parts[1] ?? ''; // Format: HH-MM-SS
            $datetime = $date . ' ' . $time;

            // Extract hour and minute
            $time_parts = explode('-', $time);
            $hour = (int)$time_parts[0] ?? 0;
            $minute = (int)$time_parts[1] ?? 0;

            // Tentukan kategori berdasarkan waktu
            $category = 'On Time'; // Default kategori
            if ($hour >= 6) {
              if ($hour < 9) {
                $category = 'Telat';
              } elseif ($hour < 11 || ($hour == 11 && $minute < 30)) {
                $category = 'Indisipliner';
              } elseif (($hour >= 12 && $minute > 30) && $hour < 15) {
                $category = 'Telat Istirahat Berlebih';
              } elseif ($hour == 15 && $minute > 0 && $hour < 16) {
                $category = 'Indisipliner Pulang Lebih Awal';
              }
            }

            $images[] = [
              'name' => $file,
              'url' => $baseUrl . '/' . $file,
              'datetime' => $datetime,
              'date' => $date,
              'time' => $time,
              'category' => $category,
            ];
          }
        }

        // Urutkan gambar berdasarkan datetime
        usort($images, function ($a, $b) {
          return strcmp($b['datetime'], $a['datetime']); // Descending order
        });

        // Kategori pelanggaran
        $categories = ['Telat', 'Indisipliner', 'Telat Istirahat Berlebih', 'Indisipliner Pulang Lebih Awal', 'On Time'];
        foreach ($categories as $category) {
          $accordionId = strtolower(str_replace(' ', '-', $category)); // ID unik
      ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading-<?= $accordionId ?>">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $accordionId ?>" aria-expanded="true" aria-controls="collapse-<?= $accordionId ?>">
                <?= $category ?>
              </button>
            </h2>
            <div id="collapse-<?= $accordionId ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $accordionId ?>" data-bs-parent="#galleryAccordion">
              <div class="accordion-body">
                <?php if (empty(array_filter($images, fn($image) => $image['category'] == $category))) { ?>
                  <p>Belum ada gambar dengan kategori ini.</p>
                <?php } else { ?>
                  <div class="gallery-container row">
                    <?php
                    foreach ($images as $image) {
                      if ($image['category'] == $category) {
                    ?>
                        <div class="gallery-item col-md-4 mb-3" data-name="<?= $image['name'] ?>" data-datetime="<?= $image['datetime'] ?>" data-category="<?= $image['category'] ?>">
                          <div class="card">
                            <a href="javascript:void(0);" onclick="showImageModal('<?= $image['url'] ?>', '<?= $image['name'] ?>');">
                              <img src="<?= $image['url'] ?>" class="card-img-top" alt="<?= $image['name'] ?>" title="<?= $image['name'] ?>" />
                            </a>
                            <div class="card-body text-center">
                              <p><?= $image['name'] ?> - <strong><?= $image['category'] ?></strong></p>
                            </div>
                          </div>
                        </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">Pratinjau Gambar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="imageModalPreview" src="" alt="" class="img-fluid">
            <p id="imageModalName" class="mt-3"></p>
          </div>
        </div>
      </div>
    </div>

    <script>
      function showImageModal(imageUrl, imageName) {
        document.getElementById('imageModalPreview').src = imageUrl;
        document.getElementById('imageModalName').innerText = imageName;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
      }
    </script>

  </div>

  <?= view('layout/footer'); ?>

  <!-- JavaScript untuk Pencarian Langsung dan Filter -->
  <script>
    function applyFilter() {
      let dateStart = document.getElementById("filter-date-start").value;
      let dateEnd = document.getElementById("filter-date-end").value;

      let items = document.querySelectorAll(".gallery-item");

      items.forEach(item => {
        let itemDatetime = item.getAttribute("data-datetime");
        let itemDate = itemDatetime.split(' ')[0];

        // Memeriksa apakah tanggal berada dalam rentang yang dipilih
        let isInDateRange = true;
        if (dateStart && itemDate < dateStart) isInDateRange = false;
        if (dateEnd && itemDate > dateEnd) isInDateRange = false;

        // Tampilkan atau sembunyikan item berdasarkan filter
        item.style.display = isInDateRange ? "block" : "none";
      });
    }

    document.getElementById('searchInput').addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const items = document.querySelectorAll('.gallery-item');

      items.forEach(item => {
        const fileName = item.getAttribute('data-name').toLowerCase();
        const category = item.getAttribute('data-category').toLowerCase();

        // Mencari berdasarkan nama gambar atau kategori
        if (fileName.includes(searchTerm) || category.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>