<style>
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
.jsgrid-table
{
    width:202%;
}
h4
{
    color:blue;
}
#reset-data
{
    background-color:red;
}
 [percentage]:after{
              content: '%';
            }
[fixed]:before{
  content: '\20B9'; 
  margin-right: 2px;
}   
.table-sm th{
    border-bottom: 2px solid #dee2e6;
}
.table-sm td{
    border-top: 0px solid #dee2e6;
}
</style>
<?php 

 // echo _prx($shop);
 //                    die(); 
                    ?>

<div id="datatable">
    <?php if (@$rows) { ?>
    <div class="row">
        <div class="col-12 text-center">
            <h1><?=$shop->shop_name?></h1>
            <h5><?=$shop->address.', '.$shop->city_name.', '.$shop->state_name?></h5>
            <h5>GSTIN : <?=$shop->gstin?></h5>
            <h5>LEDGER</h5>
            <h5>( FROM  <?= date_format_func($_POST['from_date']).' to '.date_format_func($_POST['to_date']);?> )</h5>
            <h5>Account : Cash</h5>
        </div>
    </div>
    
    <div id="grid_table" class="table-responsive table-wrap">
        <table width="100%">
            <tr class="">
                <th class="">Date</th>
                <th class="">Type</th>
                <th class="">Reference No.</th>
                <th class="">Particulars</th>
                <th class="" int>Debit</th>
                <th class="" int>Credit</th>
                <th class="" int>Balance</th>
                <th class="">Narration</th>
            </tr>

            <?php $i=0; $total_dr = $total_cr = 0;
             if (@$rows) { ?>
            <tr class="">
                
                <td class=""><?= date_format_func($_POST['from_date']);?> </td>
                <td class=""></td>
                <td class=""></td>
                <td class="">Opening Balance</td>
                
                <td class="" int>
                    <?php
                    $newbalance = $rows[0]->opening;

                    if (@$cash_account->amount) {
                        if ($cash_account->dr_cr=="cr") {
                            $newbalance = $newbalance - $cash_account->amount;
                        }
                        else{
                            $newbalance = $newbalance + $cash_account->amount;
                        }
                    }


                     if ($newbalance > 0) {
                        echo _nf(abs($newbalance));
                        $total_dr += $newbalance;
                    } ?>
                </td>
                <td class="" int>
                    <?php 
                    if ($newbalance < 0) {
                        echo _nf(abs($newbalance));
                        $total_cr += abs($newbalance);
                    }
                     ?> </td>
                <td class="" int>
                <?php 
                    if (@$newbalance) {
                        echo _nf(abs($newbalance));
                        if($newbalance > 0){
                            echo ' Dr';
                        }
                        else{
                            echo ' Cr'; 
                        }
                    }
                    
                    ?> 
                </td>
                <td class=""></td>

               
            </tr>     
           
            
            <?php foreach($rows as $key => $value) {
            $total_dr += $value->dr; 
            $total_cr += $value->cr; ?>
            <tr class="">
                <td class=""><?= date_format_func($value->PaymentDate)?> </td>
                <td class=""><?= $value->type ?> </td>
                <td class=""><?= ($value->orderid)?$value->orderid:$value->reference_no ?> </td>
                <td class="">
                    <?php 
                    if($value->txn_type==8)
                    {
                        if (@$value->bank_name) {
                        if ($value->dr > 0) {
                            echo 'Cr ';
                        }
                        else{
                            echo 'Dr ';
                        }
                        echo $value->bank_name;
                    }
                    else{
                        if ($value->type =='Pymt') { echo 'Dr '; }
                        if ($value->type =='Rcpt') { echo 'Cr '; }
                        echo $value->title;   
                    }
                    }else
                    {
                       if (@$value->bank_name) {
                        if ($value->dr > 0) {
                            echo 'Cr ';
                        }
                        else{
                            echo 'Dr ';
                        }
                        echo $value->bank_name;
                    }
                    else{
                        if ($value->type =='Pymt') { echo 'Dr '; }
                        if ($value->type =='Rcpt') { echo 'Cr '; }
                        echo $value->name;   
                    }   
                    }
                  
                    ?>
                </td>
                
                <td class="" int><?=($value->dr > 0) ? $value->dr : '' ?> </td>
                <td class="" int><?=($value->cr > 0) ? $value->cr : '' ?></td>
                <td class="" int>

                    <?php 
                     $newbalance = $newbalance + $value->balance;
                     ?>
                    <?= _nf(abs($newbalance)) ?> <?=($newbalance > 0) ? 'Dr' : 'Cr' ?>
                        

                    </td>
                <td class=""><?= $value->narration?> </td>
            </tr>  
                <?php  if ($value->type=='Sale' && @$value->orderid ) { 
                   
                    $orders = $this->ladger_m->get_order_details($value->order_id);

                    // echo _prx($orders);
                ?>
                <tr class="">
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class="">
                        <table>
                            <tbody>
                            <?php foreach ($orders as $key1 => $value1) { ?>
                                <tr>
                                    <td><?=$value1->name?></td>
                                    <td>
                                        <?=$value1->qty?> Pcs.
                                    </td>
                                    <td> @ </td>
                                    <td>
                                        <?=$value1->price_per_unit?>
                                    </td>
                                    <td> = </td>
                                    <td><?=$value1->total_price?></td>
                                    
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </td>
                    
                    <td class="" int></td>
                    <td class="" int></td>
                    <td class="" int></td>
                    <td class=""></td>
                </tr> 
                <?php reset($orders); } ?>
                   
            <?php } ?>    
            <tr class="">
                
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <td class="" int>Total</td>
                
                <th class="" int>
                    <?php
                      echo _nf($total_dr); 
                    ?>
                </th>
                <th class="" int>
                    <?php
                      echo _nf($total_cr); 
                    ?>   
                </th>
                <td class="" int>
                </td>
                <td class=""></td>

               
            </tr> 
            <tr class="">
                
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <td class="" int>
                    <?php 
                        // $dr_balance =  _nf($total_dr - $total_cr); 
                        if($newbalance > 0){
                            echo 'Debit Balance ';
                        }
                        else{
                            echo 'Credit Balance '; 
                        }
                    ?>
                 </td>
                
                <th class="" int>
                   
                </th>
                <th class="" int>
                    <?php
                        echo _nf(abs($newbalance)); 
                    ?>   
                </th>
                <td class="" int>
                </td>
                <td class=""></td>

               
            </tr> 

            <tr class="">
                
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <td class="" int>Grand Total</td>
                
                <th class="" int>
                   <?= _nf($total_dr)?>
                </th>
                <th class="" int>
                    <?= _nf($total_cr + $newbalance)?>   
                </th>
                <td class="" int>
                </td>
                <td class=""></td>

               
            </tr> 
            <?php } ?>
        </table>

    </div>
    <?php } else{ ?>
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="text-danger">Data not available!</h2>
        </div>
    </div>
    <?php } ?>
</div>
<div class="row">
   
</div>


