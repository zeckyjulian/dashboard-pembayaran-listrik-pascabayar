<?php

namespace App\Models;
use CodeIgniter\Model;

class PenggunaanModel extends Model
{

    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'penggunaan';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'penggunaan'.
     * @var string
     */
    protected $primaryKey = 'id_penggunaan';

    /**
     * Daftar kolom yang dapat diisi secara massal.
     * @var array
     */
    protected $allowedFields = [
        'id_pelanggan', 'bulan', 'tahun', 'meter_awal', 'meter_akhir'
    ];
    
    /**
     * Mengambil data penggunaan dari database.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data penggunaan.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataPenggunaan($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_penggunaan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_penggunaan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Mengambil data penggunaan dengan join ke tabel 'pelanggan'.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data penggunaan beserta informasi pelanggan.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataPenggunaanJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan', 'left');
            $builder->orderBy('penggunaan.id_penggunaan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan', 'left');
            $builder->orderBy('penggunaan.id_penggunaan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Menyimpan data penggunaan baru ke dalam database.
     *
     * @param array $data Data yang akan disimpan, harus sesuai dengan struktur tabel 'penggunaan'.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function saveDataPenggunaan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
        return $this->db->insertID();
    }

    /**
     * Memperbarui data penggunaan yang sudah ada di dalam database.
     *
     * @param array $data Data yang akan diperbarui, harus sesuai dengan struktur tabel 'penggunaan'.
     * @param array $where Kondisi untuk menentukan data mana yang akan diperbarui.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function updateDataPenggunaan($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data, $where);
    }
}
?>