<div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Kalkulator Tagihan Listrik</h3>
                        <h6 class="op-7 mb-2">Gunakan form di bawah untuk menghitung estimasi tagihan listrik pascabayar Anda.</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Form Perhitungan</div>
                            </div>
                            <div class="card-body">
                                <form id="form-tagihan">
                                    <div class="form-group">
                                        <label for="id-pelanggan">ID Pelanggan</label>
                                        <input type="text" class="form-control" id="id-pelanggan" placeholder="Contoh: 51234567890" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="daya">Golongan Daya (VA)</label>
                                        <select class="form-select" id="daya" required>
                                            <option value="" disabled selected>Pilih Golongan Daya</option>
                                            <option value="1352.00">900 VA</option>
                                            <option value="1444.70">1.300 VA</option>
                                            <option value="1444.70">2.200 VA</option>
                                            <option value="1699.53">3.500 - 5.500 VA</option>
                                            <option value="1699.53">6.600 VA ke atas</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="meter-lalu">Stand Meter Bulan Lalu (kWh)</label>
                                        <input type="number" class="form-control" id="meter-lalu" placeholder="Contoh: 1500" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="meter-kini">Stand Meter Bulan Ini (kWh)</label>
                                        <input type="number" class="form-control" id="meter-kini" placeholder="Contoh: 1650" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Hitung Tagihan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card hasil-sembunyi" id="card-hasil">
                            <div class="card-header">
                                <h4 class="card-title">⚡ Hasil Perhitungan</h4>
                            </div>
                            <div class="card-body">
                                <div class="detail-hasil">
                                    <p><strong>ID Pelanggan:</strong> <span id="hasil-id"></span></p>
                                    <p><strong>Total Pemakaian:</strong> <span><span id="hasil-pemakaian-kwh"></span> kWh</span></p>
                                    <p><strong>Tarif per kWh:</strong> <span>Rp. <span id="hasil-tarif-kwh"></span></span></p>
                                    <hr>
                                    <p><strong>Subtotal Pemakaian:</strong> <span>Rp. <span id="hasil-subtotal"></span></span></p>
                                    <p><strong>Biaya Admin Bank:</strong> <span>Rp. <span id="hasil-admin"></span></span></p>
                                    <h4 class="fw-bold"><strong>Total Tagihan:</strong> <span>Rp. <span id="hasil-total"></span></span></h4>
                                </div>
                                <p class="disclaimer">*Perhitungan ini adalah estimasi. Tagihan resmi mengikuti data dari PLN.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formTagihan = document.getElementById('form-tagihan');
        // Ubah target ke elemen card hasil
        const kartuHasil = document.getElementById('card-hasil');
        const biayaAdmin = 3000;

        formTagihan.addEventListener('submit', function (event) {
            event.preventDefault(); 
            const idPelanggan = document.getElementById('id-pelanggan').value;
            const biayaPerKwh = parseFloat(document.getElementById('daya').value);
            const meterLalu = parseFloat(document.getElementById('meter-lalu').value);
            const meterKini = parseFloat(document.getElementById('meter-kini').value);

            if (!idPelanggan || isNaN(biayaPerKwh) || isNaN(meterLalu) || isNaN(meterKini)) {
                alert('Harap isi semua kolom dengan benar!');
                return;
            }

            if (meterKini < meterLalu) {
                alert('Stand Meter Bulan Ini tidak boleh lebih kecil dari Stand Meter Bulan Lalu.');
                return;
            }

            const pemakaianKwh = meterKini - meterLalu;
            const subtotal = pemakaianKwh * biayaPerKwh;
            const totalTagihan = subtotal + biayaAdmin;

            document.getElementById('hasil-id').textContent = idPelanggan;
            document.getElementById('hasil-pemakaian-kwh').textContent = pemakaianKwh.toFixed(2).replace('.', ',');
            document.getElementById('hasil-tarif-kwh').textContent = formatRupiah(biayaPerKwh, true);
            document.getElementById('hasil-subtotal').textContent = formatRupiah(subtotal);
            document.getElementById('hasil-admin').textContent = formatRupiah(biayaAdmin);
            document.getElementById('hasil-total').textContent = formatRupiah(totalTagihan);

            // Tampilkan card hasil
            kartuHasil.classList.remove('hasil-sembunyi');
        });

        function formatRupiah(angka, isTariff = false) {
            if (isTariff) {
                return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(angka);
            }
            return new Intl.NumberFormat('id-ID').format(Math.round(angka));
        }
    });
</script>