<?php
/**
 * Created by PhpStorm.
 * User: debasis_kar
 * Date: 11/12/2015
 * Time: 1:03 PM
 */

try {

    require_once('Stripe/lib/Stripe.php');
    Stripe::setApiKey("sk_test_jttNGqAeuCpVoftWPWenb6OO");


    $plan= Stripe_Plan::create(array(
            "amount" => 2470,
            "interval" => "day",
            "name" => "Plan ABC",
            "currency" => "usd",
            "id" => "p112")
    );


    $plan = $plan->__toJSON(true);

    print_r(($plan));

}
catch(Stripe_CardError $e) {

}