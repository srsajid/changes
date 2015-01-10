<div class="content">
    <table>
        <colgroup>
            <col style="width: 30%"/>
            <col style="width: 80%"/>
        </colgroup>
        <tr>
            <th></th>
            <th>Name</th>
        </tr>
        <?php $products->each(function($product){?>
            <tr>
                <td class="action">
                    <input type="checkbox" value="{{$product->id}}" class="selector">
                </td>
                <td class="name">{{$product->name}}</td>
            </tr>
        <?php });?>
    </table>
    <div class="footer">
        <?php echo CommonService::paginator($max, $offset, $total); ?>
    </div>
</div>