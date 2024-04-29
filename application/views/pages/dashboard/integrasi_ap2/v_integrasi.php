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
                <h3>Integrasi AP2</h3>
            </div>
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Integrasi AP2</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Domestik <?= ucfirst($this->uri->segment(2)) ?></li>
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
                            <h5 class="card-title"><?= ucfirst($this->uri->segment(2)) ?></h5>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadExcel">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="integrasi">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Aksi</th>
                                    <th>No. Invoice</th>
                                    <th>No. SMU</th>
                                    <th>Tanggal</th>
                                    <th>Nama agen</th>
                                    <th>Koli</th>
                                    <th>Chwt.</th>
                                    <th>Fee gudang</th>
                                    <th>Total Inv.</th>
                                    <th>User upload</th>
                                    <th>Cetak</th>
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

<div class="modal fade" data-bs-backdrop="static" id="uploadExcel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelTitle">Upload Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('integrasiap2/upload') ?>" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <input type="file" class="form-control" name="fileExcel" id="fileExcel">
                                <label class="input-group-text" for="fileExcel">Upload</label>
                            </div>
                            <div id="information" class="form-text">
                                Please input Excel file.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="button" class="btn btn-primary btn-confirm">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/dashboard/extensions/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    var tabelIntegrasi = '#integrasi';

    <?php
    if ($this->uri->segment(2) == "incoming") {
        $jenis = "I";
    } else if ($this->uri->segment(2) == "outgoing") {
        $jenis = "O";
    } ?>

    new DataTable(tabelIntegrasi, {
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url('integrasiap2/getData/D/' . $jenis); ?>",
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
</script>
<script>
    // Mendapatkan referensi ke elemen input file
    const fileExcel = document.getElementById('fileExcel');
    const formUpload = document.getElementById('formUpload');

    // Menambahkan event listener untuk perubahan pada elemen input file
    fileExcel.addEventListener('change', function() {
        // Memanggil fungsi validasi saat ada perubahan pada input file
        validateFile(this.files[0]);
    });

    // Fungsi validasi file
    function validateFile(file) {
        const allowedExtensions = ['xlsx', 'xls']; // Ekstensi file yang diperbolehkan
        const allowedContentTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']; // Tipe konten file yang diperbolehkan

        // Mendapatkan ekstensi file dari nama file
        const fileExtension = file.name.split('.').pop().toLowerCase();

        // Menentukan pesan dan kelas berdasarkan validasi ekstensi dan tipe konten
        let message = '';
        let className = '';

        if (!allowedExtensions.includes(fileExtension) || !allowedContentTypes.includes(file.type)) {
            message = 'Ekstensi atau tipe file tidak valid. Hanya file Excel (XLSX, XLS) yang diperbolehkan.';
            className = 'text-danger';
            formUpload.reset(); // Reset formulir jika file tidak valid
        } else {
            message = 'Tipe file ' + fileExtension;
            className = 'text-success';
        }

        // Memperbarui pesan dan kelas pada elemen 'information'
        const informationElement = document.getElementById('information');
        informationElement.innerHTML = message;
        informationElement.classList.remove('text-danger', 'text-success');
        informationElement.classList.add(className);
    }
</script>