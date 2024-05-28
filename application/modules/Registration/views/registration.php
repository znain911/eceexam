<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Registration | Distance Learning Programme (DLP)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="TMA Developed by CT Health Ltd" name="description" />
        <meta content="CTHealth" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url();?>assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
        <style type="text/css">
            .form-error{
                color: red;
            }
        </style>

    </head>

    <body class="auth-body-bg">
        <div class="home-btn d-none d-sm-block">
            <!-- <a href="index.html"><i class="mdi mdi-home-variant h2 text-white"></i></a> -->
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-7">
					<a href="https://www.dlpbadas-bd.org/" target="_blank" style="padding: 10px 5px 0px 10px;">About DLP</a>
                        <a href="https://www.dlpbadas-bd.org/terms-and-conditions" target="_blank" style="padding: 10px 5px 0px 5px;">Terms & Conditions</a>
                        <a href="https://www.dlpbadas-bd.org/terms-and-conditions" target="_blank" style="padding: 10px 5px 0px 5px;">Refund & Return Policy</a>
                        <a href="https://www.dlpbadas-bd.org/terms-and-conditions" target="_blank" style="padding: 10px 5px 0px 5px;">Privacy Policy</a>
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-11">
                                        <div>
                                            <div class="text-center">
                                                <div style="">
                                                    <a href="index.html" class="logo"><img src="<?php echo base_url();?>assets/images/dlp.png" height="70" alt="logo"></a>
                                                </div>
    
                                                <!-- <h4 class="font-size-18 mt-4">Welcome Back !</h4> -->
                                                <!-- <p class="text-muted">SignUp to continue to RTC Exam.</p> -->
                                            </div>

                                            <div class="p-2 mt-2">
                                                
                                    <?php if ($sdl_data->status == 0) {
                                            echo '<h1 style="text-align: center">Registration is close now!</h1>';
                                        }else{?>
                                                
                                                <?php $attributes = array('id' => 'form_post', 'name'=>'form_post', 'class' => 'custom-validation', 'style'=>'position:relative;', 'enctype'=>'multipart/form-data');echo form_open('javascript:void(0)',$attributes);?>
                                            <div class="errormessage"></div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username">Name</label>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" autocomplete="off" >
                                                        <div class="form-error" id="error-name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-mail-line auti-custom-input-icon"></i>
                                                        <label for="email">Email Address</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" autocomplete="off" parsley-type="email" >
                                                        <div class="form-error" id="error-email"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-profile-line auti-custom-input-icon"></i>
                                                        <label for="studentid">Student ID</label>
                                                        <input type="text" class="form-control" name="studentid" id="studentid" placeholder="Enter Student ID" autocomplete="off" >
                                                        <div class="form-error" id="error-studentid"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-phone-fill auti-custom-input-icon"></i>
                                                        <label for="phone">Mobile Number</label>
                                                        <input type="text" class="form-control" name="phone" id="phone" data-parsley-type="number" data-parsley-maxlength="11" placeholder="Enter Mobile Number" autocomplete="off" >
                                                        <div class="form-error" id="error-phone"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-qr-code-line auti-custom-input-icon"></i>
                                                        <label for="rtc">RTC Number</label>
                                                        <input type="text" class="form-control" name="rtc" id="rtc" data-parsley-type="number" placeholder="Enter RTC Number" autocomplete="off" >
                                                        <div class="form-error" id="error-rtc"></div>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-group-2-line auti-custom-input-icon"></i>
                                                        <label for="batch">Batch Number</label>
                                                        <input type="text" class="form-control" name="batch" id="batch" data-parsley-type="number" placeholder="Enter Batch Number" autocomplete="off" >
                                                        <div class="form-error" id="error-batch"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Password</label>
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" />
														<div style="color: green;">(Please set your password and save it)</div>
                                                        <div class="form-error" id="error-password"></div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Re-Type Password</label>
                                                        <input type="password" class="form-control" 
                                                            data-parsley-equalto="#password" id="passconf" name="passconf" placeholder="Re-Type Password" autocomplete="off" />
															<div style="color: green;">(Please set your password and save it)</div>
                                                            <div class="form-error" id="error-passconf"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-file-paper-fill auti-custom-input-icon"></i>
                                                        <label for="admission_slip">Upload Admission Slip</label>
                                                        <input type="file" class="form-control" name="admission_slip" id="admission_slip"  autocomplete="off" >
                                                        <div class="form-error" id="error-admission_slip"></div>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group auth-form-group-custom mb-3">
                                                        <i class="ri-file-list-3-line auti-custom-input-icon"></i>
                                                        <label for="previous_admit_card">Upload Previous Admit Card</label>
                                                        <input type="file" class="form-control" name="previous_admit_card" id="previous_admit_card" autocomplete="off" >
														<div style="color: green;">(If Available)</div>
                                                        <div class="form-error" id="error-previous_admit_card"></div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="mt-2 text-center">                                                
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" value="1" name="terms" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                        <a href="#" data-toggle="modal" data-target="#exampleModal">I have read the Terms and Conditions and agree to the Terms and Conditions and Policcies of the ECE Exam</a>
                                                        </label>
                                                        <div class="form-error" id="error-terms"></div>
                                                    </div>                                                 
                                            </div>

                                                    <div class="mt-2 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                                    </div>

                                                <?php echo form_close(); ?>
                                                
                                                <?php } ?>
                                            </div>

                                            <div class="mt-2 text-center">
                                                <p>Already have account ? <a href="<?php echo base_url('students/login');?>" class="btn btn-outline-primary btn-sm"> Login </a> </p>
                                                <p>© 2020 Bangladesh Diabetic Association. Developed by <a href="https://cthealth-bd.com/" target="_blank">CT Health Ltd.</a></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
<div class="modal fade bs-example-modal-lg show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="https://www.dlpbadas-bd.org/terms-and-conditions" style="border:0px #ffffff none;" name="myiFrame" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="400px" width="100%" allowfullscreen></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <?php $this->forminput->formpost('form_post',"loadingdiv",base_url('user/images/loading2.gif'),"submitbtn1","form_acction", 'registration/registration_data' ,'Successfully'  ); ?>
        <script type="text/javascript">
        function form_acction(msg){ 
            if(msg=='Successfully'){                                  
                var jmpurl='<?php echo base_url('students/login');?>';
                window.location=jmpurl; 
            }
        }           
        </script>

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/parsleyjs/parsley.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/pages/form-validation.init.js"></script>

        <script src="<?php echo base_url();?>assets/js/app.js"></script>

    </body>
</html>
