<?php
    
?>
<h1 class="center">Add New Prodect</h1><hr>
<div class=" flax bg-color1" style="width:100%; height: 620px; padding:auto; border:1px solid #B2B1B9;">
    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;">
            <input type="hidden" name="action" value="abb_new_prodect">
        <label class="txt-size1 color margin" for="prodect_name">Prodect Name:*</label><br>
        <input class="input" type="text" name="prodect_name" id="prodect_name" placeholder="Prodect Name..." value="<?php echo isset($old['prodect_name'])? $old['prodect_name']:''; ?>" required>

        <label class="txt-size1 color margin" for="prodect_code">Prodect Code:*</label><br>
        <input class="input" type="text" name="prodect_code" id="prodect_code" placeholder="Prodect Code..." value="<?php echo isset($old['prodect_code'])? $old['prodect_code']:''; ?>" required>

        <label class="txt-size1 color margin" for="buying_price">Buying Price:*</label><br>
        <input class="input" type="number" name="buying_price" step="0.001" max="99999999.99" maxlength="10" id="buying_price" placeholder="Buying Price..." value="<?php echo isset($old['buying_price'])? $old['buying_price']:''; ?>" required>

        <label class="txt-size1 color margin" for="selling_price">Selling Price:*</label><br>
        <input class="input" type="number" name="selling_price" step="0.001" max="99999999.99" maxlength="10" id="selling_price" placeholder="Selling Price..." value="<?php echo isset($old['selling_price'])? $old['selling_price']:''; ?>" required>
        
        <label class="txt-size1 color margin" for="type">Type:*</label><br>
        <select name="type" id="type" class="select">
            <option value="General" <?php echo isset($old['type']) && $old['type'] == 'General'? 'selected':'selected';?> >General</option>
            <option value="Technology" <?php echo isset($old['type']) && $old['type'] == 'Technology'? 'selected':'';?>>Technology</option>
            <option value="Service" <?php echo isset($old['type']) && $old['type'] == 'Service'? 'selected':'';?>>Service</option>
            <option value="Clothing" <?php echo isset($old['type']) && $old['type'] == 'Clothing'? 'selected':'';?>>Clothing</option>
            <option value="Food" <?php echo isset($old['type']) && $old['type'] == 'Food'? 'selected':'';?>>Food</option>
        </select>

    </div>

    <div style=" border:1px solid #B2B1B9; width:0%; height:80%; margin:auto;">
        
    </div>

    <div class='' style="width:48%; height:100%; margin:auto; text-align: laft; justify-content: laft;"><br><br>

        <label class="txt-size1 color margin" for="description" style="margin-top:50px;">Description:*</label><br>
        <textarea class="inputbox" rows="8" cols="58" name="description" id="description" maxlength="1200" placeholder="Prodect description In 1200 character..." required><?php echo isset($old['description'])? $old['description']:''; ?></textarea>
        
        <label class="txt-size1 color margin" for="status">Status:*</label><br>
        <select name="status" id="status" class="select">
            <option value="Active" <?php echo isset($old['status']) && $old['status'] == 'Active'? 'selected':'selected';?> >Active</option>
            <option value="Inactive" <?php echo isset($old['status']) && $old['status'] == 'Inactive'? 'selected':'';?>>Inactive</option>
        </select>

        <label class="txt-size1 color margin" for="prodect_picture">Prodect Picture:</label><br>
        <input class="input" type="file" name="prodect_picture" id="prodect_picture">
    </div>
</div>
<div class='center' style="width:50%; height:120px; margin:auto;">
        <button class="button" type="submit" style="margin-top:10px; margin-left: -40px;">Abb New Prodect</button>
        </form>
</div>
