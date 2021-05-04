@php
$date = $value;

$value = date('m', strtotime($date)); //this return you 06(edited)
$monthName = date("F", mktime(0, 0, 0, $value, 10));
echo $monthName; // Output: May
@endphp
