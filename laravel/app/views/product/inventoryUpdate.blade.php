<form class="form-horizontal create-edit-form" role="form" action="<?php echo OSMS::$baseUrl;?>product/updateInventory" method="post">
    <input name="id" type="hidden" value="<?php echo $product->id; ?>">
    <div class="form-group">
        <label class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-10">
            <input type="text" name="quantity" class="form-control" placeholder="Quantity">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Comment</label>
        <div class="col-sm-10">
            <textarea type="text" name="comment" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </div>
</form>