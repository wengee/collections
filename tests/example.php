<?php

require __DIR__ . '/../src/Collection.php';

$data = new Fung\Collections\Collection([
    'foo' => 123,
    'bar' => 234,
]);

echo "<pre>";
var_dump($data->foo);
var_dump($data['bar']);
print_r(json_encode($data));
echo "</pre>";