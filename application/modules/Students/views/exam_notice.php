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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Exam Notice</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Exam Notice</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="row justify-content-center">
                            <div class="col-xl-7">
                                <h2>Instructions<?php //echo $examinfo->schedule_name;?></h2>
                                <p><?php /*echo $examinfo->exam_notice;*/?></p>
                               <p class="justify-content-center">
                                <?php if ($examinfo->tma == 3) {?>
                                    <?php
                                    /*if(empty($eceexamstatus)){
                                        $theorybtn = 'enable';
                                        $oscebtn = 'disabled';
                                        $ospebtn = 'disabled';
                                    }else{
                                        if($eceexamstatus->qtype == 1){
                                            $theorybtn = 'disabled';
                                            $oscebtn = 'enable';
                                            $ospebtn = 'disabled';
                                        }elseif($eceexamstatus->qtype == 2){
                                            $theorybtn = 'disabled';
                                            $oscebtn = 'disabled';
                                            $ospebtn = 'enable';
                                        }else{
                                            $theorybtn = 'enable';
                                            $oscebtn = 'disabled';
                                            $ospebtn = 'disabled';
                                        }
                                    }*/
                                    $stid = $metadata['id'];
                                    $eid = $examinfo->schedule_id;
                                    $thry = 1;
                                    $sc = 2;
                                    $sp = 3;
                                    $examdatathry = $this->students_m->getExambyScheduleEce($stid,$eid,$thry);
                                     if (empty($examdatathry)) {?>

                                    
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalThry">
                                      Start Exam (Theory)
                                    </button>
                                    <?php }else{ ?>
<a href="javascript:void(0)" class="btn btn-warning waves-effect waves-light">Attended</a>
                                    <?php    $passedst = $this->students_m->getPassedExamEce($stid,$eid,$thry);

                                        if (empty($passedst)) {?>
                                        <!-- <a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/1" class="btn btn-warning waves-effect waves-light" >Start Retake (Theory)</a> -->
                                        <?php }else{?>
                                        <!-- <a href="javascript:void(0)" class="btn btn-warning waves-effect waves-light">Already Passed</a> -->


                                    <?php } ?> 
                                <?php } ?>

                                    <?php $examdatasc = $this->students_m->getExambyScheduleEce($stid,$eid,$sc);
                                     if (empty($examdatasc)) {?>
                                    <!-- <a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/2" class="btn btn-info waves-effect waves-light" >Start Exam (OSCE)</a> -->
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                      Start Exam (OSCE)
                                    </button>

                                    <?php }else{?>
                                        <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light">Attended</a>


                                      <?php  $passedstsc = $this->students_m->getPassedExamEce($stid,$eid,$sc);

                                        if (empty($passedstsc)) {?>
                                        <!-- <a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/2" class="btn btn-info waves-effect waves-light" >Start Retake (OSCE)</a> -->
                                        <?php }else{?>
                                        <!-- <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light">Already Passed</a> -->
                                      <?php } ?>  
                                    <?php } ?>

                                    <?php $examdatasp = $this->students_m->getExambyScheduleEce($stid,$eid,$sp);
                                     if (empty($examdatasp)) {?>
                                    
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalOspe">
                                      Start Exam (OSPE)
                                    </button>
                                    <?php }else{?>

                                        <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light">Attended</a>
                                    <?php $passedstsp = $this->students_m->getPassedExamEce($stid,$eid,$sp);

                                        if (empty($passedstsp)) {?>
                                        <!-- <a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/3" class="btn btn-success waves-effect waves-light" >Start Retake (OSPE)</a> -->
                                        <?php }else{?>
                                        <!-- <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light">Already Passed</a> -->
                                       <?php } ?> 
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                    <?php if (!empty($examdatathry) && !empty($examdatasc) && !empty($examdatasp)){?>
                                        <!--<a style="width: 200px;" href="<?php echo base_url('students/examresult/').$examinfo->schedule_id; ?>" class="btn btn-lg btn-danger waves-effect waves-light">View Result</a>-->
										<h3>You have successfully submitted your answers of ECE Exam. Please wait for CCD-DLP authority to publish the ECE Exam result.</h3>
                                    <?php } ?>


                                <?php }else{?>
                                    <a href="<?php echo base_url('students/makeexam/').$examinfo->schedule_id;?>" class="btn btn-warning waves-effect waves-light">Start Exam</a>
                                <?php }?>


                                    
                                </p>
                            </div>
                        </div>
                        <!-- end row -->
<div class="modal fade" id="exampleModalThry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Instructions Theory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <p><?php echo $examinfo->exam_notice;?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/1" class="btn btn-warning waves-effect waves-light" >Start Exam (Theory)</a>-->
		<a href="<?php echo base_url('students/cameraoption_notice/').$examinfo->schedule_id;?>/1" class="btn btn-warning waves-effect waves-light" >Start Exam (Theory)</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Instructions OSCE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <p><?php echo $examinfo->exam_notice_osce;?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/2" class="btn btn-info waves-effect waves-light" >Start Exam (OSCE)</a>-->
		<a href="<?php echo base_url('students/cameraoption_notice/').$examinfo->schedule_id;?>/2" class="btn btn-warning waves-effect waves-light" >Start Exam (OSCE)</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalOspe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Instructions OSPE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <p><?php echo $examinfo->exam_notice_ospe;?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<a href="<?php echo base_url('students/makeexamece/').$examinfo->schedule_id;?>/3" class="btn btn-success waves-effect waves-light" >Start Exam (OSPE)</a>-->
		<a href="<?php echo base_url('students/cameraoption_notice/').$examinfo->schedule_id;?>/3" class="btn btn-warning waves-effect waves-light" >Start Exam (OSPE)</a>
      </div>
    </div>
  </div>
</div>
                        
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
        $(function(e) {
            $('#example').DataTable(
                {lengthMenu:[5,10,25,50,100],pageLength:10,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}}
                );
        } );
          
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
