<?php 
$data=$_SESSION['dashbord'];
// print_r($data);
echo '</pre>';
?>

<div class="center">
    <h1>dashbord</h1><br><hr><br>
</div>
<div>
    <h2>Today Completed Sales: &nbsp; &nbsp;<?php echo $data['today_completed_sales'].' tk' ?></h2><br><hr><br>
    <h2>Today Pending sales: &nbsp; &nbsp;<?php echo $data['today_pending_sales'].' tk' ?></h2><br><hr><br>
    <h2>Today Total Sales: &nbsp; &nbsp;<?php echo $data['today_total_sales'].' tk' ?></h2><br><hr><br>
    <h2>Total Pending Order: &nbsp; &nbsp;<?php echo $data['total_pending_order'] ?></h2><br><hr><br>

    <h2>Total Completed Order: &nbsp; &nbsp;<?php echo $data['total_completed_order'] ?></h2><br><hr><br>
    <h2>Total Completed Sales: &nbsp; &nbsp;<?php echo $data['total_completed_sales'].' tk' ?></h2><br><hr><br>
    <h2>Total Pending Sales: &nbsp; &nbsp;<?php echo $data['total_pending_sales'].' tk' ?></h2><br><hr><br>
    <h2>Total Sales: &nbsp; &nbsp;<?php echo $data['total_sales'].' tk' ?></h2><br><hr><br>
    <h2>Total Product: &nbsp; &nbsp;<?php echo $data['total_product'] ?></h2><br><hr><br>
</div>


