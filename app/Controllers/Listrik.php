<?php

namespace App\Controllers;
use App\Models\PenggunaanModel;
use App\Models\PelangganModel;
use App\Models\TagihanModel;
use App\Models\PembayaranModel;

/**
 * Class Listrik
 *
 * Controller ini bertanggung jawab untuk menangani semua fungsi
 * yang terkait dengan penggunaan listrik, seperti kalkulasi tagihan,
 * pengelolaan data penggunaan bulanan, dan manajemen tagihan listrik.
 *
 * @package App\Controllers
 */
class Listrik extends BaseController
{
    protected $helpers = ['form'];

    /**
     * Menampilkan halaman dashboard untuk pelanggan.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, menampilkan halaman dashboard dengan data yang relevan.
     * @return void
     */
    public function dashboard()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $title['title'] = 'Dashboard';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/dashboard');
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Menampilkan halaman login untuk pelanggan.
     *
     * @return string Halaman view login.
     */
    public function login()
    {
        return view('/Backend/Login/login-pelanggan');
    }

    /**
     * Mengarahkan pengguna ke halaman login jika sesi tidak valid.
     * Digunakan untuk memastikan bahwa hanya pengguna yang telah login yang dapat mengakses halaman tertentu.
     *
     * @return void
     */
    public function autentikasi()
    {
        $pelangganModel = new PelangganModel;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Memeriksa apakah username ada di database
        $cekPelanggan = $pelangganModel->getDataPelanggan(['username' => $username])->getNumRows();
        // Jika tidak ada, tampilkan pesan error dan arahkan ke halaman login
        if ($cekPelanggan == 0) {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            ?>
                <script>
                    document.location = "<?= base_url('login'); ?>";
                </script>
            <?php
        } else {
            // Jika ada, ambil data pelanggan berdasarkan username
            $dataPelanggan = $pelangganModel->getDataPelanggan(['username' => $username])->getRowArray();
            $passwordUser = $dataPelanggan['password'];

            $verifikasiPassword = password_verify($password, $passwordUser);
            //  Penanganan error jika password tidak sesuai
            if (!$verifikasiPassword) {
                session()->setFlashdata('error', 'Login Gagal! Periksa kembali username dan kata sandi Anda.');
                ?>
                    <script>
                        document.location = "<?= base_url('login'); ?>";
                    </script>
                <?php
            } else {
                $dataSession = [
                    'ses_id' => $dataPelanggan['id_pelanggan'],
                    'ses_user' => $dataPelanggan['username']
                ];
                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
                    <script>
                        document.location = "<?= base_url('dashboard'); ?>";
                    </script>
                <?php
            }
        }
    }

    /**
     * Menampilkan halaman kalkulasi tagihan listrik.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, menampilkan halaman kalkulasi tagihan listrik.
     *
     * @throws \CodeIgniter\Exceptions\PageNotFoundException
     * @return void
     */
    public function kalkulasi()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $title['title'] = 'Kalkulator Tagihan Listrik';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Menampilkan data penggunaan listrik bulanan pelanggan.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data penggunaan dari model dan menampilkannya di view.
     *
     * @return void
     */
    public function penggunaan_bulanan()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $penggunaanModel = new PenggunaanModel;

            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $idPelanggan = session()->get('ses_id');
            $dataPenggunaan = $penggunaanModel->getDataPenggunaanJoin(['penggunaan.id_pelanggan' => $idPelanggan])->getResultArray();

            $data['dataPenggunaan'] = $dataPenggunaan;
            $data['validation'] = \Config\Services::validation();
            $title['title'] = 'Penggunaan Listrik Bulanan';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/listrik-bulanan', $data);
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Menyimpan data penggunaan listrik bulanan pelanggan.
     * Mengambil data dari form, menyimpannya ke model, dan mengarahkan kembali ke halaman penggunaan bulanan.
     *
     * @return void
     */
    public function simpan_penggunaan()
    {
        $rules = [
            'bulan' => [
                'rules' => [
                    'required',
                    function ($value, $data, &$error) {
                        $penggunaanModel = new \App\Models\PenggunaanModel();
                        $idPelanggan = session()->get('ses_id');

                        // Cek ke database
                        $isExist = $penggunaanModel->where('id_pelanggan', $idPelanggan)
                                                ->where('bulan', $data['bulan'])
                                                ->where('tahun', $data['tahun'])
                                                ->first();
                        
                        // Jika data sudah ada, kembalikan false (validasi gagal)
                        if ($isExist) {
                            $error = 'Data penggunaan untuk bulan dan tahun ini sudah ada.';
                            return false;
                        }

                        // Jika data belum ada, kembalikan true (validasi berhasil)
                        return true;
                    }
                ],
                'errors' => [
                    'required' => 'Kolom bulan wajib diisi.',
                ]
            ],
            'tahun' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom tahun wajib diisi.',
                    'numeric' => 'Tahun harus berupa angka.'
                ]
            ],
            'meterawal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Meter awal wajib diisi.'
                ]
            ],
            'meterakhir' => [
                'rules' => 'required|numeric|greater_than_equal_to[{meterawal}]',
                'errors' => [
                    'required' => 'Meter akhir wajib diisi.',
                    'greater_than_equal_to' => 'Meter akhir harus lebih besar atau sama dengan meter awal.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {

            session()->setFlashdata('errors', $this->validator->getErrors());

            // Mengalihkan pengguna kembali ke halaman utama manajemen pelanggan
            return redirect()->to('/listrik-bulanan');
        }

        $penggunaanModel = new PenggunaanModel;

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $meterAwal = $this->request->getPost('meterawal');
        $meterAkhir = $this->request->getPost('meterakhir');

        $idPelanggan = session()->get('ses_id');

        $dataSimpan = [
            'id_pelanggan' => $idPelanggan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'meter_awal' => $meterAwal,
            'meter_akhir' => $meterAkhir
        ];

        $penggunaanModel->saveDataPenggunaan($dataSimpan);
        session()->setFlashdata('success', 'Data Penggunaan Berhasil Ditambahkan!');
        ?>
            <script>
                document.location = "<?= base_url('listrik-bulanan'); ?>";
            </script>
        <?php
    }

    /**
     * Menampilkan halaman untuk mengedit data penggunaan listrik bulanan.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data penggunaan berdasarkan ID yang diberikan dan menampilkannya di view.
     * @param string $idEdit ID yang dienkripsi dari data penggunaan yang akan diedit.
     * @return void
     */
    public function edit_penggunaan()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $penggunaanModel = new PenggunaanModel;

            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $idEdit = $uri->getSegment(2);
            $dataEdit = $penggunaanModel->getDataPenggunaan(['sha1(id_penggunaan)' => $idEdit])->getRowArray();

            session()->set(['idUpdate' => $dataEdit['id_penggunaan']]);
            $data['data_edit'] = $dataEdit;
            $title['title'] = 'Edit Penggunaan Listrik Bulanan';
            $data['halaman'] = $halaman;
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/edit-penggunaan', $data);
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Memperbarui data penggunaan listrik bulanan pelanggan.
     * Mengambil data dari form, memperbarui data di model, dan mengarahkan kembali ke halaman penggunaan bulanan.
     *
     * @return void
     */
    public function update_penggunaan()
    {
        $penggunaanModel = new PenggunaanModel;

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $meterAwal = $this->request->getPost('meterawal');
        $meterAkhir = $this->request->getPost('meterakhir');
        $idUpdate = session()->get('idUpdate');

        $dataUpdate = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'meter_awal' => $meterAwal,
            'meter_akhir' => $meterAkhir
        ];

        $penggunaanModel->updateDataPenggunaan($dataUpdate, ['id_penggunaan' => $idUpdate]);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Penggunaan Berhasil Diupdate!');
        ?>
            <script>
                document.location = "<?= base_url('listrik-bulanan'); ?>";
            </script>
        <?php
    }

    /**
     * Menampilkan data tagihan listrik pelanggan.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data tagihan dari model dan menampilkannya di view.
     * Data tagihan yang ditampilkan berdsarkan ID pelanggan yang sedang login.
     *
     * @return void
     */
    public function tagihan_listrik()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $tagihanModel = new TagihanModel;

            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $idPelanggan = session()->get('ses_id');
            $dataTagihan = $tagihanModel->getDataTagihanJoin(['tagihan.id_pelanggan' => $idPelanggan])->getResultArray();

            $data['dataTagihan'] = $dataTagihan;
            $title['title'] = 'Tagihan Listrik';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/tagihan-listrik', $data);
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Menampilkan halaman pembayaran tagihan listrik.
     * Memeriksa apakah sesi pelanggan valid, jika tidak, mengarahkan ke halaman login.
     * Jika valid, mengambil data tagihan berdasarkan ID yang diberikan,
     * menghitung total tagihan, dan menampilkan halaman pembayaran.
     * @param string $idBayar ID yang dienkripsi dari tagihan yang akan dibayar.
     * @return void
     */
    public function pembayaran()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "") {
            session()->setFlashData('error', 'Silahkan login terlebih dahulu!');
            ?>
                <script>
                    document.location = "<?= base_url('login');?>";
                </script>
            <?php
        } else {
            $tagihanModel = new TagihanModel;
            $pelangganModel = new PelangganModel;

            $uri = service('uri');
            $halaman = $uri->getSegment(1);
            $idBayar = $uri->getSegment(2);
            $dataTagihan = $tagihanModel->getDataTagihanJoin(['sha1(id_tagihan)' => $idBayar])->getRowArray();
            $dataPelanggan = $pelangganModel->getDataPelangganJoin(['id_pelanggan' => session()->get('ses_id')])->getRowArray();

            $biayaAdmin = 2500;
            $tagihanAwal = $dataTagihan['jumlah_meter'] * $dataPelanggan['tarifperkwh'];

            $totalTagihan = $tagihanAwal + $biayaAdmin;

            session()->set(['idTagihan' => $dataTagihan['id_tagihan']]);
            $data['dataTagihan'] = $dataTagihan;
            $data['totalTagihan'] = $totalTagihan;
            $title['title'] = 'Tagihan Listrik';
            $data['halaman'] = $halaman;
            // return view('/Backend/Listrik/kalkulasi');
            echo view('/Backend/Template/header', $title);
            echo view('/Backend/Template/sidebar', $data);
            echo view('/Backend/Listrik/pembayaran', $data);
            echo view('/Backend/Template/footer');
        }
    }

    /**
     * Memproses pembayaran tagihan listrik.
     * Mengambil data tagihan dan pelanggan, memperbarui status tagihan menjadi 'Lunas',
     * menyimpan data pembayaran, dan mengarahkan kembali ke halaman tagihan listrik.
     *
     * @return void
     */
    public function prosesPembayaran()
    {
        $tagihanModel = new TagihanModel;
        $pelangganModel = new PelangganModel;
        $pembayaranModel = new PembayaranModel;
        $db = \Config\Database::connect();

        $idTagihan = session()->get('idTagihan');

        $dataTagihan = $tagihanModel->getDataTagihanJoin(['id_tagihan' => $idTagihan])->getRowArray();
        $dataPelanggan = $pelangganModel->getDataPelangganJoin(['id_pelanggan' => session()->get('ses_id')])->getRowArray();

        $db->transStart();

        $tagihanModel->update($idTagihan, ['status' => 'Lunas']);

        $biayaAdmin = 2500;
        $tagihanAwal = $dataTagihan['jumlah_meter'] * $dataPelanggan['tarifperkwh'];

        $totalTagihan = $tagihanAwal + $biayaAdmin;

        $dataPembayaran = [
            'id_tagihan' => $dataTagihan['id_tagihan'],
            'id_pelanggan' => $dataTagihan['id_pelanggan'],
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'bulan_bayar' => $dataTagihan['bulan'],
            'total_bayar' => $totalTagihan,
            'id_admin' => 2
        ];
        $pembayaranModel->saveDataPembayaran($dataPembayaran);

        $db->transComplete();

        session()->remove('idTagihan');
        session()->setFlashdata('success', 'Pembayaran Berhasil Dilakukan!');
        ?>
            <script>
                document.location = "<?= base_url('tagihan-listrik'); ?>";
            </script>
        <?php
    }

    /**
     * Menghapus sesi pelanggan dan mengarahkan ke halaman login.
     * Menampilkan pesan bahwa pelanggan telah keluar dari sistem.
     *
     * @return void
     */
    public function logout()
    {
        session()->remove('ses_id');
        session()->setFlashdata('warning', 'Anda telah keluar dari sistem!');
        ?>
            <script>
                document.location = "<?= base_url('login');?>";
            </script>
        <?php
    }
}
