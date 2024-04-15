<?php
session_start();
require "vendor/autoload.php";
use Razorpay\Api\Api;
// order generate 

$key_id = "rzp_test_nT6ymsesXsSYWp";
$key_secret = "rasOFeZDBOLkKw1qxAnuMnaF";


$api = new Api($key_id, $key_secret );

$user_id = "1234";
$order_amount = 460;

$order_details = array(
	'receipt' => '123'.rand(200,1000)."_".$user_id, 
	'amount' => $order_amount*100, 
	'currency' => 'INR', 
	'notes'=> array('key1'=> 'value3','key2'=> 'value2')
);

// echo "<br> my order </br>";
// echo "<pre>";
// print_r($order_details);
// echo "</pre>";

// print_r($api);
$new_order  = $api->order->create($order_details);


// echo "<br> razorpay order </br>";

// echo "<pre>";
// print_r($new_order );
// echo "</pre>";




// order details form the razorpay 

$order_id = $new_order['id'];
$order_receipt = $new_order['receipt'];
$order_amount = $new_order['amount'];
$order_currency = $new_order['currency'];

// Setting the order in SESSION

$_SESSION['razorpay_order_id'] = $order_id;



// mysite                            //razorpay
// prepare_order[id,price]     --->         generate_order : new_order_id
// initiate_transation[new_order_id] ---> razorpay_transaction : transaction_id
// save_in_db(transaction_id) 
?>

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "<?= $key_id ?>", // Enter the Key ID generated from the Dashboard
    "amount": "<?= $order_amount ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "<?= $order_currency ?>",
    "name": "CSLAB Computer institute", //your business name
    "description": "Just for Learning purpose",
    "image": "https://mliekvpsfk1b.i.optimole.com/w:1920/h:640/q:mauto/ig:avif/https://cslab.in/wp-content/uploads/2024/01/CSLAB-Logo-2023.svg",
    "order_id": "<?= $order_id ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "status.php",
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
        "name": "Vishnu Rajoria", //your customer's name
        "email": "vishnu@cslab.in",
        "contact": "1234567890" //Provide the customer's phone number for better conversion rates 
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#36f"
    }
};



var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>









