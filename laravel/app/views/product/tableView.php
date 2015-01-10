<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Products</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-product" title="Create Product">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-pack-product" title="Create Product">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 18%">
            <col style="width: 15%">
            <col style="width: 6%">
            <col style="width: 18%">
            <col style="width: 18%">
            <col style="width: 15%">
        </colgroup>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Sale Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $products->each(function($product){ ?>
            <tr class="active">
                <td><?php echo $product->id; ?></td>
                <td><?php echo $product->name; ?></td>
                <td><?php echo $product->sale_price; ?></td>
                <td><?php echo $product->available_stock; ?></td>
                <td><?php echo $product->category->name; ?></td>
                <td><?php echo $product->created_at; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $product->id; ?>" action="edit" title="Edit Product">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $product->id; ?>" action="view" title="View Product">
                        <span class="glyphicon glyphicon-resize-full"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $product->id; ?>" action="inventory-update" title="Update Inventory">
                        <span class="glyphicon glyphicon-upload"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $product->id; ?>" action="inventory-history" title="Inventory History">
                        <span class="glyphicon glyphicon-time"></span>
                    </button>
                </td>
            </tr>
        <?php }); ?>
        </tbody>
    </table>
</div>
<div class="footer">
    <?php
        echo CommonService::paginator($max, $offset, $total);
        echo CommonService::itemPerPage($max);
    ?>
</div>
