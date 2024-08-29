<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($rows)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <div class="col-md-4" style="float: left; margin: 12px 0px;">
            <input type="text" class="form-control" name="tb-search" id="tb-search" value="<?=$search?>" placeholder="Search...">
        </div>
        <div class="col-md-8 text-right" style="float: left;">
            <?=$links?>
        </div>
    </div>
</div>
<div id="datatable">
    <div id="grid_table">
        <table class="jsgrid-table">
            <tr class="jsgrid-header-row">
                <th class="jsgrid-header-cell jsgrid-align-center">S.No.</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Photo</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Product Name</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Code</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Keywords</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Action</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Barcode</th>
            </tr>
            
            <?php
             $i=$page;
            foreach($rows as $value)
            {
              ?>
              <tr class="jsgrid-filter-row">
              <th class="jsgrid-cell  jsgrid-align-center"><?=++$i?></th>
              <td class="jsgrid-cell  jsgrid-align-center"><img src="<?=IMGS_URL.$value->thumbnail;?>" alt=""></td>
              <td class="jsgrid-cell  jsgrid-align-center"><?php echo $value->name;?></td>
              <td class="jsgrid-cell  jsgrid-align-center"><?=$value->product_code;?></td>
              <td class="jsgrid-cell  jsgrid-align-center"><?=$value->search_keywords;?></td>
              <td class="jsgrid-cell  jsgrid-align-center">
              <a onclick="GenerateBarcode('<?= $value->product_code; ?>', '<?= $value->id; ?>')">
                <i class="mdi mdi-note-multiple text-primary" style="font-size:1.5rem;cursor:pointer" title="Barcode Generate"></i>
            </a>

              </td>
              <td class="jsgrid-cell  jsgrid-align-center">
                <span id="barcodeImage_<?=$value->product_code;?>"></span>
             <?php if(!empty($value->barcode)){?>
                <button class="text-center btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="View Slip" data-url="<?php echo base_url('product-barcode/view/'.$value->id);?>" >View Slip</button>
                  <?php };?></td>
              </tr>
            <?php }?>
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
//    $(document).ready(function () {
    function GenerateBarcode(pcode,id) {
    swal({
        title: "Enter Barcode Value",
        text: "Please enter the barcode value:",
        content: "input",
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
    .then((value) => {
        if (value) {
            // User entered a value, proceed with barcode generation
            $.ajax({
                url: '<?php echo base_url('product-barcode/GenerateCode');?>',
                type: 'POST',
                data: { code: value ,pcode:pcode},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var url = '<?php echo base_url('product-barcode/view/');?>'+id;
                        $('#barcodeImage_' + pcode).html('<button class="btn btn-primary text-center" data-toggle="modal" data-target="#showModal" data-whatever="View Slip" data-url="'+url+'" >View Slip</button>');

                    } else {
                        swal('Failed to generate the barcode: ' + response.message, {
                            icon: "info",
                        });
                    }
                    swal.close();
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





    function delete_map(id) {
        if(confirm('Do you want to delete?') == true)
        {
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>return-policy-master/map_remove',
            data: {id:id},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.res === 'success') {
                    $('#showModal').modal('hide');
                    loadtb();
                }
                alert(response.msg);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
  }
}
//    });
</script>