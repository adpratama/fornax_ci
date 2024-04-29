<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?> | Fornax</title>

  <?php $this->load->view('layouts/_style') ?>
</head>

<body onload="startTime()">
  <script src="<?= base_url() ?>assets/dashboard/static/js/initTheme.js"></script>
  <div id="app">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message_name') ?>"></div>
    <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('message_error') ?>"></div>

    <!-- Navbar -->

    <?php $this->load->view('layouts/_navbar') ?>


    <!-- Menu -->
    <?php $this->load->view('layouts/_sidebar') ?>
    <!-- / Menu -->

    <div id="main">

      <!-- Content -->
      <?php if (isset($pages)) $this->load->view($pages) ?>
      <!-- / Content -->


      <!-- Footer -->
      <?php $this->load->view('layouts/_footer') ?>
      <!-- / Footer -->
    </div>
  </div>
  <!-- Script -->
  <?php $this->load->view('layouts/_script') ?>
  <!-- / Script -->
</body>

</html>