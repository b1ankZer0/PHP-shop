<?php
if ($_SESSION['c_user']['authority'] == 'Sudo' || $_SESSION['c_user']['authority'] == 'Admin' 
|| $_SESSION['c_user']['authority'] == 'Moderator') {
}
else {
    $_SESSION['error_msg']= "Unauthorised action.";
    header("Location:http://localhost/shop/?page=dashboed");
    exit;
}

$a=isset($_SESSION['accounts'])? count($_SESSION['accounts']) : '';

if (empty($a)) {
    exit;
}
if (!empty($a)) {

?>

<div class="center">
    <h1>Account List</h1><hr>
    <table class=" center" style="width:100%; margin:auto; table-layout: fixed;">
        <tr class="bg-color2 color2 txt-size">
            <th style="width:3%; "> # </th>
            <th style="height: 50px; width:18%; "> Fast Name </th>
           
            <th style="width:20%; ">  Email  </th>
            <th>  Balance  </th>
            <th style="width:8%; ">  Gender  </th>
            <th>  Birth Day  </th>
            <th>  Authority  </th>
            <th>  Edit  </th>
        </tr>

        <?php 
        for ($i=0; $i < $a; $i++) {  
            $b=$_SESSION['accounts'][$i]; 
            if ($i > -1) {
                $bg=($i%2)==0?'row1':'row2';
            }
            $id=$b['id'];
        ?>

        <tr class="<?php echo $bg;?> txt-size" >
            <td><?php  echo ($i+1)?></td>
            <td style="height: 40px;  width:100%; "><div style="width:100%; overflow: hidden; text-overflow: ellipsis;"><?php  echo $b['fast_name']?></div></td>
            
            <td><div style="width:100%; overflow: hidden; text-overflow: ellipsis;"><?php  echo $b['email']?></div></td>
            <td><?php  echo $b['balance'].' tk' ?></td>
            <td><?php  echo $b['gender']?></td>
            <td><?php  echo $b['birth_day']?></td>
            <td><?php  echo $b['authority']?></td>
            <td><a href="<?php echo BASE_URL.'?action=account_info&id='.$id ?>" style="text-decoration: none;"><i class='far icon_i'>&#xf15c;</i></a><?php echo $_SESSION['c_user']['authority']!=$b['authority']? "<a href=".BASE_URL.'?action=account_info_change&id='.$id ." style='text-decoration: none;'><i class='far icon_e'>&#xf044;</i></a>":'';?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php }?>
