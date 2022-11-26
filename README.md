# SimpleBytes

## About

![plot](./info.jpg)

**SimpleBytes** library allow to easier working with bytes in PHP!

I created because _working with bytes_ in PHP suck.
PHP does _not_ have byte data type, byteval and other methods/classes for bytes.
PHP have only random_bytes(), and difficult pack() and unpack() functions.

## Simple Start

### Import library to your project

So, with this library working with bytes is really easy!
Just import `simplebytes.php` to your project, and add it using

> require_once 'simplebytes.php'

### Main methods

#### byteval()

byteval() function supports only integers, integer arrays and string.

If you pass integer/array of integers as an argument, it will be truncated to integer(s) with value(s) from 0 to 255
Also, if you pass string, it will be converted to array of integers and also truncated to values from 0 to 255

Example:

```php

require_once '../simplebytes.php';

$bytes_one = byteval(random_bytes(50));
$bytes_two = byteval(random_bytes(50));

$bytes = array();
for($i = 0; $i < 50; $i++) {
    $sum = byteval($bytes_one[$i] ^ $bytes_two[$i]);

    array_push($bytes, $sum);
}

var_dump($bytes);

/*

Output:

array(50) { [0]=> int(253) [1]=> int(228) [2]=> int(48) [3]=> int(238) [4]=> int(144) [5]=> int(243) [6]=> int(250) [7]=> int(12) [8]=> int(115) [9]=> int(147) [10]=> int(221) [11]=> int(223) [12]=> int(236) [13]=> int(212) [14]=> int(124) [15]=> int(10) [16]=> int(199) [17]=> int(88) [18]=> int(73) [19]=> int(42) [20]=> int(245) [21]=> int(95) [22]=> int(191) [23]=> int(223) [24]=> int(196) [25]=> int(40) [26]=> int(101) [27]=> int(61) [28]=> int(83) [29]=> int(40) [30]=> int(164) [31]=> int(253) [32]=> int(115) [33]=> int(224) [34]=> int(52) [35]=> int(118) [36]=> int(56) [37]=> int(155) [38]=> int(118) [39]=> int(96) [40]=> int(75) [41]=> int(27) [42]=> int(253) [43]=> int(88) [44]=> int(94) [45]=> int(76) [46]=> int(11) [47]=> int(162) [48]=> int(182) [49]=> int(60) }

*/

```

#### getbytes()

getbytes() function used to convert values to bytes.

Supported value types:
Integer and String

|:warning: Float and Double values currectly not supported. Is there someone who can realize it? ##issue|

Example:

```php

require_once '../simplebytes.php';

$int_val = 56;
$double_val = 139.3;
$str_val = "Hello World!";

$int_bytes = getbytes($int_val);
$double_bytes = getbytes($double_val);
$str_bytes = getbytes($str_val);

echo "Int: " . $int_val . " Bytes: ";
var_dump($int_bytes);
echo "<br/>";

echo "Double: " . $double_val . " Bytes: ";
var_dump($double_bytes);
echo "<br/>";

echo "String: " . $str_val . " Bytes: ";
var_dump($str_bytes);
echo "<br/>";

/*

Output:

Int: 56 Bytes: array(4) { [1]=> int(56) [2]=> int(0) [3]=> int(0) [4]=> int(0) }
Double: 139.3 Bytes: array(4) { [1]=> int(-51) [2]=> int(76) [3]=> int(11) [4]=> int(67) }
String: Hello World! Bytes: array(12) { [1]=> int(72) [2]=> int(101) [3]=> int(108) [4]=> int(108) [5]=> int(111) [6]=> int(32) [7]=> int(87) [8]=> int(111) [9]=> int(114) [10]=> int(108) [11]=> int(100) [12]=> int(33) }

*/
```

#### intbytes()

intbytes() used to convert bytes (integers) array to integer (something like reversed getbytes() function)

Example:

```php

require_once("../simplebytes.php");

$int_before = 56;
$int_bytes = getbytes($int_before);
$int_after = intbytes($int_bytes);

echo "Before: " . $int_before . "<br/>" . "After: " . $int_after;

/*

Output:

Before: 56
After: 56

*/

```

#### strbytes()

strbytes() used to convert bytes (integers) array to string (something like reversed getbytes() function)

Example:

```php

require_once("../simplebytes.php");

$str_before = "Hello World!";
$str_bytes = getbytes($str_before);
$str_after = strbytes($str_bytes);

echo "Before: " . $str_before . "<br/>" . "After: " . $str_after;

/*

Output:

Before: Hello World!
After: Hello World!

*/

```

#### repairindexes() && fixarray()

This functions are same.
Used to repair array indexes starts from 1

Example:

```php

require_once '../simplebytes.php';

$str = "The quick brown fox jumps over the lazy dog";
$str_bytes = byteval($str); // Indexes starts with 1
$str_bytes_fixed = repairindexes($str_bytes); // Now indexes starts with 0

echo "<h1>First index test</h1>" . "<br/>";
echo "Test ##1 (Before): "; var_dump($str_bytes); echo "<br/><br/>";
echo "Test ##2 (After): "; var_dump($str_bytes_fixed); echo "<br/>";

/*

Output:

**First index test**

Test ##1 (Before): array(43) { [1]=> int(84) [2]=> int(104) [3]=> int(101) [4]=> int(32) [5]=> int(113) [6]=> int(117) [7]=> int(105) [8]=> int(99) [9]=> int(107) [10]=> int(32) [11]=> int(98) [12]=> int(114) [13]=> int(111) [14]=> int(119) [15]=> int(110) [16]=> int(32) [17]=> int(102) [18]=> int(111) [19]=> int(120) [20]=> int(32) [21]=> int(106) [22]=> int(117) [23]=> int(109) [24]=> int(112) [25]=> int(115) [26]=> int(32) [27]=> int(111) [28]=> int(118) [29]=> int(101) [30]=> int(114) [31]=> int(32) [32]=> int(116) [33]=> int(104) [34]=> int(101) [35]=> int(32) [36]=> int(108) [37]=> int(97) [38]=> int(122) [39]=> int(121) [40]=> int(32) [41]=> int(100) [42]=> int(111) [43]=> int(103) }

Test ##2 (After): array(43) { [0]=> int(84) [1]=> int(104) [2]=> int(101) [3]=> int(32) [4]=> int(113) [5]=> int(117) [6]=> int(105) [7]=> int(99) [8]=> int(107) [9]=> int(32) [10]=> int(98) [11]=> int(114) [12]=> int(111) [13]=> int(119) [14]=> int(110) [15]=> int(32) [16]=> int(102) [17]=> int(111) [18]=> int(120) [19]=> int(32) [20]=> int(106) [21]=> int(117) [22]=> int(109) [23]=> int(112) [24]=> int(115) [25]=> int(32) [26]=> int(111) [27]=> int(118) [28]=> int(101) [29]=> int(114) [30]=> int(32) [31]=> int(116) [32]=> int(104) [33]=> int(101) [34]=> int(32) [35]=> int(108) [36]=> int(97) [37]=> int(122) [38]=> int(121) [39]=> int(32) [40]=> int(100) [41]=> int(111) [42]=> int(103) }

*/
```

Good luck.
