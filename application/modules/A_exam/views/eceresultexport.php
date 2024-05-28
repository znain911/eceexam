<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=ece_result.xls");
?>
<table border="1">
	<thead>
	<tr>
       <th>SL</th>
       <th>ID</th>
       <th>Name</th>
       <th>Batch</th>
       <th>RTC</th>
       <th>SCHEDULE_DATE</th>
       <th>Theory Attend Date</th>
       <th>Theory Marks</th>
       <th>Theory Pass Marks</th>
       <th>Theory marks Obtained by right answer</th>
       <th>Theory mark Deducted from Wrong answer</th>
       <th>Theory Net Marks</th>
       <th>Theory Status</th>
       <th>OSCE Attend Date</th>
       <th>OSCE Marks</th>
       <th>OSCE marks Obtained by right answer</th>
       <th>OSCE marks Deducted from Wrong answer</th>
       <th>OSCE Net Marks</th>
       <th>OSPE Attend Date</th>
       <th>OSPE Marks</th>
       <th>OSPE marks Obtained by right answer</th>
       <th>OSPE marks Deducted from Wrong answer</th>
       <th>OSPE Net Marks</th>
       <th>OSCE & OSPE Pass Marks</th>
       <th>OSCE & OSPE Net Marks</th>
       <th>OSCE & OSPE Result</th>
       <th>Result Status</th>
	   <th>Theory Camera</th>
       <th>OSCE Camera</th>
       <th>OSPE Camera</th>
    </tr>
    </thead>
	<tbody>

    <?php $i=1; foreach ($qsn_list as $lst) {?>   
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $lst->student_id; ?></td>
        <td><?php echo $lst->st_name; ?></td>
        <td><?php echo $lst->batch; ?></td>
        <td><?php echo $lst->rtc_number; ?></td>
        <td><?php echo date("d-m-Y",strtotime($lst->start_date)); ?></td>
<?php 
$theoryrslt = $this->a_exam_m->getEceTheoryReport($lst->st_id,$sid);
$oscerslt = $this->a_exam_m->getEceOsceReport($lst->st_id,$sid);
$osperslt = $this->a_exam_m->getEceOspeReport($lst->st_id,$sid);
//The number of hours to add.
$hoursToAdd = 0;
?>
         <?php if (!empty($theoryrslt)) {
        $thryrslt = $theoryrslt->result;
        ?>                                              
        <td>
		<?php /* echo date("d-M-Y g:i A",strtotime($theoryrslt->exam_attend_date)); */ ?>
		<?php
                                                            $current = new DateTime($theoryrslt->exam_attend_date);
                                                            
                                                            //Add the hours b
                                                            $current->add(new DateInterval("PT{$hoursToAdd}H"));
                                                            $newTime = $current->format('d-M-Y g:i A');
                                                            echo $newTime;
        ?>
		</td>
        <td><?php echo $theoryrslt->total_mark_theory; ?></td>
        <td><?php echo $theoryrslt->pass_mark_theory; ?></td>
        <td><?php echo $theoryrslt->total_marks; ?></td>
        <td><?php echo $theoryrslt->negative_marks; ?></td>
        <td><?php echo $theoryrslt->geting_marks; ?></td>
        <td><?php echo $theoryrslt->result; ?></td>   
		<?php }else{
          $thryrslt = 'Fail';
          ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <?php } ?>   
        <?php if (!empty($oscerslt)) {
            $oscemark = $oscerslt->geting_marks;
          ?>
        <td>
		<?php
                                                            $current2 = new DateTime($oscerslt->exam_attend_date);
                                                            
                                                            //Add the hours b
                                                            $current2->add(new DateInterval("PT{$hoursToAdd}H"));
                                                            $newTime2 = $current2->format('d-M-Y g:i A');
                                                            echo $newTime2;
                                                      ?>
		</td>
        <td><?php echo $oscerslt->total_mark_osce; ?></td>
        <td><?php echo $oscerslt->total_marks; ?></td>
        <td><?php echo $oscerslt->negative_marks; ?></td>
        <td><?php echo $oscerslt->geting_marks; ?></td>
		<?php }else{
            $oscemark = 0;?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        <?php }?>
        <?php if (!empty($osperslt)) {
            $ospemark = $osperslt->geting_marks;
        ?>
        <td>
		<?php
                                                            $current3 = new DateTime($osperslt->exam_attend_date);
                                                            
                                                            //Add the hours b
                                                            $current3->add(new DateInterval("PT{$hoursToAdd}H"));
                                                            $newTime3 = $current3->format('d-M-Y g:i A');
                                                            echo $newTime3;
                                                      ?>	
		</td>
        <td><?php echo $osperslt->total_mark_ospe; ?></td>
        <td><?php echo $osperslt->total_marks; ?></td>
        <td><?php echo $osperslt->negative_marks; ?></td>
        <td><?php echo $osperslt->geting_marks; ?></td>
        <td><?php echo $osperslt->pass_mark_osce_ospe; ?></td>
		<?php }else{
          $ospemark = 0;?>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
         <?php }?>
		
        <td>
        	<?php $osce_ospemark = (float)$oscemark + (float)$ospemark; 
        	echo $osce_ospemark;
        	?>
        </td>
        <td>
          <?php
            if($osce_ospemark < $scheduledtl->pass_mark_osce_ospe){
            	$cp = 'Fail';
                echo '<div class="text-danger">Fail</div>';
            }else{
                echo '<div class="text-success">Passed</div>';
                $cp = 'Passed';
            }
          ?>
        </td>

        <td>
          <?php
            if($cp == 'Passed' && $thryrslt == 'Passed'){                
                echo '<div class="text-success">Passed</div>';
            }else{
                echo '<div class="text-danger">Fail</div>';
            }
          ?>
        </td>
		<td>
          <?php $camth = $this->a_exam_m->exam_camera_theory($lst->st_id,$sid);
             if (!empty($camth)) {
              if ($camth->camera_status == 1) {
                    echo 'On';
                  }else{
                    echo 'Off';
                }
            }
          ?> 
        </td>
        <td>
          <?php $camce = $this->a_exam_m->exam_camera_osce($lst->st_id,$sid);
            if (!empty($camce)) { 
              if ($camce->camera_status == 1) {
                    echo 'On';
                  }else{
                    echo 'Off';
                }
            }
          ?> 
        </td>
        <td>
          <?php $campe = $this->a_exam_m->exam_camera_ospe($lst->st_id,$sid);
            if (!empty($campe)) {
              if ($campe->camera_status == 1) {
                    echo 'On';
                  }else{
                    echo 'Off';
                }
             }
          ?> 
        </td>
        
        </tr>
        <?php $i++; } ?>
                                                    
    </tbody>
</table>