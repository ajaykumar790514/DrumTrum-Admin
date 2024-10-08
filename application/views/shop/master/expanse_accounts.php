<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor">Dashboard</h3>
      <?php echo $breadcrumb;?>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="float-left col-md-10 col-lg-10 col-sm-12">
                                <h3 class="card-title" id="test">Expense   Accounts</h3>
                                <h6 class="card-subtitle"></h6>
                            </div>
                            <div class="float-right col-md-2 col-lg-2 col-sm-12">
                                <div id="add-shop-social" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <b>Add Expense  Accounts</b>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" action="<?php echo base_url('shop-master-data/add_expanse_accounts'); ?>" method="post">
                                                <div class="row">

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input type="text" name="title" class="form-control"  required>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Description </label>
                                                                <input type="text" name="description" class="form-control"  required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="control-label">Opening</label>
                                                        </div>



                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Dr./Cr.:</label>
                                                                <select class="form-control" name="dr_cr">
                                                                    <option value="">-- Select --</option>
                                                                    <option value="cr">Credit</option>
                                                                    <option value="dr">Debit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Amount:</label>
                                                                <input type="number" class="form-control" name="amount" step="0.01" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Remark:</label>
                                                                <input type="text" class="form-control" name="remark">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-danger waves-light" type="submit" v alue="CREATE">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button class="float-right btn btn-sm btn-primary" data-toggle="modal" data-target="#add-shop-social" >Add Expense Accounts</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="grid_table" class="table-responsive table-wrap">
                            <table width="100%">
                                <tr class="jsgrid-header-row">
                                    <th class="jsgrid-header-cell jsgrid-align-center">S.No.</th>
                                    <th class="jsgrid-header-cell jsgrid-align-center">Title</th>
                                    <th class="jsgrid-header-cell jsgrid-align-center">Description</th>
                                    <th class="jsgrid-header-cell jsgrid-align-center">Status</th>
                                    <th class="jsgrid-header-cell jsgrid-align-center">Action</th>
                                </tr>
                                <?php $i=1; foreach($rows as $value){ ?>
                                <tr class="jsgrid-filter-row">
                                   
                                    <td class="jsgrid-cell jsgrid-align-center"><?=$i++?></td>
                                    <td class="jsgrid-cell jsgrid-align-center"><?=$value->title?></td>
                                    <td class="jsgrid-cell jsgrid-align-center"><?=$value->description?></td>
                                    <td class="jsgrid-cell jsgrid-align-center" id="status<?php echo $value->id; ?>">
                                        <?php if($value->active==1) { ?>
                                    <button class="btn btn-sm btn-success" onclick="change_status(<?php echo $value->id;?>)">Active</button>
                                    <?php } else {?>
                                        <button class="btn btn-sm btn-danger" onclick="change_status(<?php echo $value->id;?>)">Inactive</button>
                                        <?php }?>
                                    </td>
                                    <td class="jsgrid-cell jsgrid-align-center">
                                    <a  data-toggle="modal" href="#" data-target="#edit-shop-bank-accounts<?=$value->id?>" ><i class="fa fa-edit"></i></a>
                                    <a href="javscript:void(0)" onclick="delete_account(<?php echo $value->id;?>)">
                                   <i class="fa fa-trash"></i>
                                   </a>
                                    </td>
                                </tr> 
                                <div id="edit-shop-bank-accounts<?=$value->id?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <b>Update Icon</b>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?=base_url('shop-master-data/edit_expanse_accounts/'.$value->id)?>" method="post">
                                                    <div class="row">

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input type="text" name="title" class="form-control" value="<?=$value->title?>" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Description </label>
                                                                <input type="text" name="description" class="form-control" value="<?=$value->description?>" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="control-label">Opening</label>
                                                        </div>



                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Dr./Cr.:</label>
                                                                <select class="form-control" name="dr_cr">
                                                                    <option value="">-- Select --</option>
                                                                    <option value="cr" <?=($value->dr_cr=='cr') ? 'selected' : ''?> >Credit</option>
                                                                    <option value="dr" <?=($value->dr_cr=='dr') ? 'selected' : ''?> >Debit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Amount:</label>
                                                                <input type="number" class="form-control" name="amount" value="<?=$value->amount?>" step="0.01" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Remark:</label>
                                                                <input type="text" class="form-control" name="remark" value="<?=$value->remark?>">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-danger waves-light" type="submit" value="UPDATE">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>   
                                <?php } ?>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<script type="text/javascript">
    $(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            icon:{
                required:true,
                remote:"<?=$remote?>null/icon"
            },
            url:"required",
        },
        messages: {
            icon: {
                required : "Please enter icon.",
                remote : "Icon already exists!"
            }
        }
    }); 
});

</script>
<script>
    function change_status(id)
    {
        $.ajax({
        url: "<?php echo base_url('shop-master-data/change_expanse_accounts'); ?>",
        method: "POST",
        data: {
            id:id
        },
        success:function(data){
            $("#status"+id).html(data);
        }
    });
    }
          //multiple delete
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
        var table = 'shop_social';
            if(checkbox.length > 0)
            {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });
            $.ajax({
                url:"<?php echo base_url(); ?>shop-master-data/multiple_delete",
                method:"POST",
                data:{checkbox_value:checkbox_value,table:table},
                success:function(data)
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
   function delete_account(id){
        if(confirm('Do you want to delete?') == true)
        {
            $.ajax({
                url: "<?php echo base_url('shop-master-data/delete_expanse_accounts/'); ?>",
                method: "POST",
                data: {
                    id:id
                },
                success:function(data){
                    $("#tb").html(data);
                    location.reload();
                }
            });
        }
    }
</script>