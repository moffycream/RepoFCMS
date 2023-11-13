@extends('layouts.app')
@section('title', 'Membership')
@section('content')

<div class="membership-container">

    <h1>Membership</h1>

    <div class="tier-container">
        
        <section id="tier0">
            <h2>Tier 0 Membership</h2>
            <p>Tier 0 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Default Membership</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> No Discount</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> No Spending Minimum Required</li>

            </ul>        
        </section>

        <section id="tier1">
            <h2>Tier 1 Membership</h2>
            <p>Tier 1 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Discount: RM 25</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Capped to 5 Discount Every Month</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Minimum Total Spent: RM 300</li>
            </ul>        
        </section>
        
        <section id="tier2">
            <h2>Tier 2 Membership</h2>
            <p>Tier 2 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Discount: RM 30</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Capped to 5 Discount Every Month</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Minimum Total Spent: RM 600</li>
            </ul>  
        </section>

        <section id="tier3">
            <h2>Tier 3 Membership</h2>
            <p>Tier 3 Benefits: </p>
            <ul class="benefit-list">
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Discount: RM 40</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Capped to 5 Discount Every Month</li>
                <li class="benefit-item"><span style="color: #90EE90;">&#10004</span> Minimum Total Spent: RM 1000</li>
            </ul>  
        </section>
    </div>

    <aside id='membership-aside'>
        {{--Display Total Spending--}}
        @if(isset($totalAmountPaid))
            <p><strong>Your Total Spent:</strong> RM{{ $totalAmountPaid }}</p>
            <p><strong>Current Tier Level:</strong> {{ $tier }}</p>
            <p><strong>Discount Amount:</strong> {{ $discountAmount }}</p>
        @endif
    </aside>

</div>

@endsection
