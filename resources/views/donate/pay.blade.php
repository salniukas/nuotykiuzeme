<!DOCTYPE html>
<html>
<head>
  <title>Trys Kubai</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet/less" type="text/css" href="//tryskubai.lt/src/less/app.less" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>
<body>
  <header class="top">
    <div class="inner">
      <div class="navigation">
        <div class="right">
          <a href="#" class="button blue small discord">Discord</a>
        </div>
        <div class="logo">
          <a href="./"><img src="//tryskubai.lt/img/logo-black.svg"></a>
        </div>
        <nav>
          <ul>
            <li><a href="./#projects">Projektai</a></li>
            <li><a href="./#creators">Kūrėjai</a></li>
            <li><a href="./#news">Naujienos</a></li>
            <li><a href="./#partners">Partneriai</a></li>
            <li><a href="about-us">Apie mus</a></li>
            <li><a class="active" href="visata">Visata</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
<div class="wrapper nav">
    <section name="visata" class="container gray">
      <div class="inner">
      <div class="block">
          <div class="left">
            Pasirinkite Apmokejimo Būdą
            <div id="paypal-button"></div>
             <a href="https://tryskubai.lt/projektai/paslaugos/apmoketi/{{ $order->id }}"><div><img src="https://bank.paysera.com/assets/image/payment_types/wallet.png"></div></a>
          </div>
        </div>
            <h3>Paslauga: {{ $service->displayName }}</h3>
            <h3>Kaina: {{ $order->amount/100 }}€</h3>
            <h4>{{$service->aprasymas}}</h4>
      </div>
        <div class="clearfix"></div>
    <script type="text/javascript" charset="utf-8">
            var wtpQualitySign_projectId  = 91781;
            var wtpQualitySign_language   = "lt";
    </script><script src="https://bank.paysera.com/new/js/project/wtpQualitySigns.js" type="text/javascript" charset="utf-8"></script>

    <script>
    paypal.Button.render({
      env: 'production', // Or 'sandbox',production

      commit: true, // Show a 'Pay Now' button

      style: {
        tagline: 'false',
        color: 'gold',
        size: 'medium'
      },
      client: {
                production:    'AU5eFfEbIbtuGAn3sb2Ne1IQLq_-vO8UjL6MkPSr5CDFMcMA9bW8DuL1_hkfkwr05iod7iFvDZ21hxBn'
                //sandbox: 'AeoEhixQ2aJ7NN7u9K-dfOwAKguZu4yiE8GQWBt9hIG4a82-i16sfcFbU57XYefqUyeTMsi_0_-5O6bA'
      },

      payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '{{ $order->amount/100 }}', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

      onAuthorize: function(data, actions) {
        /* 
         * Execute the payment here 
         */
         $(document).ready(function(){
            var CSRF_TOKEN = '{{ csrf_token() }} ';
            var ORDER_ID = '{{ $order->id }}';
            $.ajax({
              /* the route pointing to the post function */
              url: 'https://tryskubai.lt/paypal/complete',
              type: 'POST',
              /* send the csrf-token and the input to the controller */
              data: {_token: CSRF_TOKEN, message: ORDER_ID},
              dataType: 'JSON',
              /* remind that 'data' is the response of the AjaxController */
              success: function () { 
                $(location).attr('href', 'https://tryskubai.lt/uzsakymas-pavyko') 
              }
            }); 
       });    
      },

      onCancel: function(data, actions) {
        /* 
         * Buyer cancelled the payment 
         */
         $(location).attr('href', 'https://tryskubai.lt/uzsakymas-nepavyko')
      },

      onError: function(err) {
        /* 
         * An error occurred during the transaction 
         */

        $(location).attr('href', 'https://tryskubai.lt/uzsakymas-nepavyko')
      }
    }, '#paypal-button');
  </script>
    <footer class="container">
      <div class="inner">
        <div class="right">©2018, ThreeCubes. Visos teisės saugomos.</div>
        <a href="./"><img src="//tryskubai.lt/img/logobw.svg"></a>
      </div>
    </footer>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="//tryskubai.lt/assets/js/less.min.js" ></script>
  <script src="//tryskubai.lt/assets/js/script.js"></script>
</body>
</html>