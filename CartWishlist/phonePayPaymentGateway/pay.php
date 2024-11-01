<?php
require_once "./utils/config.php";
require_once "./utils/common.php";

// session_start();

// Check if the required fields are set
if (isset($_POST['totalPrice']) && isset($_POST['totalQuantity'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $totalPrice = $_POST['totalPrice']; // total price from cart
    $totalQuantity = $_POST['totalQuantity']; // total quantity from cart

    // Store customer and order data in session
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['totalPrice'] = $totalPrice;
    $_SESSION['totalQuantity'] = $totalQuantity;

    // Payment details
    $merchantid = MERCHANTIDUAT;
    $saltkey = SALTKEYUAT;
    $saltindex = SALTINDEX;

    // Prepare the payload for the payment gateway
    $payLoad = array(
        'merchantId' => $merchantid,
        'merchantTransactionId' => "MT-" . getTransactionID(), // Unique transaction ID
        "merchantUserId" => "M-" . uniqid(),
        'amount' => $totalPrice * 100, // Convert total price to paise (since PhonePe works on paise)
        'redirectUrl' => BASE_URL . REDIRECTURL,
        'redirectMode' => "POST",
        'callbackUrl' => BASE_URL . REDIRECTURL,
        "mobileNumber" => $mobile,
        "paymentInstrument" => array(
            "type" => "PAY_PAGE",
        )
    );

    // Encode payload in JSON format
    $jsonencode = json_encode($payLoad);

    // Base64 encode the payload
    $payloadbase64 = base64_encode($jsonencode);

    // Prepare data for the checksum
    $payloaddata = $payloadbase64 . "/pg/v1/pay" . $saltkey;

    // Generate checksum using SHA-256
    $sha256 = hash("sha256", $payloaddata);

    // Combine checksum with the salt index
    $checksum = $sha256 . '###' . $saltindex;

    // Prepare request payload
    $request = json_encode(array('request' => $payloadbase64));

    // Determine the payment API URL based on the environment (LIVE or UAT)
    $url = (API_STATUS == "LIVE") ? LIVEURLPAY : UATURLPAY;

    // Initialize cURL to send the payment request
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $checksum,
            "accept: application/json"
        ],
    ]);

    // Execute the request and handle the response
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res = json_decode($response);
        if (isset($res->success) && $res->success == '1') {
            // If the response is successful, redirect to the payment URL
            $payUrl = $res->data->instrumentResponse->redirectInfo->url;
            header('Location:' . $payUrl);
        } else {
            // Handle failure case
            echo "Payment initiation failed. Please try again.";
        }
    }
} else {
    echo "Missing required form data.";
}
?>
