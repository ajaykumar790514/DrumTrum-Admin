<div class="row">
    <div class="col-md-6 text-left">
        <input type="hidden" value="<?=$page_url;?>" id="page_url">
        <span>Showing <?=$page+1?> to <?=$page+count($products)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <div class="col-md-4" style="float: left; margin: 12px 0px;">
        </div>
        <div class="col-md-8 text-right" style="float: left;">
            <?=$links?>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">Parent Categories:</label>
                <?php 
                // print_r($parent_cat); die; 
                ?>
                <select class="form-control form-control-sm" style="width:100%;" name="parent_id" id="parent_id" onchange="fetch_sub_categories(this.value)">
                <option value="">Select</option>
                <?php foreach ($parent_cat as $parent) { ?>
                <option value="<?php echo $parent->id; ?>" <?php if(!empty($parent_id)) { if($parent_id==$parent->id) {echo "selected"; } }?>>
                    <?php echo $parent->name; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">Sub Categories:</label>
                
                <select class="form-control form-control-sm parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" value="<?=$cat_id?>" onchange="fetch_products(this.value)">
                    <option value="">Select</option>
                    <?php if($cat_id!=='null') { ?>
                        <?php foreach ($sub_cat as $scat) { ?>
                        <option value="<?php echo $scat->id; ?>" <?php if(!empty($cat_id)) { if($cat_id==$scat->id) {echo "selected"; } }?>>
                            <?php echo $scat->name; ?>
                        </option>
                        <?php } ?>
                    <?php }?>                                  
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">Categories:</label>
                
                <select class="form-control form-control-sm child_cat_id" style="width:100%;" name="cat_id" id="cat_id" value="<?=$cat_id?>" onchange="fetch_products_by_cat(this.value)">
                    <option value="">Select</option>
                    <?php if($child_cat_id!=='null') { ?>
                        <?php foreach ($child_cat as $ccat) { ?>
                        <option value="<?php echo $ccat->id; ?>" <?php if(!empty($child_cat_id)) { if($child_cat_id==$ccat->id) {echo "selected"; } }?>>
                            <?php echo $ccat->name; ?>
                        </option>
                        <?php } ?>
                    <?php }?>                                  
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="form-group">
                <label class="control-label">Search:</label>
                <input type="text" class="form-control form-control-sm" name="tb-search" id="tb-search" value="<?php if($search!='null'){echo $search;}?>" placeholder="Search...">
            </div>
        </div>
</div>
<div id="datatable">
<div id="grid_table" class="table-responsive ">
<table width="100%">
            <tr class="jsgrid-header-row">
                <th class="jsgrid-header-cell jsgrid-align-center"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-sm">Delete Selected</button></th>
                <th class="jsgrid-header-cell jsgrid-align-center">S.No.</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Image</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Category</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Name</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Search Keyword</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Code</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Quantity</th>
                <!--<th class="jsgrid-header-cell jsgrid-align-center">Description</th>-->
                <th class="jsgrid-header-cell jsgrid-align-center">Inventry</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Indexing</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Status</th>
                <th style="width: 100px;" class="jsgrid-header-cell jsgrid-align-center">Actions</th>
            </tr>
            
            <?php $i=$page; foreach($products as $value){ ?>
            <tr class="jsgrid-filter-row">
                <td class="jsgrid-cell jsgrid-align-center">
                    <input type="checkbox" class="delete_checkbox" value="<?= $value->id; ?>" id="multiple_delete<?= $value->id; ?>" />
                    <label for="multiple_delete<?= $value->id; ?>"></label>
                </td>
                <th class="jsgrid-cell jsgrid-align-center"><?=++$i?></th>
                <td class="jsgrid-cell jsgrid-align-center">
                
                <?php if($value->is_cover == '1'){ ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$value->name?>" data-url="<?=$image_url?><?=$value->cover_id?>" >
                        <img src="<?php echo IMGS_URL.$value->thumbnail; ?>" alt="cover" height="50">
                    </a>
                <?php  } ?>

                </td>
                <td class="jsgrid-cell jsgrid-align-center">
                    <?php 
                    foreach ($cat_pro_map as $cat) {
                        if($cat->pro_id == $value->id){
                            echo '('.$cat->name.') ';
                        } 
                        
                    }
                    // foreach ($categories as $cat) {
                    //     if($cat->id == $value->parent_cat_id){
                    //         echo $cat->name;
                    //     } 
                    //     if($cat->id == $value->sub_cat_id){
                    //         echo '('.$cat->name.')';
                    //     } 
                    // } 
                    ?>
                </td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->name;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->search_keywords;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->product_code;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->unit_value;?> <?php echo $value->unit_type;?></td>

                <!--<td class="jsgrid-cell jsgrid-align-left">-->
                    <?php /* $desc = strip_tags( $value->description);
                        $desc = substr($desc,0,15);
                        echo $desc;*/ ?>
                    <?php // if(strlen($value->description) > 15){ ?> 
                        <!--.... <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#read-desc<?php echo $value->id; ?>">Read More</button>-->
                    <?php //} ?>
                    
                <!-- </td> -->
                 <td class="jsgrid-cell jsgrid-align-center"><strong>Qty.</strong>(<?=$value->qty;?>)<br><strong>Purchase Rate.</strong>(<?=$value->purchase_rate;?>)<br><strong>Mrp.</strong>(<?=$value->selling_rate;?>)</td>
             
              <td class="jsgrid-cell jsgrid-align-center" >
                 <input type="number" value="<?=$value->seq?>" data="<?=$value->id?>,products_subcategory,id,seq" class="change-indexing" min="0">
                 </td>
                <td class="jsgrid-cell jsgrid-align-center" id="status<?php echo $value->id; ?>">
                    <?php if($value->active==1) { ?>
                        <button class="btn btn-sm btn-success" onclick="change_status(<?php echo $value->id;?>)">Active</button>
                    <?php } else {?>
                        <button class="btn btn-sm btn-danger" onclick="change_status(<?php echo $value->id;?>)">Inactive</button>
                    <?php }?>
                </td>

                <td  style="width: 200px;" class="text-center" >
                    
                    <a class="btn btn-success btn-sm " title="Product Recommend" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Recommend ( <?=$value->name?> )" data-url="<?=$recommend_url?><?=$value->id?>" >
                        Recommend
                    </a>
                    <br>
                    
                    <a class="btn btn-success btn-sm mt-1" href="javascript:void(0)" title="Multi Buy Deal" data-toggle="modal" data-target="#showModal" data-whatever="Multi Buy Deal ( <?=$value->name?> )" data-url="<?=$p_multi_map_url?><?=$value->id?>" >
                        MultiBuy
                    </a>
                    <br>
                    <?php   $count = $this->master_model->Counter('product_props', array('product_id'=> $value->id,'props_id'=>'1'));
                      $count2 = $this->master_model->Counter('product_props', array('product_id'=> $value->id,'props_id'=>'2'));
                   if($count >=1 && $count2 >=1){ ?>
                    <a class="btn btn-success btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Property value ( <?=$value->name?> )" data-url="<?=$pv_url?><?=$value->id?>" >
                        Assign Property
                    </a>
                   <?php }else{?>
                    <a class="btn btn-danger btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Property value ( <?=$value->name?> )" data-url="<?=$pv_url?><?=$value->id?>" >
                        Assign Property
                    </a>
                  <?php }?>
                  <br>

                    <a class="btn btn-success btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Property Images ( <?=$value->name?> )" data-url="<?=$pimg_url?><?=$value->id?>" >Album</a>
                    <br>
<!--
                    <a title="Product Flags" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Product Flags ( <?=$value->name?> )" data-url="<?=$pf_url?><?=$value->id?>" >
                        <i class="fa fa-plus-circle"></i>
                    </a>
-->
<!--
                    <a title="Subscription plan type" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Subscription plan type ( <?=$value->name?> )" data-url="<?=$plan_type_url?><?=$value->id?>" >
                        <i class="fa fa-plus-circle"></i>
                    </a>
-->
                  <?php /*  $count = $this->master_model->Counter('products_mapping', array('pro_id'=> $value->id));
                   if($count==0){ */?>
                    <a class="btn btn-success btn-sm mt-1" title="Product Mapping" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Map Products ( <?=$value->name?> )" data-url="<?=$map_url?><?=$value->id?>" >
                        Mapping
                    </a>   
                    <br>                 
                  <?php /* }else{?>
                    <a class="btn btn-warning btn-sm mt-1" title="Product Mapping" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Map Products ( <?=$value->name?> )" data-url="<?=$map_url?><?=$value->id?>" >
                        Mapping
                    </a>  
                <?php } ; */?>
                
                 <?php /*  $count = $this->master_model->Counter('shops_inventory', array('product_id'=> $value->id,'purchase_rate'=>'0.00'));
                   if($count==1){ */?>
                    <a class="btn btn-success btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Duplicate Product ( <?=$value->name?> )" data-url="<?=$duplicate_url?><?=$value->id?>" title="Duplicate Product">
                        Duplicate
                    </a>
                    <br>
                <?php /*}else{;?>
                     <a class="btn btn-success btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Duplicate Product ( <?=$value->name?> )" data-url="<?=$duplicate_url?><?=$value->id?>" title="Duplicate Product">
                        Duplicate
                    </a>
                <?php } */?>
                   <?php   $sql = $this->master_model->getcatid($value->id);?>
                    <a class="btn btn-success btn-sm mt-1" target="_blank" href="https://drumtrum.com/portal/portal-ab/product/<?=$value->url;?>" > View Products </a>
                    <br />

                    
                    <a onclick="GenerateBarcode('<?= $value->product_code; ?>', '<?= $value->id; ?>')" class="btn btn-success btn-sm mt-1 text-white">
                Barcode
            </a>
            <br>
                 
                     <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Product ( <?=$value->name?> )" data-url="<?=$update_url?><?=$value->id?>">
                        <i class="fa fa-edit"></i>
                    </a>

                         <a href="javascript:void(0)" onclick="_delete(this)" url="master-data/products/delete_product/<?=$value->id?>" title="Delete Product" >
                           <i class="fa fa-trash"></i>
                       </a>


                </td>
            </tr> 
            <!--Read Description modal-->

            <!--<div id="read-desc<?php //echo $value->id; ?>" class="modal  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">-->
                <!--<div class="modal-dialog  modal-lg">-->
                <!--    <div class="modal-content">-->
                <!--        <div class="modal-header">-->
                <!--            <b>Description</b>-->
                <!--            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <!--        </div>-->
                <!--        <div class="modal-body">-->
                            <?php //echo $value->description; ?>
            <!--            </div>-->
            <!--            <div class="modal-footer">-->

                            
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        <!--/Read Description modal-->
            <?php } ?>    
        </table>

            
    </div>
</div>

<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($products)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <?=$links?>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Print Slip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function GenerateBarcode(pcode, id) {
    swal({
        title: "Generate Barcode",
        text: "Are you sure you want to generate the barcode?",
        buttons: {
            confirm: {
                text: "Generate Barcode",
                closeModal: false,
            },
            cancel: {
                text: "Cancel",
                visible: true,
                closeModal: true,
            }
        },
    })
    .then((confirm) => {
        if (confirm) {
            // Proceed with barcode generation
            $.ajax({
                url: '<?php echo base_url('products/GenerateCode');?>',
                type: 'POST',
                data: { code: pcode },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var url = '<?php echo base_url('products/view/');?>' + id;
                        window.open(url, '_blank'); // Opens the URL in a new tab or window
                        // $('#exampleModal .modal-body').load(url, function(responseText, textStatus, jqXHR) {
                        //     if (textStatus === 'error') {
                        //         $('#exampleModal .modal-body').html('<p>Error loading content.</p>');
                        //     } else {
                        //         $('#exampleModal').modal('show');
                        //     }
                        // });
                         swal.close();
                    } else {
                        swal('Failed to generate the barcode: ' + response.message, {
                            icon: "info",
                        }).then(() => {
                            swal.close();
                        });
                    }
                },

                error: function(xhr, status, error) {
                    console.error(error);
                    swal("An error occurred while generating the barcode", {
                        icon: "info",
                    });
                }
            });
        } else {
            // User cancelled barcode generation
            swal("Barcode generation cancelled!", {
                icon: "info",
            });
        }
    });
}




    // function myFunction(page)
    // {
    //     $.ajax({
    //     url: "<?php echo base_url('products/tb'); ?>",
    //     method: "POST",
    //     data: {
    //         page:page
    //     },
    //     success:function(data){
    //         $("#tb").html(data);
    //     }
    // });
    // }
    function change_status(id)
    {
        $.ajax({
        url: "<?php echo base_url('master-data/change_product_status'); ?>",
        method: "POST",
        data: {
            id:id
        },
        success:function(data){
            $("#status"+id).html(data);
        }
    });
    }
  
</script>
<script>
    function delete_product(pid){
        if(confirm('Do you want to delete?') == true)
        {
            $('#tb').load("<?php echo base_url('master-data/products/delete_product/')?>"+pid );
            toastr.success('Product Deleted Successfully..')
        }
    };

</script>
<script type="text/javascript">
   function fetch_products(cat_id) 
   {
    var parent_id = $('#parent_id').val();
    var search = $('#tb-search').val();
        $.ajax({
            url: "<?php echo base_url('master-data/products/tb'); ?>",
            method: "POST",
            data: {
                cat_id:cat_id,  //cat2 id
                parent_id:parent_id,    //cat1 id
                search:search,
            },
            success: function(data){
                // console.log(data);
                $("#tb").html(data);
                //ajax method for loading child categories
                var parent_cat_id = $('#parent_cat_id').val();
                    $.ajax({
                        url: "<?php echo base_url('master-data/fetch_cat'); ?>",
                        method: "POST",
                        data: {
                            parent_cat_id:parent_cat_id
                        },
                        success: function(data){
                            $(".child_cat_id").html(data);
                        },
                    });
            },
        });
        
   }
   function fetch_products_by_cat(child_cat_id)
   {
    var parent_id = $('#parent_id').val();
    var search = $('#tb-search').val();
    var parent_cat_id = $('#parent_cat_id').val();
        $.ajax({
            url: "<?php echo base_url('master-data/products/tb'); ?>",
            method: "POST",
            data: {
                child_cat_id:child_cat_id,
                parent_id:parent_id,
                search:search,
                cat_id:parent_cat_id,
            },
            success: function(data){
                $("#tb").html(data);
               
            },
        });
        
   }
   $('.delete_checkbox').click(function(){
        if($(this).is(':checked'))
        {
        $(this).closest('tr').addClass('removeRow');
        }
        else
        {
        $(this).closest('tr').removeClass('removeRow');
        }
    });
   $('#delete_all').click(function(){
        var checkbox = $('.delete_checkbox:checked');
        var table = 'products_subcategory';
            if(checkbox.length > 0)
            {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url:"<?php echo base_url(); ?>master/multiple_delete",
                method:"POST",
                data:{checkbox_value:checkbox_value,table:table},
                success:function()
                {
                    $('.removeRow').fadeOut(1500);
                }
            })
            }
            else
            {
            alert('Select atleast one record');
            }
   })
</script>