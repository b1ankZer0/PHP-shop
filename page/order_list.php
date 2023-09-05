</pre>
<?php
$a=isset($_SESSION['order_list'])? count($_SESSION['order_list']) : '';
// print_r($_SESSION['order_list']);
// exit;
if (empty($a)) {
?>
<div class="flax" style="width:100%; height:50px;">
    <div style="margin-left: 20px; width:20%;">
        <h1>Deposit List</h1> 
    </div>
</div>
    <hr>
    <?php  exit;}if (!empty($a)) { ?>
        <div class="flax" style="width:100%; height:50px;">
    <div style="margin-left: 20px; width:20%; ">
        <h1>Order List</h1> 
    </div>
</div>
    <hr>
<div class="center">
    <table class=" center" style="width:100%; margin:auto; table-layout: fixed; border:none;">
        <tr class="bg-color2 color2 txt-size">
            <th style="width:3%; "> # </th>
            <th style="height: 50px; width:25%; "> Product Name </th>
            <th>  Order ID  </th>
            <th>  Quantity  </th>
            <th>  Total Price  </th>
            <th>  status  </th>
            <th style="width:7%; ">  Edit  </th>
        </tr>
        <?php 
        for ($i=0; $i < $a; $i++) {  
            $b=$_SESSION['order_list'][$i]; 
            if ($i > -1) {
                $bg=($i%2)==0?'row1':'row2';
            }
            $id=$b['id'];
            
        ?>
        <tr class="<?php echo $bg;?> txt-size" >
            <td><?php  echo ($i+1)?></td>
            <td style="height: 40px;  width:100%; "><div style="width:100%; overflow: hidden; text-overflow: ellipsis;"><?php  echo $b['prodect_name']?></div></td>
            <td><?php  echo $b['Order_number']?></td>
            <td><?php  echo $b['quantity']?></td>
            <td><?php  echo $b['total_price'].' tk';?></td>
            <td><p style="margin:auto; color:white; padding: 5px; border-radius: 15px; width: 85%; background:<?php  echo $b['dv_status']=='Pending'?"#CF0A0A":'';echo $b['dv_status']=='Completed'?"#1A4D2E":'';?>;"><?php  echo $b['dv_status'] ?></p></td>
            <td>
                <?php if ($b['dv_status']=='Pending') { ?>
                    
                
                    <!-- <a href="<?php echo BASE_URL.'?action=account_info&id='.$id ?>" style="text-decoration: none;"><i class='far icon_i'>&#xf15c;</i></a> -->
                    <a href="<?php echo BASE_URL.'?action=order_complete&id='.$id ?>" style="text-decoration: none;"><i style="" class="fa icon_e">&#xf14a;</i></a>
                    <!-- <a href="<?php echo BASE_URL.'?action=update_deposit_c&id='.$id ?>" style="text-decoration: none;"><i class='fas icon_d'>&#xf071;</i></a> -->
                <?php }else {
                    
                }?>
            </td>

            <?php if ($_SESSION['c_user']['authority'] != 'Entrepreneur' and $b['status'] != 'Banned') {}?>  
        </tr>
        <?php } ?>
    </table>
</div>
<?php }?>
