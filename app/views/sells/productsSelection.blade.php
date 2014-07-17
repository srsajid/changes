<table class="srui-table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
    </tr>
    <?php $products->each(function($product){?>
        <tr product-name="{{$product->name}}" product-id="{{$product->id}}" product-stock="{{$product->available_stock}}" product-quantity="1" product-price="{{$product->sale_price}}">
            <td class="name">{{$product->name}}</td>
            <td>{{$product->sale_price}}</td>
            <td>{{$product->available_stock}}</td>
        </tr>
    <?php });?>
</table>
<div class="footer">
    <?php echo CommonService::paginator($max, $offset, $total); ?>
</div>