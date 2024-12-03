<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReportModel;

class ReportController extends Controller
{
    public function laporkan()
    {
        // Ambil data JSON yang dikirim oleh client
        $request = \Config\Services::request();
        $data = $request->getJSON(true); // Mengambil data sebagai array

        // Log data yang diterima
        log_message('debug', print_r($data, true)); // Untuk memeriksa apa yang diterima

        // Pastikan data yang diperlukan ada
        if (isset($data['image_id'], $data['violation_status'], $data['description'], $data['user_name'])) {
            $imageId = $data['image_id'];
            $violationStatus = $data['violation_status'];
            $description = $data['description'];
            $userName = $data['user_name'];

            // Persiapkan data untuk disimpan
            $reportData = [
                'image_id' => $imageId,
                'violation_status' => $violationStatus,
                'description' => $description,
                'user_name' => $userName, // Tambahkan user_name ke data yang disimpan
                'created_at' => date('Y-m-d H:i:s'), // Waktu saat laporan dibuat
            ];

            // Load model pelaporan
            $reportModel = new ReportModel();

            // Simpan laporan ke dalam database
            if ($reportModel->save($reportData)) {
                // Kembalikan response sukses
                return $this->response->setJSON(['success' => true]);
            } else {
                // Kembalikan response gagal
                return $this->response->setJSON(['success' => false]);
            }
        }

        // Jika data tidak valid
        return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap.']);
    }




    public function index()
    {
        $reportModel = new ReportModel(); // Instantiate the ReportModel
        // Corrected line: directly use $reportModel without extra $
        $data['pelaporan'] = $reportModel->findAll(); // Get all data from the model

        // Pass the data to the view
        return view('pelaporan', $data);
    }


    // Fungsi untuk menangani permintaan AJAX untuk update status
    public function updateStatus()
    {
        $reportModel = new ReportModel(); // Instantiate the ReportModel

        // Ambil data dari request
        $reportId = $this->request->getPost('reportId');
        $status = $this->request->getPost('status');

        // Validasi status
        if (!in_array($status, ['pending', 'diterima', 'ditolak'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status tidak valid'
            ]);
        }

        // Perbarui status di database
        $updateSuccess = $reportModel->updateStatus($reportId, $status); // Perbaiki penggunaan model

        if ($updateSuccess) {
            return $this->response->setJSON([
                'success' => true
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui status'
            ]);
        }
    }

    public function delete($id)
    {
        $reportModel = new ReportModel();

        // Periksa apakah ID valid
        $report = $reportModel->find($id);
        if (!$report) {
            // Jika laporan tidak ditemukan, kirimkan respons error
            return redirect()->to('/laporan')->with('error', 'Data tidak ditemukan');
        }

        // Hapus data dari database
        $deleteSuccess = $reportModel->delete($id);

        if ($deleteSuccess) {
            // Jika berhasil, redirect ke halaman laporan dengan pesan sukses
            return redirect()->to('/pelaporan')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika gagal, redirect ke halaman laporan dengan pesan error
            return redirect()->to('/pelaporan')->with('error', 'Gagal menghapus data');
        }
    }
}
