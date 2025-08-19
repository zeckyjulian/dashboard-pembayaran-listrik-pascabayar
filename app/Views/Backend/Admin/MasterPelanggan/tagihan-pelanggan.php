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

    <!-- Table Tagihan Listrik -->

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Tagihan Listrik Pelanggan</h4>
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
                    <th>Nama Pelanggan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah Meter</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>No.</th>
                    <th>Nomor kWh</th>
                    <th>Nama Pelanggan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Jumlah Meter</th>
                    <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $no = 0;
                        foreach ($dataTagihan as $data) {
                    ?>
                    <tr>
                    <td><?= $no=$no+1; ?></td>
                    <td><?= $data['nomor_kwh']; ?></td>
                    <td><?= $data['nama_pelanggan']; ?></td>
                    <td><?= $data['bulan']; ?></td>
                    <td><?= $data['tahun']; ?></td>
                    <td><?= $data['jumlah_meter']; ?></td>
                    <td><?= $data['status']; ?></td>
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