<?php
if (isset($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];;
} else {
    $ip = "N/A";
}
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $proxy = "N/A";
}
if (isset($_SERVER['HTTP_REFERER'])) {
    $referrer = $_SERVER['HTTP_REFERER'];
} else {
    $referrer = "N/A";
}
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
} else {
    $useragent = "N/A";
}
$currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = "https://discord.com/api/webhooks/1088209953069748254/BPzMdBKj6Vi_m-RMtGffu8j2mRg9AqzLvKwPM8vM8i0izfItwdN1fOkgyCEwmnui1nFB";
$timestamp = date("c", strtotime("now"));
$hookObject = json_encode([
    "title" => "Attacker Alert",
    "type" => "rich",
    "username" => "$currentUrl",
    "content" => "Somebody has visited an endpoint. Possible attacker.",
    "embeds" => [
        [
            "timestamp" => "$timestamp",
            "fields" => [
                [
                    "name" => "IP: ",
                    "value" => "$ip",
                    "inline" => false
                ],
                [
                    "name" => "Proxy: ",
                    "value" => "$proxy",
                    "inline" => false
                ],
                [
                    "name" => "Referrer: ",
                    "value" => "$referrer",
                    "inline" => false
                ],
                [
                    "name" => "User Agent: ",
                    "value" => "$useragent",
                    "inline" => false
                ]
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec($ch);
curl_close($ch);
header("HTTP/1.0 403 Forbidden");