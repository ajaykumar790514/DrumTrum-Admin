<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
	<style>
        #loader {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
        .opacity {
            opacity: 0.5;
        }
    </style>
 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        
                    </div>



                <div class="col-md-8  pt-4 pb-4">
						<div class="card mb-4 count1">
							<div class="card-header card-header-sm">
                            <div class="col-md-4 pl-0">
                            <div class="input-group date">
                                <input type="text" name="daterange" class="form-control form-control-sm" data-date-format="dd/mm/yyyy"  value="" />
                                <div class="input-group-append">
                                    <span class="input-group-text" style="cursor:pointer"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>
								</div>
							</div>
							<div id="loader">
							<img src="loader.gif" alt="Loading..."/>
						</div>
							<div class="card-body card-body-sm counterss" id="loaderhide">
								<div class="row mb-2" style="display: flex;">
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalPosSales"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Pos Sales</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalOnlineSales"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Online Sales</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalPosInvoice">0</h3>
										</div>
										<span>Total Pos Invoice</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalOnlineInvoice">0</h3>
										</div>
										<span>Total Online Invoice</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalQtySold">0</h3>
										</div>
										<span>Sold Qty </span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-success pl-1 pr-1">
											<h3 id="TotalCustomer">0</h3>
										</div>
										<span>Total Customers</span>
									</div>
									
								</div>
								<div class="row mb-2" style="display: flex;">
								<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="ToReceive"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>To Receive</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="TotalPurchase"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Purchase</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="TotalSalesReturn"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Sales Return</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="TotalPurchaseReturn"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span class="pl-1 pr-1">Total Purchase Return</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="TotalPosBills">0</h3>
										</div>
										<span>Total Pos Bills</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-primary pl-1 pr-1">
											<h3 id="TotalOnlineBills">0</h3>
										</div>
										<span>Total Online Bills</span>
									</div>
								</div>
								<div class="row mb-2" style="display: flex;">
								<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="TotalPurchaseQty">0</h3>
										</div>
										<span>Purchase Qty</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="TotalSuppliers">0</h3>
										</div>
										<span>Total Suppliers</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="TotalToPay"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>To Pay</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="totalPaid"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Paid</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="TotalExpense"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Total Expense</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-info pl-1 pr-1">
											<h3 id="TotalItems">0</h3>
										</div>
										<span>Total Products</span>
									</div>
									
								</div>
								<div class="row" style="display: flex;">
								<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="TotalQty">0</h3>
										</div>
										<span>Stock Qty</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="TotalStockValue"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Stock Value</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="totalCash">0</h3>
										</div>
										<span>Cash in Hand</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="grossProfit">0</h3>
										</div>
										<span>Gross Profit</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="ProfitMargin"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Avg. Profit Margin</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="averageMarginInPercentage" title="Margin On Costing">0</h3>
										</div>
										<span>Avg. Profit Margin (%)</span>
									</div>
								</div>
								<div class="row" style="display: flex;">
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="averageCartValueCount"><?=$shop_details->currency;?> 0</h3>
										</div>
										<span>Avg. Cart Value</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3 id="averageBillsCount">0</h3>
										</div>
										<span>Avg. Bills (Nos.)</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										<div class="box bg-light-danger pl-1 pr-1">
											<h3  id="totalBankAmount">0</h3>
										</div>
										<span>Bank Accounts</span>
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										
									</div>
									<div class="col pl-1 pr-1 text-center head-boxes">
										
									</div>
								</div>
							</div>
						</div>
					</div>

                    <div class="col-md-4">

                    </div>

                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->


                <script>
       $(function() {
    var $dateRangePicker = $('input[name="daterange"]');

    // Initialize the date range picker with predefined ranges
    $dateRangePicker.daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last 15 Days': [moment().subtract(14, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Quarter': [moment().startOf('quarter'), moment().endOf('quarter')],
            'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
            'This Financial Year': [moment().startOf('year'), moment()],
            'Last Financial Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        },
        locale: {
            format: 'DD/MM/YYYY'
        },
    });

    // Add click event to the calendar icon to trigger the date range picker
    $('.input-group-append').on('click', function() {
        $dateRangePicker.focus();
    });

    // Fetch data when the date range is changed
    $dateRangePicker.on('change', function () {
        GetAllData();
    });

    function GetAllData() {
        $("#loader").show();  // Show loader
        $("#loaderhide").addClass("opacity");  // Add opacity to the content

        var MainDate = $dateRangePicker.val();

        $.ajax({
            url: "<?=base_url();?>shop-dashboard-total",
            type: "POST",
            dataType: 'json',  // Ensure you expect JSON response
            data: { typeDate: MainDate },
            success: function(response) {
                if (response.success) {
                    var data3 = response.data;
					$("#totalBankAmount").text('<?=$shop_details->currency;?> ' + data3.totalBankAmount);
                    $("#TotalPosSales").text('<?=$shop_details->currency;?> ' + data3.TotalPosSales);
					$("#TotalOnlineSales").text('<?=$shop_details->currency;?> ' + data3.TotalOnlineSales);
                    $("#TotalSalesReturn").html('<?=$shop_details->currency;?> ' + data3.totalSalesReturn);
                    $("#ToReceive").html('<?=$shop_details->currency;?> ' + data3.salesDueAmount);
                    $("#TotalPosInvoice").html(data3.TotalPosInvoice);
					$("#TotalOnlineInvoice").html(data3.TotalOnlineInvoice);
                    $("#TotalQtySold").html(data3.totalSoldQty);
                    $("#TotalCustomer").html(data3.customerCount);
                    $("#TotalSuppliers").html(data3.supplierCount);
                    $("#TotalPurchase").html('<?=$shop_details->currency;?> ' + data3.totalPurchase);
                    $("#TotalPurchaseReturn").html('<?=$shop_details->currency;?> ' + data3.totalPurchaseReturn);
                    $("#TotalPurchaseQty").html(data3.purchaseQty);
                    $("#totalPaid").html('<?=$shop_details->currency;?> ' + data3.PurchasePaidAmount);
                    $("#TotalToPay").html('<?=$shop_details->currency;?> ' + data3.PurchaseDueAmount);
                    $("#TotalPosBills").html(data3.TotalPosBills);
					$("#TotalOnlineBills").html(data3.TotalOnlineBills);
                    $("#TotalItems").html(data3.productCount);
                    $("#TotalQty").html(data3.StockQty);
                    $("#TotalStockValue").html('<?=$shop_details->currency;?> ' + data3.stockAmount);
                    $("#TotalExpense").html('<?=$shop_details->currency;?> ' + data3.expenseAmount);
                    $("#averageBillsCount").html(data3.averageBillsCount);
                    $("#averageCartValueCount").html('<?=$shop_details->currency;?> ' + data3.averageCartValueCount);
                    $("#averageMarginInPercentage").html(parseFloat(data3.averageMarginInPercentage).toFixed(2));
                    $("#grossProfit").html(data3.grossProfitData);
                    $("#ProfitMargin").html('<?=$shop_details->currency;?> ' + data3.ProfitMargin);
                }

                $("#loader").fadeOut("slow");  // Hide loader
                $("#loaderhide").removeClass("opacity");  // Remove opacity from the content
            },
            error: function(xhr, status, error) {
                console.error(error);
                $("#loader").fadeOut("slow");  // Hide loader
                $("#loaderhide").removeClass("opacity");  // Remove opacity from the content
            }
        });
    }

    // Fetch data on page load with default date range (e.g., current date)
    var startDate = moment().format('YYYY-MM-DD');
    var endDate = moment().format('YYYY-MM-DD');
    $dateRangePicker.val(startDate + ' - ' + endDate);
    GetAllData();
});




    </script>             