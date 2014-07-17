<table class="srui-table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
    </tr>
    <?php $pack->items->each(function($item){?>
        <tr product-name="{{$item->product->name}}" product-id="{{$item->product->id}}" product-stock="{{$item->product->available_stock}}" product-quantity="{{$item->quantity}}" product-price="{{$item->product->sale_price}}">
            <td class="name">{{$item->product->name}}</td>
            <td>{{$item->product->sale_price}}</td>
            <td>{{$item->product->available_stock}}</td>
        </tr>
    <?php });?>
</table>
