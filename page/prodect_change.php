</pre>
<?php 

$info=$_SESSION['prodect_info'];
    
?>
<h1 class="center">Prodect Change</h1><hr>
<div class=" flax bg-color1" style="width:100%; height: 650px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;">
            <input type="hidden" name="action" value="prodect_change_action"><br><br><br><br>

        <label class="txt-size1 color margin" for="prodect_name">Prodect Name:</label><br><br>
        <input class="input" type="text" name="prodect_name" id="prodect_name" value="<?php echo $info['prodect_name'];?>" ><br><br>

        <!-- <label class="txt-size1 color margin" for="prodect_code">Prodect Code:</label><br>
        <input class="input" type="text" name="prodect_code" id="prodect_code" placeholder="Prodect Code" > -->

        <label class="txt-size1 color margin" for="buying_price">Buying Price:</label><br><br>
        <input class="input" type="number" name="buying_price" step="0.001" max="99999999.99" maxlength="10" id="buying_price" value="<?php echo $info['buying_price'];?>" ><br><br>

        <label class="txt-size1 color margin" for="selling_price">Selling Price:</label><br><br>
        <input class="input" type="number" name="selling_price" step="0.001" max="99999999.99" maxlength="10" id="selling_price" value="<?php echo $info['selling_price'];?>" ><br><br>

        <label class="txt-size1 color margin" for="discount">Add Discount: (in taka)</label><br><br>
        <input class="input" type="number" name="discount"  max="99999999" maxlength="10" id="discount" value="<?php echo $info['discount'];?>" ><br><br>

        <label class="txt-size1 color margin" for="type">Type:</label><br><br> 
        <select name="type" id="type" class="select">
            <option value="General" <?php echo $info['type']=='General'?'selected':'';?>>General</option>
            <option value="Technology" <?php echo $info['type']=='Technology'?'selected':'';?>>Technology</option>
            <option value="Service" <?php echo $info['type']=='Service'?'selected':'';?>>Service</option>
            <option value="Clothing" <?php echo $info['type']=='Clothing'?'selected':'';?>>Clothing</option>
            <option value="Food" <?php echo $info['type']=='Food'?'selected':'';?>>Food</option>
        </select><br>
    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:85%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; padding-left: 30px; text-align: laft; justify-content: laft;"><br><br><br><br>

        <label class="txt-size1 color margin" for="description" style="margin-top:50px;">Description:</label><br><br>
        <textarea class="inputbox" rows="8" cols="58" name="description" maxlength="1000" 
        id="description" ><?php echo $info['description']; ?></textarea><br><br>

        <label class="txt-size1 color margin" for="status">Status:</label><br><br>
        <?php if ($_SESSION['c_user']['authority'] == 'Entrepreneur') { 
            if ($info['status']=='Banned') { ?>
            <label class="txt-size1 margin" for="description" style="margin-top:50px; color: #CF0A0A"><?php echo $info['status'] ?></label><br><br>
            <?php } else { ?>
                <select name="status" id="status" class="select" aria-placeholder="<?php echo $info['status'];?>"><br>
                    <option class="select" value="Active" <?php echo $info['status']=='Active'?'selected':'';?>>Active</option>
                    <option class="select" value="Inactive" <?php echo $info['status']=='Inactive'?'selected':'';?>>Inactive</option>
                </select><br><br>
            <?php } ?>
        
        <?php }else { ?>
            <select name="status" id="status" class="select" aria-placeholder="<?php echo $info['status'];?>"><br>
            <option class="select" value="Active" <?php echo $info['status']=='Active'?'selected':'';?>>Active</option>
            <option class="select" value="Inactive" <?php echo $info['status']=='Inactive'?'selected':'';?>>Inactive</option>
            <option class="select" value="Banned" <?php echo $info['status']=='Banned'?'selected':'';?>>Banned</option> 
        </select><br><br>
        <?php } ?>
        
        <!-- <label class="txt-size1 color margin" for="status">Status:</label><br>
        <select name="status" id="status" class="select">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
        </select><br> -->

        <label class="txt-size1 color margin" for="prodect_picture">Prodect Picture:</label><br><br>
        <input class="input" type="file" name="prodect_picture" id="prodect_picture"><br><br>
    </div>
</div>
<div class='center' style="width:50%; height:120px; margin:auto;">
<?php if ($_SESSION['c_user']['authority'] == 'Entrepreneur' and $info['status']=='Banned') { 
            // if ($info['status']=='Banned') { ?>
            <!-- <label class="txt-size1 margin" for="description" style="margin-top:50px; color: #CF0A0A"><?php // echo $info['status'] ?></label><br><br> -->
            <!-- <?php // } ?> -->
        
        <?php }else { ?>
            <button class="button" type="submit" style="margin-top:30px; margin-left: 0px;">Update Prodect info</button>
        </form>
        <?php } ?>
        
</div>
