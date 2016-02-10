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


    $customer = Stripe_Customer::retrieve(CUSTOMER_ID);
$subscription = $customer->subscriptions->retrieve(SUBSCRIPTION_ID);
$subscription->plan = PLAN_ID;
$subscription->save();

}
catch(Stripe_CardError $e) {

}