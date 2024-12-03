<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports'; // Nama tabel yang akan digunakan
    protected $primaryKey = 'id';
    protected $allowedFields = ['image_id', 'violation_status', 'description', 'created_at', 'status', 'user_name']; // Tambahkan user_name
    // protected $useTimestamps = true;

    // Fungsi untuk update status laporan
    public function updateStatus($reportId, $status)
    {
        // Cek apakah laporan dengan ID yang diberikan ada
        $report = $this->find($reportId);
        if (!$report) {
            return false; // Jika laporan tidak ditemukan, kembalikan false
        }

        // Lakukan update status di database
        $updateSuccess = $this->update($reportId, ['status' => $status]);

        if ($updateSuccess) {
            return true;
        }

        // Jika update gagal, log kesalahan dan kembalikan false
        log_message('error', 'Gagal memperbarui status laporan dengan ID: ' . $reportId);
        return false;
    }
}
