<link rel="stylesheet" href="<?=base_url();?>public/assets/css/pos.css">
<input type="hidden" value="<?=$order_id;?>" id="oid">
<div class="row main-div " id="main-div" style="background: #fff;">
    <!-- Column -->
    <div class="col-lg-10 col-md-10">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row" style="margin-top: -10px;margin-bottom: -10px;">
                    <div class="col-lg-3 col-md-3 mb-1">
                        <div class="pull-left">
                            <input type="text" name="item" value="" id="item" placeholder="Search Product Name or Scan Barcode..." class="form-control form-control-sm input-sm ui-autocomplete-input" size="50" tabindex="1" autocomplete="off">
                            <span class="ui-helper-hidden-accessible" role="status"></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                    <div class="form-group mb-0" id="select_customer">
                    <input type="text" name="customer" placeholder="Search customer details..." id="customer" class="customer form-control form-control-sm input-sm ui-autocomplete-input" autocomplete="off">
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                    <div class="center">
                        <button class="btn btn-sm btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever="Add Customer" data-url="<?=$new_customer?>" ><span class="fa fa-user">&nbsp;</span>New Customer</button>&nbsp;&nbsp;
                    </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                    <div class="order-mode text-right">
                        <label class="mb-0 ">
                            <input type="radio" name="orderType" id="orderType" checked value="Walk In">
                            <span>Walk In</span>
                        </label>
                        <label class="mb-0 ">
                            <input type="radio" name="orderType" id="orderType" value="Delivery">
                            <span>Online</span>
                        </label>
                    </div>
                </div>

                </div>
            </div>
        </div>
        <div id="datatable">
            <div id="grid_table" class="table-responsive ">
                <table width="100%" id="item-table">
                    <thead>
                        <tr class="jsgrid-header-row">
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:7%">Delete</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width: 12%">Product Code</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:24%">Product Name</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:7%">MRP </th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:11%">Disc / Unit Price</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:9%">Selling Price</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:6%">Quantity</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:6%">Total</th>
                            
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:11%">Dis2 / Unit  Price</th>
                            <th class="jsgrid-header-cell jsgrid-align-center" style="width:6%">Profit %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="noItem">
                            <td class="jsgrid-cell jsgrid-align-center" colspan="10">
                                <div class="alert alert-dismissible alert-info mb-0" id="bill_details">There are no Product in the cart.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            <!-- </form> -->
            </div>
        </div>
        <div class="pos-left-bottom-fixed">
	        <div class="row">
            <input type="hidden" id="is_hold" class="is_hold">
            <div class="col-lg-3 mb-0 form-group" id="lastfutterdetails">
	          <input type="text" class="form-control form-control-sm" name="reference_no_or_remark" id="reference_no_or_remark" placeholder="Reference No." value="" autocomplete="off" data-fv-field="reference_no_or_remark" fdprocessedid="ege1kv">
            </div>
            <div class="col-lg-5 mb-0 form-group" id="lastfutterdetails">
	          <input type="text" class="form-control form-control-sm" name="narration" id="narration" placeholder="Narration" value="" autocomplete="off" data-fv-field="narration" fdprocessedid="ege1kv">
            </div>
            <div class="col-lg-4 mb-0 form-group" id="lastfutterdetails">
             <div class="row">
                <div class="col-mg-4">
                <label>Due Date:</label>
                </div>
                <div class="col-md-8">
                <input type="date" name="due_date" id="due_date" class="due_date form-control form-control-sm" data-date-inline-picker="true" >
                </div>
             </div>   
            </div>             
	        <div class="col-12 mt-1 mb-0 text-center" id="lastfutterdetails">
	          <div class="invoice-summary bg-white pt-1 pb-1 col-12">
	            <div class="row">
	               <div class="col border-right ">  
	                <h6 id="total_quantity">0</h6>
	                <span style="font-weight:700;">Quantity</span>
	                </div>
	                <div class="col border-right ">
	                <h6 id="sub_total">0</h6>
	                <span style="font-weight:700;">Sub Total</span>
					</div>
	                
                                                            <div class="col border-right ">
	                                       						<h6 id="tax_amount">0</h6>
	                                       						<span style="font-weight:700;">Tax Amount</span>
	                                    					</div>
                                                           
	                                    				
	                                    					<div class="col border-right">
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <button type="button" id="btn_percentage_flat_discount" onclick="changeDiscountType('1')" class="btn btn-dark btn-percent">
                                                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                                                </button>
                                                            </span>
                                                            <input type="text" id="flat_discount" name="flatDiscount" onchange="checkFlat()" style="max-width:70px;" class="form-control form-control-sm" value="0" placeholder="Discount">
                                                            <input type="hidden" id="flat_type" class="flat_type">
                                                            <input type="hidden" id="flat_value" class="flat_value">
                                                            
                                                        </div>
                                                        <span style="font-weight:700;margin-top:6px;display:block;">Flat Discount</span>
                                                    </div>

                                                            <div class="col border-right">
	                                       						<h6 id="total_discount_amount">0</h6>
	                                       						<span style="font-weight: 700;">Discount Amount</span>
	                                    					</div>
                                                            <div class="col border-right ">
	                                       						<h6 id="coupon_amount">0</h6>
	                                       						<span style="font-weight:700;">Coupon Disc</span>
	                                    					</div>
															<div class="col border-right ">
                                                                <input type="hidden" id="coupon_code" class="coupon_code">
                                                                <input type="hidden" id="ttotal" class="ttotal">
                                                                <input type="hidden" id="oldTotal" class="oldTotal">
                                                                <input type="hidden" id="coupon_value" name="coupon_value" class="coupon_value">
                                                                <input type="hidden" id="coupon_type" name="coupon_type" class="coupon_type">
                                                                <input type="hidden" id="coupon_net_amount" name="coupon_net_amount" class="coupon_net_amount">
                                                                <input type="hidden" id="coupon_discount_amount" name="coupon_discount_amount" class="coupon_discount_amount">
                                                                
	                                       						<h6 id="rounded_amount">0</h6>
	                                       						<span style="font-weight:700;">Rounded Amount</span>
                                                                
	                                    					</div>
	                                    					<div class="col border-right ">
	                                       						<input type="text" class="form-control form-control-sm text-right" onkeydown="checkforroundoff(event,this)" onchange="setRoundoff()" name="round_off" id="round_off" placeholder="Roundoff" value="" style="margin-bottom:.5rem;" data-fv-field="round_off" fdprocessedid="dcb6jr">
	                                       						<span style="font-weight:700;">Round OFF</span>
	                                    					</div>
	                                    					<div class="col total">
	                                       							<h4 style="font-size:30px;color:#00a4e5;" class="mb-0 font-weight-bold" id="net_amount">0</h4>
	                                       							<span style="font-size:15px;font-weight:700;color:#00a4e5;">Amount</span>
	                                    					</div>
	                                    					<div class="clearfix"></div>
	                                 					</div>
	                                 				</div>
	                              				</div>
	                              				<div class="col-md-12">
	                                 				<div class="footer-button">
	                                    				<div class="col-md-12">
                                       						<div class="row" id="salesbtndiv"> 
                                          						<button type="button" class="col btn btn-dark " onclick="openmultipay()" fdprocessedid="jyvn5"><i class="fa fa-columns" aria-hidden="true"></i> Multiple Pay(F12)</button>
                                                                  <button type="button" class="col btn btn-dark " id="payLatterBillId" onclick="payLatterBill()" fdprocessedid="93jgj">
																	<i class="fa fa-calendar" aria-hidden="true"></i> Pay Later (F11)
																</button>
                                       							<button type="button" class="col btn btn-dark " id="holdbill" onclick="holdbillBill('NoPrint')" fdprocessedid="3h8evq"><i class="fa fa-pause" aria-hidden="true"></i> Hold (F6)</button>
                                       							<button type="button" class="col btn btn-dark " id="upibtn" onclick="setUPIModal('NoPrint')" fdprocessedid="sancjh"><i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-caret-right" aria-hidden="true"></i> UPI (F5)</button>
                                       							<button type="button" class="col btn btn-dark " id="openCardModal">
                                       								<i class="fa fa-credit-card" aria-hidden="true"></i> Card (F3)
                                       							</button>
                                       							<button type="button" onclick="cashOrder()" class="col btn btn-dark" id="cashbtn" data-toggle="modal" data-target="#pos_cash_tendering_model">
                                                                <i class="fa fa-inr text-white currency_style" aria-hidden="true"></i> Cash (F4)
                                                            </button>
                                                            <button type="button" class="col btn btn-dark" id="applyecoupon" onclick="applyeCouponModel()">
                                                                <i class="fa fa-gift" aria-hidden="true"></i> Apply Coupon
                                                            </button>
																<button type="button" class="col btn btn-dark " id="payLatterBillId" onclick="payLatterBillPrint()" fdprocessedid="93jgj">
																	<i class="fa fa-calendar" aria-hidden="true"></i> Pay Later & Print (F11)
																</button>
                                        						<button type="button" class="col btn btn-dark " id="holdbillandprint" onclick="holdbillBill('print')" fdprocessedid="020fpu">
                                        							<i class="fa fa-pause" aria-hidden="true"></i> Hold &amp; Print(F7)
                                        						</button>
                                       								<button type="button" class="col btn btn-dark " id="upiandprintbtn" onclick="setUPIModal('Print')" fdprocessedid="fqiy4d">
                                       									<i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-caret-right" aria-hidden="true"></i> UPI &amp; Print (F10)
                                       								</button>
                                       							<button type="button" class="col btn btn-dark " onclick="cardAndPrint()" fdprocessedid="sypz6n">
                                       								<i class="fa fa-credit-card" aria-hidden="true"></i> Card &amp; Print (F9)
                                       							</button>
                                                                   <button type="button" class="col btn btn-dark" onclick="cashPrint()" id="cashbtn" data-toggle="modal" data-target="#pos_cash_tendering_model">
                                                                <i class="fa fa-inr text-white currency_style" aria-hidden="true"></i> Cash &amp; Print (F8)
                                                            </button>
                                       						</div>
	                                    				</div>
	                                 				</div>
	                                 				<div class="clearfix"></div>
	                              				</div>
	                           				</div>
	                        			</div>
                                </div>


  

    <div class="col-lg-2 col-md-2">
        <div class="card mb-0">
            <div class="card-body pb-0">
            <div class="right-top ">
                <div class="sidebar-widget row">
                    <div class="sidebar-item col-lg-4 col-md-6 one">
                        <a href="javascript:void(0)" title="Hold Bill" onclick="openholdbill()">
                            <i class="fa fa-pause" aria-hidden="true"></i>
                            <span>Hold Bill</span>
                        </a>
                    </div>
                    <div class="sidebar-item col-lg-4 col-md-6 two">
                        <a target="_blank" href="<?=base_url();?>pos_orders/118" title="Orders" id="pos-list">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span>Orders</span>
                        </a>
                    </div>
                </div>
            </div>


                <div class="row mb-1">
                    <div class="col-12 pb-0"><strong>Manual Invoice No</strong></div>
                    <div class="col-12 pt-0 text-center">
                        <input type="text" class="form-control form-control-sm manual_order_number" placeholder="Manual Invoice No" name="manual_order_number">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 pb-0"><strong>Manual Order Date</strong></div>
                    <div class="col-12 pt-0 text-center">
                        <input type="date" class="form-control form-control-sm manual_order_date" placeholder="Manual Order Date" name="manual_order_date">
                    </div>
                </div>
                <div class="customer-highlights ">
				<span class="font-weight-bold">Last Bill No.:</span> <span class="font-weight-bold" id="bill_last_no">NA</span>
                <br>
	            <span class="font-weight-bold">Last Bill Amount:</span> 
                <span id="billlast_amount" class="font-weight-bold"><i class="fa fa-inr currency_style" aria-hidden="true"></i>0.00</span>
	             <button type="button" class="col btn btn-sm btn-dark" id="print_last_bill" >
	             <i class="fa fa-print" aria-hidden="true"></i> Last Bill Print
	             </button>
	             </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <hr style="border: 1px solid black;margin:0px">
                    </div>
                    
                </div>
                
                

                <div id="Customer_div" class="table-responsive" style="display:none;">
                    <style type="text/css">
                        .same_as_billing{
                            position: relative!important;
                            opacity: 1!important;
                            margin: auto!important;
                            left: 1px !important;
                            top: 2px !important;
                            cursor: pointer;
                        }
                    </style>
                    <script type="text/javascript">
                        $('body').on('change','.same_as_billing',function(event){
                            var t = $(this);
                            if (t.is(':checked')) {
                                $('[name=same_as_billing]').val(1);
                            }
                            else {
                                $('[name=same_as_billing]').val(0);
                            }
                        })
                    </script>

                    <table class="jsgrid-table" id="customer_totals" width="100%">
                        <tbody id="Customer-record">
                            <tr class="jsgrid-header-row">

                                <th style="width: 55%;font-size:10px" class="">Customer Name
                                    <input type="hidden" name="cusId" class="cusId">
                                </th>
                                <td style="width: 45%;font-size:10px; text-align: right;" class="CusName"></td>
                            </tr>
                            
                            <tr>
                                <th style="width: 55%;font-size:10px">Mobile No.</th>
                                <td style="width: 45%;font-size:10px; text-align: right;" class="MobileNo"></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;font-size:10px">Email</th>
                                <td style="width: 80%; text-align: right;font-size:10px" class="Email"></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;font-size:10px">GSTN</th>
                                <td style="width: 80%;  text-align: right;font-size:10px" class="GSTN"></td>
                            </tr>
                            <tr>
                                <th style="width: 25%;font-size:10px">Address</th>
                                <td style="width: 75%; text-align: right;font-size:10px" class="Address"></td>
                            </tr>
                            <tr>
                                <th style="width: 100%;font-size:10px">
                                    <label style="font-size:13px;width: 146px !important;" data-toggle="collapse" data-target=".shipping_address"> 
                                        Shipping Address 
                                        <input type="checkbox" class="same_as_billing" checked >
                                        <input type="hidden" name="same_as_billing">
                                        
                                    </label>
                                    <label for="" style="font-size:13px;;width: 146px;position:relative;top: -12px;">Same As Billing</label>
                                    </th>
                            </tr>
                            <tr class="shipping_address collapse">
                                <th style="width: 100%;" colspan="2">
                                    <textarea class="form-control shipping_address" name="shipping_address" placeholder="Shipping Address"></textarea>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <center><button class="btn btn-sm btn-danger" id="RmoveBtn" onclick="RemoveTable()" style="display: none;"><span class="fa fa-remove">&nbsp;</span>Remove</button></center>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="multipay h-100 d-none" id="multipay" style="background: #fff;">
         			<div class="paylater-center mt-3">
            			<div class="container-fluid height-100">
               				<div class="row height-100">
                  				<div class="col-lg-4 col-md-4 col-sm-12 left-vertical-middle">
                     				<div class="row height-100">
                        				<div class="col-lg-12 col-md-12 col-sm-12 ">
                           					<h4 class="mb-3">Sale Summary</h4>
                           					<div class="customer-name">
                              					<p>Customer : <span class="text-primary summary_customer"></span></p>
                           					</div>
                        				</div>
                        				<div class="col-lg-12 col-md-12 col-sm-12">
                           					<div class="table-responsive left-cart-list">
                              					<table class="table table-sm border-bottom" id="sales_summary_table">
                                 					<thead class="thead-dark">
                                    					<tr>
                                       						<th>#</th>
                                       						<th>Product</th>
                                       						<th class="text-right">Qty</th>
                                    					</tr>
                                 					</thead>
                                 					<tbody data-sales-list="">
                                 					    
                                                    </tbody>
                              					</table>
                           					</div>
                        				</div>
                        				<div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-md-12 border-bottom pb-2 mb-2 pl-0 pr-0">
                              					<div class="row">
                                 					<div class="col-lg-8 col-md-8 col-sm-12 col-6">
                                    					<h6 class="mb-0">Sub Total</h6>
                                 					</div>
                                 					<div class="col-lg-4 col-md-4 col-sm-12 col-6 text-right">
                                    					<h6 class="mb-0" id="summary_sub_total"></h6>
                                 					</div>
                              					</div>
                           					</div>
                                               <div class="col-md-12 border-bottom pb-2 mb-2 pl-0 pr-0">
                              					<div class="row">
                                 					<div class="col-lg-8 col-md-8 col-sm-12 col-6">
                                    					<h6 class="mb-0">Taxable Amount</h6>
                                 					</div>
                                 					<div class="col-lg-4 col-md-4 col-sm-12 col-6 text-right">
                                    					<h6 class="mb-0" id="summary_taxable_amount"></h6>
                                 					</div>
                              					</div>
                           					</div>
                           					<div class="col-md-12 border-bottom pb-2 mb-2 pl-0 pr-0">
                              					<div class="row">
                                 					<div class="col-lg-8 col-md-8 col-sm-12 col-6">
                                    					<h6 class="mb-0">Tax Amount</h6>
                                 					</div>
                                 					<div class="col-lg-4 col-md-4 col-sm-12 col-6 text-right">
                                    					<h6 class="mb-0" id="summary_tax_amount"></h6>
                                 					</div>
                              					</div>
                           					</div>
                                               <div class="col-md-12 border-bottom pb-2 mb-2 pl-0 pr-0">
                              					<div class="row">
                                 					<div class="col-lg-8 col-md-8 col-6 col-sm-12">
                                    					<h6 class="mb-0">Rounded Amount</h6>
                                 					</div>
                                 					<div class="col-lg-4 col-md-4 col-sm-12 col-6 text-right">
                                    					<h6 class="mb-0" id="summary_rounded_amount"></h6>
                                 					</div>
                              					</div>	
                           					</div>
                           					<div class="col-md-12 border-bottom pb-2 mb-2 pl-0 pr-0">
                              					<div class="row">
                                 					<div class="col-lg-8 col-md-8 col-6 col-sm-12">
                                    					<h6 class="mb-0">Roundoff</h6>
                                 					</div>
                                 					<div class="col-lg-4 col-md-4 col-sm-12 col-6 text-right">
                                    					<h6 class="mb-0" id="summary_round_off"></h6>
                                 					</div>
                              					</div>	
                           					</div>
                           					<div class="row">
                              					<div class="col-lg-12 col-md-12 col-sm-12 border-bottom text-right pb-2 mb-2">
                                                    <input type="hidden" class="PayableAmount" id="PayableAmount">
                                 					<h2 class="mb-0" class="summary_net_amount" id="summary_net_amount"></h2>
                                 					<h6 class="mb-0">Payable Amount</h6>
                              					</div>
											</div>
                        				</div>
                     				</div>
                  				</div>
                  				<div class="col-lg-8 col-md-8 col-sm-12" style="border-left: solid 0.1rem;">
                     				<div class="row">
                        				<div class="col-lg-1 col-md-2 col-sm-12 col-2">
                           					<h5>Pay</h5>
                        				</div>
                        				<div class="col-lg-3 col-md-4 col-sm-12 col-6">
                        					<input type="hidden" name="deletereceiptids" id="deletereceiptids" value="">
                           					<div class="form-group">
                              					<div class="input-group">
                                 					<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fa fa-inr currency_style" aria-hidden="true"></i></span></div>
                                 					<input type="text" class="form-control form-control-sm" readonly="readonly" value="" id="totalPayment" name="totalPayment" placeholder="Amount">
                              					</div>
                           					</div>
                        				</div>
                                        <div class="col-lg-6 col-md-4 col-sm-12 col-6"></div>
                                        <div class="text-left col-lg-1 col-md-2 col-sm-12 col-2">
                        				<a href="javascript:void(0)" class="btn btn-dark" id="back-to-sale" onclick="backtosale();">Back to Sale</a>
                     				</div>
                     				</div>
                     				<div class="row">
                        				<div class="col-lg-12 col-md-12 col-sm-12" id="copy_here">
                           					<div class="col-md-12 bg-boxes mb-2 payment-row" data-payment-item="template">
                              					<div class="row ">
                                                    <input type="hidden" value="1" name="srno[]" id="srno[]">
                                 					<div class="col-lg-3 col-md-5 col-sm-12" id="receipt_mode_cash">
                                    					<div class="form-group row">
                                       						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Received Amount:</label>
                                       						<div class="col-lg-12 col-md-12 col-sm-12">
                                          						<input type="text" class="form-control form-control-sm decimalset" name="receivedAmount[]" id="receivedAmount" data-payment-amount="" placeholder="Received Amount" onkeyup="calculateChangeAmount()" value="">
                                       						</div>
                                    					</div>
                                 					</div>
                                 					<div class="col-lg-4 col-md-5 col-sm-12 ">
                                    					<div class="form-group row">
                                       						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Payment Method:</label>
                                       						<div class="col-lg-12 col-md-12 col-sm-12">
                                          						<div class="input-group">
                                             						<select class="form-control form-control-sm  " id="payment_method"  name="payment_method[]">
                                                                        <?php foreach($modemultipay as $mode):?>
						                                                <option value="<?=$mode->id;?>"><?=$mode->name;?></option>
                                                                        <?php endforeach;?>
                                             						</select>
                                          						</div>
                                       						</div>
                                    					</div>
                                 					</div>
                                 					<div class="col-lg-4 col-md-6 col-sm-12 d-none" id="payment_bank">
                                    					<div class="form-group row">
                                       						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Payment Account:</label>
                                       						<div class="col-lg-12 col-md-12 col-sm-12">
                                          						<select class="form-control form-control-sm select2" id="bankId" name="bankId[]">
                                                                  <?php foreach($accounts as $account):?>
                                                                    <option value="<?=$account->id;?>"><?=$account->bank_name.' '.$account->branch_name;?></option>
                                                                    <?php endforeach;?>
																</select>
                                       						</div>
                                    					</div>
                                 					</div>
                                 					<div class="col-lg-1 col-md-2 col-sm-1">
                                    					<div class="form-group row">
                                       						<label class="col-form-label col-lg-12 col-md-12 col-sm-12 d-none d-sm-block d-md-block d-lg-block">&nbsp;</label>
                                       						<div class="col-lg-12 col-md-12 col-sm-12">
                                          						<a href="javascript:void(0)" id="paymentRemove" data-payment-remove="" class="btn btn-outline-danger">
                                             						<i class="fa fa-times"></i>
                                          						</a>
                                       						</div>
                                    					</div>
                                 					</div>
                                 					<div class="col-lg-12 col-md-12 col-sm-12 d-none" id="receipt_mode_card">
                                    					<div class="form-group row">     
                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                          						<div class="form-group row">
                                             						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Customer Bank Name:</label>
                                             						<div class="col-lg-12 col-md-12 col-sm-12">
                                                						<input type="text" class="form-control" id="customer_bank_name" name="customer_bank_name[]" placeholder="Customer Bank Name" value="">
                                             						</div>
                                          						</div>
                                       						</div>                               
                                       						<div class="col-lg-3 col-md-3 col-sm-12">
                                          						<div class="form-group row">
                                             						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Card holder name:</label>
                                             						<div class="col-lg-12 col-md-12 col-sm-12">
                                                						<input type="text" class="form-control" id="card_holder_name" name="card_holder_name[]" placeholder="Card holder name" value="">
                                             						</div>
                                          						</div>
                                       						</div>
			                           						<div class="col-lg-3 col-md-12 col-sm-12">
                                          						<div class="form-group row">
                                             						<label class="col-form-label col-lg-12 col-md-12 col-sm-12">Card Transaction No:</label>
                                             						<div class="col-lg-12 col-md-12 col-sm-12">
                                                						<input type="text" class="form-control" id="card_Transaction_no" name="card_Transaction_no[]" placeholder="Card Transaction No." value="">
                                             						</div>
                                          						</div>
                                       						</div>
                                    					</div>
                                 					</div>
                              					</div>
                           					</div>
                                        </div>
                     				</div>
                     				<div class="row">
                        				<div class="col-lg-12 col-md-12 col-sm-12 mt-3 mb-3">
                           					<div class="m-demo-icon__class">
                              					<a href="javascript:void(0)" id="addMorePayment" onclick="AddpaymentDiv()" class="font-weight-bold"><i class="fa fa-plus-square" aria-hidden="true"></i> Add More Payment</a>
                           					</div>
                        				</div>
                        				<div class="col-lg-12 col-md-12 col-sm-12 mt-3 mb-3">
                           					<h3 class="text-danger" id="pending_payment_message">Note : If you don't pay in full, the remaining amount will be considered as Pay Later.</h3>
                           					<div class="clearfix"></div>
                        				</div>
                     				</div>
                  				</div>

               				</div>
            			</div>
         			</div>
         			<div class="clearfix"></div>
         			<div class="footer2">
            			<div class="container-fluid">
               				<div class="row">
                  				<div class="col-lg-12 col-md-12 col-sm-12">
                     				<button type="button" class="btn btn-dark btn-block mt-1 mb-1" id="proceedToPay" onclick="saveMultiPay()">Proceed To Pay
                        				<i class="fa fa-long-arrow-right ml-2"></i>
                        			</button>
                  				</div>
               				</div>
            			</div>
         			</div>
      			</div>

<!-- Model -->
<div class="modal fade pos_card_model" id="pos_card_model" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-sm">
                <h5 class="modal-title">Card Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body modal-body-sm">
            <div class="row">
                  <div class="col-md-12">
                           <label class="mb-0">Payment Account</label>
                           <select class="form-control select2 " style="width: 100%;" id="bankId" name="bankId" placeholder="Select Payment Account bankId">
                            <option value="">Select Bank</option>
                            <?php foreach($accounts as $account):?>
                            <option value="<?=$account->id;?>"><?=$account->bank_name.' '.$account->branch_name;?></option>
                            <?php endforeach;?>
                        </select>
                  </div>
                  <div class="col-md-12 mt-2">
                           <label class="mb-0">Customer Bank Name</label>
                           <input type="text" class="form-control form-control-sm CardBank" id="customerbankmodel" name="CardBank" placeholder="Customer bank Name" value="" autocomplete="off">
                  </div>
                  <div class="col-md-12 mt-2">
                           <label class="mb-0">Card Payment Amount</label>
                           <input type="text" class="form-control form-control-sm decimalset cardAmount" id="cardpaymentamountmodel" name="cardAmount" placeholder="Amount" value="" autocomplete="off">
                        </div>
                  <div class="col-md-12 mt-2">
                           <label class="mb-0">Card Holder Name</label>
                           <input type="text" class="form-control form-control-sm CardHolder" id="cardholdernamemodel" name="CardHolder" placeholder="Card holder name" value="" autocomplete="off">
                        </div>
                  <div class="col-md-12 mt-2">
                           <label class="mb-0">Card Transaction No.</label>
                           <input type="text" class="form-control form-control-sm tr_no" id="card_Transaction_nomodel" name="tr_no" placeholder="Card Transaction No." value="">
                        </div>
               </div>
            </div>
            <div class="modal-footer modal-footer-sm" style="justify-content:center;">
                <button type="button" class="btn btn-sm btn-dark" id="cardPrintbtn" onclick="SaveCard('NoPrint')">Finalize Payment</button>
            </div>
        </div>
    </div>
</div>
   

    <div class="modal fade" id="pos_cash_tendering_model" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <!-- Due Amount Section -->
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 input-group">
                                <label class="col-form-label col-lg-12 col-md-12 col-sm-12 text-center">Due Amount</label>
                                <input readonly="readonly" class="form-control form-control-lg text-center DueAmount_tendering"
                                    id="DueAmount_tendering" placeholder="Due Amount" value="0"
                                    style="border-color: #79D67F; border-width: 2px; font-size: 1.4rem; color: black;">
                            </div>
                        </div>
                    </div>

                    <!-- Tendered Amount Section -->
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 input-group">
                                <label class="col-form-label col-lg-12 col-md-12 col-sm-12 text-center">Tendered</label>
                                <input type="text" onkeydown="check(event, this)" class="form-control form-control-lg text-center tendered"
                                    id="tendered" placeholder="Tendered Amount" value="0" autocomplete="off"
                                    style="border-color: #79D67F; border-width: 2px; font-size: 1.4rem; color: black;">
                            </div>
                        </div>
                    </div>

                    <!-- Change Section -->
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 input-group">
                                <label class="col-form-label col-lg-12 col-md-12 col-sm-12 text-center">Change</label>
                                <input readonly="readonly" type="text" class="form-control form-control-lg text-center change"
                                    id="change" placeholder="Change" value="0"
                                    style="background-color: #A96FC9; color: white; font-size: 1.4rem;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Number Pad and Actions -->
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <!-- Number Buttons -->
                        <div class="row">
                            <!-- Row 1 -->
                            <div class="col-md-12 d-flex">
                                <button type="button" class="btn btn-light" onclick="tenderedSum(1)" style="width: 60px;">1</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(2)" style="width: 60px;">2</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(3)" style="width: 60px;">3</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(5)" style="width: 90px;">+05</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(100)" style="width: 100px;">+100</button>
                            </div>
                            <!-- Row 2 -->
                            <div class="col-md-12 d-flex">
                                <button type="button" class="btn btn-light" onclick="tenderedSum(4)" style="width: 60px;">4</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(5)" style="width: 60px;">5</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(6)" style="width: 60px;">6</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(10)" style="width: 90px;">+10</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(500)" style="width: 100px;">+500</button>
                            </div>
                            <!-- Row 3 -->
                            <div class="col-md-12 d-flex">
                                <button type="button" class="btn btn-light" onclick="tenderedSum(7)" style="width: 60px;">7</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(8)" style="width: 60px;">8</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(9)" style="width: 60px;">9</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(20)" style="width: 90px;">+20</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(2000)" style="width: 100px;">+2000</button>
                            </div>
                            <!-- Row 4 -->
                            <div class="col-md-12 d-flex">
                                <button type="button" class="btn btn-light" onclick="tenderedSum(-1)" style="width: 60px;">C</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(0)" style="width: 60px;">0</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum('.')" style="width: 60px;">.</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(50)" style="width: 90px;">+50</button>
                                <button type="button" class="btn btn-light" onclick="tenderedSum(-1)" style="width: 100px;">
                                    <i class="fa fa-window-close" style="font-size: 1rem"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit and Cancel Actions -->
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="row">
                            <!-- Submit Button -->
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <button type="button" id="SaveCashFromtendered_btn" class="btn btn-block"
                                    onclick="SaveCashFromtendered()"
                                    style="font-size: 20px; background-color: #91DAFF; color: black; height: 60px; font-weight: 700;">
                                    Submit
                                </button>
                            </div>
                            <!-- Cancel Button -->
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="button" class="btn btn-block" id="pos_cash_tendering_model_cancel" data-dismiss="modal"
                                    aria-label="Close"
                                    style="font-size: 20px; background-color: #FF8888; color: black; height: 60px; font-weight: 700;">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal structure -->
<div class="modal fade" id="pos_apply_coupon_model" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="applyCouponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyCouponModalLabel">Apply Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Invoice Balance Display -->
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-info text-center">
                            <span>Invoice Balance:</span>
                            <strong id="invoice_total_sales_coupon">0</strong>
                        </div>
                    </div>
                </div>
                <!-- Coupon Input and Table -->
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" id="searchTerm" placeholder="Enter coupon code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-sm table-bordered table-striped" id="select_coupon_table">
                            <thead>
                                <tr>
                                    <th scope="col">Coupon Name</th>
                                    <th scope="col" class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="couponTableBody">
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Alerts -->
                <div class="alert alert-success d-none" id="success_alert_coupon">
                    <span id="success_alert_coupon_name"></span>
                </div>
                <div class="alert alert-danger d-none" id="wrong_alert_coupon">
                    <span id="wrong_alert_coupon_msg"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Structure -->
<div class="modal fade pos_card_model" id="paylater_termsadd_model" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-sm" style="background-color:#000;">
                <h5 class="modal-title text-light" id="paylater_termsadd_model_headeramount">Invoice Amount : <span id="payLaterAmount"></span></h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body modal-body-sm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="mb-0">Payment Terms</label>
                                <select class="form-control" name="paylater_terms" onchange="changeDueDate()" style="width: 100%;" id="paylater_terms" placeholder="Select Payment Terms" tabindex="-1" aria-hidden="true">
                                    <option value="7 Days" data-days="7">7 Days</option>
                                    <option value="15 Days" data-days="15">15 Days</option>
                                    <option value="30 Days" data-days="30">30 Days</option>
                                    <option value="60 Days" data-days="60">60 Days</option>
                                    <option value="90 Days" data-days="90">90 Days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 paylater_due_date">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="mb-0">Due Date</label>
                                <input type="text" class="form-control form-control-sm" placeholder="dd/mm/yyyy" name="paylater_terms_due_date" data-date-format="dd/mm/yyyy" id="paylater_terms_due_date" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="mb-0">Send Reminder</label>
                                <div class="form-group mb-0">
                                    <label class="m-radiomb-0">
                                        <input type="radio" checked="checked" name="paylater_reminder" id="paylater_reminder" value="YES">
                                        <span>Yes</span>
                                    </label>
                                    <label class="m-radio  mb-0">
                                        <input type="radio" name="paylater_reminder" id="paylater_reminder" value="NO">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-sm p-0" style="justify-content:center;background-color:#000;">
                <button type="button" class="btn btn-sm btn-dark w-100 p-2" id="paylater_termsadd_modelbtn" onclick="savepaylater('NoPrint')">Proceed to Paylater</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Modal content will be loaded here -->
          </div>
      </div>
  </div>
</div>

<div id="holdbilldiv" class="holdbilldiv" style="right: 0px;">
      <div class="bg-dark p-2">
         <h6 class="modal-title">On Hold</h6>
         <a href="javascript:void(0)'" class="closebtn" onclick="closeholdbill()">×</a>
      </div>
      <div class="row">
      <div class="col-12 mt-4">
      	<div class="col-12 d-flex">
	      	<input class="form-control form-control-sm tt-input" placeholder="Search" id="search_hold_bill" >
	  		</div>
	    </div>
  	</div>
      <div class="hold-bill-list p-2">
         <ul id="hold_bill_div">
        </ul>
      </div>
   </div>

   <!-- UPI Account Selection Modal -->
<div class="modal fade" id="upiAccountModal" tabindex="-1" role="dialog" aria-labelledby="upiAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upiAccountModalLabel">Select UPI Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- UPI accounts will be dynamically inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUPIAccount">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="public/assets/js/jquery.validate.min.js"></script>

<script>
//    MultiPay

function openmultipay()
{
    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        var cusId = $(".cusId").val();
        if (typeof cusId === 'undefined' || cusId=='' ) {
            toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
    $('#main-div').addClass('d-none');
    $('#multipay').removeClass('d-none');
}
function backtosale()
{
    $('#main-div').removeClass('d-none');
    $('#multipay').addClass('d-none');
}
$(document).ready(function() {
    $('#payment_method').on('change', function () {
        $('#payment_bank').addClass('d-none');
        $('#receipt_mode_card').addClass('d-none');
        var paymentMethod = $(this).val();
        if (paymentMethod == '1') {
        } else if (paymentMethod == '2') {
            $('#payment_bank').removeClass('d-none');
            $('#receipt_mode_card').removeClass('d-none');
        } else if (paymentMethod == '3') {
            $('#payment_bank').removeClass('d-none');
            $('#receipt_mode_card').addClass('d-none');
        }
    });
});
$(document).ready(function() {
    $(document).on('click', '#paymentRemove', function() {
        $(this).closest('.payment-row').remove();
    });
});

    function getHighestSerialNumber() {
        let maxSerialNumber = 0;
        $('#copy_here .payment-row').each(function() {
            let currentSerial = parseInt($(this).find('input[name="srno[]"]').val(), 10);
            if (currentSerial > maxSerialNumber) {
                maxSerialNumber = currentSerial;
            }
        });
        return maxSerialNumber;
    }

    let serialNumberCounter = getHighestSerialNumber() + 1;

    window.AddpaymentDiv = function() {
        // Calculate the remaining amount
        let summaryNetAmount = parseFloat($('.PayableAmount').val()) || 0;
        let totalReceived = getTotalReceivedAmount();
        let remainingAmount = summaryNetAmount - totalReceived;
         // Check if the number of rows is less than the limit
         if ($('#copy_here .payment-row').length >= 3) {
            toastr.warning('You cannot add more than 3 rows.', 'Warning', { positionClass: 'toast-top-full-width' });
            return;
        }

        if (remainingAmount <= 0) {
            toastr.warning('You have already entered the required amount.', 'Warning', { positionClass: 'toast-top-full-width' });
            return;
        }

        var newRow = `
            <div class="col-md-12 bg-boxes mb-2 payment-row">
                <div class="row">
                    <input type="hidden" name="srno[]" value="${serialNumberCounter}">
                    <div class="col-lg-3 col-md-5 col-sm-12" id="receipt_mode_cash">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Received Amount:</label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="text" class="form-control form-control-sm decimalset" name="receivedAmount[]" value="${remainingAmount}" data-payment-amount="" placeholder="Received Amount" onkeyup="calculateChangeAmount()" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Payment Method:</label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input-group">
                                    <select class="form-control form-control-sm payment_method" name="payment_method[]">
                                        <?php foreach($modemultipay as $mode):?>
                                            <option value="<?=$mode->id;?>"><?=$mode->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 d-none payment_bank">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Payment Account:</label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <select class="form-control form-control-sm select2" name="bankId[]">
                                    <?php foreach($accounts as $account):?>
                                        <option value="<?=$account->id;?>"><?=$account->bank_name.' '.$account->branch_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-1">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12 col-md-12 col-sm-12 d-none d-sm-block d-md-block d-lg-block">&nbsp;</label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <a href="javascript:void(0)" class="btn btn-outline-danger paymentRemove">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 d-none receipt_mode_card">
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Customer Bank Name:</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="customer_bank_name[]" placeholder="Customer Bank Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Card holder name:</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="card_holder_name[]" placeholder="Card holder name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12 col-md-12 col-sm-12">Card Transaction No:</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" name="card_Transaction_no[]" placeholder="Card Transaction No.">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Append the new row to the container
        $('#copy_here').append(newRow);

        // Increment the serial number counter
        serialNumberCounter++;
    };

   

    // Remove row functionality
    $(document).on('click', '.paymentRemove', function() {
        $(this).closest('.bg-boxes.payment-row').remove();
        // You may want to recalculate and update remaining amount if needed
        let totalReceived = getTotalReceivedAmount();
        let summaryNetAmount = parseFloat($('.PayableAmount').val()) || 0;
        let remainingAmount = summaryNetAmount - totalReceived;

        // Update the remaining amount for all rows
        $('.payment-row').each(function() {
            $(this).find('input[name="receivedAmount[]"]').attr('data-payment-amount', remainingAmount.toFixed(2));
        });
    });

    // Handle payment method change
    $(document).on('change', '.payment_method', function() {
        var paymentMethod = $(this).val();
        var $row = $(this).closest('.bg-boxes.payment-row');
        if (paymentMethod === '1') {
            $row.find('.payment_bank').addClass('d-none');
            $row.find('.receipt_mode_card').addClass('d-none');
        } else if (paymentMethod === '2') {
            $row.find('.payment_bank').removeClass('d-none');
            $row.find('.receipt_mode_card').removeClass('d-none');
        } else if (paymentMethod === '3') {
            $row.find('.payment_bank').removeClass('d-none');
            $row.find('.receipt_mode_card').addClass('d-none');
        }
    });

    // Function to calculate the total received amount
    function getTotalReceivedAmount() {
        let total = 0;
        $('.payment-row').each(function() {
            let amount = parseFloat($(this).find('input[name="receivedAmount[]"]').val()) || 0;
            total += amount;
        });
        return total;
    }

    // Function to calculate and validate received amount
    function calculateChangeAmount() {
        let summaryNetAmount = parseFloat($('.PayableAmount').val()) || 0;
        let totalReceived = getTotalReceivedAmount();
        if (totalReceived > summaryNetAmount) {
            toastr.warning('The total received amount exceeds the net amount.', 'Warning', { positionClass: 'toast-top-full-width' });
            $(this).val(''); 
        }
    }

  

function saveMultiPay()
{
     // Check for duplicate payment methods
    let paymentMethods = [];
    let hasDuplicates = false;
    $('.payment_row').each(function() {
        let paymentMethod = $(this).find('select[name="payment_method[]"]').val();
        if (paymentMethods.includes(paymentMethod)) {
            hasDuplicates = true;
            return false; // Exit the loop
        }
        paymentMethods.push(paymentMethod);
    });

    if (hasDuplicates) {
        toastr.warning('Each payment method must be unique.', 'Warning', { positionClass: 'toast-top-full-width' });
        return;
    }

     // Validate payment rows
     let isValid = true;
     let summaryNetAmount = parseFloat($('.PayableAmount').val()) || 0;
    $('#copy_here .payment-row').each(function() {
        let receivedAmount = $(this).find('input[name="receivedAmount[]"]').val();
        let paymentMethod = $(this).find('select[name="payment_method[]"]').val();
        if (!receivedAmount || parseFloat(receivedAmount) <= 0) {
            toastr.warning('Received Amount must be greater than 0.', 'Warning', { positionClass: 'toast-top-full-width' });
            isValid = false;
            return false; // Exit the loop
        }

        if (!paymentMethod) {
            toastr.warning('Please select a payment method.', 'Warning', { positionClass: 'toast-top-full-width' });
            isValid = false;
            return false; // Exit the loop
        }
    });

    if (!isValid) {
        return; // Exit the function if validation fails
    }
    let totalReceived = getTotalReceivedAmount();
    if(summaryNetAmount!=totalReceived)
    {
        toastr.warning('Please enter valid payable amount', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }
    var formData = [];
    var check_product = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            check_product.push($(this).find('td.product_id').text());
        }
    });

    // Check if any products are added
    if (check_product.length == 0) {
        toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    var cusId = $(".cusId").val();
    if (typeof cusId === 'undefined' || cusId == '') {
        toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    // Gather form data
    var TotalValue = $('#net_amount').text();
    var TaxValue = $('#tax_amount').text();
    var RoundOff = $('#round_off').val();

    var due_amount = $('.DueAmount_tendering').val();
    var tendered_amount = $('.tendered').val();
    var change_amount = $('.change').val();
    var coupon_type = $('.coupon_type').val();
    var coupon_value = $('.coupon_value').val();
    var flat_value = $('.flat_value').val();
    var flat_type = $('.flat_type').val();
    var coupon_net_amount = $('.coupon_net_amount').val();
    var coupon_discount_amount = $('.coupon_discount_amount').val();

    var address = $('#customer_totals').find('.Address').text();
    var dueDate = $('[name=due_date]').val();
    var ref_no_or_remark = $('[name=reference_no_or_remark]').val();
    var same_as_billing = $('[name=same_as_billing]').val();
    var shipping_address = $('[name=shipping_address]').val();
    var order_number = $('[name=manual_order_number]').val();
    var narration = $('[name=narration]').val();
    var payment_method = '3';
    var order_date = $('[name=manual_order_date]').val();
    var orderType = $('[name="orderType"]:checked').val();
    var oid                 = $('#oid').val();


    formData.push({ name: "orderId", value: order_number });
    formData.push({ name: "user_id", value: cusId });
    formData.push({ name: "total_value", value: TotalValue });
    formData.push({ name: "total_tax", value: TaxValue });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "random_address", value: address });
    formData.push({ name: "due_date", value: dueDate });
    formData.push({ name: "payment_method", value: payment_method });
    formData.push({ name: "ref_no_or_remark", value: ref_no_or_remark });
    formData.push({ name: "same_as_billing", value: same_as_billing });
    formData.push({ name: "shipping_address", value: shipping_address });
    formData.push({ name: "narration", value: narration });
    formData.push({ name: "order_date", value: order_date });
    formData.push({ name: "due_amount", value: due_amount });
    formData.push({ name: "tendered_amount", value: tendered_amount });
    formData.push({ name: "change_amount", value: change_amount });
    formData.push({ name: "coupon_type", value: coupon_type });
    formData.push({ name: "coupon_value", value: coupon_value });
    formData.push({ name: "flat_value", value: flat_value });
    formData.push({ name: "flat_type", value: flat_type });
    formData.push({ name: "coupon_net_amount", value: coupon_net_amount });
    formData.push({ name: "coupon_discount_amount", value: coupon_discount_amount });
    formData.push({ name: "orderType", value: orderType });
    formData.push({ name: "oid", value: oid });
   

    var product_id = [];
    var inventory_id = [];
    var qty = [];
    var free = [];
    var price_per_unit = [];
    var purchase_rate = [];
    var mrp = [];
    var total_price = [];
    var tax = [];
    var tax_value = [];
    var offer_applied = [];
    var discount_type = [];
    var offer_applied2 = [];
    var discount_type2 = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            product_id.push($(this).find('td.product_id').text());
            inventory_id.push($(this).find('td.inventory_id').text());
            qty.push($(this).find('td.quantity1 [name=qty]').val());
            free.push($(this).find('td.free [name=free]').val());
            price_per_unit.push($(this).find('td.omrp').text());
            purchase_rate.push($(this).find('td.purchase_rate').text());
            mrp.push($(this).find('td.mrp').text());
            total_price.push($(this).find('td.totalamount').text());
            tax.push($(this).find('td.TotalTaxValue').text());
            tax_value.push($(this).find('td.TaxValue1').text());
            offer_applied.push($(this).find('td.Disc [name=discount]').val());
            var discount_type_v = $(this).find('td.Disc [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type.push(discount_type_v);
            offer_applied2.push($(this).find('td.Disc2 [name=discount2]').val());
            var discount_type2_v = $(this).find('td.Disc2 [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type2.push(discount_type2_v);
        }
    });

    if (product_id.length == 0) {
        toastr.warning('Please select Product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    formData.push({ name: "product_id", value: product_id });
    formData.push({ name: "inventory_id", value: inventory_id });
    formData.push({ name: "qty", value: qty });
    formData.push({ name: "free", value: free });
    formData.push({ name: "price_per_unit", value: price_per_unit });
    formData.push({ name: "purchase_rate", value: purchase_rate });
    formData.push({ name: "mrp", value: mrp });
    formData.push({ name: "total_price", value: total_price });
    formData.push({ name: "tax", value: tax });
    formData.push({ name: "tax_value", value: tax_value });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "offer_applied", value: offer_applied });
    formData.push({ name: "discount_type", value: discount_type });
    formData.push({ name: "offer_applied2", value: offer_applied2 });
    formData.push({ name: "discount_type2", value: discount_type2 });

    // Gather payment data
    var srno = [];
    var receivedAmount = [];
    var payment_method = [];
    var bankId = [];
    var customer_bank_name = [];
    var card_holder_name = [];
    var card_Transaction_no = [];

    $('#copy_here .payment-row').each(function() {
        srno.push($(this).find('input[name="srno[]"]').val());
        receivedAmount.push($(this).find('input[name="receivedAmount[]"]').val());
        payment_method.push($(this).find('select[name="payment_method[]"]').val());
        bankId.push($(this).find('select[name="bankId[]"]').val() || '');
        customer_bank_name.push($(this).find('input[name="customer_bank_name[]"]').val() || '');
        card_holder_name.push($(this).find('input[name="card_holder_name[]"]').val() || '');
        card_Transaction_no.push($(this).find('input[name="card_Transaction_no[]"]').val() || '');
    });

    formData.push({ name: "srno", value: srno });
    formData.push({ name: "receivedAmount", value: receivedAmount });
    formData.push({ name: "payment_method", value: payment_method });
    formData.push({ name: "bankId", value: bankId });
    formData.push({ name: "customer_bank_name", value: customer_bank_name });
    formData.push({ name: "card_holder_name", value: card_holder_name });
    formData.push({ name: "card_Transaction_no", value: card_Transaction_no });

    $.ajax({
        url: '<?= base_url() ?>shop-pos/check_customer_credit_limit',
        type: 'POST',
        data: { business_id: cusId, TotalValue: TotalValue },
        dataType: 'JSON',
        success: function(data) {
            if (data.res == 'success') {
                $.ajax({
                    url: "<?= base_url() ?>shop-pos/saveMultiPayOrder_edit",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    success: function(data) {
                        if (data.res == 'success') {
                            toastr.success('Order Placed Successfully!', 'Success', 'positionclass:toast-bottom-full-width');
                            setTimeout(() => {
                                window.location.href='<?=base_url();?>pos_orders';
                            }, 1000);
                            if (action == 'Print') {
                                window.open(data.invoice_url, '_blank');
                            }
                        } else {
                            Swal.fire({
                                icon: data.res,
                                text: data.msg,
                                position: 'center'
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: data.res,
                    text: data.msg,
                    position: 'center'
                });
            }
        }
    });

    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
    audio.play();
}
    

   

    function changeDueDate() {
            let selectElement = $('#paylater_terms');
            let days = parseInt(selectElement.find(':selected').data('days'), 10);
            updateDueDate(days);
        }

        function updateDueDate(days) {
            let today = new Date();
            today.setDate(today.getDate() + days);
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); 
            let yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            due_date =yyyy+ '-' + mm + '-' +dd ;
            $('#paylater_terms_due_date').val(today);
            $('.due_date').val(due_date);
        }

        function initializeDueDate() {
            let defaultDays = parseInt($('#paylater_terms option:selected').data('days'), 10);
            updateDueDate(defaultDays);
        }

        function payLatterBill() {
        var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }else{
            $('#paylater_termsadd_model').modal('show');
            initializeDueDate();
        }
      
    }
    
function payLatterBillPrint()
{
    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }else{
            $('#paylater_termsadd_model').modal('show');
            initializeDueDate();
            var button = document.getElementById('paylater_termsadd_modelbtn');
        button.setAttribute('onclick', "savepaylater('Print')");

        // Change button text
        button.textContent = 'Proceed to Paylater & Print';
        }
}

    function savepaylater(action)
        {
            var formData = [];
    var check_product = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            check_product.push($(this).find('td.product_id').text());
        }
    });

    // Check if any products are added
    if (check_product.length == 0) {
        toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    var cusId = $(".cusId").val();
    if (typeof cusId === 'undefined' || cusId == '') {
        toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

  
    // Gather form data
    var TotalValue = $('#net_amount').text();
    var TaxValue = $('#tax_amount').text();
    var RoundOff = $('#round_off').val();

    var due_amount = $('.DueAmount_tendering').val();
    var tendered_amount = $('.tendered').val();
    var change_amount = $('.change').val();
    var coupon_type = $('.coupon_type').val();
    var coupon_value = $('.coupon_value').val();
    var flat_value = $('.flat_value').val();
    var flat_type = $('.flat_type').val();
    var coupon_net_amount = $('.coupon_net_amount').val();
    var coupon_discount_amount = $('.coupon_discount_amount').val();

    var address = $('#customer_totals').find('.Address').text();
    var dueDate = $('[name=due_date]').val();
    var ref_no_or_remark = $('[name=reference_no_or_remark]').val();
    var same_as_billing = $('[name=same_as_billing]').val();
    var shipping_address = $('[name=shipping_address]').val();
    var order_number = $('[name=manual_order_number]').val();
    var narration = $('[name=narration]').val();
    var payment_method = '4';
    var order_date = $('[name=manual_order_date]').val();
    var orderType = $('[name="orderType"]:checked').val();
    var paylater_terms = $('[name=paylater_terms]').val();
    var paylater_terms_due_date = $('[name=paylater_terms_due_date]').val();
    var paylater_reminder = $('[name=paylater_reminder]').val();
    var oid                 = $('#oid').val();
    
    formData.push({ name: "orderId", value: order_number });
    formData.push({ name: "user_id", value: cusId });
    formData.push({ name: "total_value", value: TotalValue });
    formData.push({ name: "total_tax", value: TaxValue });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "random_address", value: address });
    formData.push({ name: "due_date", value: dueDate });
    formData.push({ name: "payment_method", value: payment_method });
    formData.push({ name: "ref_no_or_remark", value: ref_no_or_remark });
    formData.push({ name: "same_as_billing", value: same_as_billing });
    formData.push({ name: "shipping_address", value: shipping_address });
    formData.push({ name: "narration", value: narration });
    formData.push({ name: "order_date", value: order_date });
    formData.push({ name: "due_amount", value: due_amount });
    formData.push({ name: "tendered_amount", value: tendered_amount });
    formData.push({ name: "change_amount", value: change_amount });
    formData.push({ name: "coupon_type", value: coupon_type });
    formData.push({ name: "coupon_value", value: coupon_value });
    formData.push({ name: "flat_value", value: flat_value });
    formData.push({ name: "flat_type", value: flat_type });
    formData.push({ name: "coupon_net_amount", value: coupon_net_amount });
    formData.push({ name: "coupon_discount_amount", value: coupon_discount_amount });
    formData.push({ name: "orderType", value: orderType });
    formData.push({ name: "paylater_terms_due_date", value: paylater_terms_due_date });
    formData.push({ name: "paylater_terms", value: paylater_terms });
    formData.push({ name: "paylater_reminder", value: paylater_reminder });
    formData.push({ name: "oid", value: oid });
    var product_id = [];
    var inventory_id = [];
    var qty = [];
    var free = [];
    var price_per_unit = [];
    var purchase_rate = [];
    var mrp = [];
    var total_price = [];
    var tax = [];
    var tax_value = [];
    var offer_applied = [];
    var discount_type = [];
    var offer_applied2 = [];
    var discount_type2 = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            product_id.push($(this).find('td.product_id').text());
            inventory_id.push($(this).find('td.inventory_id').text());
            qty.push($(this).find('td.quantity1 [name=qty]').val());
            free.push($(this).find('td.free [name=free]').val());
            price_per_unit.push($(this).find('td.omrp').text());
            purchase_rate.push($(this).find('td.purchase_rate').text());
            mrp.push($(this).find('td.mrp').text());
            total_price.push($(this).find('td.totalamount').text());
            tax.push($(this).find('td.TotalTaxValue').text());
            tax_value.push($(this).find('td.TaxValue1').text());
            offer_applied.push($(this).find('td.Disc [name=discount]').val());
            var discount_type_v = $(this).find('td.Disc [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type.push(discount_type_v);
            offer_applied2.push($(this).find('td.Disc2 [name=discount2]').val());
            var discount_type2_v = $(this).find('td.Disc2 [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type2.push(discount_type2_v);
        }
    });

    if (product_id.length == 0) {
        toastr.warning('Please select Product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    formData.push({ name: "product_id", value: product_id });
    formData.push({ name: "inventory_id", value: inventory_id });
    formData.push({ name: "qty", value: qty });
    formData.push({ name: "free", value: free });
    formData.push({ name: "price_per_unit", value: price_per_unit });
    formData.push({ name: "purchase_rate", value: purchase_rate });
    formData.push({ name: "mrp", value: mrp });
    formData.push({ name: "total_price", value: total_price });
    formData.push({ name: "tax", value: tax });
    formData.push({ name: "tax_value", value: tax_value });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "offer_applied", value: offer_applied });
    formData.push({ name: "discount_type", value: discount_type });
    formData.push({ name: "offer_applied2", value: offer_applied2 });
    formData.push({ name: "discount_type2", value: discount_type2 });

    $.ajax({
        url: '<?= base_url() ?>shop-pos/check_customer_credit_limit',
        type: 'POST',
        data: { business_id: cusId, TotalValue: TotalValue },
        dataType: 'JSON',
        success: function(data) {
            if (data.res == 'success') {
                $.ajax({
                    url: "<?= base_url() ?>shop-pos/save_payater_order_edit",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    success: function(data) {
                        if (data.res == 'success') {
                            toastr.success('Order Placed Successfully!', 'Success', 'positionclass:toast-bottom-full-width');
                            setTimeout(() => {
                                window.location.href='<?=base_url();?>pos_orders';
                            }, 1000);
                            if (action == 'Print') {
                                window.open(data.invoice_url, '_blank');
                            }
                        } else {
                            Swal.fire({
                                icon: data.res,
                                text: data.msg,
                                position: 'center'
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: data.res,
                    text: data.msg,
                    position: 'center'
                });
            }
        }
    });

    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
    audio.play();
        }
</script>

<script type="text/javascript">
   
    $(document).ready(function () {
    $('#openCardModal').click(function () {
        var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }else{
            $('#pos_card_model').modal('show');
        }
       
    });
    $('#pos_card_model').on('hidden.bs.modal', function () {

    });
})


function setUPIModal(action) {
    // First, check the UPI status
    $.ajax({
        url: '<?= base_url() ?>shop-pos/check_upi_status',
        type: 'GET',
        dataType: 'json',
        success: function(upidata) {
            if (upidata.success) {
                if (upidata.status.length > 1) {
                    showUPIAccountModal(action, upidata.status);
                } else if (upidata.status.length === 1) {
                    processUPIOrder(action, upidata.status[0].id);
                } else {
                    toastr.warning('Add at least one UPI and then refresh this page', 'Warning', 'positionclass:toast-bottom-full-width');
                }
            } else {
                toastr.warning('Add at least one UPI and then refresh this page', 'Warning', 'positionclass:toast-bottom-full-width');
            }
        },
        error: function() {
            toastr.error('Error checking UPI status. Please try again.', 'Error', 'positionclass:toast-bottom-full-width');
        }
    });
}

function showUPIAccountModal(action, upiAccounts) {
    // Populate the modal with UPI accounts
    var modalBody = '';
    upiAccounts.forEach(function(account) {
        modalBody += `<div class="form-check">
                        <input class="form-check-input" type="radio" name="upi_account" value="${account.id}" id="upi_${account.id}" style="left: 27px !important;">
                        <label class="form-check-label" for="upi_${account.id}">
                            ${account.bank_name}  ${account.branch_name}
                        </label>
                      </div>`;
    });
    
    $('#upiAccountModal .modal-body').html(modalBody);
    $('#upiAccountModal').modal('show');
    
    // Set the action for the button in the modal
    $('#confirmUPIAccount').off('click').on('click', function() {
        var selectedUPIAccount = $('input[name="upi_account"]:checked').val();
        if (selectedUPIAccount) {
            processUPIOrder(action, selectedUPIAccount);
        } else {
            toastr.warning('Please select a UPI account', 'Warning', 'positionclass:toast-bottom-full-width');
        }
    });
}

function processUPIOrder(action, upiAccountId) {
    var formData = [];
    var check_product = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            check_product.push($(this).find('td.product_id').text());
        }
    });

    // Check if any products are added
    if (check_product.length == 0) {
        toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    var cusId = $(".cusId").val();
    if (typeof cusId === 'undefined' || cusId == '') {
        toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    // Gather form data
    var TotalValue = $('#net_amount').text();
    var TaxValue = $('#tax_amount').text();
    var RoundOff = $('#round_off').val();

    var due_amount = $('.DueAmount_tendering').val();
    var tendered_amount = $('.tendered').val();
    var change_amount = $('.change').val();
    var coupon_type = $('.coupon_type').val();
    var coupon_value = $('.coupon_value').val();
    var flat_value = $('.flat_value').val();
    var flat_type = $('.flat_type').val();
    var coupon_net_amount = $('.coupon_net_amount').val();
    var coupon_discount_amount = $('.coupon_discount_amount').val();

    var address = $('#customer_totals').find('.Address').text();
    var dueDate = $('[name=due_date]').val();
    var ref_no_or_remark = $('[name=reference_no_or_remark]').val();
    var same_as_billing = $('[name=same_as_billing]').val();
    var shipping_address = $('[name=shipping_address]').val();
    var order_number = $('[name=manual_order_number]').val();
    var narration = $('[name=narration]').val();
    var payment_method = '3';
    var order_date = $('[name=manual_order_date]').val();
    var orderType = $('[name="orderType"]:checked').val();
    var oid                 = $('#oid').val();

    formData.push({ name: "orderId", value: order_number });
    formData.push({ name: "user_id", value: cusId });
    formData.push({ name: "total_value", value: TotalValue });
    formData.push({ name: "total_tax", value: TaxValue });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "random_address", value: address });
    formData.push({ name: "due_date", value: dueDate });
    formData.push({ name: "payment_method", value: payment_method });
    formData.push({ name: "ref_no_or_remark", value: ref_no_or_remark });
    formData.push({ name: "same_as_billing", value: same_as_billing });
    formData.push({ name: "shipping_address", value: shipping_address });
    formData.push({ name: "narration", value: narration });
    formData.push({ name: "order_date", value: order_date });
    formData.push({ name: "due_amount", value: due_amount });
    formData.push({ name: "tendered_amount", value: tendered_amount });
    formData.push({ name: "change_amount", value: change_amount });
    formData.push({ name: "coupon_type", value: coupon_type });
    formData.push({ name: "coupon_value", value: coupon_value });
    formData.push({ name: "flat_value", value: flat_value });
    formData.push({ name: "flat_type", value: flat_type });
    formData.push({ name: "coupon_net_amount", value: coupon_net_amount });
    formData.push({ name: "coupon_discount_amount", value: coupon_discount_amount });
    formData.push({ name: "orderType", value: orderType });
    formData.push({ name: "oid", value: oid }); 
    formData.push({ name: "upi_account_id", value: upiAccountId });// Add selected UPI account ID

    var product_id = [];
    var inventory_id = [];
    var qty = [];
    var free = [];
    var price_per_unit = [];
    var purchase_rate = [];
    var mrp = [];
    var total_price = [];
    var tax = [];
    var tax_value = [];
    var offer_applied = [];
    var discount_type = [];
    var offer_applied2 = [];
    var discount_type2 = [];

    $('#item-table tbody tr').each(function() {
        if (!$(this).hasClass('noItem')) {
            product_id.push($(this).find('td.product_id').text());
            inventory_id.push($(this).find('td.inventory_id').text());
            qty.push($(this).find('td.quantity1 [name=qty]').val());
            free.push($(this).find('td.free [name=free]').val());
            price_per_unit.push($(this).find('td.omrp').text());
            purchase_rate.push($(this).find('td.purchase_rate').text());
            mrp.push($(this).find('td.mrp').text());
            total_price.push($(this).find('td.totalamount').text());
            tax.push($(this).find('td.TotalTaxValue').text());
            tax_value.push($(this).find('td.TaxValue1').text());
            offer_applied.push($(this).find('td.Disc [name=discount]').val());
            var discount_type_v = $(this).find('td.Disc [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type.push(discount_type_v);
            offer_applied2.push($(this).find('td.Disc2 [name=discount2]').val());
            var discount_type2_v = $(this).find('td.Disc2 [type=checkbox]').is(':checked') ? 1 : 0;
            discount_type2.push(discount_type2_v);
        }
    });

    if (product_id.length == 0) {
        toastr.warning('Please select Product', 'Warning', 'positionclass:toast-bottom-full-width');
        return;
    }

    formData.push({ name: "product_id", value: product_id });
    formData.push({ name: "inventory_id", value: inventory_id });
    formData.push({ name: "qty", value: qty });
    formData.push({ name: "free", value: free });
    formData.push({ name: "price_per_unit", value: price_per_unit });
    formData.push({ name: "purchase_rate", value: purchase_rate });
    formData.push({ name: "mrp", value: mrp });
    formData.push({ name: "total_price", value: total_price });
    formData.push({ name: "tax", value: tax });
    formData.push({ name: "tax_value", value: tax_value });
    formData.push({ name: "RoundOff", value: RoundOff });
    formData.push({ name: "offer_applied", value: offer_applied });
    formData.push({ name: "discount_type", value: discount_type });
    formData.push({ name: "offer_applied2", value: offer_applied2 });
    formData.push({ name: "discount_type2", value: discount_type2 });

    $.ajax({
        url: '<?= base_url() ?>shop-pos/check_customer_credit_limit',
        type: 'POST',
        data: { business_id: cusId, TotalValue: TotalValue },
        dataType: 'JSON',
        success: function(data) {
            if (data.res == 'success') {
                $.ajax({
                    url: "<?= base_url() ?>shop-pos/save_upi_order_edit",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    success: function(data) {
                        if (data.res == 'success') {
                            toastr.success('Order Placed Successfully!', 'Success', 'positionclass:toast-bottom-full-width');
                            setTimeout(() => {
                                window.location.href='<?=base_url();?>pos_orders';
                            }, 1000);
                            if (action == 'Print') {
                                window.open(data.invoice_url, '_blank');
                            }
                        } else {
                            Swal.fire({
                                icon: data.res,
                                text: data.msg,
                                position: 'center'
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: data.res,
                    text: data.msg,
                    position: 'center'
                });
            }
        }
    });

    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
    audio.play();
}


function cardAndPrint()
{
    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }else{
            $('#pos_card_model').modal('show');
            document.getElementById('cardPrintbtn').setAttribute('onclick', "SaveCard('print')");
        }
}

        function SaveCard(action) {
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        var cusId = $(".cusId").val();
        if (typeof cusId === 'undefined' || cusId=='' ) {
            toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
      
        if ($('[name=CardBank]').val()=='') {
            toastr.warning('Please enter customer bank name', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        if ($('[name=BankId]').val()=='') {
            toastr.warning('Please select payment bank', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        if ($('[name=cardAmount]').val()=='') {
            toastr.warning('Please enter card payment amount', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        if ($('[name=CardHolder]').val()=='') {
            toastr.warning('Please enter card holder name', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        if ($('[name=tr_no]').val()=='') {
            toastr.warning('Please enter card transaction no', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
       
        var TotalValue          = $('#net_amount').text();
        var TaxValue            = $('#tax_amount').text();
        var RoundOff            = $('#round_off').val();
        var is_hold            = $('#is_hold').val();

        var BankId = $('#bankId').val();
        var CardBank            = $('.CardBank').val();
        var CardAmount            = $('.cardAmount').val();
        var CardHolder            = $('.CardHolder').val();
        var TrNo            = $('.tr_no').val();
        
        var due_amount          = $('.DueAmount_tendering').val();
        var tendered_amount            = $('.tendered').val();
        var change_amount       = $('.change').val();
        var coupon_type       = $('.coupon_type').val();
        var coupon_value       = $('.coupon_value').val();
        var flat_value       = $('.flat_value').val();
        var flat_type       = $('.flat_type').val();
        var coupon_net_amount       = $('.coupon_net_amount').val();
        var coupon_discount_amount       = $('.coupon_discount_amount').val();
        
        
        var address             = $('#customer_totals').find('.Address').text();
        var dueDate             = $('[name=due_date]').val();
        var ref_no_or_remark    = $('[name=reference_no_or_remark]').val();
        var same_as_billing     = $('[name=same_as_billing]').val();
        var shipping_address    = $('[name=shipping_address]').val();
        var order_number        = $('[name=manual_order_number]').val();
        var narration           = $('[name=narration]').val();
        var payment_method                = '2';
        var order_date          = $('[name=manual_order_date]').val();
        var orderType = $('[name="orderType"]:checked').val();
        var oid                 = $('#oid').val();


        formData.push({ name: "orderId", value: order_number });
        formData.push({ name: "user_id", value: cusId });
        formData.push({ name: "total_value", value: TotalValue });
        formData.push({ name: "total_tax", value: TaxValue });
        formData.push({ name: "RoundOff", value: RoundOff });
        formData.push({ name: "random_address", value: address });
        formData.push({ name: "due_date", value: dueDate });
        formData.push({ name: "payment_method", value: payment_method });
        formData.push({ name: "ref_no_or_remark", value: ref_no_or_remark });
        formData.push({ name: "same_as_billing", value: same_as_billing });
        formData.push({ name: "shipping_address", value: shipping_address });
        formData.push({ name: "narration", value: narration });
        formData.push({ name: "order_date", value: order_date });
        formData.push({ name: "due_amount", value: due_amount });
        formData.push({ name: "tendered_amount", value: tendered_amount });
        formData.push({ name: "change_amount", value: change_amount });
        formData.push({ name: "coupon_type", value: coupon_type });
        formData.push({ name: "coupon_value", value: coupon_value });
        formData.push({ name: "flat_value", value: flat_value });
        formData.push({ name: "flat_type", value: flat_type });
        formData.push({ name: "coupon_net_amount", value: coupon_net_amount });
        formData.push({ name: "coupon_discount_amount", value: coupon_discount_amount });
        formData.push({ name: "is_hold", value: is_hold });
        formData.push({ name: "BankId", value: BankId });
        formData.push({ name: "CardBank", value: CardBank });
        formData.push({ name: "CardAmount", value: CardAmount });
        formData.push({ name: "CardHolder", value: CardHolder });
        formData.push({ name: "TrNo", value: TrNo });
        formData.push({ name: "orderType", value: orderType });
        formData.push({ name: "oid", value: oid });
        
        var product_id = [];
        var inventory_id = [];
        var qty = [];
        var free = [];
        var price_per_unit = [];
        var purchase_rate = [];
        var purchase_rate = [];
        var mrp = [];
        var total_price = [];
        var tax = [];
        var tax_value = [];
        var offer_applied = [];
        var discount_type = [];
        var offer_applied2 = [];
        var discount_type2 = [];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                product_id.push($(this).find('td.product_id').text());
                inventory_id.push($(this).find('td.inventory_id').text());
                qty.push($(this).find('td.quantity1 [name=qty]').val());
                free.push($(this).find('td.free [name=free]').val());
                price_per_unit.push($(this).find('td.omrp').text());
                purchase_rate.push($(this).find('td.purchase_rate').text());
                mrp.push($(this).find('td.mrp').text());
                total_price.push($(this).find('td.totalamount').text());
                tax.push($(this).find('td.TotalTaxValue').text());
                tax_value.push($(this).find('td.TaxValue1').text());
                offer_applied.push($(this).find('td.Disc [name=discount]').val());
                discount_type_v = 0;
                if ($(this).find('td.Disc [type=checkbox]').is(':checked')) {
                    discount_type_v = 1;
                }
                discount_type.push(discount_type_v);
                offer_applied2.push($(this).find('td.Disc2 [name=discount2]').val());
                discount_type2_v = 0;
                if ($(this).find('td.Disc2 [type=checkbox]').is(':checked')) {
                    discount_type2_v = 1;
                }
                discount_type2.push(discount_type2_v);
            }
            
        })

        if (product_id=='') {
            toastr.warning('Please select Product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }



        formData.push({name:  "product_id", value:product_id})
        formData.push({name:  "inventory_id", value:inventory_id})
        formData.push({name:  "qty", value:qty})
        formData.push({name:  "free", value:free})
        formData.push({name:  "price_per_unit", value:price_per_unit})
        formData.push({name:  "purchase_rate", value:purchase_rate})
        formData.push({name:  "mrp", value:mrp})
        formData.push({name:  "total_price", value:total_price})
        formData.push({name:  "tax", value:tax})
        formData.push({name:  "tax_value", value:tax_value})
        formData.push({name:  "RoundOff", value:RoundOff})
        formData.push({name:  "offer_applied", value:offer_applied})
        formData.push({name:  "discount_type", value:discount_type})
        formData.push({name:  "offer_applied2", value:offer_applied2})
        formData.push({name:  "discount_type2", value:discount_type2})        
        
            $.ajax({
                url:'<?=base_url()?>shop-pos/check_customer_credit_limit',
                type:'POST',
                data:{business_id:cusId,TotalValue:TotalValue},
                dataType:'JSON',
                success:function(data) {
                    if (data.res=='success') {
                        $.ajax({
                            url: "<?= base_url() ?>shop-pos/save_card_order_edit",
                            type: 'post',
                            dataType: "json",
                            data: formData,
                            success: function(data) {
                                if (data.res=='success') {
                                 $('#pos_card_model').modal('hide');
                                    if (data.res === 'success') {
                                 $('#pos_card_model').modal('hide');
                                toastr.success('Order Placed Successfully!', 'Success', 'positionclass:toast-bottom-full-width');
                                setTimeout(() => {
                                    window.location.href='<?=base_url();?>pos_orders';
                                    $('#pos_card_model').modal('hide');
                                }, 1000);
                                if(action=='print')
                                {
                                    window.open(data.invoice_url, '_blank');
                                    $('#pos_card_model').modal('hide');
                                }
                            }

                                }
                                else{
                                   Swal.fire({
                                      icon: data.res,
                                      text: data.msg,
                                      position: 'center'
                                    })  
                                }
                                
                            }
                        })
                    }
                    else{
                        Swal.fire({
                        icon: data.res,
                        text: data.msg,
                        position: 'center'
                      }) 
                    }
                }
            })  
            var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
            audio.play();
        

    }


function applyeCouponModel() {
    var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
    audio.play();
    var cusId = $(".cusId").val();
    if (!cusId) {
        toastr.warning('Please select Customer', 'Warning', { positionClass: 'toast-bottom-full-width' });
        return false;
    }

    var net_amount = $('#ttotal').val();
    $('#invoice_total_sales_coupon').text(net_amount);

    if (net_amount == 0) {
        toastr.warning("Coupon can't be Applied. Because Net Amount will be 0.", 'Warning', { positionClass: 'toast-bottom-full-width' });
        return false;
    }

    $('#pos_apply_coupon_model').modal('show');
    // $.ajax({
    //         url: '<?= base_url("shop-pos/unsetCouponSession"); ?>',
    //         method: 'POST',
    //         data: { customer_id: cusId },
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response.success) {
    //                 console.log('Applied coupon session has been unset.');
    //             } else {
    //                 console.error('Error unsetting coupon session: ' + response.message);
    //             }
    //         },
    //         error: function() {
    //             console.error('Error making request to unset coupon session.');
    //         }
    //     });
    $.ajax({
        url: '<?=base_url();?>shop-pos/getCoupons',
        method: 'GET',
        data: {  customer_id: cusId },
        dataType: 'json',
        success: function(response) {
            let tableBody = $('#couponTableBody');
            tableBody.empty();

            if (response.success) {
                let coupons = response.coupons;
                let appliedCouponCode = response.applied_coupon;

                if (coupons.length > 0) {
                    $('#searchTerm').data('coupons', coupons);

                    coupons.forEach((coupon) => {
                        let isApplied = (appliedCouponCode === coupon.code);
                        let row = `<tr>
                            <td>${coupon.title}</td>
                            <td class="text-right">
                                <button type="button" class="btn btn-success btn-sm" onclick="applyCoupon('${coupon.code}')" ${isApplied ? 'disabled' : ''}>Apply</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeCoupon('${coupon.code}')" ${isApplied ? '' : 'style="display:none"'}>Remove</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });

                    $('#wrong_alert_coupon').addClass('d-none');
                } else {
                    $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text('No coupons available');
                }
            } else {
                $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text(response.message);
            }
        },
        error: function() {
            $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text('Error fetching coupons');
        }
    });
}



$('#searchTerm').on('input', function() {
    let searchTerm = $(this).val().toLowerCase();
    let coupons = $(this).data('coupons') || [];
    let tableBody = $('#couponTableBody');
    tableBody.empty();

    coupons.filter(coupon => coupon.title.toLowerCase().includes(searchTerm)).forEach((coupon) => {
        let row = `<tr>
            <td>${coupon.title}</td>
            <td class="text-right">
                <button type="button" class="btn btn-success btn-sm" onclick="applyCoupon('${coupon.code}')" ${appliedCouponCode ? 'disabled' : ''}>Apply</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeCoupon('${coupon.code}')" ${appliedCouponCode === coupon.code ? '' : 'style="display:none"'}>Remove</button>
            </td>
        </tr>`;
        tableBody.append(row);
    });

    if (tableBody.children().length === 0) {
        $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text('No matching coupons found');
    } else {
        $('#wrong_alert_coupon').addClass('d-none');
    }
});
function applyCoupon(couponCode) {
    var cusId = $(".cusId").val();
    if (!cusId) {
        toastr.warning('Please select Customer', 'Warning', { positionClass: 'toast-bottom-full-width' });
        return false;
    }
    
    var net_amount = Number($('#ttotal').val()) || 0;
    $('#oldTotal').val(net_amount);
    $('#coupon_code').val(couponCode);

    $.ajax({
        url: '<?=base_url();?>shop-pos/applyCoupon',
        method: 'POST',
        dataType: 'json',
        data: { coupon_code: couponCode, net_amount: net_amount, customer_id: cusId },
        success: function(response) {
            if (response.success) {
                let discountedAmount = Number(response.value) || 0;
                let discount_value = Number(response.discount_value) || 0;
                let discount_type = response.discount_type;
                const amounts = getAmounts(Number(response.total) || 0);

                var originalAmount = Number(amounts.originalAmount) || 0;
                var roundedAmount = Number(amounts.roundedAmount) || 0;
                var roundoff = Number(amounts.roundoff) || 0;
                var newAmount = Number(amounts.newAmount) || 0;
                $('#net_amount').text(newAmount.toFixed(2));
                $('#rounded_amount').text(roundedAmount.toFixed(2));
                $('#coupon_amount').text(discountedAmount.toFixed(2)); 
                $("#round_off").val(roundoff.toFixed(2));
                $('#coupon_value').val(discount_value);
                $('#coupon_type').val(discount_type);
                $('#coupon_net_amount').val(net_amount.toFixed(2));
                $('#coupon_discount_amount').val(discountedAmount.toFixed(2));
                $("#DueAmount_tendering").val(newAmount.toFixed(2));
                $("#tendered").val(newAmount.toFixed(2));
                $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
                $("#payLaterAmount").text(Number(newAmount).toFixed(2));

                // Multipay
                $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#summary_round_off").text(Number(roundoff).toFixed(2));
                $("#summary_net_amount").text(Number(newAmount).toFixed(2));
                $("#PayableAmount").val(Number(newAmount).toFixed(2));
                $("#totalPayment").val(Number(newAmount).toFixed(2));
                $("#receivedAmount").val(Number(newAmount).toFixed(2));
                // Close modal
                setTimeout(function() {
                    $('#pos_apply_coupon_model').modal('hide');
                }, 1000);

                // Refresh coupon list to reflect applied state
                applyeCouponModel();
            } else {
                $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text(response.message);
            }
        },
        error: function() {
            $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text('Error applying coupon');
        }
    });
}




function removeCoupon(couponCode) {
    var cusId = $(".cusId").val();
    if (!cusId) {
        toastr.warning('Please select Customer', 'Warning', { positionClass: 'toast-bottom-full-width' });
        return false;
    }
    var net_amount = Number($('#sub_total').text()) || 0;
    var tax_amount = Number($('#tax_amount').text()) || 0;
    $.ajax({
        url: '<?=base_url();?>shop-pos/removeCoupon',
        method: 'POST',
        dataType: 'json',
        data: { coupon_code: couponCode, customer_id: cusId },
        success: function(response) {
            if (response.success) {
                var oldtotal = net_amount + tax_amount;
                const amounts = getAmounts(oldtotal.toFixed(2));
                var originalAmount = Number(amounts.originalAmount) || 0;
                var roundedAmount = Number(amounts.roundedAmount) || 0;
                var roundoff = Number(amounts.roundoff) || 0;
                var newAmount = Number(amounts.newAmount) || 0;
                $('#net_amount').text(newAmount.toFixed(2));
                $('#rounded_amount').text(roundedAmount.toFixed(2));
                $('#coupon_amount').text((0 ).toFixed(2)); 
                $("#round_off").val(roundoff.toFixed(2));
                $("#DueAmount_tendering").val(newAmount.toFixed(2));
                $("#tendered").val(newAmount.toFixed(2));
                $('#coupon_value').val('');
                $('#coupon_type').val('');
                $('#coupon_net_amount').val('');
                $('#coupon_discount_amount').val('');
                $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
                $("#payLaterAmount").text(Number(newAmount).toFixed(2));
                $('#coupon_code').val('');
               // Multipay
                $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#summary_round_off").text(Number(roundoff).toFixed(2));
                $("#summary_net_amount").text(Number(newAmount).toFixed(2));
                $("#PayableAmount").val(Number(newAmount).toFixed(2));
                $("#totalPayment").val(Number(newAmount).toFixed(2));
                $("#receivedAmount").val(Number(newAmount).toFixed(2));

                $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text(response.message);
                

                // Close modal
                setTimeout(function() {
                    $('#pos_apply_coupon_model').modal('hide');
                }, 1000);

                // Refresh coupon list to reflect removed state
                applyeCouponModel();
            } else {
                toastr.error(response.message, 'Error', { positionClass: 'toast-bottom-full-width' });
            }
        },
        error: function() {
            toastr.error('Error removing coupon', 'Error', { positionClass: 'toast-bottom-full-width' });
        }
    });
}
function ResetCoupon(couponCode) {
    var cusId = $(".cusId").val();
    if (!cusId) {
        toastr.warning('Please select Customer', 'Warning', { positionClass: 'toast-bottom-full-width' });
        return false;
    }
    var net_amount = Number($('#sub_total').text()) || 0;
    var tax_amount = Number($('#tax_amount').text()) || 0;
    $.ajax({
        url: '<?=base_url();?>shop-pos/removeCoupon',
        method: 'POST',
        dataType: 'json',
        data: { coupon_code: couponCode, customer_id: cusId },
        success: function(response) {
            if (response.success) {
                var oldtotal = net_amount + tax_amount;
                 console.log(oldtotal);
                const amounts = getAmounts(oldtotal.toFixed(2));

                var originalAmount = Number(amounts.originalAmount) || 0;
                var roundedAmount = Number(amounts.roundedAmount) || 0;
                var roundoff = Number(amounts.roundoff) || 0;
                var newAmount = Number(amounts.newAmount) || 0;

                $('#net_amount').text(newAmount.toFixed(2));
                $('#rounded_amount').text(roundedAmount.toFixed(2));
                $('#coupon_amount').text((0 ).toFixed(2)); 
                $("#round_off").val(roundoff.toFixed(2));
                $("#DueAmount_tendering").val(newAmount.toFixed(2));
                $("#tendered").val(newAmount.toFixed(2));
                $('#coupon_value').val('');
                $('#coupon_type').val('');
                $('#coupon_net_amount').val('');
                $('#coupon_discount_amount').val('');
                $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
                $("#payLaterAmount").text(Number(newAmount).toFixed(2));

               // Multipay
                $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#summary_round_off").text(Number(roundoff).toFixed(2));
                $("#summary_net_amount").text(Number(newAmount).toFixed(2));
                $("#PayableAmount").val(Number(newAmount).toFixed(2));
                $("#totalPayment").val(Number(newAmount).toFixed(2));
                $("#receivedAmount").val(Number(newAmount).toFixed(2));
                $('#coupon_code').val('');
                $('#wrong_alert_coupon').removeClass('d-none').find('#wrong_alert_coupon_msg').text(response.message);
                

                // Close modal
                setTimeout(function() {
                    $('#pos_apply_coupon_model').modal('hide');
                }, 1000);
                toastr.warning('Due to modification in order, applied coupon is removed!.', 'Warning', 'positionclass:toast-bottom-full-width');

            } else {
                toastr.error(response.message, 'Error', { positionClass: 'toast-bottom-full-width' });
            }
        },
        error: function() {
            toastr.error('Error removing coupon', 'Error', { positionClass: 'toast-bottom-full-width' });
        }
    });
}



function cashOrder() {
        var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
    }
     function cashPrint() {
        var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        document.getElementById('SaveCashFromtendered_btn').setAttribute('onclick', "SaveCashFromtendered('print')");

        
    }
    function tenderedSum(value) {
    let tenderedInput = document.getElementById('tendered');
    let currentTenderedValue = Number(tenderedInput.value) || 0; 
    if (value === -1) {
        tenderedInput.value = "0.00";
    } else if (value === '.') {
        if (!tenderedInput.value.includes('.')) {
            tenderedInput.value += '.';
        }
    } else {
        if (tenderedInput.value === "0" && value !== '.') {
            tenderedInput.value = value.toString();
        } else {
            tenderedInput.value = (currentTenderedValue + Number(value)).toFixed(2);
        }
    }
    let dueAmount = Number(document.getElementById('DueAmount_tendering').value) || 0;
    let tenderedAmount = Number(tenderedInput.value) || 0; 
    let change = tenderedAmount - dueAmount;
    document.getElementById('change').value = change >= 0 ? change.toFixed(2) : "0.00";
}


  function mode(value) {
    value = value.toLowerCase();  // Convert value to lowercase for comparison

    if (value === '2' || value === '3') {
        $('#refrence').removeClass('d-none');
    } else {
        $('#refrence').addClass('d-none');
    }
}

    function SaveCashFromtendered(action)
    {
        var formData = [];
        var check_product =[];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                check_product.push($(this).find('td.product_id').text());
            }
         })
          // Check if any products are added
        if (check_product.length == 0) {
            toastr.warning('Please add at least one product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }
        var cusId = $(".cusId").val();
        if (typeof cusId === 'undefined' || cusId=='' ) {
            toastr.warning('Please select Customer', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }

        var TotalValue          = $('#net_amount').text();
        var TaxValue            = $('#tax_amount').text();
        var RoundOff            = $('#round_off').val();
        var is_hold            = $('#is_hold').val();
        
        var due_amount          = $('.DueAmount_tendering').val();
        var tendered_amount            = $('.tendered').val();
        var change_amount       = $('.change').val();
        var coupon_type       = $('.coupon_type').val();
        var coupon_value       = $('.coupon_value').val();
        var flat_value       = $('.flat_value').val();
        var flat_type       = $('.flat_type').val();
        var coupon_net_amount       = $('.coupon_net_amount').val();
        var coupon_discount_amount       = $('.coupon_discount_amount').val();
        
        
        var address             = $('#customer_totals').find('.Address').text();
        var dueDate             = $('[name=due_date]').val();
        var payment_method      = '1';
        var ref_no_or_remark    = $('[name=reference_no_or_remark]').val();
        var same_as_billing     = $('[name=same_as_billing]').val();
        var shipping_address    = $('[name=shipping_address]').val();
        var order_number        = $('[name=manual_order_number]').val();
        var narration           = $('[name=narration]').val();
        var order_date          = $('[name=manual_order_date]').val();
        var orderType = $('[name="orderType"]:checked').val();
        var oid                 = $('#oid').val();


        formData.push({ name: "orderId", value: order_number });
        formData.push({ name: "user_id", value: cusId });
        formData.push({ name: "total_value", value: TotalValue });
        formData.push({ name: "total_tax", value: TaxValue });
        formData.push({ name: "RoundOff", value: RoundOff });
        formData.push({ name: "random_address", value: address });
        formData.push({ name: "due_date", value: dueDate });
        formData.push({ name: "ref_no_or_remark", value: ref_no_or_remark });
        formData.push({ name: "same_as_billing", value: same_as_billing });
        formData.push({ name: "shipping_address", value: shipping_address });
        formData.push({ name: "narration", value: narration });
        formData.push({ name: "payment_method", value: payment_method });
        formData.push({ name: "order_date", value: order_date });
        formData.push({ name: "due_amount", value: due_amount });
        formData.push({ name: "tendered_amount", value: tendered_amount });
        formData.push({ name: "change_amount", value: change_amount });
        formData.push({ name: "coupon_type", value: coupon_type });
        formData.push({ name: "coupon_value", value: coupon_value });
        formData.push({ name: "flat_value", value: flat_value });
        formData.push({ name: "flat_type", value: flat_type });
        formData.push({ name: "coupon_net_amount", value: coupon_net_amount });
        formData.push({ name: "coupon_discount_amount", value: coupon_discount_amount });
        formData.push({ name: "is_hold", value: is_hold });
        formData.push({ name: "orderType", value: orderType });
        formData.push({ name: "oid", value: oid });

        
        
        var product_id = [];
        var inventory_id = [];
        var qty = [];
        var free = [];
        var price_per_unit = [];
        var purchase_rate = [];
        var purchase_rate = [];
        var mrp = [];
        var total_price = [];
        var tax = [];
        var tax_value = [];
        var offer_applied = [];
        var discount_type = [];
        var offer_applied2 = [];
        var discount_type2 = [];
        $('#item-table tbody tr').each(function(){
            if (!$(this).hasClass('noItem')) {
                product_id.push($(this).find('td.product_id').text());
                inventory_id.push($(this).find('td.inventory_id').text());
                qty.push($(this).find('td.quantity1 [name=qty]').val());
                free.push($(this).find('td.free [name=free]').val());
                price_per_unit.push($(this).find('td.omrp').text());
                purchase_rate.push($(this).find('td.purchase_rate').text());
                mrp.push($(this).find('td.mrp').text());
                total_price.push($(this).find('td.totalamount').text());
                tax.push($(this).find('td.TotalTaxValue').text());
                tax_value.push($(this).find('td.TaxValue1').text());
                offer_applied.push($(this).find('td.Disc [name=discount]').val());
                discount_type_v = 0;
                if ($(this).find('td.Disc [type=checkbox]').is(':checked')) {
                    discount_type_v = 1;
                }
                discount_type.push(discount_type_v);
                offer_applied2.push($(this).find('td.Disc2 [name=discount2]').val());
                discount_type2_v = 0;
                if ($(this).find('td.Disc2 [type=checkbox]').is(':checked')) {
                    discount_type2_v = 1;
                }
                discount_type2.push(discount_type2_v);
            }
            
        })

        if (product_id=='') {
            toastr.warning('Please select Product', 'Warning', 'positionclass:toast-bottom-full-width');
            return false;
        }



        formData.push({name:  "product_id", value:product_id})
        formData.push({name:  "inventory_id", value:inventory_id})
        formData.push({name:  "qty", value:qty})
        formData.push({name:  "free", value:free})
        formData.push({name:  "price_per_unit", value:price_per_unit})
        formData.push({name:  "purchase_rate", value:purchase_rate})
        formData.push({name:  "mrp", value:mrp})
        formData.push({name:  "total_price", value:total_price})
        formData.push({name:  "tax", value:tax})
        formData.push({name:  "tax_value", value:tax_value})
        formData.push({name:  "RoundOff", value:RoundOff})
        formData.push({name:  "offer_applied", value:offer_applied})
        formData.push({name:  "discount_type", value:discount_type})
        formData.push({name:  "offer_applied2", value:offer_applied2})
        formData.push({name:  "discount_type2", value:discount_type2})        
        
            $.ajax({
                url:'<?=base_url()?>shop-pos/check_customer_credit_limit',
                type:'POST',
                data:{business_id:cusId,TotalValue:TotalValue},
                dataType:'JSON',
                success:function(data) {
                    if (data.res=='success') {
                        $.ajax({
                            url: "<?= base_url() ?>shop-pos/save_order_edit",
                            type: 'post',
                            dataType: "json",
                            data: formData,
                            success: function(data) {
                                if (data.res=='success') {
                                    if (data.res === 'success') {
                                toastr.success('Order Placed Successfully!', 'Success', 'positionclass:toast-bottom-full-width');
                                setTimeout(() => {
                                    window.location.href='<?=base_url();?>pos_orders';
                                }, 1000);
                                if(action=='print')
                                {
                                    window.open(data.invoice_url, '_blank');
                                }
                            }

                                }
                                else{
                                   Swal.fire({
                                      icon: data.res,
                                      text: data.msg,
                                      position: 'center'
                                    })  
                                }
                                
                            }
                        })
                    }
                    else{
                        Swal.fire({
                        icon: data.res,
                        text: data.msg,
                        position: 'center'
                      }) 
                    }
                }
            })  
            var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
            audio.play();
    }

    function hasAttr(t,name) { 
        return t.attr(name) !== undefined; 
    };
    $('body').on('input','input',function(){
        var t = $(this);
        if (hasAttr(t,"maxLength")) {
            max_lenght = t.attr('maxLength');
            val_lenght = t.val().length;
            if (val_lenght > max_lenght){
                t.val(t.val().slice(0, max_lenght));
            } 
        }
    })

    $('body').on('change','input[name=manual_order_number]',function(e){
        check_order_id();
    })

    function check_order_id() {
        var orderId = $('input[name=manual_order_number]').val();
        $.ajax({
            url:'<?=base_url()?>shop-pos/check_order_id',
            type:'post',
            data:{orderId:orderId},
            dataType:'JSON',
            success:function(data){
                if (data.res=='success') {
                    toastr.success(data.msg, data.res, 'positionclass:toast-bottom-full-width');
                    
                }
                else{
                    toastr.error(data.msg, data.res, 'positionclass:toast-bottom-full-width');
                    return false;
                }
                
                
            },
            error:function() {
                toastr.error('Order Number available', 'error', 'positionclass:toast-bottom-full-width');
                return false;
            }
        })
    }
    </script>
<script>
$(document).ready(function() {
    function fetchLastBillDetails() {
        $.ajax({
            url: '<?=base_url();?>shop-pos/getLastBill', // Your server endpoint
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.bill) {
                    var bill = response.bill;
                    $('#bill_last_no').text(bill.orderid);
                    $('#billlast_amount').html('<i class="fa fa-inr currency_style" aria-hidden="true"></i>'+bill.total_value);

                    var button = $('#print_last_bill');
                    button.attr('data-bill-id', bill.id);
                } else {
                    $('#bill_last_no').text("N/A");
                    $('#billlast_amount').html('<i class="fa fa-inr currency_style" aria-hidden="true"></i>' + 0);

                    var button = $('#print_last_bill');
                    button.attr('data-bill-id',0);
                    console.error('Error fetching bill: ' + response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    }

    fetchLastBillDetails();
      // Click handler for the print button
      $(document).on('click', '#print_last_bill', function() {
        var billId = $(this).attr('data-bill-id');
        if(billId !=0){
        var printUrl = '<?=base_url();?>pos_orders/print/bill/' + billId;
        window.open(printUrl, '_blank');
        }   });

});
    function openholdbill(searchQuery = '') {
        var modal = document.getElementById('holdbilldiv');
        modal.style.display = 'block'; 
        setTimeout(function() {
            modal.style.right = '0';
        }, 10);

        $.ajax({
            url: '<?=base_url();?>shop-pos/getHoldOrders',
            type: 'GET',
            data:{search:encodeURIComponent(searchQuery)},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var holdBillList = $('#hold_bill_div');
                    holdBillList.empty();
                    $.each(response.orders, function(index, item) {
                        var listItem = `
                            <li class="mb-2" 
                                data-order-id="${item.oid || ''}" 
                                data-order-date="${item.order_date || ''}" 
                                data-contact-name="${item.fname || ''} ${item.lname || ''}" 
                                data-contact-no="${item.cus_mobile || ''}" 
                                data-amount="${item.total_value || ''}">
                                <div>
                                    <a href="javascript:void(0)" onclick="showBill(${item.oid})">
                                        <div class="d-flex align-items-center"> 
                                            <p style="font-weight:bold; font-size:15px">Order ID :<br> <span>${item.orderid}</span></p> 
                                            <p class="mt-1 print-btn pb-0" style="width:10% !important; float:right !important; font-size:18px;position: relative;left: 36px;">
                                                <span><button style="border:none;" onclick="printHoldBill(${item.oid})"><i class="fa fa-print" aria-hidden="true"></i></button></span>
                                            </p> 
                                            <p class="mt-1 print-btn pb-0" style="width:0 !important; float:right !important; font-size:18px;">
                                                <span><button style="border:none;position: relative;left: 57px;" onclick="holdbilldelete(event, ${item.oid})"><i class="fa fa-trash" aria-hidden="true"></i></button></span>
                                            </p>
                                       </div>
                                       <p class="mt-1" style="font-size:11px"><span>${item.order_date}</span></p>
                                       <p style="font-weight:500;">Contact Name: ${item.fname} ${item.lname}</p>
                                       <p style="font-weight:500;">Contact No: ${item.cus_mobile}</p>
                                       <p>Amount <b><i class="fa fa-inr currency_style" aria-hidden="true"></i>${item.total_value}</b></p>
                                </div>
                            </li>
                        `;
                        holdBillList.append(listItem);
                    });
                } else {
                    $('#hold_bill_div').html('<p>No orders available.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching data: ", error);
            }
        });
    }
      // Search functionality
      $('#search_hold_bill').on('input', function() {
        var query = $(this).val();
        openholdbill(query); 
    });


function printHoldBill(orderId) {
    const url = `<?= base_url(); ?>shop-pos/printHoldInvoice/${orderId}`;
    window.open(url, '_blank');
}

function closeholdbill() {
    var modal = document.getElementById('holdbilldiv');
    modal.style.right = '-270px';
    setTimeout(function() {
        modal.style.display = 'none'; 
    }, 500); 
}

window.onclick = function(event) {
    var modal = document.getElementById('holdbilldiv');
    if (event.target == modal) {
        closeholdbill();
    }
}

function holdbilldelete(event, id) {
    event.preventDefault(); 
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete this hold bill?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?=base_url();?>shop-pos/deleteHoldBill',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your hold bill has been deleted.',
                        'success'
                    );
                    openholdbill();
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the hold bill.',
                        'error'
                    );
                }
            });
        }
    });
}
  

function showBill(orderId) {
    var modal = document.getElementById('holdbilldiv');
    modal.style.display = 'none'; 
    $.ajax({
        url: `<?= base_url(); ?>shop-pos/getBillDetails/${orderId}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var invoice = response.invoice;
                var items = invoice.items || [];
                var coupons = invoice.coupon || [];
                var order = invoice.order || {};
                var vendor = invoice.vendor || {};

                $('.manual_order_number').val(order.orderid || '');
                $('.manual_order_date').val(order.datetime || '');
                $('#narration').val(order.narration || '');
                $('#due_date').val(order.due_date || '');

                var gstin = vendor.gstin || "N/A";

                $('#customer_totals > tbody  > tr').each(function() {
                    $(this).find(".cusId").val(vendor.id || '');
                    $(this).find(".CusName").text(`${vendor.fname || ''} ${vendor.lname || ''}`);
                    $(this).find(".MobileNo").text(vendor.mobile || '');
                    $(this).find(".Email").text(vendor.email || '');
                    $(this).find(".Address").text(`${vendor.house_no || ''} ${vendor.address || ''} ${vendor.address_line_2 || ''} ${vendor.address_line_3 || ''} ${vendor.city || ''} ${vendor.state_name || ''} ${vendor.pincode || ''}`);
                    $('.change').val(order.change_amount || '');
                    $(this).find(".GSTN").text(gstin);
                    $(".is_hold").val(1);
                    
                });

                $("#Customer_div").show();
                $("#RmoveBtn").show();
                $('#item').val(''); 
                $("#item-table").find("tr.noItem").hide(); // Remove all rows except the noItem row

                let totalQuantity = 0;
                let totalAmount = 0;
                let totalDiscountAmount = 0;// Initialize the total discount amount
                items.forEach(function(item) {
                    let row = $('#item-table > tbody > tr').filter(function() {
                        return $(this).find(".inventory_id").text() === item.inventory_id;
                    });

                    if (row.length === 0) {
                        // Item does not exist, add new row
                        let profit = item.price_per_unit - item.purchase_rate;
                        let profit_percentage = (profit / item.purchase_rate) * 100;
                        let selling_rate = item.total_price;
                        let mrp = item.price_per_unit;
                        let Quantity = item.qty;
                        let AmountwithoutTax = item.total_price;
                        let TaxValue = item.tax;
                        let _total = Number(AmountwithoutTax + TaxValue).toFixed(2);
                        let per1 = item.offer_applied;
                        let discount_type = item.discount_type;
                        let per2 = item.offer_applied2;
                        let discount_type2 = item.discount_type2;
                        var flat_discount= item.flat_discount;
                        var flat_discount_type= item.flat_discount_type;
                          // Calculate discounts
                        let amount = mrp;
                        let discount = 0;
                        let discount2 = 0;
                        let discount3 = 0;
                        let Tdiscount=0;
                        let per=0;
                        var amount2=0;
                        var amount3=0;
                        if(discount_type==1)
                            {
                            amount = (mrp-per1);
                            discount = mrp-amount;
                            Tdiscount +=mrp-amount;
                            }else if(discount_type==0)
                            {
                                per = (mrp*per1)/100;
                                amount = mrp-per; 
                                discount = per1;
                                Tdiscount +=per;
                            }
                            if(per2 > 0){
                            if(discount_type2==1)
                            {
                            amount2 = (amount-per2);
                            discount2 = amount-amount2;
                            Tdiscount +=amount-amount2;
                            }else if(discount_type2==0)
                            {
                                per = (amount*per2)/100;
                                amount = amount-per; 
                                discount2 = per2;
                                Tdiscount +=per;
                            }
                        }else{
                            discount2=0;
                        }
                        if(flat_discount > 0){
                            if(flat_discount_type==0)
                            {
                            amount3 = (amount-flat_discount);
                            discount3 = amount-amount3;
                            Tdiscount +=amount-amount3;
                            perthird = (flat_discount);
                            }else if(flat_discount_type==1)
                            {
                                per = (amount*flat_discount)/100;
                                perthird = (amount*flat_discount)/100;
                                amount = amount-per; 
                                discount3 = flat_discount;
                                Tdiscount +=per;
                            }
                        }else{
                            discount3=0;
                        }
                        totalDiscountAmount +=perthird;
                        $("#flat_value").val(flat_discount);
                        $("#flat_type").val(flat_discount_type);
                        $('#flat_discount').val(flat_discount);
                        var total_qty =Number(item.stock_qty)+Number(item.qty);
                       

                        let ProductTable = `<tr class='jsgrid-filter-row' data-product_code='${item.product_code}'>
                            <td style='width: 7%;' class='jsgrid-cell jsgrid-align-center'>
                                <a href='javascript:void(0)' class='btn btn-sm' onclick='deleteRow(this)'>
                                    <i class='fa fa-trash' style='color:red'></i>
                                </a>
                            </td>
                            <td style='width: 11.8%;' class='jsgrid-cell jsgrid-align-center product_code' style='word-break: break-all;'>${item.product_code}</td>
                            <td class='jsgrid-cell jsgrid-align-center Stock' style='display:none;'>${total_qty}</td>
                            <td class='jsgrid-cell jsgrid-align-center product_id' style='display:none;'>${item.id}</td>
                            <td class='jsgrid-cell jsgrid-align-center inventory_id' style='display:none;'>${item.inventory_id}</td>
                            <td class='jsgrid-cell jsgrid-align-center purchase_rate' style='display:none;'>${item.purchase_rate}</td>
                            <td class='jsgrid-cell jsgrid-align-center TaxValue1' style='display:none;'>${item.tax_value}</td>
                            <td class='jsgrid-cell jsgrid-align-center AmountwithoutTax' style='display:none;'>${AmountwithoutTax}</td>
                            <td class='jsgrid-cell jsgrid-align-center TotalTaxValue' style='display:none;'>${TaxValue}</td>
                            <td class='jsgrid-cell jsgrid-align-center TotalValue' style='display:none;'>${_total}</td>
                            <td style='width: 23.4%;' class='jsgrid-cell jsgrid-align-center'>${item.name}</td>
                            <td style='width: 7%;' class='jsgrid-cell jsgrid-align-center omrp'>${item.price_per_unit}</td>
                            <td style='width: 11.3%;' class='jsgrid-cell jsgrid-align-center Disc'>
                                <input type='number' step='0.01' name='discount' onkeyup='getdiscount(this.value, "${item.inventory_id}", "${item.price_per_unit}")' class='form-control form-control-sm discount' value='${per1}'>
                                <label class='switch'>
                                    <input type='checkbox' onclick='SetValueBlank("${item.inventory_id}", "Disc", "${per1}")' class='togBtn'>
                                    <div class='slider round'>
                                        ${item.discount_type === '1' ? "<span class='off'>%</span><span class='on'>Fixed</span>" : "<span class='on'>Fixed</span><span class='off'>%</span>"}
                                    </div>
                                </label>
                            </td>
                            <td style='width: 9%;' class='jsgrid-cell jsgrid-align-center mrp'>
                                ${Number(selling_rate).toFixed(2)}
                                <input type='hidden' value='${Number(selling_rate).toFixed(2)}' class='sell_rate'>
                            </td>
                            <td class='jsgrid-cell jsgrid-align-center sellingPriceForDics2' style='display:none'>${Number(selling_rate).toFixed(2)}</td>
                             <td class='jsgrid-cell jsgrid-align-center sellingPriceForDics3' style='display:none'>${Number(selling_rate).toFixed(2)}</td>
                            <td style='width: 6%;' class='jsgrid-cell jsgrid-align-center quantity1'>
                                <input type='number' name='qty' class='form-control form-control-sm' value='${item.qty}' min='1'>
                            </td>
                            <td style='width: 5%;' class='jsgrid-cell jsgrid-align-center totalamount'>${Number(selling_rate).toFixed(2)}</td>
                            <td style='width: 11%;' class='jsgrid-cell jsgrid-align-center Disc2'>
                                <input type='number' step='0.01' name='discount2' value='${per2}' onkeyup='getdiscount2(this.value, "${item.inventory_id}")' class='form-control form-control-sm discount'>
                                <label class='switch'>
                                    <input type='checkbox' onclick='SetValueBlank("${item.inventory_id}", "Disc2")' class='togBtn2'>
                                    <div class='slider round'>
                                        ${item.discount_type2 === '1' ? "<span class='off'>%</span><span class='on'>Fixed</span>" : "<span class='on'>Fixed</span><span class='off'>%</span>"}
                                    </div>
                                </label>
                            </td>
                            <td style='width: 6%;' class='jsgrid-cell jsgrid-align-center profit'>${profit_percentage.toFixed(2)}</td>
                        </tr>`;

                        $("#item-table tbody").append(ProductTable);
                         // Update Sales Summary Table
                    var salesSummaryRow = "<tr data-sales-item=''>";
                    salesSummaryRow += "<td><span data-item-index=''>" + ($('#sales_summary_table tbody tr').length + 1) + "</span></td>";
                    salesSummaryRow += "<td><span data-item-name=''>" + item.name + "</span></td>";
                    salesSummaryRow += "<td class='text-right'><span data-item-qty=''>"+item.qty+"</span></td>";
                    salesSummaryRow += "</tr>";

                    $("#sales_summary_table tbody").append(salesSummaryRow);
                    } else {
                        // Item exists, update quantity
                        if (item.qty > row.find("input[name=qty]").val()) {
                            let newQuantity = Number(row.find("input[name=qty]").val()) + 1;
                            row.find("input[name=qty]").val(newQuantity).change();

                            let totalAmount = item.mrp * newQuantity;
                            let GetResult = GetSaleRecord(totalAmount, item.tax_value, item.qty);
                            let getV = GetResult.split(",");
                            let AmountwithoutTax = getV[0];
                            let TaxValue = getV[1];

                            row.find(".totalamount").text(Number(totalAmount).toFixed(2));
                        } else {
                            toastr.warning('You don\'t have enough stock', 'Warning', { positionClass: 'toast-bottom-full-width' });
                        }
                    }
                });
                $('#total_discount_amount').text(Number(totalDiscountAmount).toFixed(2));
                // Recalculate totals
                $('#item-table > tbody > tr').each(function() {
                    let row = $(this);
                    let quantity = Number(row.find(".quantity1 input").val()) || 0;
                    let amount = Number(row.find(".totalamount").text()) || 0;

                    totalQuantity += quantity;
                    totalAmount += amount;
                });

                let CouponDisc = 0;
                let totalWithoutTax=0;
                var coupon_value=0;
                var coupon_discount_type='';
                var coupon_net_amount=0;
                var coupon_discount_amount=0;
                var SubTotal=0;
              

                if (coupons.length > 0) {
                coupons.forEach(function(coupon) {
                    if (coupon.coupon_type == '2') {
                        CouponDisc += coupon.discount_amount;
                        coupon_value=coupon.coupon_value;
                        coupon_discount_type=coupon.coupon_value_type;
                        coupon_net_amount =coupon.amount;
                        coupon_discount_amount=coupon.discount_amount;
                    }
                });
            }

              // Initialize discount and tax values
                let CouponDiscount = Number(CouponDisc || 0);
                let total_value = Number(order.total_value || 0);
                let round_off = Number(order.round_off || 0);
                let tax = Number(order.tax || 0);
               
                // Calculate totals
               // Calculate totals
               totalAmount = Number((total_value) - round_off).toFixed(2);
                var ttotal =Number(total_value).toFixed(2);
                if(CouponDiscount==0)
                {
                    totalWithoutTax = Number(((CouponDiscount+total_value) - round_off)-tax).toFixed(2);
                    SubTotal=Number(((CouponDiscount+total_value)-round_off)-tax).toFixed(2);
                }else{
                    totalWithoutTax = Number(((CouponDiscount+total_value) - round_off)).toFixed(2);
                    SubTotal=Number(((CouponDiscount+total_value)-round_off)+tax).toFixed(2);
                }
                // Update totals on the UI
                 $("#total_quantity").text(totalQuantity);
                 $("#sub_total").text(totalWithoutTax); // Adjust as needed
                 $("#tax_amount").text(order.tax || 0);
                 $("#rounded_amount").text(Number(totalAmount).toFixed(2));
                 $("#round_off").val(Number(order.round_off).toFixed(2));
                 $("#net_amount").text(Number(ttotal).toFixed(2));
                 $("#DueAmount_tendering").val(Number(order.due_amount).toFixed(2));
                 $("#tendered").val(Number(order.tendered_amount).toFixed(2));
                 $("#ttotal").val(Number(totalWithoutTax).toFixed(2));
                 $("#oldTotal").val(Number(coupon_net_amount).toFixed(2));
                 $("#cardpaymentamountmodel").val(Number(ttotal).toFixed(2));
                 $("#payLaterAmount").text(Number(ttotal).toFixed(2));
                //  $('#total_discount_amount').text(Number(flatDiscount).toFixed(2));
                 $('#coupon_amount').text(Number(CouponDiscount).toFixed(2));
              

                //  Coupon
                $('#coupon_value').val(coupon_value);
                $('#coupon_type').val(coupon_discount_type);
                $('#coupon_net_amount').val(coupon_net_amount);
                $('#coupon_discount_amount').val(coupon_discount_amount);
                 
                // Discount
              

                // Multipay
                $("#summary_sub_total").text(Number(SubTotal).toFixed(2));
                $("#summary_taxable_amount").text(Number(totalWithoutTax).toFixed(2));
                $("#summary_tax_amount").text(order.tax || 0);
                $("#summary_rounded_amount").text(Number(totalAmount).toFixed(2));
                $("#summary_round_off").text(Number(order.round_off).toFixed(2));
                $("#summary_net_amount").text(Number(ttotal).toFixed(2));
                $("#PayableAmount").val(Number(ttotal).toFixed(2));
                $("#totalPayment").val(Number(ttotal).toFixed(2));
                $("#receivedAmount").val(Number(ttotal).toFixed(2));

                var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
                audio.play();
                $('#item').val('');
            } else {
                $('#bill_details').html('<p>Bill details not found.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.log("Error fetching bill details: ", error);
        }
    });
}

// Function to delete a row
function deleteRow(button) {
    $(button).closest('tr').remove();
}





</script>





<script type="text/javascript">

$('#showModal-xl').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var data_url  = button.data('url');
    var modal = $(this);
    $('#showModal-xl .modal-title').text(recipient);
    $('#showModal-xl .modal-body').load(data_url);
});

$(document).on('click', '[data-dismiss="modal"]', function(event) {
    $('#showModal-xl .modal-body').html('');
});


$(document).on("submit", '.ajaxsubmit', function(event) {
    var element = document.getElementById("loader");
    element.className = 'fa fa-spinner fa-spin';
    $("#btnsubmit").prop('disabled', true);
    event.preventDefault(); 
    $this = $(this);
    
    if ($this.hasClass("needs-validation")) {
        if (!$this.valid()) {
            $("#btnsubmit").prop('disabled', false);
            return false;
        }
    }

    $.ajax({
        url: $this.attr("action"),
        type: $this.attr("method"),
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            data = JSON.parse(data);
            
            if (data.res == 'success') {
                var gstin = data.row.gstin != '' ? data.row.gstin : "N/A";
                $('.summary_customer').text(data.row.fname + ' ' + data.row.lname + ' ' + data.row.mobile);
                $('#customer_totals > tbody  > tr').each(function(i, j) {
                    $(j).find(".cusId").val(data.row.id);
                    $(j).find(".CusName").text(data.row.fname + ' ' + data.row.lname);
                    $(j).find(".MobileNo").text(data.row.mobile);
                    $(j).find(".Email").text(data.row.email);
                    $(j).find(".Address").text(data.row.address);
                    $(j).find(".GSTN").text(gstin);
                });
                $("#Customer_div").show();
                $("#RmoveBtn").show();
                if($this.hasClass("add-form")) {
                    $('#showModal-xl').modal('hide');
                }
            }
            alert(data.msg);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle any errors that occurred during the request
            alert("An error occurred: " + textStatus + " - " + errorThrown);
        },
        complete: function() {
            // Re-enable the submit button regardless of success or error
            $("#btnsubmit").prop('disabled', false);
            element.className = ''; // Reset loader class if needed
        }
    });

    return false;
});

function SubmitCustomer() {
        if ($("#fname").val() == '') {
            toastr.warning('Please fill Customer First Name', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#lname").val() == '') {
            toastr.warning('Please fill Customer Last Name', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#email").val() == '') {
            toastr.warning('Please fill Customer Email', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#mobile").val() == '') {
            toastr.warning('Please fill Customer Mobile', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#state").val() == '') {
            toastr.warning('Please fill State', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#city").val() == '') {
            toastr.warning('Please fill City', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#customer_code").val() == '') {
            toastr.warning('Please fill Customer Code', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#pincode").val() == '') {
            toastr.warning('Please fill Pin Code', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        if ($("#address").val() == '') {
            toastr.warning('Please fill Address', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }

        if ($("#aadhar_no").val() == '') {
            toastr.warning('Please fill Aadhaar number', 'Warning', 'positionclass:toast-bottom-full-width');
            return;
        }
        $.ajax({
            url: "<?php echo base_url('shop-pos/save'); ?>",
            method: "POST",
            data: {
                fname: $("#fname").val(),
                lname: $("#lname").val(),
                email: $("#email").val(),
                mobile: $("#mobile").val(),
                alternate_mobile: $("#alternate_mobile").val(),
                state: $("#state").val(),
                city: $("#city").val(),
                customer_code: $("#customer_code").val(),
                gstin: $("#gstin").val(),
                pincode: $("#pincode").val(),
                address: $("#address").val(),
                customer_type: $("#customer_type").val(),
                customer_category: $("#customer_category").val(),
                contact_person_name: $("#contact_person_name").val(),
                customer_profile: $("#customer_profile").val(),
                aadhar_no: $("#aadhar_no").val(),
                credit_limit: $("#credit_limit").val(),
                b2b_b2c: $("#b2b_b2c").val(),
                dr_cr: $("#dr_cr").val(),
                amount: $("#amount").val(),
                remark: $("#remark").val(),
            },
            success: function(data) {
                var gstin = '';
                if (data=="false") {
                    toastr.warning('Mobile No. Already Exists!', 'Warning', 'positionclass:toast-bottom-full-width');
                    return;
                }
                else{

                    if ($("#gstin").val() != '') {
                        gstin = $("#gstin").val();
                    } else {
                        gstin = "N/A";
                    }
                    if (data == "saved") {
                        toastr.success('Saved', 'Success', 'positionclass:toast-bottom-full-width');
                        setInterval(function(){
                            location.reload();
                        }, 2000);
                        $('#customer_totals > tbody  > tr').each(function(i, j) {
                            // $(j).find(".cusId").val(ui.item.value);

                            $(j).find(".CusName").text($("#fname").val()+''+$("#lname").val());
                            $(j).find(".MobileNo").text($("#mobile").val());
                            $(j).find(".Email").text(ui.item.email);
                            $(j).find(".ContactPerson").text($("#contact_person_name").val());
                            $(j).find(".Address").text(ui.item.address);
                            $(j).find(".GSTN").text(gstin);
                        });
                        $('form#AddCustomer').trigger("reset");
                        $("#Customer_div").show();
                        // $("#select_customer").hide();
                        $("#RmoveBtn").show();
                        $('#modalcustomer').modal('hide');
                    }
            }
            },
        });
    }
function validateInput() {
 var gstin = document.getElementById("gstinInput").value;
 var isValid = vGST(gstin.trim());
 }
        
let vGST = (gnumber)=>{
    let gstVal = gnumber;
    let eMMessage = "No Errors";
    let submitButton = document.getElementById("btnsubmit");
    let errorMessage = document.getElementById("errorMessage");
    let successMessage = document.getElementById("successMessage");
    let statecode = gstVal.substring(0, 2);
    let patternstatecode=/^[0-9]{2}$/
    let threetoseven = gstVal.substring(2, 7);
    let patternthreetoseven=/^[A-Z]{5}$/
    let seventoten = gstVal.substring(7, 11);
    let patternseventoten=/^[0-9]{4}$/
    let Twelveth = gstVal.substring(11, 12);
    let patternTwelveth=/^[A-Z]{1}$/
    let Thirteen = gstVal.substring(12, 13);
    let patternThirteen=/^[1-9A-Z]{1}$/
    let fourteen = gstVal.substring(13, 14);
    let patternfourteen=/^Z$/
    let fifteen = gstVal.substring(14, 15);
    let patternfifteen=/^[0-9A-Z]{1}$/
    if (gstVal.length != 15) {
        eMMessage = 'Length should be restricted to 15 digits and should not allow anything more or less';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
            
    }else if (!patternstatecode.test(statecode)) {
        eMMessage = 'First two characters of GSTIN should be numbers';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternthreetoseven.test(threetoseven)) {
        eMMessage = 'Third to seventh characters of GSTIN should be alphabets';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternseventoten.test(seventoten)) {
        eMMessage = 'Eighth to Eleventh characters of GSTIN should be numbers';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternTwelveth.test(Twelveth)) {
        eMMessage = 'Twelveth character of GSTIN should be alphabet';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternThirteen.test(Thirteen)) {
        eMMessage = 'Thirteen characters of GSTIN can be either alphabet or numeric';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternfourteen.test(fourteen)) {
        eMMessage = 'fourteen characters of GSTIN should be Z';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else if (!patternfifteen.test(fifteen)) {
        eMMessage = 'fifteen characters of GSTIN can be either alphabet or numeric';
        submitButton.disabled = true;
        successMessage.innerText = "";
        errorMessage.innerText = eMMessage;
        
    }else{
        submitButton.disabled = false;
        successMessage.innerText = "Valid GSTIN!.";
        errorMessage.innerText = "";
    }
}

    function RemoveTable() {
        $("#select_customer").show();
        $("#RmoveBtn").hide();
        $("#Customer_div").hide();
        $("#customer").val("");
    }

    function CheckCustomerCode() {
        $.ajax({
            url: "<?php echo base_url('shop-pos/check_customer_code/'); ?>",
            method: "POST",
            data: {
                vendor_code: $("#customer_code").val()
            },
            success: function(data) {
                if (data == 1) {

                    toastr.warning('Customer Code Already Exists', 'Warning', 'positionclass:toast-bottom-full-width');
                    $("#customer_code").val('');
                }
            },
        });
    }

  
    $("#customer").autocomplete({
    source: function(request, response) {
        // Fetch data
        $.ajax({
            url: "<?= base_url() ?>shop-pos/getcustomer",
            type: 'post',
            dataType: "json",
            data: {
                search: request.term
            },
            success: function(data) { 
                response(data);
            }
        });
    },
    select: function(event, ui) {
        // Prevent default behavior
        event.preventDefault();

        // Set selection
        $('.customer').val(""); 
        $("#Customer_div").show();
        $("#RmoveBtn").show();

        var Gstn = ui.item.gstin ? ui.item.gstin : "N/A";
        $('.summary_customer').text(ui.item.label+ ' ' +ui.item.mobile);
        $('#customer_totals > tbody > tr').each(function(i, j) {
            $(j).find(".cusId").val(ui.item.value);
            $(j).find(".CusName").text(ui.item.label);
            $(j).find(".MobileNo").text(ui.item.mobile);
            $(j).find(".Email").text(ui.item.email);
            $(j).find(".CustomerType").text(ui.item.customer_type);
            $(j).find(".Address").text(ui.item.address);
            $(j).find(".GSTN").text(Gstn);
        });

        // Play sound
        var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
        audio.play();
        
        // Clear input field
        $("#customer").val("").trigger("input"); // Clear the input and trigger input event
    }
});


   


    $("#item").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "<?= base_url() ?>shop-pos/getitem",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    // debugger
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#item').val(ui.item.label); 
            $("#item-table").find("tr.noItem").hide();
            // $("#sale-record").hide();
            let ProductTable = '';
            let TotalSaleTb = '';
            var inventoryId = '';
            var totalAmount = '';
            var mrp = '';
            var Quantity = '1';
            var selling_per = '';
            var PerAmount = '';
            var per='';
            $('#item-table > tbody  > tr').each(function(i, j) {
                $(this).find(".inventory_id").each(function() {
                    if (ui.item.inventory_id == $(this).html()) {
                        totalAmount = $(j).find(".totalamount").text();
                        mrp = $(j).find(".mrp").text();
                        inventoryId = $(j).find(".inventory_id").text();
                        $(this).closest('tr').find("input").each(function(k) {
                            Quantity = $(this).closest('tr').find("input").val();
                        })
                    }
                });
            });
            if (inventoryId != ui.item.inventory_id) {
                var profit =  ui.item.mrp - ui.item.purchase_rate;
                var profit_percentage =   (profit / ui.item.purchase_rate) * 100;
                var selling_rate = ui.item.mrp;
                if(ui.item.discount_type=='1')
                {
                    selling_per = (Quantity*selling_rate * ui.item.offer_upto)/100;
                    selling_rate = (Quantity*selling_rate) - selling_per;
                    per = ui.item.offer_upto;
                }else
                 if(ui.item.discount_type=='0'){
                    selling_per = ui.item.offer_upto;
                    per = ui.item.offer_upto;
                    selling_rate = (Quantity*selling_rate) - ui.item.offer_upto;
                }else
                {
                    selling_rate = Quantity*selling_rate;
                }
                var GetResult = GetSaleRecord(selling_rate, ui.item.tax_value)
                var getV = GetResult.split(",");
                var AmountwithoutTax = Number(getV[0]).toFixed(2);
                var TaxValue = Number(getV[1]).toFixed(2);
                var _total = getV[2];
                ProductTable += "<tr class='jsgrid-filter-row' data-product_code='"+ui.item.product_code+"'><td style='width: 7%;' class='jsgrid-cell jsgrid-align-center'><a href='javascript:void(0)' id='DeleteButton' class='btn  btn-sm' ><i class='fa fa-trash' style='color:red'></i></a></td>";
                ProductTable += "<td style='width: 11.8%;' class='jsgrid-cell jsgrid-align-center product_code' style='word-break: break-all;'>" + ui.item.product_code + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center Stock' style='display:none;'>" + ui.item.qty + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center product_id' style='display:none;'>" + ui.item.value + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center inventory_id' style='display:none;'>" + ui.item.inventory_id + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center purchase_rate' style='display:none;'>" + ui.item.purchase_rate + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center TaxValue1' style='display:none;'>" + ui.item.tax_value + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center AmountwithoutTax' style='display:none;'>" +Number(AmountwithoutTax).toFixed(2) + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center TotalTaxValue' style='display:none;'>" + Number(TaxValue).toFixed(2) + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center TotalValue' style='display:none;'>" + Number(_total).toFixed(2) + "</td>";
                ProductTable += "<td style='width: 23.4%;' class='jsgrid-cell jsgrid-align-center'>" + ui.item.label + "</td>";
                ProductTable += "<td style='width: 7%;' class='jsgrid-cell jsgrid-align-center omrp'> " + ui.item.mrp + "</td>";
                ProductTable += "<td style='width: 11.3%;' class='jsgrid-cell jsgrid-align-center Disc'><input type='number' step='0.01'  name='discount' id='discount' onkeyup='getdiscount(this.value,`" + ui.item.inventory_id + "`,`" + ui.item.mrp + "`)' class='form-control form-control-sm discount' value='"+per+"'><label class='switch'><input type='checkbox' onclick='SetValueBlank(`" + ui.item.inventory_id + "`,`Disc`,`" + per + "`)' class='togBtn'><div class='slider round'>";
                    if(ui.item.discount_type == '1') {
                        ProductTable += "<span class='off'>%</span><span class='on'>Fixed</span>";
                    } else if(ui.item.discount_type == '0') {
                        ProductTable += "<span class='on'>Fixed</span><span class='off'>%</span>";
                    }
                    ProductTable += "</div></label></td>";
                // Selling Rate
                ProductTable += "<td style='width: 9%;'  class='jsgrid-cell jsgrid-align-center mrp'> " + Number(selling_rate).toFixed(2) + "<input type='hidden' value='"+ Number(selling_rate).toFixed(2) + "' class='sell_rate' id='sell_rate'></td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center sellingPriceForDics2' style='display:none'> " + Number(selling_rate).toFixed(2) + "</td>";
                ProductTable += "<td class='jsgrid-cell jsgrid-align-center sellingPriceForDics3' style='display:none'> " + Number(selling_rate).toFixed(2) + "</td>";
                
                // ProductTable += "<td class='jsgrid-cell jsgrid-align-center quantity1'><input type='text'  onkeypress='return /[0-9]/i.test(event.key)'  name='qty' id='quantity' onkeyup='gettotalamount(this.value,`" + ui.item.product_code + "`)'  class='form-control form-control-sm' value='1'></td>";

                ProductTable += "<td style='width: 6%;'  class='jsgrid-cell jsgrid-align-center quantity1'><input type='number' name='qty' id='quantity' class='form-control form-control-sm' value='1' min='1'></td>";

                // ProductTable += "<td class='jsgrid-cell jsgrid-align-center free'><input type='number' name='free' class='form-control form-control-sm' value='0' min='0'></td>";


                ProductTable += "<td style='width: 5%;'  class='jsgrid-cell jsgrid-align-center totalamount'> " +Number(selling_rate).toFixed(2)  + " </td>";
               

                ProductTable += "<td style='width: 11%;'  class='jsgrid-cell jsgrid-align-center Disc2'><input type='number' step='0.01'  name='discount2' id='discount2' onkeyup='getdiscount2(this.value,`" + ui.item.inventory_id + "`)' class='form-control form-control-sm discount' value=''><label class='switch'><input type='checkbox' onclick='SetValueBlank(`" + ui.item.inventory_id + "`,`Disc2`)' class='togBtn2'><div class='slider round'><!--ADDED HTML --><span class='on'>Fixed</span><span class='off'>%</span><!--END--></div></label></td>";
                ProductTable += "<td style='width: 6%;'  class='jsgrid-cell jsgrid-align-center profit'>"+ ((profit_percentage)).toFixed(2)  +"</td>";

                // ProductTable += "<td class='jsgrid-cell jsgrid-align-center'>Update</td></tr>";
                tableBody = $("#item-table tbody");
                tableBody.append(ProductTable);


            // Update Sales Summary Table
            var salesSummaryRow = "<tr data-sales-item=''>";
            salesSummaryRow += "<td><span data-item-index=''>" + ($('#sales_summary_table tbody tr').length + 1) + "</span></td>";
            salesSummaryRow += "<td><span data-item-name=''>" + ui.item.label + "</span></td>";
            salesSummaryRow += "<td class='text-right'><span data-item-qty=''>" + Quantity + "</span></td>";
            salesSummaryRow += "</tr>";

            $("#sales_summary_table tbody").append(salesSummaryRow);
            } else {
                if ((ui.item.qty) > (Quantity)) {
                    // debugger;
                    var totalAmount = ui.item.mrp * ((Quantity) + 1);
                    var GetResult = GetSaleRecord(totalAmount, ui.item.tax_value, ui.item.qty)
                    var getV = GetResult.split(",");
                    var AmountwithoutTax = getV[0];
                    var TaxValue = getV[1];
                    $('#item-table > tbody  > tr').each(function(i, j) {
                        $(this).find(".inventory_id").each(function() {
                            if ($(this).html() == inventoryId) {
                                // $(this).closest('tr').find("input").each(function(k) {
                                //     $(this).closest('tr').find("input").val(Number(Quantity) + 1);
                                // })
                                
                                $(j).find("[name=qty]").val((Quantity) + 1).change();
                                // $(j).find(".totalamount").text(Number(totalAmount).toFixed(2));
                                // $(j).find(".AmountwithoutTax").text(Number(AmountwithoutTax).toFixed(2));
                                // $(j).find(".TotalTaxValue").text(Number(TaxValue).toFixed(2));
                                // $(j).find(".TotalValue").text((Number(AmountwithoutTax) + Number(TaxValue)).toFixed(2));
                            }
                        });
                    });

                } else {
                    toastr.warning('you don\'t have enough stock', 'Warning', 'positionclass:toast-bottom-full-width');
                }
            }
            if ($('#item-table >tbody >tr').length == 2 && inventoryId != ui.item.inventory_id) {
                var GetResult = GetSaleRecord(selling_rate, ui.item.tax_value)
                var getV = GetResult.split(",");
                var AmountwithoutTax = getV[0];
                var TaxValue = getV[1];
                var _total = getV[2];
                var Tquantity = 0;
                var TbRow = $('#item-table >tbody >tr').length - 1;
                $('#item-table > tbody  > tr').each(function(i, j) {
                    $(this).closest('tr').find(".quantity1 input").each(function(k) {
                        Tquantity += Number($(this).closest('tr').find(".quantity1 input").val()) || 0;
                    })
                });
                var finalTotal = Number(_total).toFixed(2);
                // alert();
                const amounts = getAmounts(finalTotal);
                var originalAmount=amounts.originalAmount;
                var roundedAmount =amounts.roundedAmount;
                var roundoff =amounts.roundoff;
                var newAmount= amounts.newAmount;
                var subtotal = finalTotal;
                $("#total_quantity").text(Tquantity);
                $("#sub_total").text(Number(AmountwithoutTax).toFixed(2));
                $("#tax_amount").text(Number(TaxValue).toFixed(2));
                $("#rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#round_off").val(Number(roundoff).toFixed(2));
                $("#net_amount").text(Number(newAmount).toFixed(2));
                $("#DueAmount_tendering").val(Number(newAmount).toFixed(2));
                $("#tendered").val(Number(newAmount).toFixed(2));
                $("#ttotal").val(Number(AmountwithoutTax).toFixed(2));
                $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
                $("#payLaterAmount").text(Number(newAmount).toFixed(2));

                // Multipay
                $("#summary_sub_total").text(Number(finalTotal).toFixed(2));
                $("#summary_taxable_amount").text(Number(AmountwithoutTax).toFixed(2));
                $("#summary_tax_amount").text(Number(TaxValue).toFixed(2));
                $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#summary_round_off").text(Number(roundoff).toFixed(2));
                $("#summary_net_amount").text(Number(newAmount).toFixed(2));
                $("#PayableAmount").val(Number(newAmount).toFixed(2));
                $("#totalPayment").val(Number(newAmount).toFixed(2));
                $("#receivedAmount").val(Number(newAmount).toFixed(2));
               
                
            } else {
                var GetResult = GetSaleRecord(selling_rate, ui.item.tax_value, ui.item.qty)
            }
            resetFlatDiscount();
                ResetCoupon();
            var audio = new Audio('<?= base_url("assets/sounds/beep.mp3") ?>');
            audio.play();
            $('#item').val('');
            return false;
        }
    });
    var li = $('#ui-id-2 li');
    var liSelected;
    $(window).keydown(function(e) {
        if (e.which === 40) {
        // debugger;

            if (liSelected) {
                liSelected.removeClass('selected');
                next = liSelected.next();
                if (next.length > 0) {
                    liSelected = next.addClass('selected');
                } else {
                    liSelected = li.eq(0).addClass('selected');
                }
            } else {
                liSelected = li.eq(0).addClass('selected');
            }
            liSelected.trigger('click');
        }
    })
    function getAmounts(amount) {
    const originalAmount = Number(amount).toFixed(2); // Rounded to 2 decimal places
    const roundedAmount = Number(Math.round(amount * 100) / 100).toFixed(2); // Rounded to 2 decimal places
    const newAmount = Number(Math.ceil(amount)).toFixed(2); // Rounded up to the next whole number

    return {
        originalAmount: originalAmount,
        roundedAmount: roundedAmount,
        newAmount: newAmount,
        roundoff: Number(newAmount-roundedAmount).toFixed(2)
    };
}






    function GetSaleRecord(SellingRate, TaxValue, Stock) {
        var TaxAmount = (SellingRate - (SellingRate / (1+ (TaxValue/100)))).toFixed(2);
        var AmountWithoutTax = (SellingRate - TaxAmount).toFixed(2); 
        var TotalValue = (parseFloat(AmountWithoutTax) + parseFloat(TaxAmount)).toFixed(2);
        var getResult = AmountWithoutTax + ',' + TaxAmount + ',' + TotalValue;
        var AmountwithoutTax = 0;
        var TaxValue1 = 0;
        var TotalValue = 0;
        var Tquantity = 0;
        var Thisquantity = 0;
        var TbRow = $('#item-table >tbody >tr').length - 1;
        $('#item-table > tbody  > tr').each(function(i, j) {
            $(this).closest('tr').find(".quantity1 input").each(function(k) {
                Tquantity += Number($(this).closest('tr').find(".quantity1 input").val()) || 0;
            })
        });
        $('#item-table > tbody  > tr').each(function(i, j) {
            $(this).closest('tr').find(".quantity1 input").each(function(k) {
                Thisquantity = Number($(this).closest('tr').find(".quantity1 input").val()) || 0;
            })
            if ($(this).find(".AmountwithoutTax").text() != '') {
                AmountwithoutTax += Number($(this).find(".AmountwithoutTax").text());
            }
            if ($(this).find(".TotalTaxValue").text() != '') {
                TaxValue1 += Number($(this).find(".TotalTaxValue").text());
            }
            if ($(this).find(".totalamount").text() != '') {
                TotalValue += Number($(this).find(".totalamount").text());
            }
        });

        if ((Thisquantity) != '' && (Stock) >= (Thisquantity)) {
                const amounts = getAmounts(TotalValue);
                var originalAmount=amounts.originalAmount;
                var roundedAmount =amounts.roundedAmount;
                var roundoff =amounts.roundoff;
                var newAmount= amounts.newAmount;
                var subtotal = Number(TotalValue).toFixed(2);
                $("#total_quantity").text(Tquantity);
                $("#sub_total").text(Number(AmountwithoutTax).toFixed(2));
                $("#tax_amount").text(Number(TaxValue1).toFixed(2));
                $("#rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#round_off").val(Number(roundoff).toFixed(2));
                $("#net_amount").text(Number(newAmount).toFixed(2));
                $("#DueAmount_tendering").val(Number(newAmount).toFixed(2));
                $("#tendered").val(Number(newAmount).toFixed(2));
                $("#ttotal").val(Number(AmountwithoutTax).toFixed(2));
                $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
                $("#payLaterAmount").text(Number(newAmount).toFixed(2));

                // Multipay
                $("#summary_sub_total").text(Number(subtotal).toFixed(2));
                $("#summary_taxable_amount").text(Number(AmountwithoutTax).toFixed(2));
                $("#summary_tax_amount").text(Number(TaxValue1).toFixed(2));
                $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
                $("#summary_round_off").text(Number(roundoff).toFixed(2));
                $("#summary_net_amount").text(Number(newAmount).toFixed(2));
                $("#PayableAmount").val(Number(newAmount).toFixed(2));
                $("#totalPayment").val(Number(newAmount).toFixed(2));
                $("#receivedAmount").val(Number(newAmount).toFixed(2));
        }
        return getResult;

    }
$('body').on('change', 'input[name=qty]',function(){
    var t = $(this);

    if (t.val()==0) {
        t.val(1)
    }
})
$('body').on('change | input', 'input[name=qty]',function(){
    var t = $(this);
    if (t.val()=='0') {
        t.val(1)
    }
   
    var qty = t.val();
    var tr = t.parents('tr');
    var id = tr.data('product_code');
    var mrp = tr.find(".mrp").text();
    var TaxValue1 = tr.find(".TaxValue1").text();
    var Stock = tr.find(".Stock").text();
    var productCode = tr.data("product_code");
    if ((Stock) >= (qty)) {
        var totalAmount = mrp * qty;
        var GetResult = GetSaleRecord(totalAmount, TaxValue1, qty)
        var getV = GetResult.split(",");
        var AmountwithoutTax = getV[0];
        var TaxValue = getV[1];
        var _total = getV[2];
        
        Number(tr.find(".totalamount").text(totalAmount.toFixed(2)));
        tr.find(".AmountwithoutTax").text(Number(AmountwithoutTax).toFixed(2));
        tr.find(".TotalTaxValue").text(Number(TaxValue).toFixed(2));
        tr.find(".TotalValue").text(Number((AmountwithoutTax) + (TaxValue)).toFixed(2));
      
    }
    else{
        t.val('');
        toastr.warning('You dont have enough stock', 'Warning', 'positionclass:toast-bottom-full-width');
    }
    resetFlatDiscount();
     ResetCoupon();
})





$("#item-table").on("click", "#DeleteButton", function() {
    $(this).closest("tr").remove();

    if ($('#item-table >tbody >tr').length == 1) {
        $("#item-table").find("tr.noItem").show();
        $("#sale-record").show();
        $("#sale-record1").remove();
    }

    var AmountwithoutTax = 0;
    var TaxValue1 = 0;
    var TotalValue = 0;
    var Tquantity = 0;
    var Thisquantity = 0;
    var Stock = 0;
    var tax=0;
    var TbRow = $('#item-table >tbody >tr').length - 1;

    $('#item-table > tbody  > tr').each(function(i, j) {
        $(this).closest('tr').find(".quantity1 input").each(function(k) {
            Tquantity += Number($(this).closest('tr').find(".quantity1 input").val()) || 0;
        });
    });

    $('#item-table > tbody  > tr').each(function(i, j) {
        $(this).closest('tr').find(".quantity1 input").each(function(k) {
            Thisquantity = Number($(this).closest('tr').find(".quantity1 input").val()) || 0;
        });

        if ($(this).find(".AmountwithoutTax").text() != '') {
            AmountwithoutTax += Number($(this).find(".AmountwithoutTax").text()) || 0;
        }
        if ($(this).find(".TotalTaxValue").text() != '') {
            TaxValue1 += Number($(this).find(".TotalTaxValue").text()) || 0;
        }
        if ($(this).find(".totalamount").text() != '') {
            TotalValue += Number($(this).find(".totalamount").text()) || 0;
        }
        if ($(this).find(".TaxValue1").text() != '') {
            tax = Number($(this).find(".TaxValue1").text()) || 0;
        }
        if ($(this).find(".Stock").text() != '') {
            Stock += Number($(this).find(".Stock").text()) || 0;
        }
    });

    if (Thisquantity !== '' && Stock >= Thisquantity) {
        const amounts = getAmounts(TotalValue);
        var originalAmount = Number(amounts.originalAmount) || 0;
        var roundedAmount = Number(amounts.roundedAmount) || 0;
        var roundoff = Number(amounts.roundoff) || 0;
        var newAmount = Number(amounts.newAmount) || 0;
        var subtotal = Number(TotalValue).toFixed(2);
        $("#total_quantity").text(Thisquantity.toFixed(2));
        $("#sub_total").text(AmountwithoutTax.toFixed(2));
        $("#tax_amount").text(TaxValue1.toFixed(2));
        $("#rounded_amount").text(roundedAmount.toFixed(2));
        $("#round_off").val(roundoff.toFixed(2));
        $("#net_amount").text(newAmount.toFixed(2));
        $("#DueAmount_tendering").val(newAmount.toFixed(2));
        $("#tendered").val(newAmount.toFixed(2));
        $("#ttotal").val(AmountwithoutTax.toFixed(2));
        $("#cardpaymentamountmodel").val(Number(newAmount).toFixed(2));
        $("#payLaterAmount").text(Number(newAmount).toFixed(2));

         // Multipay
         $("#summary_sub_total").text(Number(subtotal).toFixed(2));
         $("#summary_taxable_amount").text(Number(AmountwithoutTax).toFixed(2));
         $("#summary_tax_amount").text(Number(TaxValue1).toFixed(2));
         $("#summary_rounded_amount").text(Number(roundedAmount).toFixed(2));
         $("#summary_round_off").text(Number(roundoff).toFixed(2));
         $("#summary_net_amount").text(Number(newAmount).toFixed(2));
         $("#PayableAmount").val(Number(newAmount).toFixed(2));
         $("#totalPayment").val(Number(newAmount).toFixed(2));
         $("#receivedAmount").val(Number(newAmount).toFixed(2));
         
         
    }
    resetFlatDiscount();
            ResetCoupon();
});




    function getdiscount(Discount, InventoryId, SellingPrice, is_discount1 = true, togBtnClass = '.togBtn') {
    var togBtn = Boolean;
    var TaxValue = '';
    var Quantity = '';
    var inventoryId = '';
    var purchase_rate = '';
    var Stock = '';

    $('#item-table > tbody  > tr').each(function(i, j) {
        $(this).find(".inventory_id").each(function() {
            if (InventoryId == $(this).html()) {
                Quantity = Number($(this).closest('tr').find("[name=qty]").val()) || 0;
                togBtn = $(j).find(togBtnClass).is(':checked');
                TaxValue = Number($(j).find(".TaxValue1").text()) || 0;
                Stock = Number($(j).find(".Stock").text()) || 0;
                inventoryId = $(j).find(".inventory_id").text();
                purchase_rate = Number($(j).find(".purchase_rate").text()) || 0;
            }
        });
    });

    var GetDiscount = SellingPrice;
    if (togBtn == false) {
        if (Discount <= 100) {
            var DiscountValue = (SellingPrice * Discount) / 100;
            GetDiscount = SellingPrice - DiscountValue;
        } else {
            toastr.warning('You can not apply discount more than 100%.', 'Warning', 'positionclass:toast-bottom-full-width');
            if (is_discount1 == true) {
                $(".inventory_id").each(function() {
                    if (InventoryId == $(this).html()) {
                        $(this).closest('tr').find("[name=discount]").val('');
                    }
                });
            } else {
                $(".inventory_id").each(function() {
                    if (InventoryId == $(this).html()) {
                        $(this).closest('tr').find("[name=discount2]").val('');
                    }
                });
            }
        }
    } else {
        if (SellingPrice >= Discount) {
            GetDiscount = SellingPrice - Discount;
        } else {
            toastr.warning('You can not apply discount more than MRP.', 'Warning', 'positionclass:toast-bottom-full-width');
            if (is_discount1 == true) {
                $(".inventory_id").each(function() {
                    if (InventoryId == $(this).html()) {
                        $(this).closest('tr').find("[name=discount]").val('');
                    }
                });
            } else {
                $(".inventory_id").each(function() {
                    if (InventoryId == $(this).html()) {
                        $(this).closest('tr').find("[name=discount2]").val('');
                    }
                });
            }
        }
    }

    var TaxValue1 = '';
    var DisAmountWithoutTax = 0;
    $('#item-table > tbody  > tr').each(function(i, j) {
        $(this).find(".inventory_id").each(function() {
            if ($(this).html() == inventoryId) {
                $(j).find(".mrp").text(GetDiscount.toFixed(2));

                var profit = GetDiscount - purchase_rate;
                var profit_percentage = (profit / purchase_rate) * 100;
                $(j).find(".profit").text(profit_percentage.toFixed(2));

                if (is_discount1 == true) {
                    $(j).find(".sellingPriceForDics2").text(GetDiscount.toFixed(2));
                }
                $(j).find(".sellingPriceForDics3").text(GetDiscount.toFixed(2));
                $(j).find(".totalamount").text((GetDiscount * Quantity).toFixed(2));
                TaxValue1 = GetDiscount - (GetDiscount * (100 / (100 + TaxValue)));
                DisAmountWithoutTax = GetDiscount - TaxValue1;
                $(j).find(".TotalTaxValue").text((TaxValue1 * Quantity).toFixed(2));
                $(j).find(".AmountwithoutTax").text((DisAmountWithoutTax * Quantity).toFixed(2));
                $(j).find(".TotalValue").text((GetDiscount * Quantity).toFixed(2));
            }
        });
    });
    resetFlatDiscount();
            ResetCoupon();
    GetSaleRecord(GetDiscount, TaxValue, Stock);
    return GetDiscount;
}

function getdiscount2(Discount, InventoryId) {
    var togBtn = Boolean;
    var TaxValue = '';
    var SellingPrice = '';
    var inventoryId = '';
    var Disc = '';

    $('#item-table > tbody  > tr').each(function(i, j) {
        $(this).find(".inventory_id").each(function() {
            if (InventoryId == $(this).html()) {
                
                Disc = $(this).closest('tr').find(".Disc input").val();
                SellingPrice = Number($(j).find(".sellingPriceForDics2").text()) || 0;
                inventoryId = $(j).find(".inventory_id").text();
            }
        });
    });

    if (Disc != "") {
        getdiscount(Discount, InventoryId, SellingPrice, is_discount1 = false, togBtnClass = '.togBtn2');
    } else {
        toastr.warning('Please apply the first discount.', 'Warning', 'positionclass:toast-bottom-full-width');
    }
            ResetCoupon();
}


let isPercentage = true;
let originalNetAmount = 0; 
function changeDiscountType() {
    isPercentage = !isPercentage;
    const btn = document.getElementById('btn_percentage_flat_discount');
    if (isPercentage) {
        btn.innerHTML = '<i class="fa fa-percent" aria-hidden="true"></i>';
        document.getElementById('flat_discount').setAttribute('placeholder', 'Percentage');
    } else {
        btn.innerHTML = '<i class="fa fa-rupee" aria-hidden="true"></i>';
        document.getElementById('flat_discount').setAttribute('placeholder', 'Amount');
    }
    checkFlat();
}

function checkFlat() {
    const discountValue = Number(document.getElementById('flat_discount').value) || 0;
    var SellingPrice = '';
    var inventoryId = '';
    var discount = '';
    var totalDiscount = 0;  // Reset totalDiscount here
    var GetDiscount = SellingPrice;
    var Stock = '';
    var TaxValue = '';
    var purchase_rate = '';
    var is_discount1 = true;
    var type='';
    let DiscountValue = 0; 

    $('#item-table > tbody > tr').each(function(i, j) {
        $(this).find(".inventory_id").each(function() {
            Quantity = Number($(this).closest('tr').find("[name=qty]").val()) || 0;
            SellingPrice = Number($(j).find(".sellingPriceForDics3").text()).toFixed(2) || 0;
            inventoryId = $(j).find(".inventory_id").text();
            TaxValue = Number($(j).find(".TaxValue1").text()) || 0;
            Stock = Number($(j).find(".Stock").text()) || 0;
            purchase_rate = Number($(j).find(".purchase_rate").text()) || 0;

            let DiscountValue;
            if (isPercentage) {
                DiscountValue = Number((SellingPrice * discountValue) / 100).toFixed(2);
                type=1;
            } else {
                DiscountValue = discountValue;
                type=0;
            }
            GetDiscount = Number((SellingPrice - DiscountValue) ).toFixed(2);
            totalDiscount += Number(DiscountValue); 

            $(j).find(".mrp").text(Number(GetDiscount).toFixed(2));
            var profit = GetDiscount - purchase_rate;
            var profit_percentage = (profit / purchase_rate) * 100;
            $(j).find(".profit").text(Number(profit_percentage).toFixed(2));
            $(j).find(".totalamount").text(Number(GetDiscount * Quantity).toFixed(2));

            var TaxValue1 = GetDiscount - (GetDiscount * (100 / (100 + TaxValue)));
            var DisAmountWithoutTax = GetDiscount - TaxValue1;
            $(j).find(".TotalTaxValue").text(Number(TaxValue1 * Quantity).toFixed(2));
            $(j).find(".AmountwithoutTax").text(Number(DisAmountWithoutTax * Quantity).toFixed(2));
            $(j).find(".TotalValue").text(Number(GetDiscount * Quantity).toFixed(2));
        });
    });
    var total_discount_amount = $('#total_discount_amount').text();
    $("#flat_value").val(Number(document.getElementById('flat_discount').value) || 0);
    $("#flat_type").val(type);
    document.getElementById('total_discount_amount').innerText = Number(totalDiscount).toFixed(2);
  
    
    GetSaleRecord(GetDiscount, TaxValue, Quantity);
    ResetCoupon();
    return GetDiscount;
}



function resetFlatDiscount() {
    var discountValue = Number($('#flat_discount').val()) || 0;
    if(discountValue >0 || discountValue !=''){
    document.getElementById('flat_discount').value = '';
    document.getElementById('total_discount_amount').innerText = '0.00';
    toastr.warning('Due to modification in order, applied Flat Discount is removed!.', 'Warning', 'positionclass:toast-bottom-full-width');
    checkFlat();
    }
}



    function SetValueBlank(InventoryId, disTd,value) {
        $('#item-table > tbody  > tr').each(function(i, j) {
            $(this).find(".inventory_id").each(function() {
                if ($(this).html() == InventoryId) {
                    // $(this).closest('tr').find(`.${disTd} input`".Disc input").each(function(k) {
                    //     $(this).closest('tr').find(".Disc input").val('');
                    // })

                    $(this).closest('tr').find(`.${disTd} input`).val(value).keyup();
                }
            });
        });
        resetFlatDiscount();
            ResetCoupon();
       
    }

    function fetch_city(state) {
        $.ajax({
            url: "<?php echo base_url('shop-pos/fetch_city'); ?>",
            method: "POST",
            data: {
                state: state
            },
            success: function(data) {
                $(".city").html(data);
            },
        });
    }



$(document).ready(function(){
    editPOS('<?=@$order_id;?>');
})



    function editPOS(orderId) {
     if(orderId !=''){   
    $.ajax({
        url: `<?= base_url(); ?>shop-pos/EditPosDetails/${orderId}`,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var invoice = response.invoice;
                var items = invoice.items || [];
                var coupons = invoice.coupon || [];
                var order = invoice.order || {};
                var vendor = invoice.vendor || {};

                $('.manual_order_number').val(order.orderid || '');
                $('.manual_order_date').val(order.datetime || '');
                $('#narration').val(order.narration || '');
                $('#due_date').val(order.due_date || '');
                $('#reference_no_or_remark').val(order.reference_no_or_remark || '');

                var gstin = vendor.gstin || "N/A";

                $('#customer_totals > tbody  > tr').each(function() {
                    $(this).find(".cusId").val(vendor.id || '');
                    $(this).find(".CusName").text(`${vendor.fname || ''} ${vendor.lname || ''}`);
                    $(this).find(".MobileNo").text(vendor.mobile || '');
                    $(this).find(".Email").text(vendor.email || '');
                    $(this).find(".Address").text(`${vendor.house_no || ''} ${vendor.address || ''} ${vendor.address_line_2 || ''} ${vendor.address_line_3 || ''} ${vendor.city || ''} ${vendor.state_name || ''} ${vendor.pincode || ''}`);
                    $('.change').val(order.change_amount || '');
                    $(this).find(".GSTN").text(gstin);
                    $(".is_hold").val(1);
                    
                });
                if (order.order_type === 'Walk In') {
                        $('input[name="orderType"][value="Walk In"]').prop('checked', true);
                    } else if (order.order_type === 'Delivery') {
                        $('input[name="orderType"][value="Delivery"]').prop('checked', true);
                    }
                $("#Customer_div").show();
                $("#RmoveBtn").show();
                $('#item').val(''); 
                $("#item-table").find("tr.noItem").hide(); // Remove all rows except the noItem row

                let totalQuantity = 0;
                let totalAmount = 0;
                let totalDiscountAmount = 0;// Initialize the total discount amount
                items.forEach(function(item) {
                    let row = $('#item-table > tbody > tr').filter(function() {
                        return $(this).find(".inventory_id").text() === item.inventory_id;
                    });

                    if (row.length === 0) {
                        // Item does not exist, add new row
                        let profit = item.price_per_unit - item.purchase_rate;
                        let profit_percentage = (profit / item.purchase_rate) * 100;
                        let selling_rate = item.total_price;
                        let mrp = item.price_per_unit;
                        let Quantity = item.qty;
                        let AmountwithoutTax = item.total_price;
                        let TaxValue = item.tax;
                        let _total = Number(AmountwithoutTax + TaxValue).toFixed(2);
                        let per1 = item.offer_applied;
                        let discount_type = item.discount_type;
                        let per2 = item.offer_applied2;
                        let discount_type2 = item.discount_type2;
                        var flat_discount= item.flat_discount;
                        var flat_discount_type= item.flat_discount_type;
                          // Calculate discounts
                        let amount = mrp;
                        let discount = 0;
                        let discount2 = 0;
                        let discount3 = 0;
                        let Tdiscount=0;
                        let per=0;
                        var amount2=0;
                        var amount3=0;
                      if (discount_type == 1) {
                            // Fixed discount
                            amount = mrp - per1;
                            discount = per1; 
                            Tdiscount = per1; 
                        } else if (discount_type == 0) {
                            discount = (mrp * per1) / 100; 
                            amount = mrp - discount;
                            Tdiscount = discount; 
                        }

                        if (per2 > 0) {
                            if (discount_type2 == 1) {
                                amount2 = amount - per2;
                                discount2 = per2; 
                                Tdiscount = per2; 
                                sele_rate2 = amount2;
                            } else if (discount_type2 == 0) {
                                discount2 = (amount * per2) / 100; 
                                amount2 = amount - discount2; 
                                Tdiscount = discount2;
                                sele_rate2 = amount2; 
                            }
                        } else {
                            discount2 = 0;
                        }

                        if (flat_discount > 0) {
                            if (flat_discount_type == 0) {
                                amount3 = amount2 - flat_discount;
                                discount3 = flat_discount;
                                Tdiscount = flat_discount;
                                 sele_rate3 = amount3; 
                            } else if (flat_discount_type == 1) {
                                discount3 = (amount2 * flat_discount) / 100;
                                amount3 = amount2 - discount3; 
                                Tdiscount = discount3;
                                sele_rate3 = amount3; 
                            }
                        } else {
                            discount3 = 0;
                        }
                        totalDiscountAmount +=Tdiscount;
                        $("#flat_value").val(flat_discount);
                        $("#flat_type").val(flat_discount_type);
                        $('#flat_discount').val(flat_discount);
                        var total_qty =Number(item.stock_qty)+Number(item.qty);
                        var NewMrp=0;
                        var sellingPriceForDics2=0;
                        var sellingPriceForDics3=0;
                        if(amount==0)
                        {
                            NewMrp =mrp; 
                        }else 
                        if(amount2==0)
                        {
                            NewMrp =amount; 
                        }else 
                        if(amount3==0)
                        {
                            NewMrp =amount2; 
                        }else if(amount3!=0){
                            NewMrp =amount3;
                        }
                        if(amount==0)
                        {
                            sellingPriceForDics2 =mrp; 
                        }else{
                            sellingPriceForDics2 =amount; 
                        }
                        if(amount==0)
                        {
                            sellingPriceForDics3 =mrp; 
                        }else if(amount2==0){
                            sellingPriceForDics3 =amount; 
                        }else{
                            sellingPriceForDics3 =amount2; 
                        }

                        let ProductTable = `<tr class='jsgrid-filter-row' data-product_code='${item.product_code}'>
                            <td style='width: 7%;' class='jsgrid-cell jsgrid-align-center'>
                                <a href='javascript:void(0)' class='btn btn-sm' onclick='deleteRowPermanant(this,${item.id})'>
                                    <i class='fa fa-trash' style='color:red'></i>
                                </a>
                            </td>
                            <td style='width: 11.8%;' class='jsgrid-cell jsgrid-align-center product_code' style='word-break: break-all;'>${item.product_code}</td>
                            <td class='jsgrid-cell jsgrid-align-center Stock' style='display:none;'>${total_qty}</td>
                            <td class='jsgrid-cell jsgrid-align-center product_id' style='display:none;'>${item.id}</td>
                            <td class='jsgrid-cell jsgrid-align-center inventory_id' style='display:none;'>${item.inventory_id}</td>
                            <td class='jsgrid-cell jsgrid-align-center purchase_rate' style='display:none;'>${item.purchase_rate}</td>
                            <td class='jsgrid-cell jsgrid-align-center TaxValue1' style='display:none;'>${item.tax_value}</td>
                            <td class='jsgrid-cell jsgrid-align-center AmountwithoutTax' style='display:none;'>${AmountwithoutTax}</td>
                            <td class='jsgrid-cell jsgrid-align-center TotalTaxValue' style='display:none;'>${TaxValue}</td>
                            <td class='jsgrid-cell jsgrid-align-center TotalValue' style='display:none;'>${_total}</td>
                            <td style='width: 23.4%;' class='jsgrid-cell jsgrid-align-center'>${item.name}</td>
                            <td style='width: 7%;' class='jsgrid-cell jsgrid-align-center omrp'>${item.price_per_unit}</td>
                            <td style='width: 11.3%;' class='jsgrid-cell jsgrid-align-center Disc'>
                                <input type='number' step='0.01' name='discount' onkeyup='getdiscount(this.value, "${item.inventory_id}", "${item.price_per_unit}")' class='form-control form-control-sm discount' value='${per1}'>
                                <label class='switch'>
                                    <input type='checkbox' onclick='SetValueBlank("${item.inventory_id}", "Disc", "${per1}")' class='togBtn'>
                                    <div class='slider round'>
                                        ${item.discount_type === '1' ? "<span class='off'>%</span><span class='on'>Fixed</span>" : "<span class='on'>Fixed</span><span class='off'>%</span>"}
                                    </div>
                                </label>
                            </td>
                            <td style='width: 9%;' class='jsgrid-cell jsgrid-align-center mrp'>
                                ${Number(NewMrp).toFixed(2)}
                                <input type='hidden' value='${Number(NewMrp).toFixed(2)}' class='sell_rate'>
                            </td>
                            <td class='jsgrid-cell jsgrid-align-center sellingPriceForDics2' style='display:none'>${Number(sellingPriceForDics2).toFixed(2)}</td>
                             <td class='jsgrid-cell jsgrid-align-center sellingPriceForDics3' style='display:none'>${Number(sellingPriceForDics3).toFixed(2)}</td>
                            <td style='width: 6%;' class='jsgrid-cell jsgrid-align-center quantity1'>
                                <input type='number' name='qty' class='form-control form-control-sm' value='${item.qty}' min='1'>
                            </td>
                            <td style='width: 5%;' class='jsgrid-cell jsgrid-align-center totalamount'>${Number(item.price_per_unit).toFixed(2)}</td>
                            <td style='width: 11%;' class='jsgrid-cell jsgrid-align-center Disc2'>
                                <input type='number' step='0.01' name='discount2' value='${per2}' onkeyup='getdiscount2(this.value, "${item.inventory_id}")' class='form-control form-control-sm discount'>
                                <label class='switch'>
                                    <input type='checkbox' onclick='SetValueBlank("${item.inventory_id}", "Disc2")' class='togBtn2'>
                                    <div class='slider round'>
                                        ${item.discount_type2 === '1' ? "<span class='off'>%</span><span class='on'>Fixed</span>" : "<span class='on'>Fixed</span><span class='off'>%</span>"}
                                    </div>
                                </label>
                            </td>
                            <td style='width: 6%;' class='jsgrid-cell jsgrid-align-center profit'>${profit_percentage.toFixed(2)}</td>
                        </tr>`;

                        $("#item-table tbody").append(ProductTable);
                         // Update Sales Summary Table
                    var salesSummaryRow = "<tr data-sales-item=''>";
                    salesSummaryRow += "<td><span data-item-index=''>" + ($('#sales_summary_table tbody tr').length + 1) + "</span></td>";
                    salesSummaryRow += "<td><span data-item-name=''>" + item.name + "</span></td>";
                    salesSummaryRow += "<td class='text-right'><span data-item-qty=''>"+item.qty+"</span></td>";
                    salesSummaryRow += "</tr>";

                    $("#sales_summary_table tbody").append(salesSummaryRow);
                    } else {
                        // Item exists, update quantity
                        if (item.qty > row.find("input[name=qty]").val()) {
                            let newQuantity = Number(row.find("input[name=qty]").val()) + 1;
                            row.find("input[name=qty]").val(newQuantity).change();

                            let totalAmount = item.mrp * newQuantity;
                            let GetResult = GetSaleRecord(totalAmount, item.tax_value, item.qty);
                            let getV = GetResult.split(",");
                            let AmountwithoutTax = getV[0];
                            let TaxValue = getV[1];

                            row.find(".totalamount").text(Number(totalAmount).toFixed(2));
                        } else {
                            toastr.warning('You don\'t have enough stock', 'Warning', { positionClass: 'toast-bottom-full-width' });
                        }
                    }
                });
                $('#total_discount_amount').text(Number(totalDiscountAmount).toFixed(2));
                // Recalculate totals
                $('#item-table > tbody > tr').each(function() {
                    let row = $(this);
                    let quantity = Number(row.find(".quantity1 input").val()) || 0;
                    let amount = Number(row.find(".totalamount").text()) || 0;

                    totalQuantity += quantity;
                    totalAmount += amount;
                });

                let CouponDisc = 0;
                let totalWithoutTax=0;
                var coupon_value=0;
                var coupon_discount_type='';
                var coupon_net_amount=0;
                var coupon_discount_amount=0;
                var SubTotal=0;
              

                if (coupons.length > 0) {
                coupons.forEach(function(coupon) {
                    if (coupon.coupon_type == '2') {
                        CouponDisc += coupon.discount_amount;
                        coupon_value=coupon.coupon_value;
                        coupon_discount_type=coupon.coupon_value_type;
                        coupon_net_amount =coupon.amount;
                        coupon_discount_amount=coupon.discount_amount;
                    }
                });
            }

              // Initialize discount and tax values
                let CouponDiscount = Number(CouponDisc || 0);
                let total_value = Number(order.total_value || 0);
                let round_off = Number(order.round_off || 0);
                let tax = Number(order.tax || 0);
                // Calculate totals
                totalAmount = Number((total_value) - round_off).toFixed(2);
                var ttotal =Number(total_value).toFixed(2);
                if(CouponDiscount==0)
                {
                    totalWithoutTax = Number(((CouponDiscount+total_value) - round_off)-tax).toFixed(2);
                    SubTotal=Number(((CouponDiscount+total_value)-round_off)-tax).toFixed(2);
                }else{
                    totalWithoutTax = Number(((CouponDiscount+total_value) - round_off)).toFixed(2);
                    SubTotal=Number(((CouponDiscount+total_value)-round_off)+tax).toFixed(2);
                }
        
                // Update totals on the UI
                 $("#total_quantity").text(totalQuantity);
                 $("#sub_total").text(totalWithoutTax); // Adjust as needed
                 $("#tax_amount").text(order.tax || 0);
                 $("#rounded_amount").text(Number(totalAmount).toFixed(2));
                 $("#round_off").val(Number(order.round_off).toFixed(2));
                 $("#net_amount").text(Number(ttotal).toFixed(2));
                 $("#DueAmount_tendering").val(Number(order.due_amount).toFixed(2));
                 $("#tendered").val(Number(order.tendered_amount).toFixed(2));
                 $("#ttotal").val(Number(totalWithoutTax).toFixed(2));
                 $("#oldTotal").val(Number(coupon_net_amount).toFixed(2));
                 $("#cardpaymentamountmodel").val(Number(ttotal).toFixed(2));
                 $("#payLaterAmount").text(Number(ttotal).toFixed(2));
                //  $('#total_discount_amount').text(Number(flatDiscount).toFixed(2));
                 $('#coupon_amount').text(Number(CouponDiscount).toFixed(2));
              

                //  Coupon
                $('#coupon_value').val(coupon_value);
                $('#coupon_type').val(coupon_discount_type);
                $('#coupon_net_amount').val(coupon_net_amount);
                $('#coupon_discount_amount').val(coupon_discount_amount);
                 
                // Discount
              

                // Multipay
                $("#summary_sub_total").text(Number(SubTotal).toFixed(2));
                $("#summary_taxable_amount").text(Number(totalWithoutTax).toFixed(2));
                $("#summary_tax_amount").text(order.tax || 0);
                $("#summary_rounded_amount").text(Number(totalAmount).toFixed(2));
                $("#summary_round_off").text(Number(order.round_off).toFixed(2));
                $("#summary_net_amount").text(Number(ttotal).toFixed(2));
                $("#PayableAmount").val(Number(ttotal).toFixed(2));
                $("#totalPayment").val(Number(ttotal).toFixed(2));
                $("#receivedAmount").val(Number(ttotal).toFixed(2));

                $('#item').val('');
            } else {
                $('#bill_details').html('<p>Bill details not found.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.log("Error fetching bill details: ", error);
        }
    });
  }
}

function deleteRowPermanant(button, item_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `<?= base_url(); ?>shop-pos/deleteItem/${item_id}`,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $(button).closest('tr').remove();
                        updateTotals(); // Call this function to update the totals
                        Swal.fire(
                            'Deleted!',
                            'Your item has been deleted.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the item.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error deleting item: ", error);
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the item.',
                        'error'
                    );
                }
            });
        }
    });
}

function updateTotals() {
    let AmountwithoutTax = 0;
    let TaxValue1 = 0;
    let TotalValue = 0;
    let Tquantity = 0;
    let Stock = 0;

    $('#item-table > tbody > tr').each(function() {
        let quantity = Number($(this).find(".quantity1 input").val()) || 0;
        Tquantity += quantity;

        AmountwithoutTax += Number($(this).find(".AmountwithoutTax").text()) || 0;
        TaxValue1 += Number($(this).find(".TotalTaxValue").text()) || 0;
        TotalValue += Number($(this).find(".totalamount").text()) || 0;
        Stock += Number($(this).find(".Stock").text()) || 0;
    });

    if (Stock >= Tquantity) {
        const amounts = getAmounts(TotalValue);
        $("#total_quantity").text(Number(Tquantity).toFixed(2));
        $("#sub_total").text(Number(AmountwithoutTax).toFixed(2));
        $("#tax_amount").text(Number(TaxValue1).toFixed(2));
        $("#rounded_amount").text(Number(amounts.roundedAmount).toFixed(2));
        $("#round_off").val(Number(amounts.roundoff).toFixed(2));
        $("#net_amount").text(Number(amounts.newAmount).toFixed(2));
        $("#DueAmount_tendering").val(Number(amounts.newAmount).toFixed(2));
        $("#tendered").val(Number(amounts.newAmount).toFixed(2));
        $("#ttotal").val(Number(AmountwithoutTax).toFixed(2));
        $("#cardpaymentamountmodel").val(Number(amounts.newAmount).toFixed(2));
        $("#payLaterAmount").text(Number(amounts.newAmount).toFixed(2));

        // Multipay
        $("#summary_sub_total").text(Number(TotalValue).toFixed(2));
        $("#summary_taxable_amount").text(Number(AmountwithoutTax).toFixed(2));
        $("#summary_tax_amount").text(Number(TaxValue1).toFixed(2));
        $("#summary_rounded_amount").text(Number(amounts.roundedAmount).toFixed(2));
        $("#summary_round_off").text(Number(amounts.roundoff).toFixed(2));
        $("#summary_net_amount").text(Number(amounts.newAmount).toFixed(2));
        $("#PayableAmount").val(Number(amounts.newAmount).toFixed(2));
        $("#totalPayment").val(Number(amounts.newAmount).toFixed(2));
        $("#receivedAmount").val(Number(amounts.newAmount).toFixed(2));
    }
    ResetCoupon();
    resetFlatDiscount();
        
}


</script>



