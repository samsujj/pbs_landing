<?php

//let's say each article costs 15.00 bucks




try {

    require_once('Stripe/lib/Stripe.php');
    Stripe::setApiKey("sk_test_jttNGqAeuCpVoftWPWenb6OO");


    $plan = Stripe_Plan::all(array(
            "limit" => 25,
           )
    );


    $plan = $plan->__toJSON(true);

    print_r(($plan));

}
catch(Stripe_CardError $e) {

}