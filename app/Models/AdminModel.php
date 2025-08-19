<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Class AdminModel
 *
 * Model ini bertanggung jawab untuk mengelola data administrator,
 * termasuk mengambil, menyimpan, memperbarui, dan menghapus data admin.
 *
 * @package App\Models
 */
class AdminModel extends Model
{

    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'admin';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'admin'.
     * @var string
     */
    protected $primaryKey = 'id_admin';
    
    /**
     * Mengambil data admin dari database.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data admin.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataAdmin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_admin', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_admin', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Mengambil data admin dengan join ke tabel 'level'.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data admin beserta levelnya.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataAdminJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('level', 'level.id_level = admin.id_level', 'left');
            $builder->orderBy('admin.id_admin', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('level', 'level.id_level = admin.id_level', 'left');
            $builder->orderBy('admin.id_admin', 'DESC');
            return $query = $builder->get();
        }
    }

    // Kode di bawah ini bertanggung jawab untuk menyimpan, memperbarui, dan menghapus data admin.
    // Metode ini akan digunakan jika ada operasi CRUD pada web untuk data admin.

    /**
     * Menyimpan data administrator baru ke dalam database.
     *
     * @param array $data Data yang akan disimpan, harus sesuai dengan struktur tabel 'admin'.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function saveDataAdmin($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    /**
     * Memperbarui data administrator yang sudah ada di dalam database.
     *
     * @param array $data Data yang akan diperbarui, harus sesuai dengan struktur tabel 'admin'.
     * @param array $where Kondisi untuk menentukan data mana yang akan diperbarui.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function updateDataAdmin($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data, $where);
    }

    /**
     * Menghapus data administrator dari database berdasarkan kondisi yang diberikan.
     *
     * @param array $where Kondisi untuk menentukan data mana yang akan dihapus.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function hapusDataAdmin($where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete($where);
    }
}
?>