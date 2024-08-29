<div class="row return-box pb-3 pr-3 pl-3 pt-3">
	<form action="<?=base_url()?>sale_return/store"	 method="POST" class="return-form ajaxsubmit reload-tb add-form">
	 <div class="row">	
	<div class="col-md-6">
			<strong>Customer : </strong><span class="customer_name"></span><br>
            <strong>Order Date : </strong><span class="order_date"></span><br>
            <strong>Reference No : </strong><span class="reference_no"></span>
			<input type="hidden" name="customer_id">
		</div>
		<div class="col-md-6">
			<strong>Product : </strong><span class="product_name"></span>
			<input type="hidden" name="product_id" >
            <input type="hidden" name="stock_id" >
            <input type="hidden" name="pro_max_qty" >
            <input type="hidden" name="invoice_no" >
		</div>
		<div class="col-12"><br></div>

		<div class="col-md-4">
            <div class="form-group">
	            <label class="control-label">Qty<sup>*</sup> :</label>
	            <input type="number" class="form-control" name="return_qty" min="1" >
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
	            <label class="control-label">Return Rate<sup>*</sup> : </label>
	            <input type="number" class="form-control" name="return_rate" min="1" step="0.01">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
	            <label class="control-label">Total : </label>
	            <input type="number" class="form-control" name="return_total" readonly>
            </div>
        </div>


        <div class="col-md-4">
        	<div class="form-group">
	            <label class="control-label">Return Date : </label>
	            <input type="date" class="form-control" name="return_date" value="<?=date('Y-m-d');?>">
            </div>
        </div>


        <div class="col-md-8">
        	<div class="form-group">
	            <label class="control-label">Remark : </label>
	            <input type="text" class="form-control" name="remark" placeholder="Enter Remark">
            </div>
        </div>

        
		<div class="col-12">
            <div class="form-group">
	            <label class="control-label"><br></label>
	            <input type="submit" class="btn btn-primary btn-sm text-white" value="Save" name="return_store" >
            </div>
        </div>
		</div>
	</form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var pro_qty = parseFloat($('.tb-filter input[name=pro_qty]').val()) || 0;
        var pro_max_qty = parseFloat($('.tb-filter input[name=pro_max_qty]').val()) || 0;

        // Set the initial values
        var cus_id = $('.tb-filter input[name=customer_id]').val();
        var pro_id = $('.tb-filter select[name=product_id]').val();
        if (cus_id !== '' && pro_id !== '') {
            var customer_name = $('.tb-filter input[name=customer_name]').val();
            var order_date = $('.tb-filter input[name=order_date]').val();
            var reference_no = $('.tb-filter input[name=reference_no]').val();
            var product_name = $('.tb-filter select[name=product_id] option:selected').text();
            var pro_rate = $('.tb-filter input[name=pro_rate]').val();
            var pro_stock_id = $('.tb-filter input[name=pro_stock_id]').val();
            var pro_total = $('.tb-filter input[name=pro_total]').val();
            var invoice_no = $('.tb-filter input[name=invoice_no]').val();
            
            $('.customer_name').text(customer_name);
            $('.order_date').text(order_date);
            $('.reference_no').text(reference_no);
            $('.product_name').text(product_name);
            $('input[name=customer_id]').val(cus_id);
            $('input[name=product_id]').val(pro_id);

            $('input[name=return_qty]').val(pro_qty);
            $('input[name=return_rate]').val(pro_rate);
            $('input[name=stock_id]').val(pro_stock_id);
            $('input[name=return_total]').val(pro_total);
            $('input[name=pro_max_qty]').val(pro_max_qty);
            $('input[name=invoice_no]').val(invoice_no);
        } else {
            $('.return-box').html(`<h2 class='text-center text-danger w-100'>Select customer and product</h2>`);
        }
        $('input[name=return_qty]').on('input', function() {
            var entered_qty = parseFloat($(this).val()) || 0;

            if (entered_qty > pro_qty) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: `Quantity cannot be greater than ${pro_qty}.`,
                    confirmButtonColor: '#3085d6'
                });
                $(this).val(pro_qty);
            }

            var rate = parseFloat($('input[name=return_rate]').val()) || 0;
            $('input[name=return_total]').val((entered_qty * rate).toFixed(2));
        });

        $('.return-form').on('submit', function(e) {
            var entered_qty = parseFloat($('input[name=return_qty]').val()) || 0;
            if (entered_qty > pro_qty) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: `Quantity cannot be greater than ${pro_qty}.`,
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });
</script>
