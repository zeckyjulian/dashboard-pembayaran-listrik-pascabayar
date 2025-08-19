<?php

namespace App\Controllers;
use App\Models\PelangganModel;
use App\Models\PenggunaanModel;
use App\Models\TarifModel;
use App\Models\TagihanModel;

/**
 * Class Pelanggan
 *
 * Controller ini bertanggung jawab untuk menangani semua data pelanggan listrik,
 * Controller ini digunakan oleh administrator untuk mengelola data pelanggan,
 * dari input, edit, update, hingga penghapusan data pelanggan.
 *
 * @package App\Controllers
 */
class Pelanggan extends BaseController
{

    /**
     * Menampilkan halaman master data pelanggan.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login
     * Jika valid, mengambil data pelanggan dari model dan menampilkannya di view.
     * 
     * @return void
     */
    public function master_data_pelanggan()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $pelangganModel = new PelangganModel();

            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $dataPelanggan = $pelangganModel->getDataPelangganJoin()->getResultArray();

            $data2['dataPelanggan'] = $dataPelanggan;
            $title['title'] = 'Data Pelanggan Listrik';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Admin/Template/header', $title);
            echo view('/Backend/Admin/Template/sidebar', $data);
            echo view('/Backend/Admin/MasterPelanggan/master-data-pelanggan', $data2);
            echo view('/Backend/Admin/Template/footer');
        }
    }

    /**
     * Menampilkan halaman untuk input data pelanggan listrik.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data tarif dari model dan menampilkannya di view.
     *
     * @return void
     */
    public function input_data_pelanggan()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $tarifModel = new TarifModel;

            $uri = service('uri');
            $halaman = $uri->getSegment(2);

            $data2['dataTarif'] = $tarifModel->findAll();
            $title['title'] = 'Input Data Pelanggan Listrik';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Admin/Template/header', $title);
            echo view('/Backend/Admin/Template/sidebar', $data);
            echo view('/Backend/Admin/MasterPelanggan/input-pelanggan', $data2);
            echo view('/Backend/Admin/Template/footer');
        }
    }

    /**
     * Menyimpan data pelanggan listrik baru.
     * Mengambil data dari form, memeriksa apakah pelanggan sudah ada, jika tidak, menyimpan data ke model.
     * Jika berhasil, mengarahkan kembali ke halaman data pelanggan dengan pesan sukses.
     * Jika gagal, mengarahkan kembali dengan pesan error.
     *
     * @return void
     */
    public function simpan_data_pelanggan()
    {
        $pelangganModel = new PelangganModel;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nokwh = $this->request->getPost('nokwh');
        $idTarif = $this->request->getPost('daya');
        $namapelanggan = $this->request->getPost('namapelanggan');
        $alamat = $this->request->getPost('alamat');

        $cekPelanggan = $pelangganModel->where('username', $username)
            ->orWhere('nomor_kwh', $nokwh)
            ->first();
        if ($cekPelanggan) {
            session()->setFlashdata('error', 'Data Pelanggan Sudah ada!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/input-pelanggan'); ?>";
                </script>
            <?php
        } else {
            $dataSimpan = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'nomor_kwh' => $nokwh,
                'nama_pelanggan' => $namapelanggan,
                'alamat' => $alamat,
                'id_tarif' => $idTarif
            ];
            $pelangganModel->saveDataPelanggan($dataSimpan);
            session()->setFlashdata('success', 'Data Pelanggan berhasil disimpan!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/data-pelanggan'); ?>";
                </script>
            <?php
        }
    }

    /**
     * Menampilkan halaman untuk mengedit data pelanggan listrik.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data pelanggan berdasarkan ID yang diberikan dan menampilkannya di view.
     * @param string $idEdit ID yang dienkripsi dari data pelanggan yang akan diedit.
     * @return void
     */
    public function edit_data_pelanggan()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $pelangganModel = new PelangganModel;
            $tarifModel = new TarifModel;


            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $idEdit = $uri->getSegment(3);
            $dataEdit = $pelangganModel->getDataPelanggan(['sha1(id_pelanggan)' => $idEdit])->getRowArray();

            session()->set(['idUpdate' => $dataEdit['id_pelanggan']]);
            $data['data_edit'] = $dataEdit;
            $data['dataTarif'] = $tarifModel->findAll();
            $data['halaman'] = $halaman;
            $title['title'] = 'Edit Data Pelanggan Listrik';
            echo view('/Backend/Admin/Template/header', $title);
            echo view('/Backend/Admin/Template/sidebar', $data);
            echo view('/Backend/Admin/MasterPelanggan/edit-pelanggan', $data);
            echo view('/Backend/Admin/Template/footer');
        }
    }

    /**
     * Memperbarui data pelanggan listrik.
     * Mengambil data dari form, memperbarui data di model, dan mengarahkan kembali ke halaman data pelanggan.
     *
     * @return void
     */
    public function update_data_pelanggan()
    {
        $pelangganModel = new PelangganModel;

        $username = $this->request->getPost('username');
        $nokwh = $this->request->getPost('nokwh');
        $idTarif = $this->request->getPost('daya');
        $namapelanggan = $this->request->getPost('namapelanggan');
        $alamat = $this->request->getPost('alamat');
        $idUpdate = session()->get('idUpdate');

        $dataSimpan = [
            'username' => $username,
            'nomor_kwh' => $nokwh,
            'nama_pelanggan' => $namapelanggan,
            'alamat' => $alamat,
            'id_tarif' => $idTarif
        ];
        $pelangganModel->updateDataPelanggan($dataSimpan, ['id_pelanggan' => $idUpdate]);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Pelanggan berhasil diupdate!');
        ?>
            <script>
                document.location = "<?= base_url('admin/data-pelanggan'); ?>";
            </script>
        <?php
    }

    /**
     * Menghapus data pelanggan listrik.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, menghapus data pelanggan dan riwayat terkait dari model.
     * Mengarahkan kembali ke halaman data pelanggan dengan pesan sukses atau error.
     *
     * @return void
     */
    public function hapus_data_pelanggan()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $pelangganModel = new PelangganModel;
            $penggunaanModel = new PenggunaanModel;
            $tagihanModel = new TagihanModel;

            $uri = service('uri');
            $idHapus = $uri->getSegment(3);
            

            $pelanggan = $pelangganModel->getDataPelanggan(['sha1(id_pelanggan)' => $idHapus])->getRowArray();

            if($pelanggan) {
                $idPelanggan = $pelanggan['id_pelanggan'];
                $tagihanModel->where('id_pelanggan', $idPelanggan)->delete();
                $penggunaanModel->where('id_pelanggan', $idPelanggan)->delete();

                $pelangganModel->delete($idPelanggan);
                session()->setFlashdata('success', 'Data Pelanggan beserta riwayatnya berhasil dihapus!');
                ?>
                    <script>
                        document.location = "<?= base_url('admin/data-pelanggan'); ?>";
                    </script>
                <?php
            } else {
                session()->setFlashdata('error', 'Data Pelanggan gagal dihapus!');
                ?>
                    <script>
                        document.location = "<?= base_url('admin/data-pelanggan'); ?>";
                    </script>
                <?php
            }
        }
    }
}
