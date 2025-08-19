<?php

namespace App\Models;
use CodeIgniter\Model;

class PelangganModel extends Model
{
    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'pelanggan'.
     * @var string
     */
    protected $primaryKey = 'id_pelanggan';
    
    /**
     * Mengambil data pelanggan dari database.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data pelanggan.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataPelanggan($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_pelanggan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_pelanggan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Mengambil data pelanggan dengan join ke tabel 'tarif'.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data pelanggan beserta tarifnya.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataPelangganJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'left');
            $builder->orderBy('pelanggan.id_pelanggan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'left');
            $builder->orderBy('pelanggan.id_pelanggan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Menyimpan data pelanggan baru ke dalam database.
     *
     * @param array $data Data yang akan disimpan, harus sesuai dengan struktur tabel 'pelanggan'.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function saveDataPelanggan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    /**
     * Memperbarui data pelanggan yang sudah ada di dalam database.
     *
     * @param array $data Data yang akan diperbarui, harus sesuai dengan struktur tabel 'pelanggan'.
     * @param array $where Kondisi untuk menentukan data mana yang akan diperbarui.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function updateDataPelanggan($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data, $where);
    }

    /**
     * Menghapus data pelanggan dari database.
     *
     * @param array $where Kondisi untuk menentukan data mana yang akan dihapus.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function hapusDataPelanggan($where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete($where);
    }
}
?>