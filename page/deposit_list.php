</pre>
<?php
$a=isset($_SESSION['deposit_list'])? count($_SESSION['deposit_list']) : '';
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
        <h1>Deposit List</h1> 
    </div>
</div>
    <hr>
<div class="center">
    <table class=" center" style="width:100%; margin:auto; table-layout: fixed; border:none;">
        <tr class="bg-color2 color2 txt-size">
            <th style="width:3%; "> # </th>
            <th style="height: 50px; width:25%; "> Deposit ID </th>
            <th>  Deposit Amount  </th>
            <th>  Payment Type  </th>
            <th>  Transaction ID  </th>
            <th>  status  </th>
            <th>  Edit  </th>
        </tr>
        <?php 
        for ($i=0; $i < $a; $i++) {  
            $b=$_SESSION['deposit_list'][$i]; 
            if ($i > -1) {
                $bg=($i%2)==0?'row1':'row2';
            }
            $id=$b['id'];
            
        ?>
        <tr class="<?php echo $bg;?> txt-size" >
            <td><?php  echo ($i+1)?></td>
            <td style="height: 40px;  width:100%; "><div style="width:100%; overflow: hidden; text-overflow: ellipsis;"><?php  echo $b['deposit_id']?></div></td>
            <td><?php  echo $b['deposit_amount'].' TK/-'?></td>
            <td><?php  echo $b['payment_type']?></td>
            <td><?php  echo $b['transaction_id']?></td>
            <td><p style="margin:auto; color:white; padding: 5px; border-radius: 15px; width: 85%; background:<?php  echo $b['status']=='Cancelled'?"#CF0A0A":''; echo $b['status']=='Accepted'?"#1A4D2E":''; echo $b['status']=='Pending'?"#FF9F29":'';?>;"><?php  echo $b['status'] ?></p></td>
            <td>
                <?php if ($_SESSION['c_user']['authority']=="Admin" and $b['status']=='Pending') { ?>
                    <a href="<?php echo BASE_URL.'?action=update_deposit_r&id='.$id ?>" style="text-decoration: none;"><i style="" class="fa icon_e">&#xf14a;</i></a>
                    <a href="<?php echo BASE_URL.'?action=update_deposit_c&id='.$id ?>" style="text-decoration: none;"><i class='fas icon_d'>&#xf071;</i></a>
                    
                <?php }else { ?>
            <?php } ?>
            <?php if ($_SESSION['c_user']['authority'] == "Sudo" and $b['status']=='Pending') { ?>
                    <a href="<?php echo BASE_URL.'?action=update_deposit_r&id='.$id ?>" style="text-decoration: none;"><i style="" class="fa icon_e">&#xf14a;</i></a>
                    <a href="<?php echo BASE_URL.'?action=update_deposit_c&id='.$id ?>" style="text-decoration: none;"><i class='fas icon_d'>&#xf071;</i></a>
                    
                <?php }else { ?>
            <?php } ?>
            </td>

            <?php if ($_SESSION['c_user']['authority'] != 'Entrepreneur' and $b['status'] != 'Banned') {}?>  
        </tr>
        <?php } ?>
    </table>
</div>
<?php }?>
