</pre>
<?php 
$prodect_details = isset($_SESSION['prodect_details'])?$_SESSION['prodect_details']:'';
$type = $prodect_details['type'];
// echo '<pre>';
// print_r($prodect_details);
// echo '</pre>';

?>
<div class=" flax" style="width: 100%; height: 750px; margin: auto;">
    <div class="" style="width: 48%; height: 96%; margin: auto;">
        <div class="" style="width: 90%; height: 80%; margin: auto; margin-top: 65px;">
            <img class="prodect_details_prodect_picture" src="<?php echo file_exists($prodect_details['prodect_picture'])? $prodect_details['prodect_picture']:"./asset/prodect.jpg"?>" alt="Prodect Picture">
        </div>
    </div>
    <div class="border2" style="width: 48%; height: 96%; margin: auto;">
        <div class="" style="width: 96%; height: 20%;  margin: auto;">
            <br><h2><?php echo ucfirst($prodect_details['prodect_name']) ?></h2><br>
            <hr>
        </div>
        <div class="" style="width: 96%; height: 64%;  margin: auto;">
            <br><h3>Description</h3>-------------------------<br>
            <p><?php echo ucfirst($prodect_details['description']) ?></p><br>
        </div>
        <div class="center" style="width: 96%; height: 6%;  margin: auto;">
            
                    <?php if (empty($prodect_details['discount'])) { ?>
                        <h2 style="margin-left: 10px; color:#4E9F3D"><?php echo $prodect_details['selling_price']?> tk</h2>
                    <?php } else { ?>
                        <h2 style="margin-left: 10px; color:#4E9F3D"><?php echo ($prodect_details['selling_price'] - $prodect_details['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $prodect_details['selling_price'];?> tk</span></del></h2> 
                    <?php }?>

        </div>
        <hr>
        <div class=" flax" style=" justify-content: space-between; align-items: center; padding: 22px 30px;">
            <div class="flax" style="">
             <?php echo $prodect_details['total_in_stock'] != 0? "<h3>In Stock: &nbsp; &nbsp;</h3><h3 style='color: #83142C'> ".$prodect_details['total_in_stock']." </h3>" : "<h3 style='color: red;'> Out of stock" ?>
            </div>
            <div class="" style="">
            <?php if ($prodect_details['total_in_stock'] >= 1) { ?>
                <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="" style="margin-top: -2%;">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="hidden" name="id" value="<?php echo $prodect_details['id'];?>">
                    <input class="input1" type="number" name="quantity"  max='<?php echo $prodect_details['total_in_stock']; ?>' maxlength="10000" id="quantity" placeholder="Abb" value="1" required>
                    <button class="button1" type="submit"  style="margin-top:0px; margin-left: 2px;">Add to Cart</button>
                </form>
            <?php }else { ?>
                
            <?php }?>
            </div>
        </div>

    </div>
</div>
<div class="border" style="width: 100%; height: 500px;">
    <br><div class="" style="width: 100%; height: 370px;">
        <?php 
            $product=isset($_SESSION[strtolower($type).'_p'])? $_SESSION[strtolower($type).'_p']:'';
            $count=!empty($product)?count($product):'';
            if ($count <= 0 ) {
                
            }
                    
            if (!empty($product)) { 
        ?>
        <div class="" style="height: 300px;">
            <h2 style="margin-left: 10px;"><?php echo $type ?> Prodect</h2><br><hr><br>
            <div class="flax" style="height: 250px; overflow: auto;">
            <?php for ($i=0; $i < $count; $i++) { ?>
                <?php if ($product[$i]['type'] == $type) { $id=$product[$i]['id'] ?>
                    <div class="border home_product">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                    <img class="home_prodect_picture" src="<?php echo file_exists($product[$i]['prodect_picture'])? $product[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                    </a>
                    <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                        <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                            <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis;">
                                <?php echo ucfirst($product[$i]['prodect_name']);?>
                            </h3>
                        </a>
                    </div>
                    <?php if (empty($product[$i]['discount'])) { ?>
                        <p style="margin-left: 10px; color:#4E9F3D"><?php echo $product[$i]['selling_price']?> tk</p>
                    <?php } else { ?>
                        <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($product[$i]['selling_price'] - $product[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $product[$i]['selling_price'];?> tk</span></del></p> 
                    <?php }?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        </div>
        <br><hr><br>
        <?php }else{
            echo "<h3 style='color:red;'>There is no product of the same type.</h3>";
        } ?>
    </div>    
</div>
