</pre>
<?php 

$info=$_SESSION['prodect_info'];
$id=$info['id'];

?>
<div class="flax" style="width:100%; height:50px;">
    <div style="margin-left: 20px;">
        <h1>Prodect Info</h1> 
    </div>
    <div style=" margin-left: 65%; margin-top: 5px; width:6%;">
        <?php if ($_SESSION['c_user']['id'] == $info['added_by']) { ?>
                 <a class="a_button_d" href="<?php echo BASE_URL.'?action=prodect_delete&id='.$id ?>" style="text-decoration: none;"> <i style='font-size:16px;color:#ffffff' class='fas'>&#xf2ed;</i></a>
            <?php }else { ?>
               
            <?php } ?>
    </div>
    <div style=" margin-left: 1%; margin-top: 5px;">
        <?php if ($_SESSION['c_user']['authority'] == 'Entrepreneur' and $info['status']=='Banned') { 
                // if ($info['status']=='Banned') { ?>
                <!-- <label class="txt-size1 margin" for="description" style="margin-top:50px; color: #CF0A0A"><?php // echo $info['status'] ?></label><br><br> -->
                <!-- <?php // } ?> -->
            <?php }else { ?>
                <a class="a_button" href="<?php echo BASE_URL.'?action=prodect_change&id='.$id ?>" style="text-decoration: none;"><i style='font-size:16px color:#ffffff' class='fas'>&#xf044;</i></a>
            <?php } ?>
    </div>
</div>

    <hr>
<div class=" flax bg-color1" style="width:100%; height: 880px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;"><br><br><br>
        
        <label class="txt-size color margin" for="prodect_picture">Prodect Picture:</label><br><br>
        <img class="prodect_picture" src="<?php echo file_exists($info['prodect_picture'])? $info['prodect_picture']:"./asset/prodect.jpg"?>" alt="Prodect Picture"><br><br>

        <label class="txt-size color margin" for="prodect_name">Prodect Name:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['prodect_name'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Prodect Code:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['prodect_code'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Type:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['type'];?></label><br><br>

        <label class="txt-size color margin" for="buying_price">Buying Price:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['buying_price'].' tk';?></label><br><br>

        <label class="txt-size color margin" for="selling_price">Selling Price:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['selling_price'].' tk';?></label><br><br>

        <label class="txt-size color margin" for="selling_price">Discount:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo !empty($info['discount'])? $info['discount'].' tk ':'none ';?></label>
        
    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:90%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; padding: 0px 50px; text-align: laft; justify-content: laft;"><br><br><br>

        <label class="txt-size color margin" for="prodect_code">Total in stock:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['total_in_stock'];?> + </label>
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;">
            <input type="hidden" name="action" value="abb_stock">
            <input type="hidden" name="id" value="<?php echo $info['id'];?>">
            <input class="input1" type="number" name="abb_stock1"  max="99999999" maxlength="10" id="abb_stock" placeholder="Abb" required>
            <button class="button1" type="submit" style="margin-top:10px; margin-left: 2px;">Abb</button>
        </form><br><br>

        <label class="txt-size color margin" for="prodect_code">Added By:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['a_name'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Added On:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo $info['added_on'];?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Last Updateed By:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo !empty($info['u_name']) ? $info['u_name']:'no Update';?></label><br><br>

        <label class="txt-size color margin" for="prodect_code">Last Updateed On:</label><br><br>
        <label class="txt-size1 " for="name"><?php echo !empty($info['updateed_on'])? $info['updateed_on']:'no Update';?></label><br><br>

        
        <label class="txt-size color margin" for="status">Status:</label><br><br>
        <p class="center" style="margin-left: 12px; color:white; padding: 5px; border-radius: 15px; width: 70px; background:<?php  echo $info['status']=='Banned'?"#CF0A0A":''; echo $info['status']=='Active'?"#1A4D2E":''; echo $info['status']=='Inactive'?"#FF9F29":'';?>;"><?php  echo $info['status'] ?></p><br>
        <!-- <label class="txt-size1 " for="name"><?php echo $info['status'];?></label><br><br> -->

        <label class="txt-size color margin" for="description" style="margin-top:50px;">Description:</label><br><br>
        <p style="margin-left: 20px;"><?php echo $info['description'];?></p>

        </form>
    </div>
</div>
<div class='center' style="width:50%; height:80px; margin:auto; padding-top:30px">

</div>
