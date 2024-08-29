
<!-- <p id="success" class="text-success"></p> -->
<input type="hidden" value=<?php echo $headerid; ?> id="headerid">
<table class="table" style="border:1px solid black">
<thead class="thead-light">
    <tr style="border:1px solid black">
        <th class="text-center">Image</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Product Code</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $flg=0;
        foreach($available_products as $products) {
            $rs = $this->master_model->get_property_val_new($products->prod_id); ?>?>
    <tr>
        <td class="text-center"><img src="<?php echo IMGS_URL.$products->thumbnail; ?>" alt="image" height="100"></td>
        <td class="text-center"><?= $products->name;?><br><?php if(!empty($rs)){?><strong class="text-danger"> [ <?php foreach($rs as $r){echo $r->value.",";};?> ] </strong><?php }?></td>
        <td class="text-center"><?= $products->product_code;?></td>
        <?php foreach($headers_mapping as $mapping) 
        {
             if($mapping->value == $products->id)
             {
                     $flg=1;   
             }
        }
        ?>
        <td class="btn btn-primary btn-sm" id="changeaction2<?= $products->id ?>">
        <?php if($flg==1)
            {?> 
            <a href="javascript:void(0)" onclick="remove_map_product(<?= $products->id ?>);" style="color:white;"> Remove </a>
        <?php } 
            else { ?>
            <a href="javascript:void(0)" onclick="map_product(<?= $products->id ?>);" style="color:white;">Map</a>
            <?php } ?>
        </td>
       
    </tr>
    <?php $flg=0; }?>
    </tbody>
</table>