<?php

echo sprintf("Exception: %s\n", get_class($exception));
echo sprintf("Message: %s\n", $exception->getMessage());
echo sprintf("App Path: %s\n", ROOT_DIR);
echo sprintf("Environment: %s\n", env());

$count = count($exception->getTrace());

foreach ($exception->getTrace() as $index => $call) {
  echo sprintf("  %s: %s:%s %s %s\n", 
    ($count - $index), 
    array_key_exists('file', $call) ? $call['file'] : '-',
    array_key_exists('line', $call) ? $call['line'] : '-',
    array_key_exists('class', $call) ? $call['class'] : '',
    $call['function']
  );
}

echo sprintf("Request Method: %s\n", $request->method);

echo "Request Params:\n";
foreach ($request->params as $key => $value) {
  echo sprintf("  %s: %s\n", $key, $value);
}

echo "Request Headers:\n";
foreach ($request->headers as $key => $value) {
  echo sprintf("  %s: %s\n", $key, $value);
}
