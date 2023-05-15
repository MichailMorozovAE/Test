<?php

$array_of_strings = array('2-4', '3-6', '5-6', '1', '8-11');

$array_of_strings = mergeIntervals($array_of_strings);

foreach($array_of_strings as $string_in_array) {
  echo($string_in_array . PHP_EOL);
}

function mergeIntervals($input) {
    foreach ($input as $interval) {
        if (!is_string($interval)) {
            echo("All intervals must be string!");
        }
    }
    $intervals = array_map(function($interval) {
        if (strpos($interval, '-') !== false) {
            return explode('-', $interval);
        } else {
            return [$interval, $interval];
        }
    }, $input);

    usort($intervals, function($a, $b) {
        return $a[0] - $b[0];
    });

    $result = [];
    $start = $intervals[0][0];
    $end = $intervals[0][1];

    for ($i = 1; $i < count($intervals); $i++) {
        if ($end >= $intervals[$i][0]) {
            $end = max($end, $intervals[$i][1]);
        } else {
            $result[] = $start == $end ? $start : $start . '-' . $end;
            $start = $intervals[$i][0];
            $end = $intervals[$i][1];
        }
    }

    $result[] = $start == $end ? $start : $start . '-' . $end;

    return $result;
}
?>
