<?php

namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\TagihanModel;

/**
 * Class Admin
 *
 * Controller ini bertanggung jawab untuk menangani semua fungsi
 * yang terkait dengan panel administrasi, seperti login, logout,
 * menampilkan dashboard, dan mengelola data tagihan pelanggan.
 *
 * @package App\Controllers
 */
class Admin extends BaseController
{
    protected $helpers = ['form'];

    /**
     * Menampilkan halaman login untuk administrator.
     *
     * @return string Halaman view login.
     */
    public function login()
    {
        return view('/Backend/Admin/Login/login-admin');
    }

    /**
     * Mengautentikasi administrator berdasarkan username dan password.
     * Jika berhasil, akan menyimpan data sesi dan mengarahkan ke dashboard.
     * Jika gagal, akan menampilkan pesan kesalahan.
     *
     * @return void
     */
    public function autentikasi()
    {
        $adminModel = new AdminModel;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cekAdmin = $adminModel->getDataAdmin(['username' => $username])->getNumRows();
        if ($cekAdmin ==0) {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login'); ?>";
                </script>
            <?php
        } else {
            $dataAdmin = $adminModel->getDataAdmin(['username' => $username])->getRowArray();
            $passwordAdmin = $dataAdmin['password'];

            $verifikasiPassword = password_verify($password, $passwordAdmin);
            if (!$verifikasiPassword) {
                session()->setFlashdata('error', 'Password tidak sesuai!');
                ?>
                    <script>
                        document.location = "<?= base_url('admin/login'); ?>";
                    </script>
                <?php
            } else {
                $dataSession = [
                    'ses_idAdmin' => $dataAdmin['id_admin'],
                    'ses_admin' => $dataAdmin['username']
                ];
                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
                    <script>
                        document.location = "<?= base_url('admin/dashboard-admin'); ?>";
                    </script>
                <?php
            }
        }
    }

    /**
     * Menghapus sesi administrator dan mengarahkan ke halaman login.
     * Menampilkan pesan bahwa administrator telah keluar dari sistem.
     *
     * @return void
     */
    public function logout()
    {
        session()->remove('ses_idAdmin');
        session()->setFlashdata('warning', 'Anda telah keluar dari sistem!');
        ?>
            <script>
                document.location = "<?= base_url('admin/login');?>";
            </script>
        <?php
    }

    /**
     * Menampilkan dashboard untuk administrator.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, menampilkan halaman dashboard dengan data yang relevan.
     *
     * @return void
     */
    public function dashboard_admin()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $title['title'] = 'Dashboard Admin';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Admin/Template/header', $title);
            echo view('/Backend/Admin/Template/sidebar', $data);
            echo view('/Backend/Admin/Login/dashboard-admin');
            echo view('/Backend/Admin/Template/footer');
        }
    }

    /**
     * Menampilkan data tagihan listrik pelanggan.
     * Memeriksa apakah sesi administrator valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data tagihan dari model dan menampilkannya di view.
     *
     * @return void
     */
    public function tagihan_pelanggan()
    {
        if (session()->get('ses_idAdmin') == "" or session()->get('ses_admin') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('admin/login');?>";
                </script>
            <?php
        } else {
            $tagihanModel = new TagihanModel();

            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $dataTagihan = $tagihanModel->getDataTagihanJoin()->getResultArray();

            $data['dataTagihan'] = $dataTagihan;
            $title['title'] = 'Data Tagihan Listrik Pelanggan';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Admin/Template/header', $title);
            echo view('/Backend/Admin/Template/sidebar', $data);
            echo view('/Backend/Admin/MasterPelanggan/tagihan-pelanggan', $data);
            echo view('/Backend/Admin/Template/footer');
        }
    }
}
