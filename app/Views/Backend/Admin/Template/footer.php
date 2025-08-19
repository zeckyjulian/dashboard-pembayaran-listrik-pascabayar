                  </div>
      </div>
    </div>
<!--   Core JS Files   -->
    <script src="/Assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="/Assets/js/core/popper.min.js"></script>
    <script src="/Assets/js/core/bootstrap.min.js"></script>
    <script src="/Assets/js/sweetalert2.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/Assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="/Assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="/Assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="/Assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="/Assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="/Assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="/Assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Kaiadmin JS -->
    <script src="/Assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="/Assets/js/setting-demo.js"></script>
    <script src="/Assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
    <script>
      $(document).ready(function () {
      // Add Row
      $("#add-row").DataTable({
          pageLength: 5,
      });

      var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function () {
          $("#add-row")
          .dataTable()
          .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
          ]);
          $("#addRowModal").modal("hide");
      });
      });
    </script>
    <?php if (session()->getFlashdata('success')) : ?>
    <script type="text/javascript">
      $(document).ready(function() {
      swal("Success!", "<?php echo $_SESSION['success'] ?>", "success");
      });
    </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
    <script type="text/javascript">
      $(document).ready(function() {
      swal("Sorry!", "<?php echo $_SESSION['error'] ?>", "error");
      });
    </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('warning')) : ?>
    <script type="text/javascript">
      $(document).ready(function() {
      swal("Warning!", "<?php echo $_SESSION['warning'] ?>", "warning");
      });
    </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('info')) : ?>
    <script type="text/javascript">
      $(document).ready(function() {
      swal("Info!", "<?php echo $_SESSION['info'] ?>", "info");
      });
    </script>
    <?php endif; ?>
  </body>
</html>
