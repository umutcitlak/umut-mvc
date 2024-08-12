<!doctype html>

<html lang="tr">

<head>
  <?php include_once "layoutcomponents/head.php"; ?>
</head>

<body>
  <script src="/public/js/demo-theme.min.js?1692870487"></script>
  <div class="page">
    <!-- Sidebar -->
    <?php include_once "layoutcomponents/sidebar.php"; ?>
    <div class="page-wrapper">
      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Overview
              </div>
              <h2 class="page-title">
                Vertical layout
              </h2>
            </div>


          </div>

          <div class="row g-2 align-items-center">

            <div class="col">
              <?php echo $viewcontent; ?>
            </div>

          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">

        </div>
      </div>

    </div>
  </div>
  
  </div>
  </div>
  <?php include_once "layoutcomponents/scripts.php"; ?>
</body>

</html>