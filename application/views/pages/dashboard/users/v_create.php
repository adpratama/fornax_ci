<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Invoice</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content" style="min-height: 500px;">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Buat Invoice</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a href="<?= base_url('hlp/invkhususra') ?>" class="btn btn-warning btn-sm text-white">Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('hlp/invkhususra/store') ?>" method="post">
                        <div class="row mb-3">
                            <div class="divider divider-left">
                                <div class="divider-text">
                                    Data Invoice
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal_invoice">Tanggal Invoice</label>
                                    <input type="date" class="form-control" name="tanggal_invoice" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="agen">Bill to</label>
                                    <select name="agen" id="agen" class="form-select" required>
                                        <option value="">-- Pilih agen</option>
                                        <?php
                                        foreach ($agents as $a) :
                                        ?>
                                            <option value="<?= $a->uid  ?>"><?= $a->nama_agent ?></option>
                                        <?php
                                        endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kategori_harga">Kategori Harga</label>
                                    <select name="kategori_harga" id="kategori_harga" class="form-select" required>
                                        <option value="">-- Pilih kategori harga</option>
                                        <?php
                                        foreach ($kategoriHarga as $k) :
                                        ?>
                                            <option value="<?= $k->uid ?>"><?= $k->nama_billing ?></option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal_invoice">Metode bayar</label>
                                    <select name="agen" id="agen" class="form-select" required>
                                        <option value="">-- Pilih metode bayar</option>
                                        <option value='1'>Deposit</option>
                                        <option value='2'>Cash</option>
                                        <option value='3'>Transfer</option>
                                        <option value='4'>Tagihan</option>
                                        <option value='5'>FOC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="divider divider-left">
                                <div class="divider-text">
                                    Data SMU
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_pengirim">No. SMU</label>
                                    <input type="hidden" name="id_smu" id="id_smu" class="form-control">
                                    <input type="text" name="no_smu" id="no_smu" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_penerima">Tujuan</label>
                                    <input type="text" name="tujuan" id="tujuan" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="komoditi">Komoditi</label>
                                    <input type="text" class="form-control" name="komoditi" id="komoditi" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_pengirim">Koli</label>
                                    <input type="text" name="koli" id="koli" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_penerima">Berat RA</label>
                                    <input type="text" name="berat_ra" id="berat_ra" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_agen">Chargeable</label>
                                    <input type="text" class="form-control" name="chargeable" id="chargeable" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_pengirim">Pengirim</label>
                                    <input type="text" class="form-control" name="pengirim" id="pengirim" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_penerima">Penerima</label>
                                    <input type="text" class="form-control" name="penerima" id="penerima" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nama_agen">Agen</label>
                                    <input type="text" class="form-control" name="nama_agen" id="nama_agen" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- jQuery -->
<script src="<?= base_url() ?>assets/jquery-ui-1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        aData = {}
        $("#no_smu").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('hlp/invkhususra/getSmu'); ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        aData = $.map(data, function(value, key) {
                            return {
                                id: value.uid,
                                label: value.smu,
                                tujuan: value.tujuan,
                                koli: value.jumlah_ra,
                                berat_ra: value.berat_ra,
                                chargeable: value.chargeable,
                                komoditi: value.komoditi,
                                pengirim: value.nama_pengirim,
                                penerima: value.nama_penerima,
                                agen: value.nama_agent,
                            };
                        });
                        var results = $.ui.autocomplete.filter(aData, request.term);
                        response(results);
                    }
                });
            },
            minLength: 5, // Jumlah karakter minimum sebelum pencarian dimulai
            select: function(event, ui) {
                // Setel nilai input dengan label dari item yang dipilih
                $('#no_smu').val(ui.item.label);
                $('#id_smu').val(ui.item.id);
                $('#tujuan').val(ui.item.tujuan);
                $('#koli').val(ui.item.koli);
                $('#berat_ra').val(ui.item.berat_ra);
                $('#chargeable').val(ui.item.chargeable);
                $('#komoditi').val(ui.item.komoditi);
                $('#penerima').val(ui.item.penerima);
                $('#pengirim').val(ui.item.pengirim);
                $('#nama_agen').val(ui.item.agen);
            }
        });
    });
</script>