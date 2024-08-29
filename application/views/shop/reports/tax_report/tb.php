<style>
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
/* CSS class to remove border for printing */
.print-no-border {
    border: none !important; /* Remove the border */
    width: 100% !important; /* Ensure full width */
}
.tax-summary 
{
    border: 2px solid grey;
    padding:10px;
}
.tax-summary .header .name{
    font-weight: 800;
    font-size: 26px;
    text-align: center;
}
.tax-summary .header .address{
    font-weight: 700;
    font-size: 16px;
    text-align: center;
    
}
.tax-summary .header .gstin{
    font-weight: 700;
    font-size: 16px;
    text-align: center;
}
.tax-summary .header .summary{
    font-weight: 700;
    font-size: 16px;
    text-align: center;
}
.tax-summary .header .date{
    font-weight: 700;
    font-size: 15px;
    text-align: right;
}
.tax-summary .main-content .hr
{
    position: relative;
    border: none;
    border-top: 2px solid grey;
    margin-bottom: 20px;
    margin-top: 6px;
    width: 99.5%;
    left: 4px;
}
.tax-summary .main-content label {
    display: inline-block;
    margin-bottom: .5rem;
    font-size: 10px;
    color: black;
    font-weight: 900;
}
.tax-summary .main-content span {
    display: inline-block;
    margin-bottom: .5rem;
    font-size: 10px;
    font-weight: 900;
    line-height: 5px;
}
.tax-summary .main-content .range2 {
    line-height:5px;
}


</style>
<div class="row">
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">From date:</label>
                <input type="date" class="form-control form-control-sm" name="from_date" id="from_date" value="<?php if(!empty($from_date)){echo $from_date; }?>">
            </div>
            <div id="msg"></div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">To date:</label>
                <input type="date" class="form-control form-control-sm" name="to_date" id="to_date" value="<?php if(!empty($to_date)){echo $to_date; }?>" onchange="filter_tax_report(this.value)">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
            <label class="control-label">Status:</label>
            <select class="form-control form-control-sm" style="width:100%;" name="status_id" id="status_id" onchange="filter_by_status(this.value)">
            <option value="">Select</option>
            <?php foreach ($order_status as $status) { ?>
            <option value="<?php echo $status->id; ?>" <?php if(!empty($status_id)) { if($status_id==$status->id) {echo "selected"; } }?>>
                <?php echo $status->name; ?>
            </option>
            <?php } ?>
            </select>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="form-group" style="margin-top:30px">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm mb-3 mr-3" id="reset-data" title="Reset"><i class="fas fa-retweet"></i></a>
            <?php if(!empty($to_date)) { ?>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm mb-3 printSummary" onclick="printDiv('printableArea')"><i class="fas fa-arrow-up"></i></a>
            <?php }?>
            </div>
        </div>
       
</div>
<?php if(!empty($to_date)) { ?>
  <div class="tax-summary bg-white" id="printableArea">
         <div class="header">
              <div class="name">
                   <span><?=$shops->shop_name;?></span>
              </div>
              <div class="address">
                   <span><?=$shops->address.' '.$shops->city_name.' '.$shops->state_name.' '.$shops->pin_code;?></span>
              </div>
              <div class="gstin">
                   <span>GSTIN : <?=$shops->gstin;?></span>
              </div>
              <div class="summary">
                   <span>GST SUMMARY</span>
              </div>
              <div class="date">
                   <span>FROM <?=date('d-m-Y',@strtotime($from_date));?> TO <?=date('d-m-Y',@strtotime($to_date));?></span>
              </div>
         </div>
         <div class="main-content">
                <div class="hr"></div>
                <div class="row ml-1">
                    <div class="col-lg-5"><label>Details</label></div>
                    <div class="col-lg-2"><label>Taxable Amt.</label></div>
                    <div class="col-lg-1"><label>IGST</label></div>
                    <div class="col-lg-1"><label>CGST </label></div>
                    <div class="col-lg-1"><label>SGST</label></div>
                    <div class="col-lg-2"><label>Total Tax</label></div>
                </div>
                <div class="hr"></div>
                <!-- Input GST -->
                <?php 
                $inputTotalGST = $inputTotalAmount = $inputTotalTax = 0;
                $igstInput = $cgstInput = $sgstInput = 0;
                $slabs = []; 

                foreach($tax_report_input as $input) {
                    $inputTotalAmount += $input['total_amount'];
                    $inputTotalTax += $input['total_tax'];
                    $inputTotalGST = $inputTotalAmount - $inputTotalTax;

                    // Calculate IGST, CGST, SGST based on the state
                    if (empty($input['cust_state'])) {
                        $cgstInput += $input['total_tax'] / 2;
                        $sgstInput += $input['total_tax'] / 2;
                    } else {
                        if ($input['cust_state'] != $input['shops_state']) {
                            $igstInput += $input['total_tax'];
                        } else {
                            $cgstInput += $input['total_tax'] / 2;
                            $sgstInput += $input['total_tax'] / 2;
                        }
                    }

                    $InputItems = $this->reports_model->getData('purchase_items', ['purchase_id' => $input['id']]);
                    
                    foreach($InputItems as $iItem) {
                        $slab = $iItem->tax; 

                        if (!isset($slabs[$slab])) {
                            $slabs[$slab] = ['amount' => 0, 'igst' => 0, 'cgst' => 0, 'sgst' => 0, 'total_tax' => 0];
                        }
                        
                        $slabs[$slab]['amount'] += $iItem->total-$iItem->tax_value;
                        $slabs[$slab]['total_tax'] += $iItem->tax_value;

                        if (empty($input['cust_state'])) {
                            $slabs[$slab]['cgst'] += $iItem->tax_value / 2;
                            $slabs[$slab]['sgst'] += $iItem->tax_value / 2;
                        } else {
                            if ($input['cust_state'] != $input['shops_state']) {
                                $slabs[$slab]['igst'] += $iItem->tax_value;
                            } else {
                                $slabs[$slab]['cgst'] += $iItem->tax_value / 2;
                                $slabs[$slab]['sgst'] += $iItem->tax_value / 2;
                            }
                        }
                    }
                }?>
                <div class="row ml-1">
                    <div class="col-lg-5"><span>Input GST</span></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($inputTotalGST, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($igstInput, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($cgstInput, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($sgstInput, 1, 2);?></span></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($inputTotalTax, 1, 2);?></span></div>
                </div>
                <?php 
                foreach($slabs as $percentage => $data) {
                    if ($data['amount'] > 0) { // Display only if there's data for the slab
                        echo '<div class="row ml-1">';
                        echo '<div class="col-lg-5"><span class="range">@ ' . $percentage . ' % (Local)</span></div>';
                        echo '<div class="col-lg-2"><span class="range">' . bcdiv($data['amount'], 1, 2) . '</span></div>';
                        echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['igst'], 1, 2) . '</span></div>';
                        echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['cgst'], 1, 2) . '</span></div>';
                        echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['sgst'], 1, 2) . '</span></div>';
                        echo '<div class="col-lg-2"><span class="range">' . bcdiv($data['total_tax'], 1, 2) . '</span></div>';
                        echo '</div>';
                    }
                }
                ?>
                <!-- Output GST -->
                <?php 
                        $igstOutputOrder = $cgstOutputOrder= $sgstOutputOrder = 0;
                        $igstOutputPos = $cgstOutputPos= $sgstOutputPos = 0;
                        $igstOutput = $cgstOutput= $sgstOutput = $TotalPosOrdertax=0;
                        $OrderTotalAmount=$OrderTotalTax=$OrderTotalWithoutTax=0;
                        $PosTotalAmount=$PosTotalTax=$PosTotalWithoutTax=0;
                        $TotalTaxableAmount=$test=0;
                        $slabsOutput = []; 

                        // Process Output Orders
                        foreach($Outputorders as $orders){
                            $OuputOrdersItems = $this->reports_model->getData('order_items', ['order_id' => $orders['id']]);

                            $OrderTotalAmount += $orders['total_value'];
                            $OrderTotalTax += $orders['tax'];
                             $OrderTotalWithoutTax +=$orders['total_value'] - $orders['tax'];

                            // Calculate IGST, CGST, SGST based on the state
                            if (empty($orders['cust_state'])) {
                                $cgstOutputOrder += $orders['tax'] / 2;
                                $sgstOutputOrder += $orders['tax'] / 2;
                            } else {
                                if ($orders['cust_state'] != $orders['shops_state']) {
                                    $igstOutputOrder += $orders['tax'];
                                } else {
                                    $cgstOutputOrder += $orders['tax'] / 2;
                                    $sgstOutputOrder += $orders['tax'] / 2;
                                }
                            }

                            foreach($OuputOrdersItems as $oItem) {
                                $slab = $oItem->tax_value;

                                if (!isset($slabsOutput[$slab])) {
                                    $slabsOutput[$slab] = ['amount' => 0, 'igst' => 0, 'cgst' => 0, 'sgst' => 0, 'total_tax' => 0];
                                }

                                $slabsOutput[$slab]['amount'] += $oItem->total_price - $oItem->tax;
                                $slabsOutput[$slab]['total_tax'] += $oItem->tax;

                                if (empty($orders['cust_state'])) {
                                    $slabsOutput[$slab]['cgst'] += $oItem->tax / 2;
                                    $slabsOutput[$slab]['sgst'] += $oItem->tax / 2;
                                } else {
                                    if ($orders['cust_state'] != $orders['shops_state']) {
                                        $slabsOutput[$slab]['igst'] += $oItem->tax;
                                    } else {
                                        $slabsOutput[$slab]['cgst'] += $oItem->tax / 2;
                                        $slabsOutput[$slab]['sgst'] += $oItem->tax / 2;
                                    }
                                }
                            }
                        }

                        // Process Output POS Orders
                        foreach($OutputposOrders as $pos){
                            $OuputPosItems = $this->reports_model->getData('pos_order_items', ['order_id' => $pos['id']]);
                            $coupons = $this->pos_orders_model->orderCoupon($pos['id']);
                            $CouponDisc = 0;
                            if($coupons){
                                foreach($coupons as $c){
                                    if($c['coupon_type'] == '2'){
                                        $CouponDisc += $c['discount_amount'];
                                    }
                                }
                            }
                            if($CouponDisc!=0){
                            $totalWithoutTax = bcdiv(($CouponDisc + $pos['total_value']) - $pos['round_off'], 1, 2);
                            }else{
                                $totalWithoutTax = bcdiv((($CouponDisc + $pos['total_value']) - $pos['round_off'])-$pos['tax'], 1, 2); 
                            }
                            $PosTotalWithoutTax += $totalWithoutTax;
                            $PosTotalTax += $pos['tax'];

                            // Calculate IGST, CGST, SGST based on the state
                            if (empty($pos['cust_state'])) {
                                $cgstOutputPos += $pos['tax'] / 2;
                                $sgstOutputPos += $pos['tax'] / 2;
                            } else {
                                if ($pos['cust_state'] != $pos['shops_state']) {
                                    $igstOutputPos += $pos['tax'];
                                } else {
                                    $cgstOutputPos += $pos['tax'] / 2;
                                    $sgstOutputPos += $pos['tax'] / 2;
                                }
                            }
                               
                            foreach($OuputPosItems as $pItem) {
                                $slab = $pItem->tax_value;

                                if (!isset($slabsOutput[$slab])) {
                                    $slabsOutput[$slab] = ['amount' => 0, 'igst' => 0, 'cgst' => 0, 'sgst' => 0, 'total_tax' => 0];
                                }
                                 $test += $pItem->total_price - $pItem->tax;

                                $slabsOutput[$slab]['amount'] += $pItem->total_price - $pItem->tax;
                                $slabsOutput[$slab]['total_tax'] += $pItem->tax;

                                if (empty($pos['cust_state'])) {
                                    $slabsOutput[$slab]['cgst'] += $pItem->tax / 2;
                                    $slabsOutput[$slab]['sgst'] += $pItem->tax / 2;
                                } else {
                                    if ($pos['cust_state'] != $pos['shops_state']) {
                                        $slabsOutput[$slab]['igst'] += $pItem->tax;
                                    } else {
                                        $slabsOutput[$slab]['cgst'] += $pItem->tax / 2;
                                        $slabsOutput[$slab]['sgst'] += $pItem->tax / 2;
                                    }
                                }
                            }
                        }

                        // Summarize totals
                        // echo $test."<br>";
                        //   echo $PosTotalWithoutTax;
                        $TotalTaxableAmount = $OrderTotalWithoutTax + $PosTotalWithoutTax;
                        $igstOutput = $igstOutputOrder + $igstOutputPos;
                        $cgstOutput = $cgstOutputOrder + $cgstOutputPos;
                        $sgstOutput = $sgstOutputOrder + $sgstOutputPos;
                        $TotalPosOrdertax = $PosTotalTax + $OrderTotalTax;

                        ?>  

                        <!-- Display Output GST Summary -->
                        <div class="row ml-1 mt-3">
                            <div class="col-lg-5"><span>Output GST</span></div>
                            <div class="col-lg-2"><span><?php echo bcdiv($TotalTaxableAmount, 1, 2);?></span></div>
                            <div class="col-lg-1"><span><?php echo bcdiv($igstOutput, 1, 2);?></span></div>
                            <div class="col-lg-1"><span> <?php echo bcdiv($cgstOutput, 1, 2);?> </span></div>
                            <div class="col-lg-1"><span><?php echo bcdiv($sgstOutput, 1, 2);?> </span></div>
                            <div class="col-lg-2"><span><?php echo bcdiv($TotalPosOrdertax, 1, 2);?></span></div>
                        </div>

                        <!-- Display Slab Breakdown -->
                        <?php 
                        foreach($slabsOutput as $percentage => $data) {
                            if ($data['amount'] > 0) { // Display only if there's data for the slab
                                echo '<div class="row ml-1">';
                                echo '<div class="col-lg-5"><span class="range">@ ' . $percentage . ' % (Local)</span></div>';
                                echo '<div class="col-lg-2"><span class="range">' . bcdiv($data['amount'], 1, 2) . '</span></div>';
                                echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['igst'], 1, 2) . '</span></div>';
                                echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['cgst'], 1, 2) . '</span></div>';
                                echo '<div class="col-lg-1"><span class="range">' . bcdiv($data['sgst'], 1, 2) . '</span></div>';
                                echo '<div class="col-lg-2"><span class="range">' . bcdiv($data['total_tax'], 1, 2) . '</span></div>';
                                echo '</div>';
                            }
                        }
                        ?>

                <!-- Tax calculation -->
                <div class="row ml-1 mt-3">
                    <div class="col-lg-5"><label>Tax Calculation </label></div>
                    <div class="col-lg-2"><label>Taxable Amt.</label></div>
                    <div class="col-lg-1"><label>IGST</label></div>
                    <div class="col-lg-1"><label>CGST </label></div>
                    <div class="col-lg-1"><label>SGST</label></div>
                    <div class="col-lg-2"><label>Total Tax</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-10px">
                    <div class="col-lg-5"><label class="range2">Opening Balance</label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">Input GST</label></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($inputTotalGST, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($igstInput, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($cgstInput, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($sgstInput, 1, 2);?></span></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($inputTotalTax, 1, 2);?></span></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">ITC Adjustment (Reversal / Reclaim / Other Adj.) </label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">RCM Input Adjusted (As Feeded)</label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">Output GST </label></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($TotalTaxableAmount, 1, 2);?></span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($igstOutput, 1, 2);?></span></div>
                    <div class="col-lg-1"><span> <?php echo bcdiv($cgstOutput, 1, 2);?> </span></div>
                    <div class="col-lg-1"><span><?php echo bcdiv($sgstOutput, 1, 2);?> </span></div>
                    <div class="col-lg-2"><span><?php echo bcdiv($TotalPosOrdertax, 1, 2);?></span></div>
                </div>
                <?php 
                  $PayableIGST = $igstOutput-$igstInput;
                  $PayableCGST = $cgstOutput-$cgstInput;
                  $PayableSGST = $sgstOutput-$sgstInput;
                  $PayableTotalTax = $TotalPosOrdertax-$inputTotalTax;
                ?>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">Regular Tax Adjustment (As Feeded)  </label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">GST Payable  </label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableIGST, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableCGST, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableSGST, 1, 2);?></label></div>
                    <div class="col-lg-2"><label class="range2"><?php echo bcdiv($PayableTotalTax, 1, 2);?></label></div>
                </div>
                <!-- Tax Payable with Payment Details -->
                <div class="row ml-1 mt-3">
                    <div class="col-lg-5"><label>Tax Payable with Payment Details</label></div>
                    <div class="col-lg-2"><label>Tax Payable</label></div>
                    <div class="col-lg-1"><label>Tax Paid via TDS/TCS</label></div>
                    <div class="col-lg-1"><label>Payment </label></div>
                    <div class="col-lg-1"><label>Bal. Tax Payable</label></div>
                    <div class="col-lg-2"><label>Ledger Bal</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">IGST  </label></div>
                    <div class="col-lg-2"><label class="range2"><?php echo bcdiv($PayableIGST, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableIGST, 1, 2);?></label></div>
                    <div class="col-lg-2"><label class="range2">0.00</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">CGST  </label></div>
                    <div class="col-lg-2"><label class="range2"><?php echo bcdiv($PayableCGST, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableCGST, 1, 2);?></label></div>
                    <div class="col-lg-2"><label class="range2">80,729.81 Cr</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">SGST  </label></div>
                    <div class="col-lg-2"><label class="range2"><?php echo bcdiv($PayableSGST, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableSGST, 1, 2);?></label></div>
                    <div class="col-lg-2"><label class="range2">80,729.81 Cr</label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">  </label></div>
                    <div class="col-lg-2"><label class="range2">........................</label></div>
                    <div class="col-lg-1"><label class="range2">........................</label></div>
                    <div class="col-lg-1"><label class="range2"> ........................</label></div>
                    <div class="col-lg-1"><label class="range2">........................</label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">Total  </label></div>
                    <div class="col-lg-2"><label class="range2"><?php echo bcdiv($PayableTotalTax, 1, 2);?></label></div>
                    <div class="col-lg-1"><label class="range2">0.00</label></div>
                    <div class="col-lg-1"><label class="range2">0.00 </label></div>
                    <div class="col-lg-1"><label class="range2"><?php echo bcdiv($PayableTotalTax, 1, 2);?></label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                </div>
                <div class="row ml-1" style="margin-top:-4px">
                    <div class="col-lg-5"><label class="range2">  </label></div>
                    <div class="col-lg-2"><label class="range2">........................</label></div>
                    <div class="col-lg-1"><label class="range2">........................</label></div>
                    <div class="col-lg-1"><label class="range2"> ........................</label></div>
                    <div class="col-lg-1"><label class="range2">........................</label></div>
                    <div class="col-lg-2"><label class="range2"></label></div>
                </div>
         </div>
  </div>
  <?php }?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
  <script type="text/javascript">
    function printDiv(divId) {
        var element = document.getElementById(divId);
        element.classList.add('print-no-border');

        var opt = {
            margin:       0.01,
            filename:     'Tax_Summary.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(element).set(opt).save().then(function () {
            element.classList.remove('print-no-border');
            alert('PDF generated and ready to download!');
        });
    }
</script>

<script type="text/javascript">
   function filter_tax_report(to_date)
   {
    if(document.getElementById('from_date').value == 0)
    {
        alert('Please Select From Date');
        document.getElementById('from_date').focus();
        $('#to_date').prop('value',0);
        return false;
    }
$("#datatable").html('<div class="text-center"><img src="loader.gif"></div>');
    var from_date = $("#from_date").val();
    var status_id = $("#status_id").val();
    if(from_date>to_date)
    {
        msg = "From date should be less than to date";
        document.getElementById('msg').style.color='red';
        document.getElementById('msg').innerHTML=msg;
        return;
    }
    $.ajax({
        url: "<?php echo base_url('reports/tax_report/tb'); ?>",
        method: "POST",
        data: {
            from_date:from_date,
            to_date:to_date,
            status_id:status_id
        },
        success: function(data){
            $("#tb").html(data);
        },
    });
   }
</script>

<script type="text/javascript">
   function filter_by_status(status_id)
   {
    $("#datatable").html('<div class="text-center"><img src="loader.gif"></div>');
    var from_date = $("#from_date").val();
    var to_date = $('#to_date').val();
    $.ajax({
        url: "<?php echo base_url('reports/tax_report/tb'); ?>",
        method: "POST",
        data: {
            from_date:from_date,
            to_date:to_date,
            status_id:status_id
        },
        success: function(data){
            $("#tb").html(data);
        },
    });
   }

    $('#reset-data').click(function(){
        location.reload();
    })
</script>

