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
            <form action="<?php echo base_url('admin/update-pelanggan') ?>" method="post" enctype="multipart/form-data">
            <div class="card-header">
            <div class="card-title">Form Elements</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"
                        >@</span
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        value="<?= $data_edit['username']; ?>"
                        placeholder="Username"
                        aria-label="Username"
                        aria-describedby="basic-addon1"
                        required
                    />
                    </div>
                </div>
                <?php /*
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    value="<?= $data_edit['password']; ?>"
                    placeholder="Password"
                    />
                    <small id="emailHelp2" class="form-text text-muted"
                        >Abaikan jika tidak ingin diubah.</small
                    >
                </div>
                <?php */ ?>
                <div class="form-group">
                    <label for="nokwh">Nomor kWh</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'0123456789+',this)"
                    id="nokwh"
                    name="nokwh"
                    value="<?= $data_edit['nomor_kwh']; ?>"
                    placeholder="Contoh: 51234567890"
                    required
                    />
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1"
                    >Pilih Daya</label
                    >
                    <select
                    class="form-select"
                    id="exampleFormControlSelect1"
                    name="daya"
                    required
                    >
                    <option> ==> Pilih Daya <== </option>
                    <?php
                        foreach ($dataTarif as $data){
                            if ($data['id_tarif'] == $data_edit['id_tarif']) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                    ?>
                        <option value="<?= $data['id_tarif']; ?>" <?= $selected; ?>><?= $data['daya']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                </div>
                <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="largeInput">Nama Pelanggan</label>
                    <input
                    type="text"
                    class="form-control form-control"
                    onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ',this)"
                    id="largeInput"
                    name="namapelanggan"
                    value="<?= $data_edit['nama_pelanggan']; ?>"
                    placeholder="Contoh: Budi Santoso"
                    required
                    />
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 1234567890/,.',this)" id="alamat" name="alamat" value="<?= $data_edit['alamat']; ?>" rows="6" required>
                    </input>
                </div>
                </div>
            </div>
            </div>
            <div class="card-action">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="<?php echo base_url('admin/data-pelanggan') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>