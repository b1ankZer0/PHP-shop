</pre>
<?php  
$general_p=isset($_SESSION['general_p'])? $_SESSION['general_p']:'';
$general_c=!empty($general_p)?count($general_p):'';


$clothing_p=isset($_SESSION['clothing_p'])? $_SESSION['clothing_p']:'';
$clothing_c=!empty($clothing_p)?count($clothing_p):'';


$technology_p=isset($_SESSION['technology_p'])? $_SESSION['technology_p']:'';
$technology_c=!empty($technology_p)?count($technology_p):'';


$food_p=isset($_SESSION['food_p'])? $_SESSION['food_p']:'';
$food_c=!empty($food_p)?count($food_p):'';


$service_p=isset($_SESSION['service_p'])? $_SESSION['service_p']:'';
$service_c=!empty($service_p)?count($service_p):'';

if ($service_c <= 0 && $food_c <= 0 && $technology_c <= 0 && $clothing_c <= 0 && $general_c <= 0) {
exit;
}

if (!empty($general_p)) {
?>
    <div class="" style=" height: 300px;">
        <h2 style="margin-left: 10px;">General Prodect</h2><br><hr><br>
        <div class="flax" style="height: 250px;padding:0 30px; column-gap: 20px;overflow-x: scroll;">
        <?php for ($i=0; $i < $general_c; $i++) { ?>
            <?php if ($general_p[$i]['type'] == 'General') { $id=$general_p[$i]['id']?>
                <div class="border home_product">
                <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                <img class="home_prodect_picture" src="<?php echo file_exists($general_p[$i]['prodect_picture'])? $general_p[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                </a>
                <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis; ">
                            <?php echo ucfirst($general_p[$i]['prodect_name']);?>
                        </h3>
                    </a>
                </div>
                <?php if (empty($general_p[$i]['discount'])) { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo $general_p[$i]['selling_price']?> tk</p>
                <?php } else { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($general_p[$i]['selling_price'] - $general_p[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $general_p[$i]['selling_price'];?> tk</span></del></p> 
                <?php }?>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    </div>
    <br><hr><br>

<?php }if (!empty($clothing_p)) { ?>

    <div class="" style="height: 300px;">
        <h2 style="margin-left: 10px;">Clothing Prodect</h2><br><hr><br>
        <div class="flax" style="height: 250px;padding:0 30px; column-gap: 20px;overflow-x: scroll;">
        <?php for ($i=0; $i < $clothing_c; $i++) { ?>
            <?php if ($clothing_p[$i]['type'] == 'Clothing') { $id=$clothing_p[$i]['id'] ?>
                <div class="border home_product">
                <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                <img class="home_prodect_picture" src="<?php echo file_exists($clothing_p[$i]['prodect_picture'])? $clothing_p[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                </a>
                <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis;">
                            <?php echo ucfirst($clothing_p[$i]['prodect_name']);?>
                        </h3>
                    </a>
                </div>
                <?php if (empty($clothing_p[$i]['discount'])) { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo $clothing_p[$i]['selling_price']?> tk</p>
                <?php } else { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($clothing_p[$i]['selling_price'] - $clothing_p[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $clothing_p[$i]['selling_price'];?> tk</span></del></p> 
                <?php }?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    </div>
    <br><hr><br>

<?php }if (!empty($technology_p)) { ?>

    <div class="" style="height: 300px;">
        <h2 style="margin-left: 10px;">Technology Prodect</h2><br><hr><br>
        <div class="flax" style="height: 250px;padding:0 30px; column-gap: 20px;overflow-x: scroll;">
        <?php for ($i=0; $i < $technology_c; $i++) { ?>
            <?php if ($technology_p[$i]['type'] == 'Technology') { $id=$technology_p[$i]['id'] ?>
                <div class="border home_product">
                <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                <img class="home_prodect_picture" src="<?php echo file_exists($technology_p[$i]['prodect_picture'])? $technology_p[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                </a>
                <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis;">
                            <?php echo ucfirst($technology_p[$i]['prodect_name']);?>
                        </h3>
                    </a>
                </div>
                <?php if (empty($technology_p[$i]['discount'])) { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo $technology_p[$i]['selling_price']?> tk</p>
                <?php } else { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($technology_p[$i]['selling_price'] - $technology_p[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $technology_p[$i]['selling_price'];?> tk</span></del></p> 
                <?php }?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    </div>
    <br><hr><br>

<?php }if (!empty($food_p)) { ?>

    <div class="" style="height: 300px;">
        <h2 style="margin-left: 10px;">Food Prodect</h2><br><hr><br>
        <div class="flax" style="height: 250px;padding:0 30px; column-gap: 20px;overflow-x: scroll;">
        <?php for ($i=0; $i < $food_c; $i++) { ?>
            <?php if ($food_p[$i]['type'] == 'Food') {  $id=$food_p[$i]['id'] ?>
                <div class="border home_product">
                <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                <img class="home_prodect_picture" src="<?php echo file_exists($food_p[$i]['prodect_picture'])? $food_p[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                </a>
                <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis;">
                            <?php echo ucfirst($food_p[$i]['prodect_name']);?>
                        </h3>
                    </a>
                </div>
                <?php if (empty($food_p[$i]['discount'])) { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo $food_p[$i]['selling_price']?> tk</p>
                <?php } else { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($food_p[$i]['selling_price'] - $food_p[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $food_p[$i]['selling_price'];?> tk</span></del></p> 
                <?php }?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    </div>
    <br><hr><br>

<?php }if (!empty($service_p)) { ?>

    <div class="" style="height: 300px;">
        <h2 style="margin-left: 10px;">Service Prodect</h2><br><hr><br>
        <div class="flax" style="height: 250px;padding:0 30px; column-gap: 20px;overflow-x: scroll;">
        <?php for ($i=0; $i < $service_c; $i++) { ?>
            <?php if ($service_p[$i]['type'] == 'Service') { $id=$service_p[$i]['id'] ?>
                <div class="border home_product">
                <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                <img class="home_prodect_picture" src="<?php echo file_exists($service_p[$i]['prodect_picture'])? $service_p[$i]['prodect_picture']:'./asset/prodect.jpg' ?>" alt="prodect picture">
                </a>
                <div style="width:100%; height: 20px; overflow: hidden; text-overflow: ellipsis;">
                    <a class="a_none" href="<?php echo BASE_URL.'?action=prodect_details&id='.$id;?>">
                        <h3 class="overflow_c" style="margin-left: 10px; text-overflow: ellipsis;">
                            <?php echo ucfirst($service_p[$i]['prodect_name']);?>
                        </h3>
                    </a>
                </div>
                <?php if (empty($service_p[$i]['discount'])) { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo $service_p[$i]['selling_price']?> tk</p>
                <?php } else { ?>
                    <p style="margin-left: 10px; color:#4E9F3D"><?php echo ($service_p[$i]['selling_price'] - $service_p[$i]['discount']);?> tk <del style="color:red"><span style="margin-left: 10px; color:#B2B1B9"><?php echo $service_p[$i]['selling_price'];?> tk</span></del></p> 
                <?php }?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    </div>
    <br><hr><br>

<?php } ?>