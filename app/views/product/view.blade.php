<form class="form-horizontal create-edit-form" role="form"  method="post">
    <input name="id" type="hidden" value="<?php echo $product->id; ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8">
            <input type="text" name="name" readonly="true" class="form-control" placeholder="Product Name" value="<?php echo $product->name;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Cost Price</label>
        <div class="col-sm-8">
            <input type="text" name="costPrice" readonly="true" class="form-control" placeholder="Cost Name" value="<?php echo $product->cost_price;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Sale Price</label>
        <div class="col-sm-8">
            <input type="text" name="salePrice" class="form-control" readonly="true" placeholder="Sale Name" value="<?php echo $product->sale_price;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Category</label>
        <div class="col-sm-8">
            <input type="text" name="salePrice" class="form-control" readonly="true" placeholder="Sale Name" value="<?php echo $categories->name;?>">
        </div>

    </div>