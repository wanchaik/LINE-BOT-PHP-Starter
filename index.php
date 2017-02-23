<?php

echo "Hello LINE BOT";

//file_put_contents("/tmp/1.log", "data", FILE_APPENED);
file_put_contents(__DIR__ . "/" . date('Y-m-d') . ".log", DATE_ISO8601, FILE_APPEND);
