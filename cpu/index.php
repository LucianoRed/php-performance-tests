<?php

function isPrime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i === 0) return false;
    }
    return true;
}

$limit = 100000;
$primes = [];

for ($i = 0; $i < $limit; $i++) {
    if (isPrime($i)) {
        $primes[] = $i;
    }
}

echo "Calculated " . count($primes) . " prime numbers.\n";
?>
