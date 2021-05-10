<?php include("lib/common.php"); include("lib/session_check.php"); 
$xlsfile = "orders-report-".date("m-d-Y-hiA").".xls";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$xlsfile");

  ?>

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%" border="1">
                                   
                                   
                                    <tbody>
                                        <?php 
$qry='';
if(isset($date_from) && $date_from!="" && isset($date_to) && $date_to!=""){
    $qry.=" and (date(order_date) between '".date("Y-m-d",strtotime($date_from))."' and '".date("Y-m-d",strtotime($date_to))."')";
} 
if(isset($category) && $category!='0') {
    $qry.=" and status='".$category."'";
} 

if($qry=='') $qry=" and 1=2";

$results=$objMain->getResults("select * from orders where status!='pending' ".$qry);
                    if(!empty($results)){ $i=0;
                        foreach($results as $result){ $i++; 

                            ?>
                            <tr>                                        
                        <th>S.No</th>
                        <th>Order Date</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Location</th>
                        <th>Pincode</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                    </tr>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date("d-m-Y h:i A",strtotime($result['order_date'])); ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['mobileno']; ?></td>
                                <td><?php echo $result['city'].",".$result['state']; ?></td>
                                <td><?php echo $result['pincode']; ?></td>
                                <td><?php echo $objMain->INR($result['sub_total']); ?></td>
                                <td><?php echo $objMain->INR($result['coupon_value']); ?></td>
                                <td><?php echo $objMain->INR($result['net_amount']); ?></td>
                                <td><?php echo $result['status']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="background: #e9e9e9; font-weight: bold;">Product Name</td>
                                <td colspan="2" style="background: #e9e9e9; font-weight: bold;">Category</td>
                                <td colspan="2" style="background: #e9e9e9; font-weight: bold;">Size</td>
                                <td style="background: #e9e9e9; font-weight: bold;">Qty</td>
                                <td style="background: #e9e9e9; font-weight: bold;">Price</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                <?php $order_items=$objMain->getResults("select * from orders_items where order_id='".$result['id']."'");
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { 
        if($item['product_type']=='free') {
            $product_name=$item['product_name'];
            $label="FREE - ";
            $price='';
        } else {            
            $product_name=$item['product_name']." ".$item['product_height']."\"";
            $label="";
            $price=$objMain->INR($item['amount']);
        }

     ?>
                            <tr>
                                <td colspan="2"><?php echo $product_name; ?></td>
                                <td colspan="2"><?php echo $label.$item['category']; ?></td>
                                <td colspan="2"><?php echo $item['product_size']; ?></td>
                                <td><?php echo $item['qty']; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                   <?php     }
                    } ?>



                            <tr>
                                <td colspan="10" style="border-right: none; border-left: none; ">&nbsp;</td>
                            </tr>

<?php                }} ?>
                                   
                                    </tbody>
                                </table>