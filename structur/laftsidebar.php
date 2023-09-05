
    <div class="laftsidebar">
        <div>
            <a class="a-sidebar" href="<?php echo BASE_URL.'?action=dashbord' ?>">Dashboard</a>
                <?php if($_SESSION['c_user']['authority'] != 'User' && $_SESSION['c_user']['authority'] != 'Entrepreneur') { ?>
                    <a class="a-sidebar" href="<?php echo BASE_URL.'?action=accounts' ?>">Accounts</a>
                <?php }?>
            <a class="a-sidebar" href="<?php echo BASE_URL.'?action=prodect_list' ?>">Prodect List</a>
            <a class="a-sidebar" href="<?php echo BASE_URL.'?action=deposit_list' ?>">Deposit List</a>
            <a class="a-sidebar" href="<?php echo BASE_URL.'?action=order_list' ?>">Order List</a>
            <!-- <a class="a-sidebar" href="<?php echo BASE_URL.'?page=add_new_prodect' ?>">Add New Prodect</a> -->
        </div>
    </div>
