<form class="form-horizontal create-edit-form" role="form" action="<?php echo OSMS::$baseUrl;?>product/save" method="post">
    <input name="id" type="hidden" value="<?php echo $product->id; ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo $product->name;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Cost Price</label>
        <div class="col-sm-8">
            <input type="text" name="costPrice" class="form-control" placeholder="Cost Name" value="<?php echo $product->cost_price;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Sale Price</label>
        <div class="col-sm-8">
            <input type="text" name="salePrice" class="form-control" placeholder="Sale Name" value="<?php echo $product->sale_price;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Category</label>
        <div class="col-sm-8">
            <select class="form-control" name="category">
                <?php foreach($categories as $cat) { ?>
                    <option <?php if($cat->id == $product->category_id) echo "selected" ?> value="{{ $cat->id }}"> {{ $cat->name }}</option>
                <?php } ?>
            </select>
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>