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
            <?php
                $validation->listErrors();
            ?>
            <form action="<?php echo base_url('simpan-penggunaan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header">
            <div class="card-title">Form Penggunaan Bulanan</div>
            </div>
            <div class="card-body">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="bulan">Bulan (Nomor)</label>
                    <input
                    type="text"
                    class="form-control form-control <?= $validation->hasError('bulan') ? 'is-invalid' : '' ?>"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="bulan"
                    name="bulan"
                    placeholder="Contoh: 1/2/3...12"
                    value="<?= old('bulan') ?>"
                    required
                    />
                    <?php if ($validation->hasError('bulan')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('bulan') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input
                    type="text"
                    class="form-control form-control <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="tahun"
                    name="tahun"
                    placeholder="Contoh: 2020"
                    value="<?= old('tahun') ?>"
                    required
                    />
                    <?php if ($validation->hasError('tahun')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tahun') ?>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="meterawal">Meter Awal</label>
                    <input
                    type="text"
                    class="form-control form-control <?= $validation->hasError('meterawal') ? 'is-invalid' : '' ?>"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="meterawal"
                    name="meterawal"
                    placeholder="Contoh: 1500"
                    value="<?= old('meterawal') ?>"
                    required
                    />
                    <?php if ($validation->hasError('meterawal')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('meterawal') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="meterakhir">Meter Akhir</label>
                    <input
                    type="text"
                    class="form-control form-control <?= $validation->hasError('meterakhir') ? 'is-invalid' : '' ?>"
                    onKeyPress="return goodchars(event,'0123456789',this)"
                    id="meterakhir"
                    name="meterakhir"
                    placeholder="Contoh: 1650"
                    value="<?= old('meterakhir') ?>"
                    required
                    />
                    <?php if ($validation->hasError('meterakhir')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('meterakhir') ?>
                        </div>
                    <?php endif; ?>
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

    <!-- Table Penggunaan Listrik -->

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Penggunaan Bulanan</h4>
            </div>
            </div>
            <div class="card-body">

            <div class="table-responsive">
                <table
                id="add-row"
                class="display table table-striped table-hover"
                >
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>Nomor kWh</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Meter Awal</th>
                    <th>Meter Akhir</th>
                    <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>No.</th>
                    <th>Nomor kWh</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Meter Awal</th>
                    <th>Meter Akhir</th>
                    <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 0;
                        foreach ($dataPenggunaan as $data) {
                    ?>
                    <tr>
                    <td><?= $no=$no+1; ?></td>
                    <td><?= $data['nomor_kwh']; ?></td>
                    <td><?= $data['bulan']; ?></td>
                    <td><?= $data['tahun']; ?></td>
                    <td><?= $data['meter_awal']; ?></td>
                    <td><?= $data['meter_akhir']; ?></td>
                    <td>
                        <div class="form-button-action">
                            <a href="<?= base_url('edit-penggunaan/'.sha1($data['id_penggunaan'])); ?>">
                                <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    title=""
                                    class="btn btn-link btn-primary btn-lg"
                                    data-original-title="Edit Task"
                                >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>