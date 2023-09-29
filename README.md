# PlexyPay library for php

### Example
```php
$plexypay = new Plexypay\Plexypay([
    'private_key' => ''
]);

$data = [
    "terminalId" => "", 
    "transactionType" => "sale", 
    "locale" => "en", 
    "orderDetails" => [
        "description" => "Demo Payment", 
        "orderReference" => "1675246018766", 
        "cartReference" => null, 
        "amount" => 126.27, 
        "currency" => "EUR", 
        "items" => []
    ], 
    "urls" => [
        "cancel" => "", 
        "success" => "", 
        "failure" => "", 
        "callback" => "" 
    ],
    "customerDetails" => [
        "accountId" => "ID123", 
        "email" => "test@mail.ru", 
        "deliveryAddress" => [
            "firstName" => "Plexypay", 
            "lastName" => "Checkout", 
            "addressLine1" => "Address Line 1", 
            "addressLine2" => "Address Line 2", 
            "postalCode" => "P1234", 
            "city" => "Berlin", 
            "phone" => "+187312345", 
            "country" => "Germany" 
        ], 
        "billingAddress" => [
            "firstName" => "Plexypay", 
            "lastName" => "SDK", 
            "addressLine1" => "Address Line 1", 
            "addressLine2" => "Address Line 2", 
            "postalCode" => "P1234", 
            "city" => "Berlin", 
            "phone" => "+187312345", 
            "country" => "Germany" 
        ]
    ]
]; 

$response = $plexypay->create_payment_session($data);
var_dump($response);
```