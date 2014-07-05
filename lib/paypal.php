<?php

// curl -v https://api.sandbox.paypal.com/v1/payments/payment \
// -H 'Content-Type: application/json' \
// -H 'Authorization: Bearer <Access-Token>' \
// -d '{
//   "intent":"sale",
//   "redirect_urls":{
//     "return_url":"http://example.com/your_redirect_url/",
//     "cancel_url":"http://example.com/your_cancel_url/"
//   },
//   "payer":{
//     "payment_method":"paypal"
//   },
//   "transactions":[
//     {
//       "amount":{
//         "total":"7.47",
//         "currency":"USD"
//       }
//     }
//   ]
// }'

$ch = curl_init();
$clientId = "EOJ2S-Z6OoN_le_KS1d75wsZ6y0SFdVsY9183IvxFyZp";
$secret = "EClusMEUk8e9ihI7ZdVLF5cZ6y0SFdVsY9183IvxFyZp";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$auth = curl_exec($ch);

if(empty($auth))die("Error: No response.");
else $auth = json_decode($auth);

curl_close($ch);

$data = array(
	"intent" => "sale",
	"redirect" => array(
		"return_url" => "http://www.google.com",
		"cancel_url" => "http://www.google.com"
	),
	"payer" => array("payment_method" => "paypal"),
	"transactions" => array(
		array("amount" => array(
			"total" => "5",
			"currency" => "USD"
		))
	)
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Authorization: Bearer '.$auth->access_token,
	'Accept: application/json',
	'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "intent":"sale",
  "redirect_urls":{
    "return_url":"http://lootpak.com/p/paypalredirectsuccess.php",
    "cancel_url":"http://lootpak.com/p/paypalredirectcancel.php"
  },
  "payer":{
    "payment_method":"paypal"
  },
  "transactions":[
    {
      "amount":{
        "total":"7.47",
        "currency":"USD"
      }
    }
  ]
}');
$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else {
	$json = json_decode($result);
	echo "success";
}



curl_close($ch);
?>
