<style>
    .parent-row {
        cursor: pointer;
    }

    .child-row {
        display: none;
        background-color: #e8e8e8;
    }

    .child-row.visible {
        display: table-row;
    }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/extensions/choices.js/public/assets/styles/choices.css" />

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
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
                            <h5 class="card-title"><?= $title ?></h5>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-outline-primary block btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMenu">
                                Add new menu
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Has Submenu</th>
                                    <th>Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($menu as $m) :
                                    $id = $m->Id;
                                    $submenu = $this->M_Setting->get_submenus($id); ?>
                                    <tr class="parent-row" data-id="<?= $id ?>">
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $m->nama_menu ?></td>
                                        <td><?= $m->url ?></td>
                                        <td><?= ($m->has_child == "1") ? "Yes" : "No" ?></td>
                                        <td>
                                            <a href="#" class="btn btn-outline-info btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?= ($m->has_child == "1") ? '<button class="btn btn-primary btn-sm show-submenu"><i class="bi bi-eye"></i></button>' : '' ?>
                                        </td>
                                    </tr>
                                    <?php
                                    foreach ($submenu as $s) :
                                    ?>
                                        <tr class="child-row submenu-of-<?= $m->Id ?> parent-<?= $m->Id ?>">
                                            <td></td>
                                            <td><?= $s->nama_menu ?></td>
                                            <td><?= $s->url ?></td>
                                            <td><?= ($s->has_child == "1") ? "Ya" : "Tidak" ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" data-bs-backdrop="static" id="tambahMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelTitle">Add new menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/addNewMenu') ?>" method="post" id="formUpload">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama_menu">Menu name</label>
                                <input type="text" class="form-control" name="nama_menu" placeholder="ex: Menu" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input name="url" id="url" class="form-control" placeholder="ex: setting/menu" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="has_child">Has child</label>
                                <select name="has_child" id="has_child" class="form-select">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12" id="parent_id_wrapper">
                            <div class="form-group">
                                <label for="parent_id">Parent ID</label>
                                <select name="parent_id" id="parent_id" class="choices form-select">
                                    <option value="">-- Select parent ID</option>
                                    <?php
                                    foreach ($menu as $me) :
                                    ?>
                                        <option value="<?= $me->Id ?>"><?= $me->nama_menu ?></option>
                                    <?php
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <div class="col-12" id="child_menu" style="display: none;">
                            <table class="table table-responsive text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>URL</th>
                                        <th>Del.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="baris">
                                        <td>
                                            <input type="text" class="form-control" name="menu_child[]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="url_child[]">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm hapusRow">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary btn-sm" id="addRow">Add new row</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary btn-confirm">Add new</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/dashboard/extensions/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const showSubmenus = document.querySelectorAll('.show-submenu');

        showSubmenus.forEach(function(showSubmenu) {
            showSubmenu.addEventListener('click', function() {
                const parentRow = showSubmenu.closest('.parent-row');
                const parentId = parentRow.dataset.id;
                const childRows = document.querySelectorAll('.submenu-of-' + parentId);

                childRows.forEach(function(childRow) {
                    childRow.style.display = childRow.style.display === 'none' ? 'table-row' : 'none';
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hasChildSelect = document.getElementById('has_child');
        const parentIdWrapper = document.getElementById('parent_id_wrapper');
        const parentIdSelect = document.getElementById('parent_id');
        const childMenu = document.getElementById('child_menu');

        hasChildSelect.addEventListener('change', function() {
            if (hasChildSelect.value === '1') {
                parentIdWrapper.style.display = 'none'; // menyembunyikan parent_id
                parentIdSelect.value = ''; // mengatur nilai parent_id menjadi NULL
                childMenu.style.display = 'block';
            } else {
                parentIdWrapper.style.display = 'block'; // menampilkan parent_id jika has_child tidak dipilih
                childMenu.style.display = 'none';
            }
        });
    });
</script>
<script>
    var rowCount = 1; // Inisialisasi row

    $('#addRow').on('click', function() {
        // Periksa apakah ada input yang kosong di baris sebelumnya
        var previousRow = $('.baris').last();
        var inputs = previousRow.find('input[type="text"]');
        var isEmpty = false;

        inputs.each(function() {
            if ($(this).val().trim() === '') {
                isEmpty = true;
                return false; // Berhenti iterasi jika ditemukan input kosong
            }
        });

        // Jika ada input yang kosong, tampilkan pesan peringatan
        if (isEmpty) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon isi semua input pada baris sebelumnya terlebih dahulu!',
            });
            return; // Hentikan penambahan baris baru
        }

        // Salin baris terakhir
        var newRow = previousRow.clone();

        // Kosongkan nilai input di baris baru
        newRow.find('input').val('');
        newRow.find('input[name="menu_child[]"]');
        newRow.find('input[name="url_child[]"]');

        // Perbarui tag <h4> pada baris baru dengan nomor urut yang baru
        rowCount++;

        // Tambahkan baris baru setelah baris terakhir
        previousRow.after(newRow);
    });
    $(document).on('click', '.hapusRow', function() {
        // Mendapatkan jumlah baris
        var rowCount = $('.baris').length;

        // Jika jumlah baris lebih dari satu, maka hapus baris
        if (rowCount > 1) {
            $(this).closest('.baris').remove();
        } else {
            // Jika jumlah baris hanya satu, tampilkan pesan atau lakukan tindakan lain
            alert('Tidak dapat menghapus baris terakhir.');
        }
    });
</script>

<script src="<?= base_url(); ?>assets/dashboard/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="<?= base_url(); ?>assets/dashboard/static/js/pages/form-element-select.js"></script>