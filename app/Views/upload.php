<?php
// Set timezone to server's local timezone (change to your location as needed)
date_default_timezone_set('Asia/Jakarta'); // Sesuaikan zona waktu sesuai lokasi server, contoh: WIB

// Path folder upload
$target_dir = FCPATH . 'uploads/'; // Sesuaikan dengan folder 'uploads' di server Anda
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true); // Membuat direktori jika belum ada
}

// Set timestamp menggunakan zona waktu server
$datum = time();
$target_file = $target_dir . date('Y-m-d_H-i-s_', $datum) . basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["imageFile"]["size"] > 500000) { // Maksimal file size 500KB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // Try to upload file
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["imageFile"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
