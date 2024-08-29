<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($rows)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <div class="col-md-6" style="float: right; margin: 12px 0px;">
            <input type="text" class="form-control form-control-sm" name="tb-search" id="tb-search" value="<?=$search?>" placeholder="Search...">
        </div>
        <div class="col-md-8 text-right" style="float: left;">
            <?=$links?>
        </div>
    </div>
</div>

<div id="datatable">
    <div id="grid_table" class="table-responsive table-wrap">
        <table width="100%">
            <tr class="jsgrid-header-row">
                <th class="jsgrid-header-cell jsgrid-align-center">S.No.</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Shop</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Name</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Address</th>
                <th class="jsgrid-header-cell jsgrid-align-center">State</th>
                <th class="jsgrid-header-cell jsgrid-align-center">City</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Pincode</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Country</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Phone</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Default</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Status</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Actions</th>
            </tr>
            
            <?php $i=$page; foreach($rows as $value){ ?>
            <tr class="jsgrid-filter-row">
                <th class="jsgrid-cell jsgrid-align-center"><?=++$i?></th>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->shop_name;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->name;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->address;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->state;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->city;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->pincode;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->country;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo $value->phone;?></td>
                 <td class="jsgrid-cell jsgrid-align-center">
                <?php if($value->is_default==1) { ?>
                <button class="btn btn-sm btn-success" onclick="set_default_add(<?php echo $value->id;?>)">Default</button>
                <?php } else {?>
                <button class="btn btn-sm btn-danger" onclick="set_default_add(<?php echo $value->id;?>)">Set Default</button>
                <?php }?>
                </td>
                <td class="jsgrid-cell jsgrid-align-center" id="status<?php echo $value->id; ?>">
                <?php if($value->active==1) { ?>
                <button class="btn btn-sm btn-success" onclick="change_status(<?php echo $value->id;?>)">Active</button>
                <?php } else {?>
                <button class="btn btn-sm btn-danger" onclick="change_status(<?php echo $value->id;?>)">Inactive</button>
                <?php }?>
                </td>
                <td class="jsgrid-cell jsgrid-align-center">
                    

                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update WareHouse ( <?=$value->name?> )" data-url="<?=$update_url?><?=$value->id?>" >
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="javscript:void(0)" onclick="delete_vendor(<?php echo $value->id;?>)">
                        <i class="fa fa-trash"></i>
                    </a>

                </td>
            </tr> 
        
        
            <?php } ?>    
        </table>

            
    </div>
</div>
<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($rows)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <?=$links?>
    </div>
</div>
<script>
    function change_status(id)
    {
        $.ajax({
        url: "<?php echo base_url('warehouse-master/change_status'); ?>",
        method: "POST",
        data: {
            id:id
        },
        success:function(data){
            $("#status"+id).html(data);
        }
    });
    }
     function set_default_add(id)
    {
        $.ajax({
        url: "<?php echo base_url('warehouse-master/set_default_add'); ?>",
        method: "POST",
        data: {
            id:id
        },
        success:function(data){
            //$("#status"+id).html(data);
             loadtb();
        }
    });
    }
</script>
<script>
    function delete_vendor(vid){
        if(confirm('Do you want to delete?') == true)
        {
            $('#tb').load("<?php echo base_url('warehouse-master/delete/')?>"+vid );
            loadtb();
        }
    }
     
</script>