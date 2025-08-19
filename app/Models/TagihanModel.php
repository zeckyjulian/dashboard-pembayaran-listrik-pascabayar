<?php

namespace App\Models;
use CodeIgniter\Model;

class TagihanModel extends Model
{

    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'tagihan';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'tagihan'.
     * @var string
     */
    protected $primaryKey = 'id_tagihan';

    /**
     * Daftar kolom yang dapat diisi secara massal.
     * @var array
     */
    protected $allowedFields = [
        'bulan', 'tahun', 'jumlah_meter', 'status'
    ];
    
    /**
     * Mengambil data tagihan dari database.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data tagihan.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataTagihan($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_tagihan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_tagihan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Mengambil data tagihan dengan join ke tabel 'penggunaan' dan 'pelanggan'.
     *
     * Jika parameter $where tidak diberikan, method akan mengembalikan semua data tagihan beserta informasi penggunaan dan pelanggan.
     * Jika $where diberikan, method akan memfilter data berdasarkan kondisi tersebut.
     *
     * @param array|false $where Kondisi untuk memfilter data, atau false untuk mengambil semua.
     * @return \CodeIgniter\Database\ResultInterface Hasil query yang dapat diiterasi.
     */
    public function getDataTagihanJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
            $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'left');
            $builder->orderBy('tagihan.id_tagihan', 'DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
            $builder->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan', 'left');
            $builder->orderBy('tagihan.id_tagihan', 'DESC');
            return $query = $builder->get();
        }
    }

    /**
     * Menyimpan data tagihan baru ke dalam database.
     *
     * @param array $data Data yang akan disimpan, harus sesuai dengan struktur tabel 'tagihan'.
     * @return bool|int Mengembalikan true jika berhasil, atau false jika gagal.
     */
    public function saveDataTagihan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
}
?>