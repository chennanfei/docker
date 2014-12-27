<?php

$paramList = array_merge($_POST, $_GET);
$user = array_key_exists('uid', $paramList) ? $paramList['uid'] : null;
if (!isset($user)) {
    print_r('Should pass arg uid');
    return;
}

$token = '731b602dc5a58bed1d659811003bef9d6bfe2d7f';

$header = array(
    'Accept: application/vnd.github.v3+json',
    "Authorization: token $token"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

//header
curl_setopt($ch, CURLOPT_HTTPHEADER , $header);
curl_setopt($ch, CURLOPT_HEADER, 0);

// user agent
curl_setopt($ch, CURLOPT_USERAGENT, 'ucdream');

// request type
curl_setopt($ch, CURLOPT_HTTPGET, true);

curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/$user/repos?type=owner");
$result = curl_exec($ch);
curl_close($ch);

print_r("repos for user $user<br>");
print_r($result);

?>