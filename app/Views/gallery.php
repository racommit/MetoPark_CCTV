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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


  <style>
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
      width: 100%;
      height: auto;
      object-fit: cover;
      /* Memastikan gambar terpotong dengan baik jika perlu */
    }

    .gallery-item {
      padding: 5px;
      /* Memberikan jarak antar kartu */
    }



    .gallery-section {
      margin-top: 30px;
    }



    @media (max-width: 576px) {
      #imageModal .row {
        flex-direction: column;
        /* Atur layout vertikal untuk mobile */
      }

      #imageModal .col-md-6 {
        text-align: center;
      }
    }

    .custom-centered-modal .modal-dialog {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      /* Pastikan modal berada di tengah halaman penuh */
    }

    /* Tambahan untuk memperbaiki layout jika halaman terlalu kecil */
    .custom-centered-modal .modal-content {
      max-height: 90vh;
      /* Batasi tinggi modal agar tidak melebihi layar */
      overflow-y: auto;
      /* Scroll jika konten terlalu panjang */
    }

    .description-container {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .list-group-item {
      padding: 10px 15px;
      border: none;
    }

    .list-group-item:not(:last-child) {
      border-bottom: 1px solid #e0e0e0;
    }

    .text-primary {
      color: #007bff;
    }

    .text-warning {
      color: #ffc107;
    }

    .text-muted {
      color: #6c757d;
    }

    .fw-semibold {
      font-weight: 600;
    }

    .modal-header {
      display: flex;
      align-items: center;
      /* Menyusun elemen di dalam header secara vertikal dan horizontal */
      justify-content: space-between;
    }

    #imageModalLabel {
      margin-right: 10px;
      /* Menambahkan jarak antara judul dan peringatan */
    }

    #violationWarning {
      font-size: 14px;
      /* Menyesuaikan ukuran font agar tidak terlalu besar */
      display: flex;
      align-items: center;
    }

    .alert-warning {
      padding: 5px 10px;
      font-size: 14px;
      border-radius: 5px;
    }

    .navbar {
      transition: top 0.3s;
      /* Smooth transition */
    }

    /* Default (untuk desktop dan tablet besar) */
    .search-input {
      width: 50%;
      padding: 10px;
      font-size: 16px;
    }

    .banner {
      width: 80%;
      height: 500px;
    }

    .container-banner {
      width: 60%;
      /* Lebih besar di mobile */
      padding: 8px;
      font-size: 14px;
    }

    /* Untuk tampilan mobile */
    @media screen and (max-width: 768px) {
      .search-input {
        width: 80%;
        /* Lebih besar di mobile */
        padding-top: 100px;
        font-size: 14px;
      }

      .container-banner {
        width: 80%;
        /* Lebih besar di mobile */
        height: 150px;
        padding-top: 50px;
        font-size: 14px;
      }

      .banner {
        width: 90%;
        /* Lebih kecil di mobile */
        height: 300px;
        /* Ukuran banner lebih kecil */
      }
    }
  </style>
</head>

<body>
  <?= view('layout/navbar'); ?>
  <?php


  date_default_timezone_set('Asia/Jakarta');

  // Dapatkan jam saat ini
  $hour = date('H');


  // Tentukan ucapan berdasarkan jam
  if ($hour >= 1 && $hour < 10) {
    $greeting = "Selamat Pagi";
  } elseif ($hour >= 10 && $hour < 14) {
    $greeting = "Selamat Siang";
  } elseif ($hour > 14 && $hour < 18) {
    $greeting = "Selamat Sore";
  } else {
    $greeting = "Selamat Malam";
  }
  // Ambil nama pengguna dari session
  $user = session()->get('user2') ? session()->get('user2') : 'PGT\'ers'; // Gantilah dengan field yang sesuai jika perlu

  ?>
  <div class="banner" style="background-image:url(<?php echo base_url('images/banner.png'); ?>); width:100%; display: flex; justify-content: center; align-items: center;">
    <div class="container container-banner" style="text-align: center;">
      <!-- Ucapan Selamat -->
      <h1 style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"><?= $greeting . ', ' . htmlspecialchars($user); ?>!</h1>
      <br>
      <!-- Search Box -->
      <div class="mb-3">
        <div class="input-group" style="height: 50px;">
          <input type="text" id="searchInput" class="form-control" placeholder="Cari sepeda berdasar waktu">
          <span class="input-group-text">
            <i class="fa fa-search"></i>
          </span>
        </div>
      </div>
      <br>
    </div>
  </div>


  <div class="container my-4">


    <div class="row mb-4">
      <div class="col-md-6">
        <label for="filter-date-start">Start Date:</label>
        <input type="date" id="filter-date-start" class="form-control">
      </div>
      <div class="col-md-6">
        <label for="filter-date-end">End Date:</label>
        <input type="date" id="filter-date-end" class="form-control">
      </div>
      <div class="col-md-12 mt-3">
        <button class="btn btn-primary" onclick="applyFilter()">Apply Filter</button>
      </div>
    </div>



    <!-- Gallery Container -->
    <div class="accordion" id="galleryAccordion" style="padding-bottom: 100px;">
      <?php
      $dir = FCPATH . 'uploads/'; // Path folder fisik untuk membaca file
      $baseUrl = base_url('uploads'); // Base URL untuk file
      $image_extensions = array("png", "jpg", "jpeg", "gif");
      $images = [];
      $today = date('Y-m-d');

      if (is_dir($dir)) {
        $files = scandir($dir);
        rsort($files);

        // Extract image details and store them in an array
        foreach ($files as $file) {
          $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
          if ($file != '.' && $file != '..' && in_array($file_ext, $image_extensions)) {
            // Extract date and time from filename
            $filename_parts = explode('_', pathinfo($file, PATHINFO_FILENAME));
            $date = $filename_parts[0]; // Format: YYYY.MM.DD
            $time = $filename_parts[1]; // Format: HH.MM.SS
            $datetime = $date . ' ' . $time; // Combine date and time

            // Push image details into array
            $images[] = [
              'name' => $file,
              'url' => $baseUrl . '/' . $file, // URL untuk ditampilkan
              'datetime' => $datetime,
              'date' => $date,
              'time' => $time,
            ];
          }
        }

        // Sort images by datetime
        usort($images, function ($a, $b) {
          return strcmp($b['datetime'], $a['datetime']);
        });

        // Display images grouped by date
        $currentDate = '';
        $accordionIndex = 0; // For unique accordion IDs
        foreach ($images as $image) {
          if ($currentDate != $image['date']) {
            if ($currentDate != '') {
              echo '</div></div></div>'; // Close previous accordion body
            }
            $currentDate = $image['date'];
            $accordionIndex++; // Increment the accordion index

            // Create a new accordion item for the date
            echo "<div class='accordion-item'>
                  <h2 class='accordion-header' id='heading-{$accordionIndex}'>
                    <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse-{$accordionIndex}' aria-expanded='true' aria-controls='collapse-{$accordionIndex}'>
                      Date: {$currentDate}
                    </button>
                  </h2>
                  <div id='collapse-{$accordionIndex}' class='accordion-collapse collapse' aria-labelledby='heading-{$accordionIndex}' data-bs-parent='#galleryAccordion'>
                    <div class='accordion-body'>
                      <div class='gallery-container row'>";
          }
      ?>
          <div class="gallery-item col-md-4" data-name="<?php echo $image['name']; ?>" data-datetime="<?php echo $image['datetime']; ?>">
            <div class="card">
              <a href="javascript:void(0);" onclick="showImageModal('<?php echo $image['url']; ?>', '<?php echo $image['name']; ?>');">
                <img src="<?php echo $image['url']; ?>" class="card-img-top" alt="<?php echo $image['name']; ?>" title="<?php echo $image['name']; ?>" />
              </a>
              <div class="card-body text-center">
                <p><?php echo $image['name']; ?></p>
              </div>
            </div>
          </div>
      <?php
        }
        echo '</div></div></div>'; // Close last accordion item
      }
      ?>
    </div>


  </div>

  <div class="modal fade custom-centered-modal" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
          <!-- Peringatan Pelanggaran -->
          <div id="violationWarning" class="alert alert-warning d-none mb-0" role="alert" style="margin-left:5px;">
            <strong>Warning</strong>

          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Container for image and description -->
          <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-md-6 text-center mb-3 mb-md-0">
              <img id="modalImage" src="" alt="Image Preview" class="img-fluid rounded shadow" />
            </div>
            <!-- Description Section -->
            <div class="col-md-6">
              <div class="description-container">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-info-circle me-3 text-primary"></i>
                    <div>
                      <strong>ID: </strong> <span id="modalImageId"></span> <!-- Menampilkan ID gambar di sini -->
                    </div>
                  </li>
                  <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-calendar-event me-3 text-primary"></i>
                    <div>
                      <strong>Date:</strong> <span id="modalDate" class="fw-semibold"></span>
                    </div>
                  </li>
                  <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-clock me-3 text-primary"></i>
                    <div>
                      <strong>Time:</strong> <span id="modalTime" class="fw-semibold"></span>
                    </div>
                  </li>
                  <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-info-circle me-3 text-primary"></i>
                    <div>
                      <strong>Description:</strong> <span id="modalDescriptionText"></span>
                    </div>
                  </li>
                  <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle me-3 text-warning"></i>
                    <div>
                      <strong>Status:</strong> <span id="modalViolationStatus" class="fw-semibold text-muted"></span>
                    </div>
                  </li>
                </ul>

                <!-- Peringatan Pelanggaran -->
                <div id="violationWarning" class="alert alert-warning mt-3 d-none" role="alert">
                  <strong>Warning:</strong> Activity detected during restricted hours. Please review the captured image.
                </div>

                <!-- Button for Reporting -->
                <div class="mt-4" style="float: right;">
                  <!-- Download Button with Icon -->

                  <button type="button" class="btn btn-danger" id="reportButton" data-bs-dismiss="modal">Laporkan</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="loggedInUser" value="<?= session()->get('user') ?>">


  <?= view('layout/footer'); ?>
  <!-- JavaScript for Live Search and Filter -->
  <script>
    document.getElementById('reportButton').addEventListener('click', function() {
      // Ambil data gambar dari modal
      const imageId = document.getElementById('modalImage').getAttribute('data-id');
      const violationStatus = document.getElementById('modalViolationStatus').innerText.trim();
      const descriptionText = document.getElementById('modalDescriptionText').innerText.trim();

      // Ambil nama pengguna dari hidden input atau elemen HTML lain
      const userName = document.getElementById('loggedInUser').value; // Pastikan elemen ini ada di halaman Anda

      // Cek apakah data yang diperlukan ada
      if (imageId && violationStatus && descriptionText && userName !== "1111111" && userName) {
        // Kirim data pelaporan ke server
        fetch('/laporkan', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
              image_id: imageId,
              violation_status: violationStatus,
              description: descriptionText,
              user_name: userName // Sertakan nama pengguna
            })
          })
          .then(response => {
            console.log(response); // Debug response
            return response.json(); // Parse response ke JSON
          })
          .then(data => {
            console.log(data); // Debug data yang diterima
            if (data.success) {
              alert('Gambar telah dilaporkan.');
            } else {
              alert('Gagal melaporkan gambar.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim laporan.');
          });

      } else {
        alert('Kamu tidak memiliki akses!');
      }
    });


    document.querySelectorAll('.image-thumbnail').forEach(image => {
      image.addEventListener('click', function() {
        const imageName = this.src.split('/').pop(); // Ambil nama file gambar dari URL
        const imageId = generateImageIdFromFileName(imageName); // Buat ID berdasarkan nama file

        // Setel ID gambar di dalam modal
        document.getElementById('modalImage').src = this.src;
        document.getElementById('modalImage').setAttribute('data-id', imageId); // Set data-id
        document.getElementById('modalImageId').innerText = imageId; // Menampilkan ID gambar
        document.getElementById('modalDate').innerText = parseImageName(imageName).date;
        document.getElementById('modalTime').innerText = parseImageName(imageName).time;
        document.getElementById('modalDescriptionText').innerText = parseImageName(imageName).description;
        document.getElementById('modalViolationStatus').innerText = "Unknown"; // Sesuaikan statusnya
      });
    });

    function generateImageIdFromFileName(imageName) {
      // Kembalikan nama file secara utuh tanpa mengubah apapun
      const imageId = imageName;

      console.log(imageId); // Menampilkan ID yang sesuai
      return imageId; // Kembalikan ID yang sesuai
    }

    // Fungsi untuk memparsing nama gambar
    function parseImageName(imageName) {
      const nameWithoutExtension = imageName.replace(/\.[^/.]+$/, ""); // Hapus ekstensi file
      const parts = nameWithoutExtension.split('_');
      if (parts.length === 3) {
        const [date, time, description] = parts;

        const formattedDate = new Date(date.replace(/-/g, '/')).toLocaleDateString('en-US', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });
        const formattedTime = time.replace(/-/g, ':');
        const formattedDescription = description.replace(/-/g, ' ');

        return {
          date: formattedDate,
          time: formattedTime,
          description: formattedDescription.charAt(0).toUpperCase() + formattedDescription.slice(1)
        };
      }
      return null; // Format tidak valid
    }





    document.querySelectorAll(".gallery-item img").forEach((img) => {
      img.addEventListener("click", function() {
        const name = this.alt; // Ambil nama file dari atribut alt
        updateModal(name);
      });
    });




    function updateModal(name) {
      console.log("Name received:", name); // Debugging log

      try {
        // Parsing waktu dari nama file
        const [date, time] = name.split('_').slice(0, 2); // Split berdasarkan _
        const [year, month, day] = date.split('-'); // Split tanggal
        const [hour, minute] = time.split('-'); // Split waktu

        const capturedTime = new Date(year, month - 1, day, hour, minute);
        console.log("Parsed time:", capturedTime); // Debugging log

        // Atur jam operasional
        const startTime = new Date(capturedTime);
        startTime.setHours(6, 45, 0); // 06:45
        const midTime = new Date(capturedTime);
        midTime.setHours(11, 30, 0); // 11:30
        const endTime = new Date(capturedTime);
        endTime.setHours(16, 0, 0); // 16:00

        // Tentukan status pelanggaran
        let status;
        if (capturedTime >= startTime && capturedTime < midTime) {
          status = "Peringatan nih! Ada aktivitas dalam kegiatan kuliah pagi di parkiran, jangan bilang itu kamu yang telat!";
        } else if (capturedTime >= midTime && capturedTime < endTime) {
          status = "Peringatan nih! Ada aktivitas dalam kegiatan kuliah siang di parkiran, buru-buru mau pulang?";
        } else {
          status = "Aman gak ada peringatan pelanggaran";
        }

        // Update modal content
        document.getElementById("modalDate").innerText = `${day}-${month}-${year}`;
        document.getElementById("modalTime").innerText = `${hour}:${minute}`;
        document.getElementById("modalDescriptionText").innerText = "Captured image details for review.";
        document.getElementById("modalViolationStatus").innerText = status;

        // Set the ID image in the modal
        const imageId = generateImageIdFromFileName(name); // Generate ID from file name
        document.getElementById("modalImageId").innerText = imageId; // Display the image ID in the modal

        const modalImage = document.getElementById("modalImage");
        modalImage.setAttribute("data-id", imageId);

        // Show the violation warning if there's a violation
        const violationWarning = document.getElementById("violationWarning");
        if (status.startsWith("Peringatan")) {
          violationWarning.classList.remove("d-none");
        } else {
          violationWarning.classList.add("d-none");
        }


        modalImage.src = name;

      } catch (error) {
        console.error("Error updating modal content: ", error);
      }
    }


    function showImageModal(imageSrc, imageName) {
      // Parse the image name
      const parsedData = parseImageName(imageName);

      // Set image and description in modal
      document.getElementById('modalImage').src = imageSrc;

      if (parsedData) {
        document.getElementById('modalDate').innerText = parsedData.date;
        document.getElementById('modalTime').innerText = parsedData.time;
        document.getElementById('modalDescriptionText').innerText = parsedData.description;
      } else {
        document.getElementById('modalDescription').innerText = 'Invalid file format';
      }

      // Show modal
      var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
      imageModal.show();
    }

    function applyFilter() {
      let dateStart = document.getElementById("filter-date-start").value;
      let dateEnd = document.getElementById("filter-date-end").value;

      let items = document.querySelectorAll(".gallery-item");

      items.forEach(item => {
        let itemDatetime = item.getAttribute("data-datetime");

        let itemDate = itemDatetime.split(' ')[0];

        // Check if the date is within the selected range
        let isInDateRange = true;
        if (dateStart && itemDate < dateStart) isInDateRange = false;
        if (dateEnd && itemDate > dateEnd) isInDateRange = false;

        // Show or hide item based on the filter
        if (isInDateRange) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    }

    document.getElementById('searchInput').addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const items = document.querySelectorAll('.gallery-item');

      items.forEach(item => {
        const fileName = item.getAttribute('data-name').toLowerCase();
        if (fileName.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });

    function toggleGallery(sectionId) {
      const section = document.getElementById(sectionId);
      const arrow = document.getElementById('arrow-' + sectionId.split('-')[1]); // Ensure this ID matches the dynamically created one

      // Ensure the arrow and section are properly found before proceeding
      if (section && arrow) {
        // Toggle the display of the gallery container
        if (section.style.display === 'none' || section.style.display === '') {
          section.style.display = 'block';
          arrow.innerHTML = '&#9660;'; // Change arrow to down
        } else {
          section.style.display = 'none';
          arrow.innerHTML = '&#9654;'; // Change arrow to right
        }
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>