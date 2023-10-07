<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<article>
    <h1 class="title">Customer Order Listing</h1>
    <table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Delivery/Pickup Date</th>
            <th>Status</th>
            <th>Total Amount</th>
            <th>Payment Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    
</table>

    </article>
@include ('include/footer')
</html>

<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->