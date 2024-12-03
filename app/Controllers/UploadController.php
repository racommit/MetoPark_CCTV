<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UploadController extends Controller
{
    public function uploadImage()
    {
        // Tentukan direktori tujuan penyimpanan gambar
        $target_dir = WRITEPATH . '../public/uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Buat folder jika belum ada
        }

        // Ambil file gambar dari request
        $file = $this->request->getFile('file');
        if (!$file->isValid()) {
            return $this->response->setJSON(['error' => $file->getErrorString()]);
        }

        // Validasi tipe file (misalnya hanya JPEG)
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($file->getExtension(), $allowedTypes)) {
            return $this->response->setJSON(['error' => 'Invalid file type.']);
        }

        // Buat nama file unik dan simpan
        $newName = date('Y-m-d_H-i-s') . '_' . $file->getRandomName();
        if ($file->move($target_dir, $newName)) {
            return $this->response->setJSON(['success' => 'File uploaded successfully!', 'file' => base_url('uploads/' . $newName)]);
        } else {
            return $this->response->setJSON(['error' => 'Failed to move uploaded file.']);
        }
    }
}
