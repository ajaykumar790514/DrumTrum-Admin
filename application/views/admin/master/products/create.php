<style>
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            parent_id:"required",
            parent_cat_id:"required",
           // unit_value:"required",
            //unit_type:"required",
            description:"required",                 
            //unit_type_id:"required",     
            tax_id:"required", 
            expiry_date:"required",                                                     
            mfg_date:"required",  
            product_code: {
                required:true,
                remote:"<?=$remote?>null/product_code"
            },
           name:{
               required:true,
               remote:"<?=$remote?>null/name"
           },
//           
        },
        messages: {
            product_code: {
                required : "Please enter product code!",
                remote : "Product code already exists!"
            },
            name: {
               required : "Please enter name !",
               remote : "Product Name already exists!"
           },
          
        }
    }); 
});
</script>

<form class="ajaxsubmit needs-validation reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">        
    <div class="row">
        <!-- <div class="col-4">
            <div class="form-group">
            <label class="control-label">Parent Categories:</label>
            <select class="form-control select2" style="width:100%;" name="parent_id" onchange="fetch_sub_categories(this.value)">
            <option value="">Select</option>
            <?php foreach ($parent_cat as $parent) { ?>
            <option value="<?php echo $parent->id; ?>">
                <?php echo $parent->name; ?>
            </option>
            <?php } ?>
            </select>
            </div>
        </div> -->

        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Categories:</label>
                <!-- <select class="form-control parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" onchange="fetch_category(this.value)">
                                                                            
                </select> -->
                <div class="parent_cat_id" id="parent_cat_id" style="height: 250px;overflow: scroll;">
                    <?php 
                        foreach($parent_cat as $row){
                            //echo $row->name;
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->id; ?>" name="cat_id[]" id="defaultCheck<?= $row->id; ?>">
                        <label class="form-check-label" for="defaultCheck<?= $row->id; ?>"><?= $row->name; ?></label>
                    </div>
                    <?php
                        foreach($categories as $row2){
                            if ($row->id == $row2->is_parent) {
                                //echo $row2->name;
                                
                    ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row2->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>)" id="defaultCheck<?= $row2->id; ?>">
                        <label class="form-check-label" for="defaultCheck<?= $row2->id; ?>"><?= $row2->name; ?></label>
                    </div>
                    <?php
                            
                            foreach($categories as $row3){
                                if ($row2->id == $row3->is_parent) {
                                    //echo $row3->name;
                                    
                    ?>
                    <div class="form-check ml-5">
                        <input class="form-check-input" type="checkbox" value="<?= $row3->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>, <?= $row2->id; ?>)" id="defaultCheck<?= $row3->id; ?>" >
                        <label class="form-check-label" for="defaultCheck<?= $row3->id; ?>"><?= $row3->name; ?></label>
                    </div>
                    <?php
                                
                                }
                            }

                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- <div class="col-4">
            <div class="form-group">
                <label class="control-label">Categories:</label>
                <select class="form-control" style="width:100%;" name="cat_id" id="level-third-cat">
                                                                            
                </select>
                <div id="level-third-cat">
                    
                </div>                
            </div>
            
        </div> -->
    </div>
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Product Name:</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Product Image:</label>
                    <input type="file" name="img[]" class="form-control"
size="55550" accept=".png, .jpg, .jpeg, .gif ,.webP, .svg"  id="productImage" multiple="" required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Search Keyword:</label>
                    <input type="text" class="form-control" name="search_keywords">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Product Code:</label>
                    <input type="text" class="form-control" name="product_code" >
                </div>
            </div>
            <div class="col-6" style="display:none">
                <div class="form-group">
                <label class="control-label">Brand Name:</label>
                    <select class="form-control select2" style="width:100%;" name="brand_id">
                    <option value="">Select Brand</option>
                    <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand->id; ?>,<?php echo $brand->name; ?>">
                        <?php echo $brand->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <!-- <div class="col-6">
                <div class="form-group">
                <label class="control-label">Flavour Name:</label>
                    <select class="form-control select2" style="width:100%;" name="flavour_id">
                    <option value="">Select Flavour</option>
                    <?php foreach ($flavours as $flavour) { ?>
                    <option value="<?php echo $flavour->id; ?>,<?php echo $flavour->name; ?>">
                        <?php echo $flavour->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div> -->
        
        <!--    <div class="col-6">-->
        <!--        <div class="form-group">-->
        <!--            <label class="control-label">Product Quantity:</label>-->
        <!--            <input type="number" class="form-control" name="unit_value" value="1">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-6">-->
                
        <!--    <div class="form-group">-->
        <!--    <label class="control-label">Quantity Type:</label>-->
        <!--    <select class="form-control select2" style="width:100%;" name="unit_type_id">-->
        <!--    <option value="">Select Quantity Type</option>-->
        <!--    <?php foreach ($unit_type as $unit) { ?>-->
        <!--    <option value="<?php echo $unit->id; ?>,<?php echo $unit->name; ?>" <?php if($unit->name=='PIECE'){echo "selected";} ;?>>-->
        <!--        <?php echo $unit->name; ?>-->
        <!--    </option>-->
        <!--    <?php } ?>-->
        <!--    </select>-->
        <!--</div>-->
        <!--    </div>-->
           
            
           <div class="col-6">
             <div class="form-group">
                    <label class="control-label">Tax Slab:</label>
                    <select class="form-control select2" style="width:100%;" name="tax_id">
                   <option value="">Select Tax Slab</option>
                   <?php foreach ($tax_slabs as $value) { ?>
                    <option value="<?php echo $value->id; ?>,<?php echo $value->slab; ?>" <?php if($value->is_select=='1'){echo "selected";} ;?> >
                        <?php echo $value->slab; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div> 
            
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Hsn/Sac Code:</label>
                    <input type="text" class="form-control" name="sku" >
                </div>
            </div>
            <div class="col-6" style="display:none">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Application</label>
                    <input type="file" class="form-control" name="application">
                </div>
            </div>
            <div class="col-6"></div>
             <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Size Chart ( In CM )</label>
                    <input type="file" class="form-control"  id="sizeImage" name="chart">
                </div>
            </div>
             <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Size Chart ( In Inch )</label>
                    <input type="file" class="form-control"  id="sizeImage2" name="chart_inch">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Description:</label>
                    <textarea id="editor" cols="92" rows="5" class="form-control" name="description"></textarea>
                </div>
            </div>
        </div>
 
        <div class="row mt-3">
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Purchase Rate:</label>
                <input type="number" class="form-control" name="NewPurchaseRate"  id="NewPurchaseRate" required value='0'>
            </div>
        </div>

        <input type="hidden" class="NewTotalTax" name="NewTotalTax" id="NewTotalTax" value="0">
        <input type="hidden" class="NewTotalValue" name="NewTotalValue" id="NewTotalValue" value="0">
        <input type="hidden" class="NewTotalTaxOne" name="NewTotalTaxOne" id="NewTotalTaxOne" value="0" >
        <input type="hidden" class="NewTotalValueOne" name="NewTotalValueOne" id="NewTotalValueOne" value="0">
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Landing Cost:</label>
                <input type="number" class="form-control" name="NewLandingCost" id="NewLandingCost" readonly required value='0'>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">MRP:</label>
                <input type="number" class="form-control"  id="NewMrp" name="NewMrp"  value='0' required>
            </div>
        </div>

        <div class="col-4">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Select Offer / Discount:</label>
            <select name="NewOffer" id="NewOffer" class="form-control select2" style="width:100%;">
                <option >--Select Offer--</option>
                <?php foreach($offers as $offer):?>
                        <option value="<?=$offer->id;?>"  >
                        <?=$offer->title;?> ( <?php if($offer->discount_type==1){ echo $offer->value."%";}elseif($offer->discount_type==0){echo $offer->value."OFF";} ;?> )</option>
                        <?php endforeach;?>     
            </select>
        </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Selling Rate:</label>
                <input type="number" readonly class="form-control" id="NewSellingRate" name="NewSellingRate" value='0' required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Stock Quantity:</label>
                <input type="number" class="form-control" id="NewQty" name="NewQty" value='0' min="0"  required>
            </div>
        </div>

        </div>
        <h3>SEO Friendly Meta</h3>
        <hr>
        <div class="row">
   
    <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Title:</label>
            <input type="text" class="form-control" name="meta_title" required>
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Keywords:</label>
            <input type="text" class="form-control" name="meta_keywords"  required>
        </div>
    </div>
  
    <div class="col-12">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Description:</label>
            <textarea class="form-control" name="meta_description"  required></textarea>
        </div>
    </div>

</div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
    <!-- <input type="submit" class="btn btn-danger waves-light" type="submit" value="ADD" /> -->
</div>

</form>
  <script>
CKEDITOR.replace( 'editor', {
toolbar: [
{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
'/',
{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
{ name: 'others', items: [ '-' ] },
]
});


$(document).ready(function() {
    // ProductCalculation();
ProductCalculation2();
    $('select[name="tax_id"]').change(function() {
        ProductCalculation();
    });
    $('select[name="NewOffer"]').change(function() {
        ProductCalculation2(); 
    });
    $('#NewPurchaseRate').on('blur', function() {
        ProductCalculation();
    });
    $('#NewQty').on('blur', function() {
        ProductCalculation3();
    });
    
    $('#NewMrp').on('blur', function() {
    var newMrp = parseFloat($('#NewMrp').val()) || 0;
    var NewPurchaseRate = parseFloat($('#NewPurchaseRate').val()) || 0;
    var NewLandingCost = parseFloat($('#NewLandingCost').val()) || 0;
    
    if (newMrp < NewPurchaseRate) {
        toastr.error("MRP must be greater than or equal to Purchase Rate.");
        $('#NewMrp').val(NewLandingCost);
        $('#NewSellingRate').val(NewLandingCost);
        return;
    }
    ProductCalculation2();
    });

    function ProductCalculation() {
    var ValuePer = 0;
    var ValueRate = 0;
    var OValue = 0;
    var OType = 0; 
    var TaxValue = $('select[name="tax_id"]').val();
    var values = TaxValue.split(',');
    var value1 = values[0]; 
    var value2 = values[1];
    var LandingPerValue=0;
    var LandingValue=0;
    var newPurchaseRate = parseFloat($('#NewPurchaseRate').val()) || 0;
    var newMrp = parseFloat($('#NewMrp').val()) || 0;
    var NewSellingRate = parseFloat($('#NewSellingRate').val()) || 0;
    var NewLandingCost = parseFloat($('#NewLandingCost').val()) || 0;
    var NewQty = parseFloat($('#NewQty').val()) || 0;
    
    
    LandingPerValue = ( newPurchaseRate * value2 )/100;
    LandingValue = newPurchaseRate+LandingPerValue;
    var finalPrice = (LandingValue) * NewQty;
    var finalPriceone = (LandingValue);

    var afterDiscTax = (newPurchaseRate*value2)/100;
    var afterDiscTotalTax = afterDiscTax*NewQty;
    $('#NewTotalTax').val(afterDiscTotalTax.toFixed(2));
    $('#NewTotalTaxOne').val(afterDiscTax.toFixed(2));
    $('#NewLandingCost').val(LandingValue.toFixed(2));
    $('#NewMrp').val(LandingValue.toFixed(2));
    $('#NewSellingRate').val(LandingValue.toFixed(2));
    $('#NewTotalValue').val(finalPrice.toFixed(2));
    $('#NewTotalValueOne').val(finalPriceone.toFixed(2));
    $('#NewTaxRate').val(value2);
    $('#NewTaxAmount').val(LandingPerValue.toFixed(2));
   
}
function ProductCalculation3(){
    var NewQty = parseFloat($('#NewQty').val()) || 0;
    var NewTotalTaxOne=$('#NewTotalTaxOne').val();
    var NewTotalValueOne=$('#NewTotalValueOne').val();
    var afterDiscTotalTax = NewTotalTaxOne*NewQty;
    var finalPrice= NewTotalValueOne*NewQty;
    $('#NewTotalTax').val(afterDiscTotalTax.toFixed(2));
    $('#NewTotalValue').val(finalPrice.toFixed(2));
}
 
   function ProductCalculation2()
    {
      var OValue=0;  
      var newMrp = parseFloat($('#NewMrp').val()) || 0;
      var newOffer = parseFloat($('#NewOffer').val()) || 0; 
      var NewLandingCost = parseFloat($('#NewLandingCost').val()) || 0;
    if (newOffer) { 
            OfferValueGet(newOffer, function(OfferValue, DiscountType) {
                OValue = OfferValue; 
                OType = DiscountType; 
                calculateValue(); 
            });
        } else {
            calculateValue(); 
        }
     function calculateValue() {
        if (OValue > 0) {
            if (OType == 1) {
                ValuePer = (newMrp * OValue) / 100;
                ValueRate = newMrp - ValuePer;
            } else if (OType == 0) {
                ValuePer = OValue;
                ValueRate = newMrp - ValuePer;
            } else {
                ValuePer = 0;
                ValueRate = newMrp;
            }
        } else {
            ValuePer = 0;
            ValueRate = newMrp;
        }
        var FinalSel = ValueRate;
        if (FinalSel < NewLandingCost) {
        toastr.error("Selling Rate  should not less than Landing Price.");
        // $('#NewOffer').val('--Select Offer--').trigger('change.select2');
        return;
       }
        $('#NewOfferValue1').val(ValuePer.toFixed(2));
        $('#NewSellingRate').val(FinalSel.toFixed(2));
    }
    }


    function OfferValueGet(id, callback) {
        $.ajax({
            url: '<?php echo base_url('master-data/products/getOffetValue');?>',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.res) { 
                    var getResult = data.row.value;
                    var getDiscountType = data.row.discount_type;
                    callback(getResult, getDiscountType);
                }
            },
            error: function(xhr, status, error) {
                callback('0', '0'); // Handle error case
            }
        });
    }
});




    // Function to check file size
    function checkFileSize() {
        var files = $('#productImage')[0].files;
        var maxSize = 200 * 1024; // 100 KB
        var submitButton = $('#btnsubmit');
        
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                toastr.error("Product image should be less than 200 KB.");
                $('#productImage').val(''); // Empty the input field
                submitButton.prop('disabled', true);
                return;
            }
        }
        submitButton.prop('disabled', false);
    }
    // Bind file size check to the file input field
    $('#productImage').on('change', checkFileSize);


// Function to check file size
function checkFileSize1() {
    var files = $('#sizeImage')[0].files;
    var maxSize = 500 * 1024; // 500 KB
    var submitButton = $('#btnsubmit');
    
    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxSize) {
            toastr.error("Size chart image should be less than 500 KB.");
            $('#sizeImage').val(''); // Empty the input field
            submitButton.prop('disabled', true);
            return;
        }
    }
    submitButton.prop('disabled', false);
}

// Bind file size check to the file input field
$('#sizeImage').on('change', checkFileSize1);


    // Function to check file size
function checkFileSize2() {
    var files = $('#sizeImage2')[0].files;
    var maxSize = 500 * 1024; // 500 KB
    var submitButton = $('#btnsubmit');
    
    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxSize) {
            toastr.error("Size chart image should be less than 500 KB.");
            $('#sizeImage2').val(''); // Empty the input field
            submitButton.prop('disabled', true);
            return;
        }
    }
    submitButton.prop('disabled', false);
}

// Bind file size check to the file input field
$('#sizeImage2').on('change', checkFileSize2);
</script>
            

