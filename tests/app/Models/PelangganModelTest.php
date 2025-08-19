<?php

namespace App\Models;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class PelangganModelTest extends CIUnitTestCase
{
    // Gunakan trait ini untuk me-reset database secara otomatis.
    use DatabaseTestTrait;

    // PENTING: Gunakan grup database 'tests' yang sudah kita konfigurasi.
    protected $DBGroup = 'tests';
    protected $migrate = true;

    protected $refresh = true;
    protected $seed = ['TarifSeeder', 'PelangganSeeder'];
    protected $namespace = null;
    protected $basePath  = APPPATH . 'Database';

    protected $model;

    /**
     * Method ini dijalankan sebelum setiap tes.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Kita hanya perlu membuat instance model di sini.
        // Trait akan menangani migrasi dan seeder secara otomatis
        // berdasarkan properti di atas.
        $this->model = new PelangganModel();
    }

    // =================================================================
    // MULAI FUNGSI-FUNGSI TES
    // (Tidak ada perubahan di bawah ini)
    // =================================================================

    public function testSaveDataPelanggan()
    {
        $newData = [
            'username'       => 'joko_susilo',
            'password'       => password_hash('passwordbaru', PASSWORD_DEFAULT),
            'nomor_kwh'      => '555666777888',
            'nama_pelanggan' => 'Joko Susilo',
            'alamat'         => 'Jl. Kemerdekaan No. 17',
            'id_tarif'       => 1,
        ];
        $result = $this->model->saveDataPelanggan($newData);
        $this->assertTrue($result);
        $this->seeInDatabase('pelanggan', ['username' => 'joko_susilo']);
    }

    public function testGetDataPelangganWithWhere()
    {
        $where = ['username' => 'andibudi'];
        $query = $this->model->getDataPelanggan($where);
        $pelanggan = $query->getRowArray();
        $this->assertNotNull($pelanggan);
        $this->assertEquals('Andi Budianto', $pelanggan['nama_pelanggan']);
    }

    public function testGetDataPelangganJoin()
    {
        $where = ['pelanggan.id_pelanggan' => 2];
        $query = $this->model->getDataPelangganJoin($where);
        $pelanggan = $query->getRowArray();
        $this->assertNotNull($pelanggan);
        $this->assertEquals('Citra Ayu Lestari', $pelanggan['nama_pelanggan']);
    }

    public function testUpdateDataPelanggan()
    {
        $newData = ['alamat' => 'Jl. Pahlawan No. 99, Kota Baru'];
        $where = ['id_pelanggan' => 2];
        $this->model->updateDataPelanggan($newData, $where);
        $this->seeInDatabase('pelanggan', [
            'id_pelanggan' => 2,
            'alamat' => 'Jl. Pahlawan No. 99, Kota Baru'
        ]);
    }

    public function testDeleteDataPelanggan()
    {
        $where = ['id_pelanggan' => 2];
        $this->seeInDatabase('pelanggan', $where);
        $this->model->hapusDataPelanggan($where);
        $this->dontSeeInDatabase('pelanggan', $where);
    }

}
