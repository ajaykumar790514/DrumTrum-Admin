
<style type="text/css">
    body{
        font-size: 14px!important;
    }
</style>
<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                        <?php echo $breadcrumb;?>
                    </div><!--
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>-->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ORDER SUMMARY: <strong>#<?php echo $orderData[0]['orderid'];
                                $coupons = $this->pos_orders_model->orderCoupon($orderData[0]['id']);
                              $totalWithoutTax= $totalWithOutTax=  $CouponDisc=0;
                              if($coupons){
                                 foreach($coupons as $c):
                                    if($c['coupon_type']=='2'){
                                        $CouponDisc += $c['discount_amount'];
                                    }
                                endforeach;
                            }
                                  $totalAmount=bcdiv(($CouponDisc+$orderData[0]['total_value'])-$orderData[0]['round_off'], 1, 2);
                                   $totalWithoutTax=bcdiv((($orderData[0]['total_value'])-$orderData[0]['round_off'])-$orderData[0]['tax'], 1, 2);
                                   $SubTotal=bcdiv((($CouponDisc+$orderData[0]['total_value'])-$orderData[0]['round_off']), 1, 2);
                                ;?></strong></h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td style="border-top: none !important; padding: .75rem; vertical-align: bottom; border-bottom: 1px solid #dee2e6;">Order Date</td>
                                                <td style="border-top: none !important; padding: .75rem; vertical-align: bottom; border-bottom: 1px solid #dee2e6;"><?php 
                                                    $formattedDate = date('d-m-Y h:i A', strtotime($orderData[0]['added']));
                                                    echo $formattedDate;
                                                ?></td>
                                            </tr>    
                                            <tr>
                                                <th>Total items</th>
                                                <th><?php if($orderItems!==FALSE){echo count($orderItems);}else{echo '0';}?></th>
                                            </tr>
                                             <tr>
                                                <th>Sub Total</th>
                                                <th>₹ <?php echo $SubTotal; ?></th>
                                            </tr>
                                          
                                            <tr>
                                                <th>Tax</th>
                                                <th>₹ <?php echo $orderData[0]['tax']; ?></th>
                                            </tr>
                                            <?php if($CouponDisc > 0):?>
                                            <tr>
                                                <td>Coupon Discount</td>
                                                <td>₹ <?php echo $CouponDisc; ?></td>
                                            </tr>
                                            <?php endif;?>
                                        </thead>
                                        <tbody>
                                       
                                            <tr>
                                                <td>Rounded Amount</td>
                                                <td>₹ <?php echo bcdiv($orderData[0]['total_value']-$orderData[0]['round_off'], 1, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Round OFF</td>
                                                <td>₹ <?php echo  bcdiv($orderData[0]['round_off'], 1, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>₹ <?php echo $orderData[0]['total_value']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Savings</td>
                                                <td>₹ <?php echo $orderData[0]['total_savings']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Remarks</td>
                                                <td><?php echo $orderData[0]['remark']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Order Details</strong></h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>

                                            <tr>
                                                <th>Customer Name</th>
                                                <th><?php echo $customerData[0]['fname'].' '.$customerData[0]['lname'].' (<span class="text-primary">'.$customerData[0]['mobile'].'</span>)'; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Shop Name</th>
                                                <th><?php echo $orderData[0]['shop_name'].' (<span class="text-primary">'.$orderData[0]['shop_mobile'].'</span>)'; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th><?php 
                                                        if($orderData[0]['same_as_billing']== 1){
                                                            echo $orderData[0]['random_address'];
                                                        }
                                                        else{
                                                            echo $orderData[0]['shipping_address'];
                                                        }   
                                                    ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // Fetch payment details
                                        $payments = $this->pos_orders_model->OrderPayments($orderData[0]['id']);
                                        $payment_modes = [];

                                        // Collect unique payment modes
                                        foreach ($payments as $payment) {
                                            $mode_name = $payment['mode_name'];
                                            if (!in_array($mode_name, $payment_modes)) {
                                                $payment_modes[] = $mode_name;
                                            }
                                        }

                                        // Build a string of payment modes
                                        $payment_modes_string = implode(' + ', $payment_modes);

                                        // Output the payment modes
                                        echo '<tr>';
                                        echo '<td>Payment Mode</td>';

                                        // Check if "Paylater" is among the payment modes
                                        if (in_array('Paylater', $payment_modes)) {
                                            echo '<td>Due Amount</td>';
                                        } else {
                                            echo '<td>By ' . htmlspecialchars($payment_modes_string) . '</td>';
                                        }
                                        echo '</tr>';

                                        // Initialize flags and details for different payment types
                                        $hasCardPayment = false;
                                        $hasPaylater = false;
                                        $hasCash = false;
                                        $hasUpi = false;
                                        $cashDetails = [];
                                        $upiDetails = [];
                                        $paylaterDetails = [];

                                        // Check if any payment mode is 'Card', 'Cash', 'UPI', or 'Paylater'
                                        foreach ($payments as $payment) {
                                            if ($payment['mode_name'] === 'Card' && $payment['card_payment_amount'] > 0) {
                                                $hasCardPayment = true;
                                            }
                                            if ($payment['mode_name'] === 'Cash') {
                                                $hasCash = true;
                                                $cashDetails = $payment; // Store the cash details
                                            }
                                            if ($payment['mode_name'] === 'UPI') {
                                                $hasUpi = true;
                                                $upiDetails = $payment; // Store the UPI details
                                            }
                                            if ($payment['mode_name'] === 'Paylater') {
                                                $hasPaylater = true;
                                                $paylaterDetails = $payment; // Store the paylater details
                                            }
                                        }

                                        // Display card payment details if 'Card' payment mode is found
                                        if ($hasCardPayment):
                                            foreach ($payments as $payment):
                                                if ($payment['mode_name'] === 'Card' && $payment['card_payment_amount'] > 0):
                                        ?>
                                                    <!-- Display card payment details -->
                                                    <tr>
                                                        <td>Payment Bank Name</td>
                                                        <td><?php echo ($payment['bank_name']); ?> <?php echo ($payment['branch_name']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Customer Bank Name</td>
                                                        <td><?php echo ($payment['customer_bank_name']); ?></td>
                                                    </tr>
                                                
                                                    <tr>
                                                        <td>Card Holder Name</td>
                                                        <td><?php echo ($payment['card_holder_name']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Card Transaction No</td>
                                                        <td><?php echo ($payment['card_tr_no']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Card  Amount</td>
                                                        <td>₹ <?php echo number_format((float)$payment['card_payment_amount'], 2, '.', ''); ?></td>
                                                    </tr>
                                        <?php
                                                    break;
                                                endif;
                                            endforeach;
                                        endif;

                                        if ($hasPaylater):
                                        ?>
                                            <tr>
                                                <td> Paylater Amount</td>
                                                <td><?php echo ($paylaterDetails['amount']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Paylater Due Date</td>
                                                <td><?php echo ($paylaterDetails['paylater_due_date']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Paylater Terms</td>
                                                <td><?php echo ($paylaterDetails['paylater_terms']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Paylater Reminder</td>
                                                <td><?php echo ($paylaterDetails['paylater_reminder']); ?></td>
                                            </tr>
                                        <?php
                                        endif;

                                        if ($hasCash):
                                        ?>
                                            <tr>
                                                <td>Cash Amount</td>
                                                <td><?php echo ($cashDetails['amount']); ?></td>
                                            </tr>
                                        <?php
                                        endif;

                                        if ($hasUpi):
                                        ?>
                                            <tr>
                                                <td>UPI Amount</td>
                                                <td><?php echo ($upiDetails['amount']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>UPI  Bank Name</td>
                                                <td><?php echo ($upiDetails['bank_name']); ?> <?php echo ($upiDetails['branch_name']); ?></td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
                                             <tr>
                                                <th>Reference No.</th>
                                                <th><?php echo $orderData[0]['reference_no_or_remark']; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Narration</th>
                                                <th><?php echo $orderData[0]['narration']; ?></th>
                                            </tr>
                                           

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Order Status</strong></h4>
                                <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>
                                                    <select class="select" id="order-status" style="width: 100%" data-placeholder="Choose">
                                                    <?php
                                                        if(isset($orderStatus) && $orderStatus!==FALSE){
                                                            if($orderData[0]['status']==='4' || $orderData[0]['status']==='6' || $orderData[0]['status']==='1'){
                                                                if($orderData[0]['status']==='4'){
                                                                    echo '<option value="4">Completed</option>';
                                                                }else if($orderData[0]['status']==='1') {
                                                                    echo '<option value="1">Pending Payment</option>';
                                                                }else{
                                                                    echo '<option value="6">Cancelled</option>';
                                                                }
                                                            }else{
                                                                echo '<option value="">Select Order Status</option>';
                                                                foreach($orderStatus as $status){
                                                                    if($status['order'] >= $orderStatusData[0]['order']){
                                                                        echo '<option value="'.$status['id'].'" ';
                                                                        if($status['id']===$orderData[0]['status']){
                                                                            echo 'selected';
                                                                        }
                                                                        echo '>'.$status['name'].'</option>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><button class="btn btn-danger float-right" id="status-update">Update Status</button></th>
                                            </tr>
                                        </thead>
                                        <!--<tbody>
                                        <tr>
                                                <td>Assign Delivery Man</td>
                                                <td>
                                                    <select class="select" id="order-delivery" style="width: 100%" data-placeholder="Choose">
                                                        <option value="">Select Order Status</option>
                                                    <?php
                                                    /*
                                                        if(isset($orderStatus) && $orderStatus!==FALSE){
                                                            foreach($orderStatus as $status){
                                                                echo '<option value="'.$status['id'].'" ';
                                                                if($status['id']===$orderData[0]['status']){
                                                                    echo 'selected';
                                                                }
                                                                echo '>'.$status['name'].'</option>';
                                                            }
                                                        }*/
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button class="btn btn-warning float-right assign-delivery">Assign</button></td>
                                            </tr>
                                        </tbody>-->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        // $('#order-status').change(function(e){
                        //     e.preventDefault();
                        //     if($('#order-status option:selected').val() === '2'){
                        //         Swal.fire({
                        //           title: 'Please enter the Invoice number for this order',
                        //           input: 'text',
                        //           inputAttributes: {
                        //             autocapitalize: 'off'
                        //           }, 
                        //           confirmButtonText: 'Update',
                        //           showLoaderOnConfirm: true,
                        //           preConfirm: (login) => {
                        //             return $.ajax({
                        //                     type:"POST",
                        //                     url: "orders/updateOrderBillNo",
                        //                     data: {id: "<?php echo $orderData[0]['id'];?>",bill_no:login},
                        //                 });
                        //           },
                        //           allowOutsideClick: () => !Swal.isLoading()
                        //         }).then((result) => {
                        //           if (result.isConfirmed) {
                        //             Swal.fire({
                        //               title: 'Invoice number updated',
                        //             })
                        //           }
                        //         })
                        //     }
                        // });
                        $('#status-update').click(function(e){
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: true
                                })

                                swalWithBootstrapButtons.fire({
                                    title: 'Are you sure to update the status to '+$('#order-status option:selected').text()+' ?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, please!',
                                    cancelButtonText: 'No, cancel!',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        return $.ajax({
                                            type:"POST",
                                            url: "pos_orders/updateOrderStatus",
                                            data: {item:{id: "<?php echo $orderData[0]['id'];?>",status:$('#order-status option:selected').val()}},
                                            'success': function (data) {
                                                // console.log(data);
                                                swalWithBootstrapButtons.fire(
                                                    'Success!',
                                                    'Status has been updated.',
                                                    'success',
                                                ).then((result) => {

                                                    //$("#grid_table").jsGrid("loadData");
                                                    location.reload();
                                                })
                                            }
                                        });
                                    } else if (
                                        /* Read more about handling dismissals below */
                                        result.dismiss === Swal.DismissReason.cancel
                                    ) {
                                        swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                        'You\'ve cancelled the transaction',
                                        'error'
                                        )
                                    }
                                })
                            
                        });
                        $('.assign-delivery').click(function(e){
                            alert('ese');
                        });
                    </script>
                    <div class="col-lg-8">
                        <div class="card">
                            <!-- .left-right-aside-column-->
                            <div class="card-body">
                                <h4 class="card-title">Order Items</h4>                        
                                <div class="contact-page-aside">
                                    <div class="table-responsive">
                                        <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list table-sm" data-paging="true" data-paging-size="7">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Product Name</th>
                                                    <th>Unit</th>
                                                    <th int>MRP</th>
                                                    <th>Disc1</th>
                                                    <th>Disc2</th>
                                                    <th>Flat Discount</th>
                                                    <th int>Rate</th>
                                                    <th int>Qty</th>
                                                    <th>Tax</th>
                                                    <th int >Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total=0;
                                                    if($orderItems!==FALSE){
                                                        $count=1;
                                                        foreach($orderItems as $items){

                                                            $dt1 = ($items['discount_type']==0) ? '%' : 'fixed' ;

                                                            $dt2 =($items['discount_type2']==0) ? '%' : 'fixed';
                                                            $dt3 =($items['flat_discount_type']==1) ? '%' : 'fixed';

                                                            $disc1 = ($items['discount_type']==0) ? '%' : 'OFF' ;
                                                            $disc2 = ($items['discount_type2']==0) ? '%' : 'OFF' ;
                                                            $disc3 = ($items['flat_discount_type']==1) ? '%' : 'OFF' ;
                                                            echo '<tr>';
                                                            echo '<td>'.$count.'</td>';
                                                            echo '<td>'.$items['product_name'].'<br> <strong>('.str_pad($items['product_code'], 6, '0', STR_PAD_LEFT).')</strong></td>';
                                                            echo '<td>'.$items['unit_value'].' '.$items['unit_type'].'</td>';
                                                            echo '<td int>₹ '.$items['price_per_unit'].'</td>';
                                                            echo '<td '.$dt1.' >'.$items['offer_applied'].$disc1.'</td>';
                                                            echo '<td '.$dt2.' >'.$items['offer_applied2'].$disc2.'</td>';
                                                            echo '<td '.$dt3.' >'.$items['flat_discount'].$disc3.'</td>';
                                                            echo '<td int>₹ '.$items['mrp'].'</td>';
                                                            echo '<td int>'.$items['qty'].'</td>';
                                                            echo '<td>'.$items['tax_value'].'%</td>';
                                                            echo '<td int >₹ '.$items['total_price'].'</td>';
                                                            
                                                            // if (@$items['is_returned']==0) {
                                                            // echo "<td> <a href='javascript:void(0)' return-item data-id='".$items['id']."' class='btn btn-warning btn-xs'>Return </a> </td>";
                                                            // }
                                                            // else{
                                                            //    echo "<td> Returned </td>"; 
                                                            // }
                                                            
                                                            echo '</tr>';
                                                            $count++;
                                                            $total+=$items['total_price'];
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <!-- .left-aside-column-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

<script type="text/javascript">
    // const swalWithBootstrapButtons = Swal.mixin({
    //                                 customClass: {
    //                                     confirmButton: 'btn btn-success',
    //                                     cancelButton: 'btn btn-danger'
    //                                 },
    //                                 buttonsStyling: true
    //                             })
    // $('body').on('click','[return-item]',function(){
    //     var id = $(this).attr('data-id');
    //     $.ajax({
    //         url:'<?=base_url()?>pos-return-items',
    //         data:{id:id},
    //         dataType:'JSON',
    //         type:'POST',
    //         success:function(data){
    //             swalWithBootstrapButtons.fire(
    //                 data.res,
    //                 data.msg,
    //                 data.res,
    //             ).then((result) => {

    //                 //$("#grid_table").jsGrid("loadData");
    //                 location.reload();
    //             })
    //         }
    //     })
    //     // alert(id);
    // })

 $('body').on('click','[return-item]',function(){
    var id = $(this).attr('data-id');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure to return this item',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, please!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            return $.ajax({
            url:'<?=base_url()?>pos-return-items',
            data:{id:id},
            dataType:'JSON',
            type:'POST',
            success:function(data){
                swalWithBootstrapButtons.fire(
                    data.res,
                    data.msg,
                    data.res,
                ).then((result) => {

                    //$("#grid_table").jsGrid("loadData");
                    location.reload();
                })
            }
        });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'You\'ve cancelled',
            'error'
            )
        }
    })
})
</script>