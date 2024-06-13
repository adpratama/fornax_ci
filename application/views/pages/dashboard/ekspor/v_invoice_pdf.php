<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        body {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }

        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* #table tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        /* #table tr:hover {
            background-color: #ddd;
        } */

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #f1f1f1;
            color: black;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h4 style="text-align: center;">INVOICE</h4>
    <table>
        <tbody>
            <tr>
                <td style="width: 400px">
                    <img src="<?= base_url(); ?>assets/img/logo_bdl_black.png" style="width: 100px;" alt="">
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 35%; vertical-align:top;">
                    <p>
                        <br>
                        Warehouse Operator Lini 1 <br>
                        SHIA Cargo Terminal <br>
                        Tel: 021 26865729 <br>
                        Fax: 021 29865731 <br>
                        E-Mail : export@bdlwarehouse.com <br>
                        E-Mail Pajak : pajak@bdlwarehouse.com
                    </p>
                </td>
                <td style="width: 35%; vertical-align:top;">
                    <p>
                        <strong>KEPADA:</strong> <br>
                        SHIA Cargo Terminal <br>
                        Tel: 021 26865729 <br>
                        Fax: 021 29865731 <br>
                    </p>
                </td>
                <td style="width: 30%; vertical-align:top;">
                    <p>
                        <br>
                        No. Invoice: <?= $invoice['invoice_num'] ?> <br>
                        Tanggal Inv: <?= format_indo_non_hari($invoice['tanggal_bayar']) ?> <br>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="table">
        <tbody>
            <tr>
                <td rowspan="2">No.</td>
                <td>SMU</td>
                <td>Penerbangan</td>
                <td>Tujuan</td>
                <td>Komoditas</td>
                <td>Jumlah</td>
                <td>Chwt.</td>
                <td>Harga Satuan</td>
                <td>Total</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td><?= $invoice['awb_num'] . ' / ' . $invoice['hawb_num'] ?></td>
                <td><?= $invoice['flight_num'] ?></td>
                <td><?= $invoice['destination'] ?></td>
                <td><?= $invoice['gtreat'] ?></td>
                <td><?= $invoice['qty'] ?></td>
                <td><?= $invoice['weight_charge'] ?></td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <?php
            $no = 1;

            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td colspan="5">Jasa gudang</td>
                <td class="text-center"><?= $invoice['weight_charge'] ?></td>
                <td class="text-right"><?= $invoice['bill_catg'] ?></td>
                <td class="text-right"><?= number_format($invoice['total_charge_all']) ?></td>
                <td>Hari</td>
            </tr>
        </tbody>
    </table>

    <!-- <p style="margin-top: 30px;">Keterangan: <br><?= $invoice['keterangan'] ?></p> -->
    <p style="margin-top: 100px;">Bank BCA 2060888399 a.n Handayani</p>
</body>

</html>