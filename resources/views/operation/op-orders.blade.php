<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

<body>
@include ('include/header')
<article>
    <h1>Testing retrieve data</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>DateTime</th>
                <th>Menu Name</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{$order->orderID}}</td>
                    <td>{{$order->getformattedDateTime()}}</td>
                    @foreach($order->menus as $menu)
                        <td>{{$menu->name}}</td>
                    @endforeach
                    <td>{{$order->getTotalPrice()}}</td>
                </tr>
                @empty
            @endforelse
        </tbody>
    </table>
</article>
@include ('include/footer')
</body>

</html>