        
                    </div>
                </div>
            </div>

        <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <?php //require_once('rightSidebar.php');?>
        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Choose Demos
        </a> -->
        
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>         
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>       
        <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>        
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <?php
            if (isset($_GET['error']) || isset($_GET['success'])) {
                // Handle the message
                if (isset($_GET['error'])) {
                    $message = $_GET['error'];
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: '$message',
                            type: 'error',
                            showConfirmButton: '!1',
                            position: 'top-end',
                            timer: '1000'
                        });
                    </script>";
                }

                if (isset($_GET['success'])) {
                    $message = $_GET['success'];
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '$message',
                            type: 'success',
                            showConfirmButton: '!1',
                            position: 'top-end',
                            timer: '1000'
                        });
                    </script>";
                }
            }
            ?>
    </body>
</html>