@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="card-title"><strong>@lang('products.titles.basicDetails')</strong></div>
                            </div>
                            <div class="card-body">
                                <hr>
                                <div class="row checkout-form">
                                    <div class="col-md-6">
                                        <label class="form-label" for="">@lang('users.fields.firstName.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.firstName.placeholder')">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">@lang('users.fields.lastName.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.lastName.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.email.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.email.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.phoneNumber.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.phoneNumber.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.address.label') 1</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.address.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.address.label') 2</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.address.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.city.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.city.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.estate.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.estate.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.country.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.country.placeholder')">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label" for="">@lang('users.fields.postalCode.label')</label>
                                        <input type="text" class="form-control" placeholder="@lang('users.fields.postalCode.placeholder')">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn float-end" style="background-color: rgb(226, 126, 11)">PlaceToPay</button>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Set up a container element for the button -->
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="card-title"><strong>@lang('products.titles.orderDetails')</strong></div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('products.titles.products')</th>
                                            <th scope="col">@lang('products.fields.quantity.label')</th>
                                            <th scope="col">@lang('products.fields.price.label')</th>
                                            <th scope="col">@lang('common.subtotal')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>{{ $item->qty * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">@lang('common.total')</th>
                                            <td colspan="4">{{ Cart::subtotal() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD" defer></script>

    <script defer>
        if (paypal) {
            paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                application_context: {
                    shipping_preference: "NO_SHIPPING"
                },
                payer: {
                    email_address: '{{ auth()->user()->email }}',
                    name: {
                        given_name: '{{ auth()->user()->name }}'
                    },
                    address: {
                        address_line: 'asddd',
                        postal_code: 'asd'

                    }
                },
                purchase_units: [{
                    amount: {
                    value: '77.44' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                    }
                }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                // When ready to go live, remove the alert and show a success message within this page. For example:
                // var element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');    
        }
    </script>
@endpush