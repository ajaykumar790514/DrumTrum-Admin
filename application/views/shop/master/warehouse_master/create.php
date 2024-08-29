<style>
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
<?php if($count==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: { 
            address:"required",     
            city:"required",
            pincode:"required",
            country:"required",
            phone:"required",
            state:"required",
            name:{
                required:true,
                remote:"<?=$remote?>null/name",
            }
        },
        messages: {
            address:"Please enter address",     
            city:"Please enter city",
            pincode:"Please enter pincode",
            country:"Please enter country",
            phone:"Please enter phone",
            state:"Please enter state",
            name: {
                required : "Please enter warehouse name.",
                remote : "Warehouse already exists!"
            } 
        }
    }); 
});
</script>
<?php }else{?>
  <script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: { 
            address:"required",     
            city:"required",
            pincode:"required",
            country:"required",
            phone:"required",
            state:"required",
            name:{
                required:true,
                remote:"<?=$remote?><?=@$value->id;?>/name",
            }
        },
        messages: {
            address:"Please enter address",     
            city:"Please enter city",
            pincode:"Please enter pincode",
            country:"Please enter country",
            phone:"Please enter phone",
            state:"Please enter state",
            name: {
                required : "Please enter warehouse name.",
                remote : "Warehouse already exists!"
            } 
        }
    }); 
});
</script>
<?php };?>
<form class="ajaxsubmit needs-validation reload-tb" action="<?=$action_url?>" method="post">
<div class="modal-body">
    
        
        <div class="row">
            <div class="col-6">
             <div class="form-group">
               <label class="control-label">Warehouse Name:</label>
                <input type="text" class="form-control" value="<?=@$value->name;?>" placeholder="Enter warehouse name" name="name">
             </div>
            </div>
            <div class="col-6">
             <div class="form-group">
               <label class="control-label">Address:</label>
                <input type="text" class="form-control" value="<?=@$value->address;?>" placeholder="Enter address" name="address">
             </div>
            </div>
            <div class="col-4">
             <div class="form-group">
               <label class="control-label">State:</label>
                <input type="text" class="form-control" value="<?=@$value->state;?>" placeholder="Enter state" name="state">
             </div>
            </div>
            <div class="col-4">
             <div class="form-group">
               <label class="control-label">City:</label>
                <input type="text" class="form-control" value="<?=@$value->city;?>" placeholder="Enter city" name="city">
             </div>
            </div>
            <div class="col-4">
             <div class="form-group">
               <label class="control-label">Pincode:</label>
                <input type="number" class="form-control" value="<?=@$value->pincode;?>" placeholder="Enter pincode" name="pincode">
             </div>
            </div>
            <div class="col-6">
             <div class="form-group">
               <label class="control-label">Country:</label>
                <input type="text" class="form-control" value="<?=@$value->country;?>" placeholder="Enter country" name="country">
             </div>
            </div>
            <div class="col-6">
             <div class="form-group">
               <label class="control-label">Phone:</label>
                <input type="number" class="form-control" value="<?=@$value->phone;?>" placeholder="Enter phone" name="phone">
             </div>
            </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
    <!-- <input type="submit" class="btn btn-danger waves-light" type="submit" value="ADD" /> -->
</div>

</form>
            

