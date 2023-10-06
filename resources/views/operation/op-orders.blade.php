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
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->orderID}}</td>
                    <td>{{$order->getTotalPrice()}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</article>
@include ('include/footer')
</body>

</html>