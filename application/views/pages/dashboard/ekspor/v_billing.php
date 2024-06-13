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
                <h3>Billing</h3>
            </div>
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ekspor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Billing</li>
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
                            <h5 class="card-title">Billing</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="billing" style="width: 100%">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Kat.</th>
                                    <th>MAWB </th>
                                    <th>No. Inv.</th>
                                    <th>Bill to</th>
                                    <th>Chwt.</th>
                                    <th>Total</th>
                                    <th>Billing Date</th>
                                    <th>Kasir</th>
                                    <th>Status</th>
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

<script src="<?= base_url(); ?>assets/dashboard/extensions/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    var tabelBilling = '#billing';

    new DataTable(tabelBilling, {
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url('ekspor/getBilling'); ?>",
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
            $('td:eq(4)', row).addClass('text-end');
            $('td:eq(5)', row).addClass('text-end');
        }
    });

    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script>