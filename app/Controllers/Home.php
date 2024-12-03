<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Ambil data pengguna dari session
        $user = session()->get('user');
        // var_dump($user);die;
        // Pastikan user ada dalam session sebelum mengirimkan ke view
        return view('gallery', ['user' => $user]);
    }
    public function upload(): string
    {
        return view('upload');
    }
    public function forbidden(): string
    {
        return view('forbidden');
    }


    public function getImages()
    {
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

            // Return the image data as JSON
            return $this->response->setJSON($images);
        }

        return $this->response->setJSON([]);
    }
}
