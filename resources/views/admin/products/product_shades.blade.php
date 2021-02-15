<table class="table table-bordered">
<tr>
    <th>S.No</th>
    <th>Shade Name</th>
    <th>Shade #</th>
    <th>Shade Code</th>
    <th>Price</th>
    <th>Packaging</th>
    <th>Packaging Type</th>
</tr>
@if(safeCount($product->items) > 0)
    @foreach ($product->items as $item)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$item->item_name}}</td>
            <td>{{$item->item_no}}</td>
            <td>{{$item->item_code}}</td>
            <td>{{get_price($item->sale_price)}}</td>
            <td>{{$item->packaging}} liters</td>
            <td>{{ucwords($item->packaging_type)}}</td>
        </tr>
    @endforeach
@endif
</table>