<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MonitoringController extends Controller
{
    public function index()
    {
        // Path folder uploads di public
        $uploadsDir = WRITEPATH . '../public/uploads/';

        // Pastikan folder ada
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        // Ambil daftar file
        $files = $this->getFiles();

        // Kirim data ke view
        return view('monitoring_view', ['files' => $files]);
    }

    public function fetchFiles()
    {
        try {
            $files = $this->getFiles();
            return $this->response->setJSON($files);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getFiles()
    {
        $uploadsDir = WRITEPATH . '../public/uploads/';
        $files = array_diff(scandir($uploadsDir), ['.', '..']);
        $fileData = [];

        foreach ($files as $file) {
            $filePath = $uploadsDir . $file;
            $fileData[] = [
                'name' => $file,
                'url' => base_url('uploads/' . $file),
                'size' => filesize($filePath),
                'modified' => date('Y-m-d H:i:s', filectime($filePath)), // Ganti ke filectime
            ];
        }

        // Urutkan file berdasarkan waktu pembuatan (descending)
        usort($fileData, function ($a, $b) {
            return strtotime($b['modified']) - strtotime($a['modified']);
        });

        return $fileData;
    }
}
