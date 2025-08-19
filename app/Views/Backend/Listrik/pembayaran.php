<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Forms</h3>
        <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="#">
            <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Forms</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Basic Form</a>
        </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <form action="<?php echo base_url('pembayaran/proses/'. sha1($dataTagihan['id_tagihan'])) ?>" method="post" enctype="multipart/form-data">
            <div class="card-header">
            <div class="card-title">Pembayaran</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <p class="form-control-static"><?= $dataTagihan['nama_pelanggan'] ?></p>
                </div>

                <div class="form-group">
                    <label>Nomor KWH</label>
                    <p class="form-control-static"><?= $dataTagihan['nomor_kwh'] ?></p>
                </div>

                <div class="form-group">
                    <label>Bulan</label>
                    <p class="form-control-static"><?= $dataTagihan['bulan'] ?></p>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <p class="form-control-static"><?= $dataTagihan['tahun'] ?></p>
                </div>

                <div class="form-group">
                    <label>Harga Bayar</label>
                    <p class="form-control-static">
                    Rp. <?= $totalTagihan ?>
                    </p>
                </div>
                </div>
            </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">
                <i class="fas fa-money-bill"></i> Bayar Sekarang
                </button>
                <a href="<?= base_url('tagihan-listrik') ?>" class="btn btn-danger">
                <i class="fas fa-times"></i> Batal
                </a>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>