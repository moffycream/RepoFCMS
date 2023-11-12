@extends('layouts.app')
@section('title', 'Membership')
@section('content')

<div class="membership-container">
    <h1>Membership</h1>

    <div class="tier-container">
        <section id="tier1">
            <h2>Tier 1 Membership</h2>
            <p>Tier 1 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item">&#10004; Discount: RM 25</li>
                <li class="benefit-item">&#10004; Minimum Total Spent: RM 500</li>
            </ul>        
        </section>
        
        <section id="tier2">
            <h2>Tier 2 Membership</h2>
            <p>Tier 2 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item">&#10004; Discount: RM 30</li>
                <li class="benefit-item">&#10004; Minimum Total Spent: RM 1000</li>
            </ul>  
        </section>

        <section id="tier3">
            <h2>Tier 3 Membership</h2>
            <p>Tier 3 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item">&#10004; Discount: RM 40</li>
                <li class="benefit-item">&#10004; Minimum Total Spent: RM 2000</li>
            </ul>  
        </section>
    </div>
    
    <aside>

        {{--Display Total Spending--}}
        @if(isset($totalAmountPaid))
            <h2>Your Total Spent: RM{{ $totalAmountPaid }}</h2>
            <h2>Current Tier Level: {{ $tier }}</h2>
            <p>Discount Amount: {{ $discountAmount }}</p>
        @endif

    </aside>
</div>

@endsection
