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
            <form action="<?php echo base_url('update-penggunaan') ?>" method="post" enctype="multipart/form-data">
            <div class="card-header">
            <div class="card-title">Form Edit Penggunaan Bulanan</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',this)"
                    id="bulan"
                    name="bulan"
                    value="<?= $data_edit['bulan']; ?>"
                    placeholder="Contoh: Januari"
                    required
                    />
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="tahun"
                    name="tahun"
                    value="<?= $data_edit['tahun']; ?>"
                    placeholder="Contoh: 2020"
                    required
                    />
                </div>
                </div>
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="meterawal">Meter Awal</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="meterawal"
                    name="meterawal"
                    value="<?= $data_edit['meter_awal']; ?>"
                    placeholder="Contoh: 1500"
                    required
                    />
                </div>
                <div class="form-group">
                    <label for="meterakhir">Meter Akhir</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="meterakhir"
                    name="meterakhir"
                    value="<?= $data_edit['meter_akhir']; ?>"
                    placeholder="Contoh: 1650"
                    required
                    />
                </div>
                </div>
            </div>
            </div>
            <div class="card-action">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>