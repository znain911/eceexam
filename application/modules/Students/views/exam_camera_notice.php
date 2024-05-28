<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Notice | Distance Learning Programme (DLP)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="CT Health Ltd" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

       <!-- jquery.vectormap css -->
        <link href="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url();?>assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/webcam.js"></script>
    </head>

    <body data-topbar="light" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php $this->load->view('includes/topbarstudent');?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title-->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Exam Camera Option</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Camera Option</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                         <!--end page title -->


                        <div class="row justify-content-center">
                            <div class="col-xl-7">
                                <div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Webcam</h5>
								  </div>
								  <div style= "margin: auto;" class="modal-body">
									
								    <h6>"To proceed to exam please provide permission to switch on your camera" Button should say OK</h6>
									<!--<h6>"If your device does not camera then please select Skip" Button should say Skip</h6>-->
									<!--<button type="button" class="btn btn-warning waves-effect waves-light" id="skip" >Start Exam</button>-->
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-info" id="cameraon">OK</button>
									<!-- <a href="<?php echo base_url('students/makeexampca/').$examinfo->schedule_id;?>" class="btn btn-warning waves-effect waves-light" id="skip" >Skip</a> -->

									<!--<button type="button" class="btn btn-warning waves-effect waves-light" id="skip" >Skip</button>-->
								  </div>
								</div>
                            </div>
                            <!-- <div class="col-md-2">
                                <div id="preview">Your captured image will appear here...</div>
                            </div> -->
                        </div>
                        <!-- end row -->

                        
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php $this->load->view('includes/footer');?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        <script type="text/javascript">
            $(document).ready(function(){
            $("#skip").click(function(){
            var camevalue = 0;
            var sdlid = <?php echo $examinfo->schedule_id; ?>;
            var stid = <?php echo $metadata['id'];?>;
            var qt = <?php echo $qtype;?>;
                    jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('students/savedata_cam'); ?>",
                    dataType: 'html',
                    data: {camevalue: camevalue, sdlid: sdlid,stid:stid, qt:qt},
                    success: function(res) 
                    {
                        /*alert('data saved');*/ 
                        window.location.href = '<?php echo base_url('students/makeexamece/').$examinfo->schedule_id.'/'.$qtype;?>';
                    },
                    error:function()
                    {
                        alert('data not saved');    
                    }
                    });                

            });

            $("#cameraon").click(function(){
            var camevalue = 1;
            var sdlid = <?php echo $examinfo->schedule_id; ?>;
            var stid = <?php echo $metadata['id'];?>;
            var qt = <?php echo $qtype;?>;
                    jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('students/savedata_cam'); ?>",
                    dataType: 'html',
                    data: {camevalue: camevalue, sdlid: sdlid,stid:stid, qt:qt},
                    success: function(res) 
                    {
                        /*alert('data saved');*/ 
                        window.location.href = '<?php echo base_url('students/cameraoption/').$examinfo->schedule_id.'/'.$qtype;;?>';
                    },
                    error:function()
                    {
                        alert('data not saved');    
                    }
                    });                

            });
        });
        </script>
        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

        <!-- Required datatable js -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


        <script src="<?php echo base_url();?>assets/js/app.js"></script>

    </body>
</html>
