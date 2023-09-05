</pre>
    <div class="flax" style="width:100%; height:50px;">
        <div style="width:20%; height:50px;">
            <h1 class="" style="margin-left: 20px;">Deposit</h1>
        </div>
        <div style="width:60%; height:50px;">
            
        </div>
        <div style="width:20%; height:50px; margin-top: 1%">
            <a class="a_button" href="<?php echo BASE_URL.'?action=deposit_history' ?>" style="text-decoration: none;">Deposit history</a>
        </div> 
    </div>
    <br><hr>
    <div class='' style="width:70%; height:100%; margin:auto; text-align: laft; justify-content: laft; margin-left: 20%; padding-left: 10%">
        <form action="http://localhost/shop/" method="post" enctype="multipart/form-data" class="pad" style="margin-left: 0%;">
            <input type="hidden" name="action" value="deposit"><br><br><br><br>

        <label class="txt-size1 color margin" for="note">Note:</label><br><br>
        <input class="input" type="text" name="note" id="note" placeholder="EX: note..." value="<?php ?>" ><br><br>

        <label class="txt-size1 color margin" for="amount">Deposit Amount: (in taka)</label><br><br>
        <input class="input" type="number" name="deposit_amount" step="0.001" max="99999999.99" maxlength="10" id="amount" placeholder="in taka..." value="<?php ?>" ><br><br>

        <label class="txt-size1 color margin" for="payment_type">Type:</label><br><br> 
        <select name="payment_type" id="payment_type" class="select">
            <option value="Online" >Online</option>
            <option value="Bank transfer" >Bank transfer</option>
        </select><br><br>

        <label class="txt-size1 color margin" for="transaction_id">Transaction ID:</label><br><br>
        <input class="input" type="text" name="transaction_id" id="transaction_id" placeholder="EX: E6554FD..." value="" ><br><br>

        <button class="button" type="submit" style="margin-top:30px; margin-left: 10%;">Apply</button>
        </form>
    </div>