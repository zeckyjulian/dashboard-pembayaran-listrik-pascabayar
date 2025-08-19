<?php

namespace App\Models;
use CodeIgniter\Model;

class TarifModel extends Model
{
    /**
     * Nama tabel database yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'tarif';

    /**
     * Nama kolom yang menjadi primary key dari tabel 'tarif'.
     * @var string
     */
    protected $primaryKey = 'id_tarif';
}
?>