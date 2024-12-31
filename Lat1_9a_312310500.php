<?php
function fibonacci(int $input_number) {
    if ($input_number === 0) {
        return 0;
    } elseif ($input_number === 1) {
        return 1;
    } else {
        return fibonacci($input_number - 1) + fibonacci($input_number - 2);
    }
}

function printFibonacci(int $fiboNumber) {
    for ($i = 0; $i <= $fiboNumber; $i++) {
        echo fibonacci($i) . " ";
    }
}


printFibonacci(5); 


?>
