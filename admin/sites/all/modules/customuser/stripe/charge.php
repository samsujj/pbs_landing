<?php 

//let's say each article costs 15.00 bucks




try {

  require_once('Stripe/lib/Stripe.php');
  Stripe::setApiKey("sk_test_jttNGqAeuCpVoftWPWenb6OO");





  /*$token = Stripe_Token ::create(array(
      'card' => [
          'number'    => '4242424242424242',
          'exp_month' => 6,
          'exp_year'  => 2017,
          'cvc'       => 123,
      ],
  ));
*/

    $token = Stripe_Token ::create(array(
        'card' => array(
            'number'    => '4242424242424242',
            'exp_month' => 6,
            'exp_year'  => 2017,
            'cvc'       => 123,
        ),
    ));

    //$token = $_POST['stripeToken'];

   /* $customer = Stripe_Customer::create(array(
            "source" => $token,
            "plan" => "gold",
            "email" => "payinguser@example.com")
    );*/
  //send the file, this line will be reached if no error was thrown above
 // echo "<h1>Your payment has been completed. We will send you the Facebook Login code in a minute.</h1>";


  //you can send the file to this email:
  //echo $_POST['stripeEmail'];
  //print_r((array)$token);
    $token= (array) $token;

   /* echo "<br>";
    print_r( $token['*_values']);
    echo "<br>";*/

    $i=0;
    foreach($token as $token=>$val){
        $i++;

       // echo "<br>";
        if($i==2) $tokenval=($val['id']);
       // echo "<br>";
        //print_r($token);
    }


    $customer = Stripe_Customer::create(array(
            "source" => $tokenval,
            "plan" => "p2",
            "email" => "payinguser@example.com")
    );


}
catch(Stripe_CardError $e) {

}
//exit;




try {

	require_once('Stripe/lib/Stripe.php');
	Stripe::setApiKey("sk_test_jttNGqAeuCpVoftWPWenb6OO");

	$charge = Stripe_Charge::create(array(
  "amount" => 21589,
  "currency" => "usd",
  "card" => $tokenval,
  "description" => "Charge for Facebook Login code."
));
	//send the file, this line will be reached if no error was thrown above
	echo "<h1>Your payment has been completed. We will send you the Facebook Login code in a minute.</h1>";


  //you can send the file to this email:
  //echo $_POST['stripeEmail'];
  //print_r($_POST);
}

catch(Stripe_CardError $e) {
	
}

//catch the errors in any way you like

 catch (Stripe_InvalidRequestError $e) {
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) {
  // Network communication with Stripe failed
} catch (Stripe_Error $e) {

  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {

  // Something else happened, completely unrelated to Stripe
}
?>