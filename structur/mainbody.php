   
    <div class="border bg-color1" style="width:96%; min-height:860px; height:auto; margin:auto; margin-top:20px; margin-bottom: 20px; /*  overflow: auto; */" >
        <div class="center" style="width:100%; height:30px; margin:auto;"> 
                <h2 style="color:#DA0037; margin:10px"><?php echo $msg.$msg2; ?> </h2>
                <h2 style="color:#4E9F3D; margin:10px"><?php echo $suss_msg; ?> </h2>
                <?php // print_r(isset($old)? $old :'');?>
        </div>
        <pre>
        <?php
            $openpage = new open();
            $openpage->page($page);
        ?>
        </pre>
    </div>