<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Bill Invoice</title>
    <style type="text/css">
      body,html {
        
        width: 390px;
        height: auto;
        margin: 0 auto;
        padding: 0;
        font-size: 10pt;
        line-height: 16px;
        background: rgb(204,204,204); 
      }
      * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
      .main-page {
        width: 390px;
        min-height: 297mm;
        margin: 10mm auto;
        padding: 30px 10px;
        background: white;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        padding-top: 44px;
      }
      @page {
        size: 390px auto;
        margin: 0mm;
      }
      @media print {
        html, body {
          width: 390px;
          height: auto;
        }
        .main-page {
          margin: 0mm;
          border: initial;
          border-radius: initial;
          width: initial;
          min-height: initial;
          box-shadow: initial;
          background: initial;
          page-break-after: always;
          padding-top: 44px;
        }
        .date{
        position: relative;
    left: 48px;
      }
      .customer-div span{
        font-weight: 700;
        font-size: 14px;
      }
      .address{
        font-weight: 700;
    font-size: 15px;
    line-height: 18px;
      }
      .address2 {
    font-weight: 700;
    font-size: 13px;
    line-height: 18px;
}
.item_props_value
{
  color:red !important; 
}
      }
      .logo-div {
        display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 156px;
    margin-bottom: 49px;
    text-align: center;
      }
      .customer-div .col-6{
        margin-top:5px;
      }
      .customer-div span{
        display: flex;
        
      }
      .text-danger{
        font-size: 10px;
        padding-right: 10px;
      }
      .address{
        font-weight: 700;
    font-size: 15px;
    line-height: 18px;
      }
      .customer-div span{
        font-weight: 700;
        font-size: 14px;
      }
      .date{
        position: relative;
    left: 48px;
      }
      .address2 {
    font-weight: 700;
    font-size: 13px;
    line-height: 18px;
}.item_props_value{
  color:red;
}
      
    </style>
  </head>
  <body onload="window.print()">
  <!-- onload="window.print()" -->
    <section class="main-page">
    <p class="rotingtxt" style="top: 615px;
    transform: rotate(331deg);
    font-size: 6em;
    color: rgba(255, 5, 5, 0.17);
    position: absolute;
    font-family: 'Denk One', sans-serif;
    text-transform: uppercase;
    padding-left: 20%;
    right: 540px;">
    Hold Bill
</p>

       <div class="logo-div">
          <img  src="<?= IMGS_URL.$invoice[0]['logo']; ?>" height="100px" alt="">
          <span class="mt-3"><b style="font-weight:800;font-size: 18px;text-transform: uppercase;"><?=$invoice[0]['shop_name'];?></b></span>
          <span class="address"><?=$invoice[0]['address'];?> </span>
          <span class="address"> <?=$invoice[0]['city_name'].',&nbsp;'.$invoice[0]['state_name'].', &nbsp;'.$invoice[0]['pin_code'];?></span>
          <span class="address">GSTIN NO: <?=$invoice[0]['gstin'];?></span>
          <span class="address">Phone No: <?=$invoice[0]['contact'];?></span>
          <span style="font-size: 16px;" ><b>Invoice</b></span>
       </div>
       <div class="customer-div row">
        <div class="col-6">
        <span>Name : <?=$invoice[0]['fname'].' '.$invoice[0]['lname'];?></span>
        </div>
        <div class="col-6">
        <span class="date">Date : <?php $now = new DateTime($invoice[0]['order_date']);
                     echo $timestring = $now->format('d-m-Y');?></span>
        </div>
        <div class="col-12 mt-1">
        <span>Invoice No : <?=$invoice[0]['orderid']; ?></span>
        </div>
        <div class="col-12 mt-1">
        <span> #  Item Name</span>
        </div>
        <div class="col-2 mt-2">
        <span>HSN</span>
        </div>
        <div class="col-1 mt-2">
        <span style="position: relative;left: 4px;">Qty</span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: 5px;">MRP</span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: -13px;">Disc1.</span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: -18px;">Disc2.</span>
        </div>
        <div class="col-1 mt-2">
        <span style="position: relative;left: -30px;">Flat.</span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: -25px;width: 100px;">Net Amt.</span>
        </div>
        <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;margin-bottom:16px;margin-top:7px">
        <?php
          // discount
          $total_=0;
            $i=1;
            $Tqty=0;
            $Tdiscount=$discount3=$total_=0;
            $totalRows = count($invoice);
            foreach($invoice as $key=> $row):
                if($row['discount_type']==1)
                {
                  $amount = ($row['selling_rate']-$row['offer_applied']);
                  $discount = $row['selling_rate']-$amount;
                  $Tdiscount +=$row['selling_rate']-$amount;
                }elseif($row['discount_type']==0)
                {
                    $per = ($row['selling_rate']*$row['offer_applied'])/100;
                     $amount = $row['selling_rate']-$per; 
                    $discount = $row['offer_applied'];
                    $Tdiscount +=$per;
                }
                if($row['offer_applied2'] > 0){
                if($row['discount_type2']==1)
                {
                  $amount2 = ($amount-$row['offer_applied2']);
                  $discount2 = $amount-$amount2;
                  $Tdiscount +=$amount-$amount2;
                }elseif($row['discount_type2']==0)
                {
                    $per = ($amount*$row['offer_applied2'])/100;
                     $amount = $amount-$per; 
                    $discount2 = $row['offer_applied2'];
                    $Tdiscount +=$per;
                }
              }else{
                $discount2=0;
              }
              if($row['flat_discount'] > 0){
                if($row['flat_discount_type']==0)
                {
                  $amount2 = ($amount-$row['flat_discount']);
                  $discount3 = $amount-$amount2;
                  $Tdiscount +=$amount-$amount2;
                }elseif($row['flat_discount_type']==1)
                {
                    $per = ($amount*$row['flat_discount'])/100;
                     $amount = $amount-$per; 
                    $discount3 = $row['flat_discount'];
                    $Tdiscount +=$per;
                }
              }else{
                $discount3=0;
              }
              $isLastRow = ($key == $totalRows - 1);
              $mbClass = $isLastRow ? 'mb-1 mt-2' : 'mb-4 mt-2';
			?>
         <div class="col-12" <?php if($i==1){ echo 'style="margin-top:-10px"';}else{echo 'style="margin-top:-15px"';};?>>
        <span><?= $row['product_name']; ?></span><span class="item_props_value"><?=$row['item_props_value']; ?></span>
        </div>
        <div class="col-3 <?= $mbClass; ?>">
        <span><?= $row['sku']; ?></span>
        </div>
        <div class="col-1 mt-2" style="margin-left: -23px;">
        <span><?=$row['item_qty'];?></span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: -14px;width: 100px;"><?=$row['currency'];?><?= $row['selling_rate']; ?></span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: 12px;margin-left: -24px;"><?=round(($discount),2)?><?php if($row['discount_type']==0){echo " % ";}elseif($row['discount_type']==1){echo " OFF";}?></span>
        </div>
        <div class="col-2 mt-2">
        <span style="position: relative;left: 12px;margin-left: -35px;"><?=round(($discount2),2)?><?php if($discount2 > 0){?><?php if($row['discount_type2']==0){echo " % ";}elseif($row['discount_type2']==1){echo " OFF";} }?></span>
        </div>
        <div class="col-1 mt-2">
        <span style="<?php if($discount3 > 0){?><?php if($row['flat_discount_type']==1){echo " position: relative;left: 12px;margin-left: -50px;width:44px ";}elseif($row['flat_discount_type']==0){echo "position: relative;left: 12px; margin-left: -69px;width: 55px;";} }else{ echo "position: relative;left: 12px;margin-left: -50px;width:44px ";}?>" ><?=round(($discount3),2)?><?php if($discount3 > 0){?><?php if($row['flat_discount_type']==1){echo " % ";}elseif($row['flat_discount_type']==0){echo " OFF";} }?></span>
        </div>
        <div class="col-2 mt-2" style="margin-left: -20px;">
        <span style="position: relative;left: -3px;float:right"><?=$row['currency'];?><?php echo number_format((float)($amount*$row['item_qty']), 2, '.', ''); ?></span>
        </div>
        <?php
        $Tqty +=$row['item_qty'];
         $total_ += ($amount*$row['item_qty']);
            $i=$i+1;
            endforeach;
            $amounts = $this->pos_orders_model->getAmounts($total_);
            $coupons = $this->pos_orders_model->orderCoupon($invoice[0]['oid']);
            $totalWithoutTax= $totalWithOutTax= $CouponDisc=0;
            if($coupons){
               foreach($coupons as $c):
                  if($c['coupon_type']=='2'){
                      $CouponDisc += $c['discount_amount'];
                  }
              endforeach;
            }
                $totalAmount=bcdiv(($CouponDisc+$invoice[0]['total_value'])-$invoice[0]['round_off'], 1, 2);
                if($CouponDisc==0){
                  $SubTotal=bcdiv((($CouponDisc+$invoice[0]['total_value'])-$invoice[0]['round_off']), 1, 2);
                   $totalWithoutTax=bcdiv((($CouponDisc+$invoice[0]['total_value'])-$invoice[0]['round_off'])-$invoice[0]['order_tax'], 1, 2);
                  }else{
                    $SubTotal=bcdiv((($CouponDisc+$invoice[0]['total_value'])-$invoice[0]['round_off'])+$invoice[0]['order_tax'], 1, 2);
                    $totalWithoutTax=bcdiv((($CouponDisc+$invoice[0]['total_value'])-$invoice[0]['round_off']), 1, 2);
                  }
            ?>
             <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;top:2px;top: 8px;margin-bottom: 23px;">
             <div class="col-12" style="margin-top:-10px;margin-bottom: 12px;">
          <span style="float:left">Sub Total	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($SubTotal), 2, '.', '');?></span>
        </div>
        <div class="col-12" style="margin-top:-10px;margin-bottom: 12px;">
          <span style="float:left">Taxable Amount	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($totalWithoutTax), 2, '.', '');?></span>
        </div>
        <?php if($CouponDisc !=0):?>
             <div class="col-12" style="margin-top:-10px;margin-bottom: 12px;">
          <span style="float:left">Coupon Discount	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($CouponDisc), 2, '.', '');?></span>
        </div>
        <?php endif;?>
             <div class="col-12" style="margin-top:-10px;margin-bottom: 12px;">
          <span style="float:left">Rounded Amount	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($invoice[0]['total_value'])-$invoice[0]['round_off'], 2, '.', '');?></span>
        </div>
             <div class="col-12" style="margin-top:-10px;margin-bottom: 12px;">
          <span style="float:left">Rounded Off	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($invoice[0]['round_off']), 2, '.', '');?></span>
        </div>
        <div class="col-12" style="margin-top:-10px">
          <span style="float:left">Grand Total (Rounded Off)	</span>
          <span style="float:right;position: relative;right: 15px;"><?=$shop->currency .number_format((float)($invoice[0]['total_value']), 2, '.', '');?></span>
        </div>
        <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;top:9px;margin-bottom: 23px;">
        <div class="col-12" style="margin-top: -6px; text-align: center;">
        <p class="address2">PIECES PURCHASED : <?=$Tqty;?></p>
          </div>
          <div class="col-12" style="margin-top: -15px; text-align: center;">
        <p class="address2">DISCOUNT ITEMS : <?=$invoice[0]['currency'] . number_format((float)($Tdiscount+$CouponDisc), 2, '.', '');?></p>
          </div>
          <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;top:-6px;margin-bottom: 26px;">
          <div class="col-12" style="margin-top: -25px; text-align: center;">
        <p class="address2">Tax Summary</p>
          </div>
          <div class="col-12" style="margin-top: -10px; text-align: center;">
          <?php
       //echo $invoice[0]['state_name'];
        $igst_per = $cgst_per = $sgst_per = $igst = $cgst = $sgst = 0;

        // Check if cust_state is null or empty
        if (empty($invoice[0]['cust_state'])) {
            // If cust_state is null or empty, apply intra-state tax rules
            $igst = '0';
            $cgst = ($invoice[0]['order_tax']) / 2;
            $sgst = ($invoice[0]['order_tax']) / 2;
            $igst_per = '0';
            $cgst_per = ($invoice[0]['tax_value']) / 2;
            $sgst_per = ($invoice[0]['tax_value']) / 2;
        } else {
            // If cust_state is not null or empty, check for inter-state tax rules
            if ($invoice[0]['cust_state'] != $invoice[0]['state_name']) {
                $igst = $invoice[0]['order_tax'];
                $cgst = '0';
                $sgst = '0';
                $igst_per = $invoice[0]['tax_value'];
                $cgst_per = '0';
                $sgst_per = '0';
            } else {
                $igst = '0';
                $cgst = ($invoice[0]['order_tax']) / 2;
                $sgst = ($invoice[0]['order_tax']) / 2;
                $igst_per = '0';
                $cgst_per = ($invoice[0]['tax_value']) / 2;
                $sgst_per = ($invoice[0]['tax_value']) / 2;
            }
        }
      
        ?>
           <table class="table text-center" width="100%">
            <tr style="border:1px solid black">
              <td style="border:1px solid black" class="address">TAXABLE VALUE</td>
              <td style="border:1px solid black" class="address">CGST<br>(@<?=$cgst_per;?>%)</td>
              <td style="border:1px solid black" class="address">SGST<br>(@<?=$sgst_per;?>%)</td>
              <td style="border:1px solid black" class="address">IGST<br>(@<?=$igst_per;?>%)</td>
            </tr>
            <tr style="border:1px solid black">
              <td style="border:1px solid black" class="address"><?=$invoice[0]['currency'];?><?php echo number_format((float)(($totalWithoutTax)), 2, '.', '');?></td>
              <td style="border:1px solid black" class="address">₹ <?php echo number_format((float)$cgst, 2, '.', ''); ?></td>
              <td style="border:1px solid black" class="address">₹ <?php echo number_format((float)$sgst, 2, '.', ''); ?></td>
              <td style="border:1px solid black" class="address">₹ <?php echo number_format((float)$igst, 2, '.', ''); ?></td>
            </tr>
           </table>
          </div>
          <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;top:-2px;margin-bottom: 27px;">
          <div class="col-12" style="margin-top: -20px">
        <p class="address">Customer Details</p>
          </div>
          <div class="col-12" style="margin-top: -15px">
          <?php 
           $address = $invoice[0]['cust_address'].' &nbsp;'.$invoice[0]['cust_city'] .'&nbsp;' .$invoice[0]['cust_state'].' '. $invoice[0]['cust_pincode'];
            $name = $invoice[0]['fname'].' '.$invoice[0]['lname'];
        
       
        ?>
        <p class="address2">Address : <?=$address;?></p>
        <p class="address2" style="margin-top:-15px">Reference No : <?=$invoice[0]['reference_no_or_remark'];?></p>
          </div>

          <hr style="border-top: 2px dashed black; width: 92%; color: #000;position:relative;left:10px;top:-4px;    margin-bottom: 20px;">
          <div class="col-12" style="margin-top: -15px">
        <p class="address2">T & C</p>
          </div>
          <div class="col-12" style="margin-top: -15px">
        <p class="address2"> 1.NO RETURN POLICY ONLY EXCHANGE</p>
          </div>
          <div class="col-12" style="margin-top: -15px">
        <p class="address2">2.TIME PERIOD FOR EXCHANGE IS 7 DAYS</p>
          </div>
          <div class="col-12" style="margin-top: -15px">
        <p class="address2">3.MON-SAT ONLY</p>
          </div>
          <div class="col-12" style="margin-top: -15px">
        <p class="address2">4.ITEMS SHOULD BE
          UNUSED, UNWORN, UNWASHED AND
          UNDAMAGED</p>
          </div>
          <div class="col-12" style="margin-top: -10px;text-align:center">
        <p class="address2">Thank you for shopping with us!</p>
          </div>
          <div class="col-9" style="margin-top: -10px">
        <p class="address2" style="font-size:13px"><?php echo "Printed On: " . date("m/d/Y h:i A");?></p>
          </div>
          <div class="col-3" style="margin-top: -10px">
        <p class="address2" style="font-size:13px">E & O E</p>
          </div>
          <div class="col-12" style="margin-top: -10px">
        <p class="address2" style="font-size:13px">visit :<a href="https://drumtrum.com/"> https://drumtrum.com</a></p>
          </div>
       </div>

    
    </section>

    <script type="text/javascript">
      jQuery.fn.exists = function(){return this.length>0;}
      function numberToWords(number) {  
          var digit = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];  
          var elevenSeries = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];  
          var countingByTens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];  
          var shortScale = ['', 'thousand', 'million', 'billion', 'trillion'];  

          number = number.toString(); number = number.replace(/[\, ]/g, ''); if (number != parseFloat(number)) return 'not a number'; var x = number.indexOf('.'); if (x == -1) x = number.length; if (x > 15) return 'too big'; var n = number.split(''); var str = ''; var sk = 0; for (var i = 0; i < x; i++) { if ((x - i) % 3 == 2) { if (n[i] == '1') { str += elevenSeries[Number(n[i + 1])] + ' '; i++; sk = 1; } else if (n[i] != 0) { str += countingByTens[n[i] - 2] + ' '; sk = 1; } } else if (n[i] != 0) { str += digit[n[i]] + ' '; if ((x - i) % 3 == 0) str += 'hundred '; sk = 1; } if ((x - i) % 3 == 1) { if (sk) str += shortScale[(x - i - 1) / 3] + ' '; sk = 0; } } if (x != number.length) { var y = number.length; str += 'point '; for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' '; } str = str.replace(/\number+/g, ' '); return str.trim() + " Only";  
      } 

      $(document).ready(function(){
        $('[nf]').each(function(){
          $(this).text(parseFloat($(this).text()).toFixed(2));
        });
        
        for (var i = 1; i <= 3; i++) {
          $(`tr.item-row${i}`).last().css('border-bottom','0px');
          var items_tb_height = 380;
          var tb_height = 0;
          $(`.item-row${i}`).each(function(){
            tb_height += Number($(this).height());
            $(`tr.fill-row${i}`).css('height',items_tb_height - tb_height);
          });

          var qty       = $(`[qty${i}]`);
          var total_qty = $(`[total_qty${i}]`);
          if (qty.exists()) {
            qty.each(function(){
              total_qty.text(parseFloat(Number($(this).text()) + Number(total_qty.text())).toFixed(2));
            });
          }

          var free        = $(`[free${i}]`);
          var total_free  = $(`[total_free${i}]`);
          if (free.exists()) {
            free.each(function(){
              total_free.text(parseFloat(Number($(this).text()) + Number(total_free.text())).toFixed(2));
            });
          }

          var list_price        = $(`[list_price${i}]`);
          var total_list_price  = $(`[total_list_price${i}]`);
          if (list_price.exists()) {
            list_price.each(function(){
              total_list_price.text(parseFloat(Number($(this).text()) + Number(total_list_price.text())).toFixed(2));
            });
          }

          var cgst        = $(`[cgst${i}]`);
          var total_cgst  = $(`[total_cgst${i}]`);
          if (cgst.exists()) {
            cgst.each(function(){
              total_cgst.text(parseFloat(Number($(this).text()) + Number(total_cgst.text())).toFixed(2));
            });
          }

          var sgst        = $(`[sgst${i}]`);
          var total_sgst  = $(`[total_sgst${i}]`);
          if (sgst.exists()) {
            sgst.each(function(){
              total_sgst.text(parseFloat(Number($(this).text()) + Number(total_sgst.text())).toFixed(2));
            });
          }

          var igst        = $(`[igst${i}]`);
          var total_igst  = $(`[total_igst${i}]`);
          if (igst.exists()) {
            igst.each(function(){
              total_igst.text(parseFloat(Number($(this).text()) + Number(total_igst.text())).toFixed(2));
            });
          }

          var amount        = $(`[amount${i}]`);
          var total_amount  = $(`[total_amount${i}]`);
          if (amount.exists()) {
            amount.each(function(){
              total_amount.text(parseFloat(Number($(this).text()) + Number(total_amount.text())).toFixed(2));
              $(`[total_amount_words${i}]`).text(numberToWords(Number(total_amount.text())));
            });
          }
        }

        function get_amount(j){
          var total_amount = parseFloat($(`[total_amount${j}]`).text());
          var f_taxable_amount = ((total_amount * 100)/(Number('<?=$items[0]->tax_value?>')+100)).toFixed(2);
          $(`[f_taxable_amount${j}]`).text(f_taxable_amount);
          $(`[f_total_tax${j}]`).text((total_amount - f_taxable_amount).toFixed(2));
          $(`[f_total_amount${j}]`).text((total_amount).toFixed(2));
        }

        setTimeout(function() {
          get_amount(1);
          get_amount(2);
          get_amount(3);
          window.print();
        }, 50);
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcWZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
