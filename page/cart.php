</pre>
<?php

$data= !empty($_SESSION['cart'])? $_SESSION['cart']:'';
// print_r($data);
$count= !empty($_SESSION['cart'])? count($_SESSION['cart']):'';

?>
<div class="flax" style="width: 100%; height: 40px; margin: auto; justify-content: space-between;">
    <div class="" style="width: 20%; height: 40px; ">
        <h1> &nbsp; Cart</h1>
    </div>
    <div class="center" style="width: 20%; height: 40px;  padding-top:10px">
        <a class="a_button" href="<?php echo BASE_URL.'?action=deposit_history' ?>" style="text-decoration: none;">Order history</a>
    </div>  
</div>
<br><hr><br>
<?php 
if ($count <= 0 ) {
    echo "<h1 class='center' style='color:red;'>Nothing is added to the cart.</h1>";
    exit;
}$total_filan=0;
for ($i=0; $i < $count; $i++) { $id=$data[$i]['id']; $pid=$data[$i]['pid'];
    ?>
<div class="border flax" style="width: 100%; height: 150px; margin: auto; margin-top: 5px;">
    <div class=" mid" style="width: 7%; height: 150px; margin: auto; padding-top: 60px;">
        # <?php echo ($i+1); ?>
    </div>
    <div class="" style="width: 20%; height: 150px; margin: auto;">
        <img class="" src="<?php echo file_exists($data[$i]['prodect_picture'])? $data[$i]['prodect_picture']:"./asset/prodect.jpg"?>" alt="Prodect Picture" style="max-width: 100%; height: 96%; margin: auto;">
    </div>
    <div class="" style="width: 25%; height: 150px; margin: auto; padding-top: 20px;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$pid;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis; ">
                            <?php echo ucfirst($data[$i]['prodect_name']);?>
                        </h3>
                    </a><hr>
        <div class="" style="width: 96%; height: 6%;  margin: auto;">
                    <br><h3>Price:</h3>
                    <?php if (empty($data[$i]['discount'])) { ?>
                        <h3 style="margin-left: 10px; color:#4E9F3D"><?php echo $data[$i]['selling_price']?> tk</h3>
                    <?php } else { ?>
                        <h3 style="margin-left: 10px; color:#4E9F3D">&nbsp;&nbsp;<?php echo ($data[$i]['selling_price'] - $data[$i]['discount']);?> tk <br><del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $data[$i]['selling_price'];?> tk</span></del></h3> 
                    <?php }?>

        </div>
    </div>
    <div class=" center" style="width: 12%; height: 150px; margin: auto; padding-top: 20px;">
                <?php echo $data[$i]['total_in_stock'] != 0? "<h3>&nbsp;&nbsp;&nbsp; In Stock: &nbsp; &nbsp;</h3><h3 style='color: #83142C'> <hr><br>".$data[$i]['total_in_stock']." </h3>" : "<h3 style='color: red;'> Out of stock" ?>
    </div>
    <div class="center " style="width: 12%; height: 150px; margin: auto; padding-top: 20px;">
         <h3>Ordered:</h3> <hr>  <br>
         <h3 style='color: #4E9F3D'><?php echo $data[$i]['quantity'] ?><h3>
    </div>
    <div class="center " style="width: 17%; height: 150px; margin: auto; padding-top: 20px;">
        <h3>Total:</h3> <hr>  <br>
        <h3 style='color: #4E9F3D'><?php $total =(floatval($data[$i]['quantity'])*floatval(($data[$i]['selling_price'])-floatval($data[$i]['discount']))).' tk'; echo $total; ?><h3>
    </div>
    <div class="border2 center" style="width: 7%; height: 150px; margin: auto; padding-top: 60px;">
        <a href="<?php echo BASE_URL.'?action=order_delete&id='.$id ?>" style="text-decoration: none;"><i class='fas icon_d'>&#xf2ed;</i></a>
    </div>
</div><hr>
<?php 

$total_filan = floatval($total_filan) + floatval($total); 
}  
// echo $total_filan;
?>

<div class="border flax" style="width: 100%; height: 150px; margin: auto; margin-top: 5px;">
    <div class=" " style="width: 50%; height: 150px; margin: auto; margin-top: 0px;">

        <br>
        <h3 style=" margin-left: 20px;">Balance: </h3><hr><br><h3 style="color: #4E9F3D; margin-left: 20px;"><?php echo $_SESSION['c_user']['balance'].' tk' ?></h3>
        
    </div>
    <div class=" " style="width: 50%; height: 150px; margin: auto; margin-top: 0px; ">

        <br>
        <h3 style=" margin-left: 20px;">Total: </h3><hr><br><h3 style="color: <?php echo ($_SESSION['c_user']['balance'] < $total_filan)? 'red':'#4E9F3D'; ?>; margin-left: 20px;"><?php echo floatval($total_filan).' tk' ?></h3>
        
    </div>
    <div class=" " style="width: 50%; height: 150px; margin: auto; margin-top: 0px;">

        <br>
        <h3 style=" margin-left: 20px;">Balance after buying: </h3><hr><br><h3 style="color: <?php echo ($_SESSION['c_user']['balance'] < $total_filan)? 'red':'#4E9F3D'; ?>; margin-left: 20px;"><?php echo ($_SESSION['c_user']['balance']-floatval($total_filan)).' tk' ?></h3>
        
    </div>
    <div class="border center" style="width: 20%; height: 150px; margin: auto;">
        
            <?php if ($_SESSION['c_user']['balance'] > $total_filan) { ?>
                <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" style="width: 170px;display: flex;align-items: center;justify-content: center;height: 100%;">
                    <input type="hidden" name="action" value="buy">
                    <button class="button1" type="submit"  style=" margin-top: 0px; margin-left: -7%;">Buy</button>
                    <script>
                        if (<?php echo($total_filan<$_SESSION['c_user']['balance']); ?>) {
                            console.log(<?php echo($_SESSION['c_user']['balance']);?>);
                        }else{
                            console.log(<?php echo($total_filan);?>);
                        }
                    </script>
                    <?php }else { ?>
                <a style="text-decoration: none;" href="<?php echo BASE_URL.'?page=deposit' ?>"><button class="button1">Deposit</button></a>
            <?php }?>
                </form>
            
        
    </div>
</div>