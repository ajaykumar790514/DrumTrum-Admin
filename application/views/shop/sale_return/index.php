<style type="text/css">
    .form-group {
    margin-bottom: 10px;
}
</style>
<div class="row page-titles">
<div class="col-md-5 col-8 align-self-center">
<h3 class="text-themecolor">Dashboard</h3>
      <?php echo $breadcrumb;?>
    </div>
</div>

<div class="row">       
    <!-- Column -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="float-left col-md-10 col-lg-10 col-sm-12">
                                <h3 class="card-title" id="test">Sale Return</h3>
                                <h6 class="card-subtitle"></h6>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-12">
                        <form action="<?=$tb_url?>" class="tb-filter" method="post">
                        <div class="row">
                        <div class="col-lg-2 col-md-6 col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Invoice No : </label>
                                 <input type="text" class="form-control form-control-sm" placeholder="Enter Invoice Number" value="<?=@$invoice;?>" id="invoice_no" name="invoice_no" onchange="filterProduct(this.value)">
                                </div>
                                </div>
                            <div class="col-lg-2 col-md-6 col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Product : </label>
                                <select class="form-control form-control-sm" style="width:100%;" name="product_id" id="product_id" onchange="productData(this.value)" >
                                <option value="">Select Product</option>
                                
                                </select>
                                </div>
                            </div>
                            <input type="hidden" id="customer_id" name="customer_id">
                            <input type="hidden" id="customer_name" name="customer_name">
                            <input type="hidden" id="order_date" name="order_date">
                            <input type="hidden" id="reference_no" name="reference_no">
                            <input type="hidden" id="pro_qty" name="pro_qty">
                            <input type="hidden" id="pro_max_qty" name="pro_max_qty">
                            <input type="hidden" id="pro_rate" name="pro_rate">
                            <input type="hidden" id="pro_stock_id" name="pro_stock_id">
                            <input type="hidden" id="pro_total" name="pro_total">

                            <div class="col-lg-2 col-md-6 col-sm-6 mt-3">
                                <div class="form-group">
                                <a href="javascript:void(0)" class="btn mt-3 btn-primary btn-sm mb-3 mr-3" id="reset-data" title="Reset"><i class="fas fa-retweet"></i></a>
                                <label class="control-label"><br></label>
                                <input type="button" class="btn-sm btn btn-primary text-white" id="add-sale-return" value="Add Sale Return" data-toggle="modal" data-target="#showModal" data-whatever="Add Sale Return" data-url="<?=base_url()?>sale_return/return"> 
                                </div>
                            </div>

                          
                        </div>
                        </form>
                    </div>
                    <div class="col-12" id="tb">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="tb" value="<?=@$tb_url?>">
<div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header py-1">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<script type="text/javascript">
       $('#reset-data').click(function(){
        location.reload();
    })
$('#showModal-xl').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal-xl .modal-title').text(recipient)
    $('#showModal-xl .modal-body').load(data_url);
})

$('#showModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal .modal-title').text(recipient)
    $('#showModal .modal-body').load(data_url);
})

$(document).on('click','[data-dismiss="modal"]', function(event) {
    $('#showModal .modal-body').html('');
    $('#showModal .modal-body').text('');
})

function loadtb(){
    $('.tb-filter').submit();
}

// loadtb();

$(document).on('click', '.pag-link', function(event){
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0;
    var search = $('#tb-search').val();
    $.post($(this).attr('href'),{search:search})
    .done(function(data){
        $('#tb').html(data);
    })
    return false;
})

$('body').on("submit", '.ajaxsubmit', function(event) {
  
    event.preventDefault(); 
    $this = $(this);
    $this.find('[type=submit]').prop('disabled',true);

    if ($this.hasClass("needs-validation")) {
        if (!$this.valid()) {
            return false;
        }
    }
    
    
    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        console.log(data);
        

        data = JSON.parse(data);
        
        if (data.res=='success') {
            
            
            if($this.hasClass("add-form")) {
                $('#showModal').modal('hide');
            }
            
            if ($this.hasClass("reload-tb")) {
                loadtb();
            }

          

            
        }
        alert(data.msg);
        // alert_toastr(data.res,data.msg);
      }
    })
    $this.find('[type=submit]').prop('disabled',false);
    return false;
})

function productData(pro_id){
        $.ajax({
            url: '<?= base_url('reports/fetchProductDetails') ?>',
            type: "POST",
            data: {pro_id:pro_id},
            dataType: 'json', 
            success: function(response) {
                if (response.status) {
                    var total =response.data.mrp*response.data.qty;
                    $('[name=pro_qty]').val(response.data.qty);
                    $('[name=pro_max_qty]').val(response.data.qty);
                    $('[name=pro_rate]').val(response.data.mrp);
                    $('[name=pro_stock_id]').val(response.data.inventory_id);
                    $('[name=pro_total]').val(total);
                } else {
                    $('[name=pro_qty]').val('');
                    $('[name=pro_rate]').val('');
                    $('[name=pro_stock_id]').val('');
                    $('[name=pro_total]').val('');
                    $('[name=pro_max_qty]').val('');
                    
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching customer data:", status, error);
            }
        });
}


$('body').on('input','[name=return_qty],[name=return_rate]',function(){
    var form = $(this).parents('form');
    var return_qty = parseFloat(form.find('[name=return_qty]').val());
    var return_rate = parseFloat(form.find('[name=return_rate]').val());
    form.find('[name=return_total]').val(parseFloat(return_qty*return_rate).toFixed(2));
})


</script>

<?php $this->load->view('shop/reports/filters_js'); ?>