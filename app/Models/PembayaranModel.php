<?php

namespace App\Models;
use CodeIgniter\Model;

class PembayaranModel extends Model
{

    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'pembayaran'.
     * @var string
     */
    protected $primaryKey = 'id_pemabayaran';

    /**
     * Daftar kolom yang dapat diisi secara massal.
     * @var array
     */
    protected $allowedFields = [
        'id_tagihan', 'id_pelanggan', 'tanggal_pembayaran', 'bulan_bayar', 'biaya_admin', 'total_bayar', 'id_admin'
    ];

    /**
     * Menyimpan data tagihan baru ke dalam database.
     *
     * @param array $data Data yang akan disimpan, harus sesuai dengan struktur tabel 'tagihan'.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function saveDataPembayaran($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
}
?>