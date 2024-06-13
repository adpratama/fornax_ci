<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview justify-content-center">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <!-- <button onclick="printCardBody()" class="btn btn-primary mb-3">Print</button> -->
                    <div id="printArea">
                        <!-- Existing content -->
                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-3 gap-2">
                                    <span class="app-brand-logo demo">
                                        <img src="<?= base_url() ?>assets/img/logo_bdl.png" alt="" class="w-10 p-2 h-auto bg-dark">
                                    </span>
                                </div>
                                <h5 class="app-brand-text demo text-body fw-bold">Bangun Desa Logistindo</h5>
                                <p class="mb-1">Area Cargo Bandara Soekarno Hatta Warehousing Lini 1</p>
                                <p class="mb-1">Kel. Panjang - Kec. Benda, Tangerang Banten</p>
                                <p class="mb-0">NPWP : 03.223.536.8 - 402.000</p>
                            </div>
                            <div class="text-end">
                                <h4><?= $invoice['invoice']['no_invoice'] ?></h4>
                                <div class="mb-2">
                                    <span class="me-1">Tanggal:</span>
                                    <span class="fw-medium"><?= ($invoice['invoice']['tanggal_kirim']) ? format_indo_non_hari($invoice['invoice']['tanggal_kirim']) : '-' ?></span>
                                </div>
                                <div>
                                    <span class="me-1">Agen:</span>
                                    <span class="fw-medium"><?= $invoice['invoice']['nama_agen'] ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Table and other content -->
                        <div class="table-responsive">
                            <table class="table border-top m-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>SMU</th>
                                        <th>Lama</th>
                                        <th>Koli</th>
                                        <th>Berat</th>
                                        <th>Volume</th>
                                        <th>Kade</th>
                                        <th>CSC</th>
                                        <th>Gudang</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $sub_total = 0;
                                    $administration = 0;
                                    $materai = 0;
                                    $pajak = 0;
                                    $total = 0;
                                    foreach ($invoice['details'] as $d) {
                                        $kade = $d->kade;
                                        $csc_fee = $d->csc_fee;
                                        $cargo_chg = $d->cargo_chg;
                                        $administration_fee = $d->administration_fee;
                                        $materai_fee = $d->materai_fee;
                                        $ppn_fee = $d->ppn_fee;

                                        // cek csc fee
                                        if (!$csc_fee) {
                                            $csc_fee = 0;
                                        } else if ($csc_fee == "-") {
                                            $csc_fee = 0;
                                        } else {
                                            $csc_fee = $csc_fee;
                                        }

                                        // cek administration fee
                                        if (!$administration_fee) {
                                            $administration_fee = 0;
                                        } else if ($administration_fee == "-") {
                                            $administration_fee = 0;
                                        } else {
                                            $administration_fee = $administration_fee;
                                        }

                                        // cek materai fee
                                        if (!$materai_fee) {
                                            $materai_fee = 0;
                                        } else if ($materai_fee == "-") {
                                            $materai_fee = 0;
                                        } else {
                                            $materai_fee = $materai_fee;
                                        }
                                        $total_per_smu = $kade + $csc_fee + $cargo_chg; ?>
                                        <tr>
                                            <td><?= ++$no; ?></td>
                                            <td><?= $d->no_smu ?></td>
                                            <td><?= $d->jml_hari ?></td>
                                            <td class="text-end"><?= $d->koli ?></td>
                                            <td class="text-end"><?= number_format($d->berat) ?></td>
                                            <td class="text-end"><?= number_format($d->volume) ?></td>
                                            <td class="text-end"><?= number_format($d->kade) ?></td>
                                            <td class="text-end"><?= number_format($d->csc_fee) ?></td>
                                            <td class="text-end"><?= number_format($d->cargo_chg) ?></td>
                                            <td class="text-end"><?= number_format($d->total_pendapatan_tanpa_ppn) ?></td>
                                        </tr>
                                    <?php
                                        $sub_total += $total_per_smu;
                                        $administration += $administration_fee;
                                        $materai += $materai_fee;
                                        $pajak += $ppn_fee;
                                        $total += $d->total_pendapatan_dengan_ppn;
                                    } ?>
                                    <tr>
                                        <td colspan="8" class="align-top px-4 py-5">
                                            <p class="mb-2">
                                                <span class="me-1 fw-medium">Salesperson:</span>
                                                <span>Alfie Solomons</span>
                                            </p>
                                            <span>Thanks for your business</span>
                                        </td>
                                        <td class="text-end px-4 py-5">
                                            <p class="mb-2">Subtotal:</p>
                                            <p class="mb-2">PPn 11%:</p>
                                            <p class="mb-2">Administrasi:</p>
                                            <p class="mb-0">Materai:</p>
                                            <hr>
                                            <p class="mb-0 fw-bold">Total:</p>
                                        </td>
                                        <td class="text-end px-4 py-5">
                                            <p class="fw-medium mb-2"><?= number_format($sub_total) ?></p>
                                            <p class="fw-medium mb-2"><?= number_format($pajak) ?></p>
                                            <p class="fw-medium mb-2"><?= number_format($administration) ?></p>
                                            <p class="fw-medium mb-0"><?= number_format($materai) ?></p>
                                            <hr>
                                            <p class="fw-bold mb-0"><?= number_format($total) ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-medium">Terbilang:</span>
                                <span class="fw-bold"><?= terbilang($total) ?> Rupiah</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice -->
    </div>
</div>