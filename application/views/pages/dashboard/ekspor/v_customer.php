<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    #integrasi {
        width: 100% !important;
        font-size: 10pt;
    }
</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Customer</h3>
            </div>
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ekspor</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($tipe) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title"><?= ucfirst($tipe) ?></h5>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNew">
                                Tambah <?= ucfirst($tipe) ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="customer">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Kode anggota</th>
                                    <th>Nama <?= ucfirst($tipe) ?></th>
                                    <th>Kota</th>
                                    <th>No. Kontak</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" data-bs-backdrop="static" id="addNew" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNew">Form tambah data <?= $tipe ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('integrasiap2/upload') ?>" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="modal-body">

                    <input type="hidden" name="jenis_customer" value="<?= $tipe ?>">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Nama <?= $tipe ?> <code>*</code></label>
                                <input type="text" class="form-control" name="name" placeholder="Maksimal 35 karakter" maxlength="35" oninput="this.value = this.value.toUpperCase()" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Alamat jalan <code>*</code></label>
                                <input type="text" class="form-control" name="alamat_jalan" placeholder="Maksimal 35 karakter" maxlength="35" oninput="this.value = this.value.toUpperCase()" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Kota <code>*</code></label>
                                <input type="text" class="form-control" name="kota" placeholder="Maksimal 17 karakter" maxlength="17" oninput="this.value = this.value.toUpperCase()" required />
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="basicInput">Provinsi</label>
                                <input type="text" class="form-control" name="provinsi" placeholder="Maksimal 17 karakter" maxlength="17" oninput="this.value = this.value.toUpperCase()" />
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="basicInput">Kode negara</label>
                                <input type="text" class="form-control" name="kode_negara" placeholder="Maksimal 2 karakter" maxlength="2" oninput="this.value = this.value.toUpperCase()" />
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="basicInput">Kode pos <code>*</code></label>
                                <input type="text" class="form-control" name="kode_pos" placeholder="Maksimal 9 karakter" maxlength="9" oninput="validateNumber(this)" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Jenis kontak</label>
                                <select name="jenis_kontak" id="jenis_kontak" class="form-select">
                                    <option value="">:: Pilih</option>
                                    <option value="FAX">Fax</option>
                                    <option value="TE">Telepon</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">No. Kontak</label>
                                <input type="text" class="form-control" name="nomor_kontak" placeholder="Maksimal 25 karakter" maxlength="25" oninput="validateNumber(this)" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">No. NPWP <code>*</code></label>
                                <input type="text" class="form-control" name="no_npwp" placeholder="Minimal 15 karakter" maxlength="20" oninput="validateNumber(this)" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">IATA Code</label>
                                <input type="text" class="form-control" name="iata_code" placeholder="Maksimal 7 karakter" maxlength="7" oninput="validateNumber(this)" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="basicInput">Alamat NPWP <code>*</code></label>
                                <textarea name="alamat_npwp" id="alamat_npwp" class="form-control" oninput="this.value = this.value.toUpperCase()" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary btn-confirm">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/dashboard/extensions/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    var tabelCustomer = '#customer';

    <?php
    if ($this->uri->segment(3) == "shipper") {
        $jenis = "shipper";
    } else if ($this->uri->segment(3) == "agent") {
        $jenis = "agent";
    } else if ($this->uri->segment(3) == "consignee") {
        $jenis = "consignee";
    } else {
        $jenis = "";
    } ?>

    new DataTable(tabelCustomer, {
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url('ekspor/getCustomer/' . $jenis); ?>",
            "type": "POST",
        },
        "columnDefs": [-1],
        "orderable": false,
        "pageLength": 20,
        "lengthMenu": [
            [10, 20, 50, -1],
            [10, 20, 50, 'All']
        ],
        "createdRow": function(row, data, dataIndex) {
            // Menambahkan kelas pada satu td
            $('td:eq(5)', row).addClass('text-end'); // Ubah '0' menjadi indeks kolom yang diinginkan
            $('td:eq(6)', row).addClass('text-end'); // Ubah '0' menjadi indeks kolom yang diinginkan
            $('td:eq(7)', row).addClass('text-end'); // Ubah '0' menjadi indeks kolom yang diinginkan
            $('td:eq(8)', row).addClass('text-end'); // Ubah '0' menjadi indeks kolom yang diinginkan
        }
    });

    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script>