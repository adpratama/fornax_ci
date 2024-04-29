<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    #users {
        width: 100% !important;
        font-size: 10pt;
    }
</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
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
                            <h5 class="card-title">List of <?= $title ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="users">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Act.</th>
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

<div class="modal fade" data-bs-backdrop="static" id="buatInvoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelTitle">Buat Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('integrasiap2/upload') ?>" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tanggal_invoice">Tanggal Invoice</label>
                                <input type="date" class="form-control" name="tanggal_invoice" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="agen">Agen</label>
                                <select name="agen" id="agen" class="form-select">
                                    <option value="">-- Pilih agen</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="kategori_harga">Kategori Harga</label>
                                <select name="kategori_harga" id="kategori_harga" class="form-select">
                                    <option value="">-- Pilih kategori harga</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tanggal_invoice">Metode bayar</label>
                                <select name="agen" id="agen" class="form-select">
                                    <option value="">-- Pilih metode bayar</option>
                                </select>
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

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    var tabelInvoice = '#users';

    new DataTable(tabelInvoice, {
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url('setting/getDataUser'); ?>",
            "type": "POST",
        },
        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4, 5], // tentukan kolom mana yang dapat diurutkan
            "orderable": false, // tentukan bahwa kolom-kolom tersebut dapat diurutkan
        }],
        "pageLength": 20,
        "lengthMenu": [
            [10, 20, 50, -1],
            [10, 20, 50, 'All']
        ],
    });
</script>

<script>

</script>