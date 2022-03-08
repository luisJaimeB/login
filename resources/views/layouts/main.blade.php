<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Entregable Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/6261fac1b2.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link href="{{ asset('/css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    </head>
    <body class="{{ $class ?? '' }}">
      <div id="app">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        @if (auth()->check())
        <div class="fixed-plugin">
          <div class="dropdown show-dropdown">
            <a href="{{ route('cart.index') }}">
              <i class="fas fa-2x fa-cart-arrow-down" style="color: rgb(135, 67, 245)"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header-title"> Sidebar Filters</li>
              <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                  <div class="badge-colors ml-auto mr-auto">
                    <span class="badge filter badge-purple " data-color="purple"></span>
                    <span class="badge filter badge-azure" data-color="azure"></span>
                    <span class="badge filter badge-green" data-color="green"></span>
                    <span class="badge filter badge-warning active" data-color="orange"></span>
                    <span class="badge filter badge-danger" data-color="danger"></span>
                    <span class="badge filter badge-rose" data-color="rose"></span>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="header-title">Images</li>
              <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('/img/sidebar-1.jpg') }}" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('/img/sidebar-2.jpg') }}" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('/img/sidebar-3.jpg') }}" alt="">
                </a>
              </li>
              <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                  <img src="{{ asset('/img/sidebar-4.jpg') }}" alt="">
                </a>
              </li>
              <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-laravel" target="_blank" class="btn btn-primary btn-block">Free Download</a>
              </li>
              <!-- <li class="header-title">Want more components?</li>
                  <li class="button-container">
                      <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                        Get the pro version
                      </a>
                  </li> -->
              <li class="button-container">
                <a href="https://material-dashboard-laravel.creative-tim.com/docs/getting-started/laravel-setup.html" target="_blank" class="btn btn-default btn-block">
                  View Documentation
                </a>
              </li>
              <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro-laravel" target="_blank" class="btn btn-danger btn-block btn-round">
                  Upgrade to PRO
                </a>
              </li>
              <li class="button-container github-star">
                <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
              </li>
              <li class="header-title">Thank you for 95 shares!</li>
              <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                <br>
                <br>
              </li>
            </ul>
          </div>
        </div>
        @endif
      </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <!--   Core JS Files   -->
        <script src="{{ asset('/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('/js/core/bootstrap-material-design.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        @stack('js')
        <script src="https://www.paypal.com/sdk/js?client-id=AYsJYvXbOx_0f-Y8LHigM1jxIQ7CMOOe-DiqYi8djeXGAIpfjJ2wkZcIaJt9vSh4NFST221r0-XAXvvj&currency=USD"></script>

        <script>
            paypal.Buttons({

              // Sets up the transaction when a payment button is clicked
              createOrder: function(data, actions) {
                return actions.order.create({
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

          </script>
    </body>
</html>