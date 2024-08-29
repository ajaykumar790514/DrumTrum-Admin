<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            parent_id:"required",
            parent_cat_id:"required",
            //unit_value:"required",
            //unit_type:"required",
            description:"required",                                   
            //unit_type_id:"required",                                     
            name:"required",                                     
            product_code:"required",
            tax_id:"required",                                                       
            expiry_date:"required",                                                                                          
            mfg_date:"required", 
            url:{
               required:true,
               remote:"<?=$remote?>/url"
           },
        },
        messages: {
            url: {
                required : "URL Already Exist.",
                remote:"URL already exists Please change this URL!"
            },
        }
    }); 
});
</script>
<form class="ajaxsubmit needs-validation add-form redirect-page reload-location" action="<?=$action_url?>" method="post" enctype= multipart/form-data>

    <div class="row">
    <!-- <div class="col-4">
            <div class="form-group">
            <label class="control-label">Parent Categories:</label>
            <select class="form-control select2" style="width:100%;" name="parent_id" onchange="fetch_sub_categories(this.value)" required>
            <option value="">Select</option>
            <?php foreach ($parent_cat as $parent) { ?>
            <option value="<?php echo $parent->id; ?>" <?php if($parent->id == $value->is_parent){echo "selected";} ?>>
                <?php echo $parent->name; ?>
            </option>
            <?php } ?>
            </select>
            </div>
        </div> -->
        <div class="col-4">
            <div class="form-group">
            <label class="control-label">Categories:</label>
                <!-- <select class="form-control select2 parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" onchange="fetch_update_category(this.value)">
                    <option value="<?php echo $value->cat_id; ?>">
                        <?php echo $value->cat_name; ?>
                    </option>
                </select> -->
                <div class="parent_cat_id" id="parent_cat_id" style="height: 250px;overflow: scroll;">
                    <?php 
                        foreach($parent_cat as $row){
                            //echo $row->name;
                            $checked1 = '';
                            foreach($cat_pro_map as $row_cat_id){ 
                                if ($row_cat_id->cat_id == $row->id) {
                                    $checked1 = 'checked';
                                }
                            }
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->id; ?>" name="cat_id[]" id="defaultCheck<?= $row->id; ?>" <?=$checked1;?>>
                        <label class="form-check-label" for="defaultCheck<?= $row->id; ?>"><?= $row->name; ?></label>
                    </div>
                    <?php
                        foreach($categories as $row2){
                            if ($row->id == $row2->is_parent) {
                                //echo $row2->name;
                                $checked2 = '';
                                foreach($cat_pro_map as $row_cat_id){ 
                                    if ($row_cat_id->cat_id == $row2->id) {
                                        $checked2 = 'checked';
                                    }
                                }
                    ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row2->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>)" id="defaultCheck<?= $row2->id; ?>" <?=$checked2;?>>
                        <label class="form-check-label" for="defaultCheck<?= $row2->id; ?>"><?= $row2->name; ?></label>
                    </div>
                    <?php
                            
                            foreach($categories as $row3){
                                if ($row2->id == $row3->is_parent) {
                                    //echo $row3->name;
                                    $checked = '';
                                    foreach($cat_pro_map as $row_cat_id){ 
                                        if ($row_cat_id->cat_id == $row3->id) {
                                            $checked = 'checked';
                                        }
                                    }
                    ?>
                    <div class="form-check ml-5">
                        <input class="form-check-input" type="checkbox" value="<?= $row3->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>, <?= $row2->id; ?>)" id="defaultCheck<?= $row3->id; ?>" <?=$checked;?>>
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
                <label class="control-label">Selected:</label>
                <select class="form-control select2 update_cat_id" style="width:100%;" name="cat_id" id="cat_id">
                    <option value="<?php echo $value->main_cat_id; ?>">
                        <?php echo $value->main_cat_name; ?>
                    </option>
                </select>
                <div id="level-third-cat">
                    <?php 
                        foreach($cat_pro_map as $row){ 
                            if ($row->flag == 1) {
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->cat_id; ?>" id="defaultCheck<?= $row->cat_id; ?>" checked>
                        <label class="form-check-label" for="defaultCheck<?= $row->cat_id; ?>"><?= $row->name; ?></label>
                    </div>
                <?php }else{ ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row->cat_id; ?>" id="defaultCheck<?= $row->cat_id; ?>" checked>
                        <label class="form-check-label" for="defaultCheck<?= $row->cat_id; ?>"><?= $row->name; ?></label>
                    </div>
                <?php } } ?>
                </div>
            </div>
        </div> -->
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Product Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $value->name; ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Search Keyword:</label>
                <input type="text" class="form-control" name="search_keywords" value="<?php echo $value->search_keywords; ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Product Code:</label>
                <input type="text" class="form-control" name="product_code" value="<?php echo $value->product_code; ?>">
            </div>
        </div>
        
    </div>
    <div class="row">
        
    <!--    <div class="col-6">-->
    <!--        <div class="form-group">-->
    <!--            <label class="control-label">Product Quantity:</label>-->
    <!--            <input type="number" class="form-control" name="unit_value" value="<?php echo $value->unit_value; ?>">-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="col-6">-->
    <!--    <div class="form-group">-->
    <!--    <label class="control-label">Quantity Type:</label>-->
    <!--    <select class="form-control select2" style="width:100%;" name="unit_type_id">-->
    <!--    <option value="">Select Quantity Type</option>-->
    <!--    <?php foreach ($unit_type as $unit) { ?>-->
    <!--    <option value="<?php echo $unit->id; ?>,<?php echo $unit->name; ?>" <?php if($unit->id == $value->unit_type_id){echo "selected";} ?>>-->
    <!--        <?php echo $unit->name; ?>-->
    <!--    </option>-->
    <!--    <?php } ?>-->
    <!--    </select>-->
    <!--</div>-->
    <!--    </div>-->
       
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Tax Slab:</label>
                    <select class="form-control select2 tax_id" style="width:100%;" name="tax_id" id="tax_id">
                    <option value="">Select Tax Slab</option>
                    <?php foreach ($tax_slabs as $slab) { ?>
                    <option value="<?php echo $slab->id; ?>,<?php echo $slab->slab; ?>" <?php if($slab->id == $value->tax_id){echo "selected";} ?>>
                    <?php echo $slab->slab; ?>
                    </option>
                      <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Hsn/Sac Code:</label>
                    <input type="text" class="form-control" name="sku" value="<?php echo $value->sku; ?>">
                </div>
            </div>
            <div class="col-6" style="display:none">
                <div class="form-group">
                    <label class="control-label">Application</label>
                    <input type="file" name="application" class="form-control">
                </div>
                <?php if(!empty($value->application)) { ?>
                    <img src="<?php echo IMGS_URL.$value->application;?>" alt="<?php echo $value->name; ?>" height="50">
                <?php } ?> 
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Size Chart ( In CM )</label>
                    <input type="file" class="form-control" id="sizeImage" name="chart">
                </div>
                  <?php if(!empty($value->size_chart)) { ?>
                    <img src="<?php echo IMGS_URL.$value->size_chart;?>" alt="<?php echo $value->name; ?>" height="50">
                <?php } ?> 
            </div>
              <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Size Chart ( In Inch )</label>
                    <input type="file" class="form-control" id="sizeImage1" name="chart_inch">
                </div>
                  <?php if(!empty($value->size_chart_inch)) { ?>
                    <img src="<?php echo IMGS_URL.$value->size_chart_inch;?>" alt="<?php echo $value->name; ?>" height="50">
                <?php } ?>
            </div>
            <div class="col-6" style="display:none">
                <div class="form-group">
                <label class="control-label">Brand Name:</label>
                    <select class="form-control select2" style="width:100%;" name="brand_id">
                    <option value="">Select Brand</option>
                    <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand->id; ?>,<?php echo $brand->name; ?>" <?php if($brand->id == $value->brand_id){echo "selected";} ?>>
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
                    <option value="<?php echo $flavour->id; ?>,<?php echo $flavour->name; ?>" <?php if($flavour->id == $value->flavour_id){echo "selected";} ?>>
                        <?php echo $flavour->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div> -->
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Description:</label>
                <textarea id="editor" cols="92" rows="5" name="description"><?=$value->description?></textarea>
            </div>
        </div>
    </div>
    <div class="row mt-3">

        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Purchase Rate:</label>
                <input type="number" class="form-control" name="NewPurchaseRate"  id="NewPurchaseRate" required value='<?=$shops_inventory->purchase_rate;?>'>
            </div>
        </div>

        <?php 
           $TaxRate=$TaxRateAmount=$afterDisc=$afterDiscTax=$afterDiscTotalTax=$NewTotalValueRate=$NewTotalValue=$NewTotalValueOne=$Landing_price=0;
            if($shops_inventory)
            {
                $TaxRate = $shops_inventory->tax_value;
                $TaxRateAmount= ($shops_inventory->purchase_rate*$TaxRate)/100;
                $Landing_price = $TaxRateAmount + $shops_inventory->purchase_rate;
                $Purchase = $this->master_model->getRow('purchase_items',['id'=>$shops_inventory->purchase_item_id,'item_id'=>$value->id]);
                $afterDisc =  $shops_inventory->purchase_rate-@$Purchase->discount_value ;
                $afterDiscTax = ($afterDisc*$TaxRate)/100;
                $afterDiscTotalTax = $afterDiscTax*$shops_inventory->qty;
                $NewTotalValueRate=$Landing_price*$shops_inventory->qty;
                $NewTotalValueRate = $Landing_price * (@$Purchase->discount ? $Purchase->discount : '0' / 100);
                $NewTotalValue = ($Landing_price - $NewTotalValueRate)*$shops_inventory->qty;
                $NewTotalValueOne = ($Landing_price - $NewTotalValueRate);
                $current_qty = $shops_inventory->qty;
                $purchase_qty = @$Purchase->qty;
                $diff_qty = $purchase_qty - $current_qty;
                if ($diff_qty < 0) {
                   $diff_qty = 0;
                 }
            }     

      ?>
      <input type="hidden" value="<?php echo @$Purchase->id ;?>" name="purchase_item_id"> 
      <input type="hidden" value="<?php echo $diff_qty;?>" name="diff_qty"> 
      <input type="hidden" name="TaxRate" id="TaxRate" value="<?=$TaxRate;?>">
      <input type="hidden" name="discount" id="discount" value="<?=@$Purchase->discount;?>">
      <input type="hidden" name="discount_value" id="discount_value" value="<?=@$Purchase->discount_value;?>">
      <input type="hidden" class="NewTotalTax" name="NewTotalTax" id="NewTotalTax" value="<?=$afterDiscTotalTax;?>">
      <input type="hidden" class="NewTotalValue" name="NewTotalValue" id="NewTotalValue" value="<?=$NewTotalValue;?>">
      <input type="hidden" class="NewTotalTaxOne" name="NewTotalTaxOne" id="NewTotalTaxOne" value="<?=$afterDiscTax;?>" >
      <input type="hidden" class="NewTotalValueOne" name="NewTotalValueOne" id="NewTotalValueOne" value="<?=$NewTotalValueOne;?>">
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Landing Cost:</label>
                <input type="number" class="form-control" name="NewLandingCost" id="NewLandingCost" readonly required value='<?=bcdiv($Landing_price, 1, 2); ?>'>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">MRP:</label>
                <input type="number" class="form-control"  id="NewMrp" name="NewMrp"  value='<?=$shops_inventory->mrp;?>' required>
            </div>
        </div>

        <div class="col-4">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Select Offer / Discount:</label>
            <select name="NewOffer" id="NewOffer" class="form-control select2" style="width:100%;">
                <option >--Select Offer--</option>
                <?php foreach($offers as $offer):?>
                        <option value="<?=$offer->id;?>" <?php if(@$applyoffer->offer_assosiated_id==$offer->id){echo "selected";} ;?>  ><?=$offer->title;?> ( <?php if($offer->discount_type==1){ echo $offer->value."%";}elseif($offer->discount_type==0){echo $offer->value."OFF";} ;?> )</option>
                        <?php endforeach;?>     
            </select>
        </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Selling Rate:</label>
                <input type="number" readonly class="form-control" id="NewSellingRate" name="NewSellingRate" value='<?=$shops_inventory->selling_rate;?>' required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Stock Quantity:</label>
                <input type="number" class="form-control" id="NewQty" name="NewQty" value='<?=$shops_inventory->qty;?>' min="0"  required>
            </div>
        </div>

        </div>
  <!-- <div class="row">
           <input type="hidden" name="product_id" value="<?//=@$value->id;?>">
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Stock Quantity ( Existing Quantity :- <span class="text-danger "><?//=@$shops_inventory->qty?></span> ) <a id="sub_inventory" class="text-danger" > <i class="fa fa-edit"></i></a>
                    <a id="add_inventory" class="text-primary" style="display: none;"> <i class="fa fa-plus"></i></a> :</label>
                    <input type="number" class="form-control add_qty" name="add_qty" min="0" id="recipient-qty" placeholder="enter add more quantity"  value="0" required>
                    <input type="number" class="form-control advanced sub_qty" name="sub_qty" min="0" id="recipient-qty" placeholder="enter subtract quantity" style="display: none;" oninput="validateInputs()"  required>
                    <input type="hidden" name="exist_qty" id="exist_qty" class="exist_qty final_total" value="<?//=@$shops_inventory->qty?>">
                </div>
            </div>
           
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Purchase Rate:</label>
                    <input type="number" class="form-control" name="purchase_rate" step="0.01" min="0.00" id="recipient-pr" value="<?//=@$shops_inventory->purchase_rate?>" required>
                    
                </div>
            </div> -->
           
            <!-- <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Selling Rate :</label>
                    <input type="number" class="form-control" name="selling_rate"  id="recipient-sr" value="<?//=@$shops_inventory->selling_rate?>"  required>
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">MRP :</label>
                    <input type="number" class="form-control" name="mrp"  id="recipient-sr" value="<?//=@$shops_inventory->mrp?>"  required>
                </div>
            </div> -->
           
            <input type="hidden" name="shop_inventry_id" value="<?=@$shops_inventory->id?>">
        <!-- </div> -->
        <h3>SEO Friendly Meta</h3>
        <hr>
        <div class="row">
        <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Product URL :</label>
            <input type="text" class="form-control" name="url" value="<?=$value->url;?>" >
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Title:</label>
            <input type="text" class="form-control" name="meta_title" value="<?=$value->meta_title;?>" >
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Keywords:</label>
            <input type="text" class="form-control" name="meta_keywords"  value="<?=$value->meta_keywords;?>" >
        </div>
    </div>
  
    <div class="col-6">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Meta Description:</label>
            <textarea class="form-control" name="meta_description"  ><?=$value->meta_description;?></textarea>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-primary waves-light"  ><i id="loader" class=""></i>Update</button>
    <!-- <input id="btnsubmit" type="submit" class="btn btn-primary waves-light" type="submit" value="UPDATE"> -->
</div>

</form>
<script type="text/javascript">
   function validateInputs() {
      var firstInputValue = $('.final_total').val();
      var secondInputValue = $(".advanced").val();
      // Perform the validation
      if (parseInt(secondInputValue) > parseInt(firstInputValue)) {
        $(".advanced").val(firstInputValue),
       alert_toastr("error","Sorry subtract quantity not less than 0")
      } else {
        
      }
    }
      $(document).ready(function(){
        $("#sub_inventory").click(function(){
          $(".add_qty").hide();
          $(".sub_qty").show();
          $("#add_inventory").show();
          $("#sub_inventory").hide();
        });
        $("#add_inventory").click(function(){
          $(".add_qty").show();
          $(".sub_qty").hide();
          $("#add_inventory").hide();
          $("#sub_inventory").show();
        });
      });
   function fetch_category(parent_id)
   {
    //    alert(business_id);
    $.ajax({
        url: "<?php echo base_url('master-data/fetch_category'); ?>",
        method: "POST",
        data: {
            parent_id:parent_id
        },
        success: function(data){
            $(".parent_cat_id").html(data);
        },
    });
   }
  
</script>
  
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
// ProductCalculation2();
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
    var discount_value = parseFloat($('#discount_value').val()) || 0;
    var discount = parseFloat($('#discount').val()) || 0;
    var NewQty = parseFloat($('#NewQty').val()) || 0;
    var TaxRate = parseFloat($('#TaxRate').val()) || 0;
    
    
    LandingPerValue = ( newPurchaseRate * value2 )/100;
    LandingValue = newPurchaseRate+LandingPerValue;
    var discountAmount = (LandingValue * discount) / 100;
    var finalPrice = (LandingValue - discountAmount) * NewQty;
    var finalPriceone = (LandingValue - discountAmount);
    // toastr.success(LandingValue);
    var afterDisc =  newPurchaseRate-discount_value ;
    var afterDiscTax = (afterDisc*value2)/100;
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
        var maxSize = 100 * 1024; // 100 KB
        var submitButton = $('#btnsubmit');
        
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                toastr.error("Product image should be less than 100 KB.");
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
    var files = $('#sizeImage1')[0].files;
    var maxSize = 500 * 1024; // 500 KB
    var submitButton = $('#btnsubmit');
    
    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxSize) {
            toastr.error("Size chart image should be less than 500 KB.");
            $('#sizeImage1').val(''); // Empty the input field
            submitButton.prop('disabled', true);
            return;
        }
    }
    submitButton.prop('disabled', false);
}

// Bind file size check to the file input field
$('#sizeImage1').on('change', checkFileSize2);


</script>