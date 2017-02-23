<?php
$access_token = 'DBUa8Nw4ulhAg1FuFf6aPtULPidvXFg7xH5gehgkIwSUkrzelRRgkZ2h+Y66Qy1byiByGgSLTgLYL3vT6MECxHrkLHZETxL4hoPZ6PwM5k62UnfrWorMpmvmozdxzGDuDZUvWfPvOWolWSday7dtIgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';
                  
$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;