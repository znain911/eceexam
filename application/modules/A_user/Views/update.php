<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('admin/includes/admin_header');?>
<!--BEGIN Style-->



<!--END Style-->
</head>
<body class="infobar-offcanvas">
<?php $this->load->view('admin/includes/admin_header_menu');?>
<div id="wrapper">
  <div id="layout-static">
    <?php $this->load->view('admin/includes/admin_sidebar'.$metadata['user_type']);?>
    <div class="static-content-wrapper">
      <div class="static-content">
        <div class="page-content">
          <div class="row" style="background: #f5f5f5 none repeat; margin-bottom:20px;">
            <div class="col-md-7">
              <ol class="breadcrumb">
                <li ><a href="<?php echo base_url('admin');?>">Home</a></li>
                <li class="active">Update <?php echo $metadata['heading'];?></li>
              </ol>
              <div class="page-heading"><h1><?php echo $metadata['heading'];?></h1></div>
            </div>
            <div class="col-md-5">
            	<div style="padding:30px 10px; text-align:right;">
                    <a class="btn btn-label btn-social btn-github" href="<?php echo base_url($listform);?>"><i class="fa fa-bars"></i><?php echo $metadata['heading'];?> List</a>
                </div>
             </div>
          </div>
          <div class="container-fluid">
            <div data-widget-group="group1">
            
<?php $attributes = array('id' => 'form_usergroup', 'name'=>'form_usergroup', 'class' => 'form-horizontal', 'style'=>'position:relative;', 'enctype'=>'multipart/form-data' );echo form_open('', $attributes);?>              
                <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                    <div class="panel-heading">
                        <h2>Update <?php echo $metadata['heading'];?></h2>
                    </div>
                    <div class="panel-editbox" data-widget-controls=""></div>
                    <div class="panel-body">                    
                    <?php
						foreach($edit_info as $editinfo):
							$Usergroup_Head = $editinfo->Usergroup_Head;
						endforeach;
						
						
						$this->form_engine->init(array(
							'default_input_container_class' => 'form-group',
							'bootstrap_required_input_class' => 'form-control',
							'default_control_label_class' => 'col-md-2 control-label',
							'default_form_control_class' => 'col-md-8',    
						));
						
						$form_options = array(
								array(
									'id' => 'Usergroup_Head',
									'label' => 'User Group Name',
									'type' => 'input',
									'placeholder' => '',
									'class' => 'form-control',
									'autocomplete' => 'off',
									'value' => isset($Usergroup_Head) ? $Usergroup_Head : '',		
								),
								
								
							);
						
						echo $this->form_engine->build_form_horizontal($form_options);
						?>
                  	<div class="panel-footer">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="errormessage"></div>
                      </div>
                      <div class="col-md-8">
                        <button type="submit" class="btn-primary btn btn-lg">Save</button>
                        <button onClick="form_reset();" type="button" class="btn-default btn btn-lg">Cancel</button>
                      </div>
                    </div>
                  </div>
                    
                                              
                    </div>
                </div>
            
<?php echo form_close(); ?>                    

<?php $this->forminput->formpost('form_usergroup',"loadingdiv",base_url('user/images/loading2.gif'),"submitbtn1","form_acction",$updateform_database.'/'.$id,"Update Successfully" ); ?>

			<script type="text/javascript">
				function form_acction(msg){	
					if(msg=='Update Successfully'){									
						var jmpurl='<?php echo base_url($listform);?>';
						window.location=jmpurl;
					}
				} 
				function form_reset(){
					$("#form_usergroup")[0].reset();
					reset_filename('');        
				}           
            </script>              
                
            </div>
          </div>
          <!-- .container-fluid --> 
        </div>
        <!-- #page-content --> 
      </div>
      <?php $this->load->view('admin/includes/admin_tinyfooter');?>
    </div>
  </div>
</div>
<?php $this->load->view('admin/includes/admin_rightsidebar');?>
<!-- Load site level scripts --> 





<!-- End loading page level scripts-->
</body>
</html>