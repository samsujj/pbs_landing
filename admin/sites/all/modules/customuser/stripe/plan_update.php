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


    $plan= Stripe_Plan::retrieve("p112");


    $plan->name = "New plan name";
    //$plan->price =2533;
    $planresponse = $plan->save();
    $planresponse = $plan->__toJSON(true);

    print_r(($planresponse));

}
catch(Stripe_CardError $e) {

}