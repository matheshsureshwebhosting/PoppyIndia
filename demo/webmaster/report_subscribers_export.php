<?php include("lib/common.php"); include("lib/session_check.php"); $menu='slider'; 
$xlsfile = "subscribers-report-".date("m-d-Y-hiA").".xls";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$xlsfile");
 ?>
                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" border="1">
                                    <thead>
                                    <tr>                                     
                        <th>S.No</th>
                        <th>Join Date</th>
                        <th>Mobile No</th>
                        <th>Email ID</th>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 
$qry='';
if(isset($date_from) && $date_from!="" && isset($date_to) && $date_to!=""){
    $qry.=" and (date(subscription_date) between '".date("Y-m-d",strtotime($date_from))."' and '".date("Y-m-d",strtotime($date_to))."')";
} 

if($qry=='') $qry=" and 1=2";

$results=$objMain->getResults("select * from subscription where 1=1 ".$qry." order by subscription_date desc");
                    if(!empty($results)){ $i=0;
                        foreach($results as $result){ $i++; 
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date("d M Y - h:m A",strtotime($result['subscription_date'])); ?></td>
                                <td><?php echo $result['mobileno']; ?></td>
                                <td><?php echo $result['emailid']; ?></td>
                            </tr>

                   <?php     }
                    } ?>
                                   
                                    </tbody>
                                </table>