<style>
    #tonnage {
        width: auto;
        height: 300px;
    }
</style>
<div class="page-content">
    <section class="row grid" data-masonry='{"percentPosition": true}'>
        <div class="col-md-6 col-lg-6 col-xl-6 grid-item">
            <div class="card">
                <div class="card-header">
                    <h4>Warehouse Tonnage</h4>
                </div>
                <div class="card-body">
                    <canvas id="tonnage"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 grid-item">
            <div class="card">
                <div class="card-body">
                    <h5 class="m-0 me-2">Needs Approval</h5>
                    <div class="demo-inline-spacing mt-3">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                CGK
                                <a href="#" class="badge bg-primary">5</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                HLP
                                <a href="#" class="badge bg-success">2</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Finance
                                <a href="#" class="badge bg-danger">3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 grid-item">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Outstanding agent</h5>
                        <!-- <small class="text-muted">42.82k Total Sales</small> -->
                    </div>
                </div>
                <div class="card-body mt-3">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex flex-column gap-1">
                            <h2 class="mb-2">IDR <?= number_format($outstanding['piutang'], 2) ?></h2>
                            <span>Total </span>
                        </div>
                        <div id="orderStatisticsChart2"></div>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="badge flex-shrink-0 me-3">
                                <span class="badge <?= ($outstanding['current_sum'] == 0) ? 'bg-primary' : 'bg-success' ?>">Rp</span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Current</h6>
                                    <small class="text-muted">0 - 15 days</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">IDR <?= number_format($outstanding['current_sum'], 2) ?></small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="badge flex-shrink-0 me-3">
                                <span class="badge <?= ($outstanding['out1_sum'] == 0) ? 'bg-primary' : 'bg-success' ?>">Rp</span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Outstanding 1</h6>
                                    <small class="text-muted">15 - 25 days</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">IDR <?= number_format($outstanding['out1_sum'], 2) ?></small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="badge flex-shrink-0 me-3">
                                <span class="badge <?= ($outstanding['out2_sum'] == 0) ? 'bg-primary' : 'bg-success' ?>">Rp</span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Outstanding 2</h6>
                                    <small class="text-muted">26 - 46 days</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">IDR <?= number_format($outstanding['out2_sum'], 2) ?></small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="badge flex-shrink-0 me-3">
                                <span class="badge <?= ($outstanding['out3_sum'] == 0) ? 'bg-primary' : 'bg-success' ?>">Rp</span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Outstanding 3</h6>
                                    <small class="text-muted">47 - 106 days</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">IDR <?= number_format($outstanding['out3_sum'], 2) ?></small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="badge flex-shrink-0 me-3">
                                <span class="badge <?= ($outstanding['out4_sum'] == 0) ? 'bg-primary' : 'bg-success' ?>">Rp</span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Oustanding 4</h6>
                                    <small class="text-muted">More than 160 days</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">IDR <?= number_format($outstanding['out4_sum'], 2) ?></small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 grid-item">
            <div class="card">
                <div class="card-body">

                    <h5 class="m-0 me-2">Shorcut Link</h5>
                    <div class="demo-inline-spacing mt-3">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                BOC
                                <a href="https://boc.bdlwarehouse.com" class="badge bg-primary" target="_blank"><i class="bi bi-link"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                HLP
                                <a href="#" class="badge bg-success"><i class="bi bi-link"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Finance
                                <a href="#" class="badge bg-danger"><i class="bi bi-link"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url() ?>assets/dashboard/vendor/libs/masonry/masonry.js"></script>
<script src="<?= base_url() ?>assets/dashboard/extensions/chart.js/chart.umd.js"></script>
<script>
    <?php
    $month = date("M");
    $month5 = date('M', strtotime('-5 months', strtotime($month)));
    $month4 = date('M', strtotime('-4 months', strtotime($month)));
    $month3 = date('M', strtotime('-3 months', strtotime($month)));
    $month2 = date('M', strtotime('-2 months', strtotime($month)));
    $month1 = date('M', strtotime('-1 months', strtotime($month)));

    ?>
    var chartColors = {
        red: "rgb(255, 99, 132)",
        orange: "rgb(255, 159, 64)",
        yellow: "rgb(255, 205, 86)",
        green: "rgb(75, 192, 192)",
        info: "#41B1F9",
        blue: "#3245D1",
        purple: "rgb(153, 102, 255)",
        grey: "#EBEFF6",
    }
    var ctxBar = document.getElementById("tonnage").getContext("2d")
    var myBar = new Chart(ctxBar, {
        type: "bar",
        data: {
            // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            labels: ["<?= $month5 ?>", "<?= $month4 ?>", "<?= $month3 ?>", "<?= $month2 ?>", "<?= $month1 ?>", "<?= $month ?>"],
            datasets: [{
                    label: 'Import',
                    data: [<?= $import['01'] ?>, <?= $import['02'] ?>, <?= $import['03'] ?>, <?= $import['04'] ?>, <?= $import['05'] ?>, <?= $import['06'] ?>],
                    borderColor: chartColors.red,
                    backgroundColor: chartColors.red,
                },
                {
                    label: 'Export',
                    data: [<?= $export['01'] ?>, <?= $export['02'] ?>, <?= $export['03'] ?>, <?= $export['04'] ?>, <?= $export['05'] ?>, <?= $export['06'] ?>],
                    borderColor: chartColors.blue,
                    backgroundColor: chartColors.blue,
                },
                {
                    label: 'In CGK',
                    data: [<?= $in_cgk['01'] ?>, <?= $in_cgk['02'] ?>, <?= $in_cgk['03'] ?>, <?= $in_cgk['04'] ?>, <?= $in_cgk['05'] ?>, <?= $in_cgk['06'] ?>],
                    borderColor: chartColors.yellow,
                    backgroundColor: chartColors.yellow,
                },
                {
                    label: 'Out CGK',
                    data: [<?= $out_cgk['01'] ?>, <?= $out_cgk['02'] ?>, <?= $out_cgk['03'] ?>, <?= $out_cgk['04'] ?>, <?= $out_cgk['05'] ?>, <?= $out_cgk['06'] ?>],
                    borderColor: chartColors.green,
                    backgroundColor: chartColors.green,
                },
                {
                    label: 'In HLP',
                    data: [<?= $in_hlp['01'] ?>, <?= $in_hlp['02'] ?>, <?= $in_hlp['03'] ?>, <?= $in_hlp['04'] ?>, <?= $in_hlp['05'] ?>, <?= $in_hlp['06'] ?>],
                    borderColor: chartColors.orange,
                    backgroundColor: chartColors.orange,
                },
                {
                    label: 'Out HLP',
                    data: [<?= $out_hlp['01'] ?>, <?= $out_hlp['02'] ?>, <?= $out_hlp['03'] ?>, <?= $out_hlp['04'] ?>, <?= $out_hlp['05'] ?>, <?= $out_hlp['06'] ?>],
                    borderColor: chartColors.purple,
                    backgroundColor: chartColors.purple,
                },
            ],
        },
        options: {
            indexAxis: 'x',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Last 6 months'
                }
            }
        },
    })
</script>