</pre>
<?php
$a=isset($_SESSION['prodects'])? count($_SESSION['prodects']) : '';
if (empty($a)) {
?>
<div class="flax" style="width:100%; height:70px;justify-content: space-between; padding:0 20px ">
    <div>
        <h1>Prodect List</h1> 
    </div>
    <div>
        <a class="a_button" href="<?php echo BASE_URL.'?page=add_new_prodect' ?>" style="text-decoration: none;">Add New +</a>
    </div>
</div>
    <hr>
    <?php  exit;}if (!empty($a)) { ?>
        <div class="flax" style="width:100%; height:70px;justify-content: space-between; padding:0 20px">
    <div>
        <h1>Prodect List</h1> 
    </div>
    <div >
        <a class="a_button" href="<?php echo BASE_URL.'?page=add_new_prodect' ?>" style="text-decoration: none;">Add New +</a>
    </div>
</div>
    <hr>
<div class="center">
    <table class=" center" style="width:100%; margin:auto; table-layout: fixed; border:none;">
        <tr class="bg-color2 color2 txt-size">
            <th style="width:3%; "> # </th>
            <th style="height: 50px; width:20%; "> Prodect Name </th>
            <th>  Prodect Code  </th>
            <th>  Buying Price  </th>
            <th>  Selling Price  </th>
            <th style="height: 50px; width:7%; ">  In Stock  </th>
            <th>  Type  </th>
            <th>  Status  </th>
            <th>  Edit  </th>
        </tr>
        <?php 
        for ($i=0; $i < $a; $i++) {  
            $b=$_SESSION['prodects'][$i]; 
            if ($i > -1) {
                $bg=($i%2)==0?'row1':'row2';
            }
            $id=$b['id'];
            
        ?>
        <tr class="<?php echo $bg;?> txt-size" >
            <td><?php  echo ($i+1)?></td>
            <td style="height: 40px;  width:100%; "><div style="width:100%; overflow: hidden; text-overflow: ellipsis;"><?php  echo $b['prodect_name']?></div></td>
            <td><?php  echo $b['prodect_code']?></td>
            <td><?php  echo $b['buying_price'].' tk'?></td>
            <td><?php  echo $b['selling_price'].' tk'?></td>
            <td><?php  echo $b['total_in_stock']?></td>
            <td><?php  echo $b['type']?></td>
            <td><p style="margin:auto; color:white; padding: 5px; border-radius: 15px; width: 85%; background:<?php  echo $b['status']=='Banned'?"#CF0A0A":''; echo $b['status']=='Active'?"#1A4D2E":''; echo $b['status']=='Inactive'?"#FF9F29":'';?>;"><?php  echo $b['status'] ?></p></td>
            <td><a href="<?php echo BASE_URL.'?action=prodect_info&id='.$id ?>" style="text-decoration: none;"><i class='far icon_i'>&#xf15c;</i></a>
                <?php echo $_SESSION['c_user']['authority'] != 'Entrepreneur' || $b['status'] != 'Banned'? "<a href=".BASE_URL."?action=prodect_change&id=$id style='text-decoration: none;'><i class='far icon_e'>&#xf044;</i></a>":'' ?> 
                <?php if ($_SESSION['c_user']['id'] == $b['added_by']) { ?>
                 <a href="<?php echo BASE_URL.'?action=prodect_delete&id='.$id ?>" style="text-decoration: none;"><i class='fas icon_d'>&#xf2ed;</i></a>
                <?php }else { ?>
            <?php } ?>
            </td>

            <?php if ($_SESSION['c_user']['authority'] != 'Entrepreneur' and $b['status'] != 'Banned') {}?>  
        </tr>
        <?php } ?>
    </table>
</div>
<?php }?>
