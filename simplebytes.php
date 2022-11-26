<?php

/***********************************************************************************\
 *  _____________________________________________________________________________  *
 * /                                                                             \ *
 * | ▒█▀▀▀█ ░▀░ █▀▄▀█ █▀▀█ █░░ █▀▀ ▒█▀▀█ █░░█ ▀▀█▀▀ █▀▀ █▀▀ ░░ ▒█▀▀█ ▒█░▒█ ▒█▀▀█ | *
 * | ░▀▀▀▄▄ ▀█▀ █░▀░█ █░░█ █░░ █▀▀ ▒█▀▀▄ █▄▄█ ░░█░░ █▀▀ ▀▀█ ▀▀ ▒█▄▄█ ▒█▀▀█ ▒█▄▄█ | *
 * | ▒█▄▄▄█ ▀▀▀ ▀░░░▀ █▀▀▀ ▀▀▀ ▀▀▀ ▒█▄▄█ ▄▄▄█ ░░▀░░ ▀▀▀ ▀▀▀ ░░ ▒█░░░ ▒█░▒█ ▒█░░░ | *
 * \-----------------------------------------------------------------------------/ *
 * /              🇵​​​​​🇷​​​​​🇴​​​​​🇹​​​​​🇪​​​​​🇨​​​​​🇹​​​​​🇪​​​​​🇩​​​​​ 🇧​​​​​🇾​​​​​ 🇲​​​​​🇮​​​​​🇹​​​​​ 🇱​​​​​🇮​​​​​🇨​​​​​🇪​​​​​🇳​​​​​🇸​​​​​🇪                \ *
 * \                                                                             / *
 * /                                   ᴸᵒᵒᵏ ᵃᵗ                                   \ *
 * \                           𝒽𝓉𝓉𝓅𝓈://𝒹𝒾𝓋ℯ𝓁ℴ𝓅ℯ𝓇.ℊ𝒶/                           / *
 * /                                                                             \ *
 * \                                                                             / *
 * /                         𝘼𝙡𝙨𝙤 𝙛𝙤𝙡𝙡𝙤𝙬 𝙢𝙚 𝙤𝙣 𝙜𝙞𝙩𝙝𝙪𝙗❗                         \ *
 * \                          𝗴𝗶𝘁𝗵𝘂𝗯.𝗰𝗼𝗺/𝗱𝗶𝘃𝗲𝗹𝗼𝗽𝗲𝗿𝟱𝟯                            / *
 *  \___________________________________________________________________________/  *
\***********************************************************************************/

// * For better understanding comments and script, download "Better Comments" extension:
// ? VSCode marketplace: https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments
// ? GitHub: https://github.com/aaron-bond/better-comments

// ? Truncates an integer(s array) to a single byte
function byteval($value)
{
    switch (gettype($value)) {

            // ? Truncate int to byte (int from 0 to 255)
        case "integer":
            while ($value > 255 || $value < 0) {
                if ($value > 255) {
                    $value -= 256;
                } else if ($value < 0) {
                    $value += 256;
                }
            }
            return $value;
            break;

            // ? Truncate integers from array in cycle
        case "array":
            $array = array();
            foreach ($value as $val) {
                if (gettype($val) == "integer") {
                    array_push($array, byteval($val));
                } else {
                    return throw new InvalidArgumentException("byteval() function supports only integers, integer arrays and string!");
                }
            }

            return $array;
            break;

            // ? For more simple working with library
        case 'string':
            return getbytes($value);
            break;

        default:
            return throw new InvalidArgumentException("byteval() function supports only integers, integer arrays and string!");
            break;
    }
}

// ? Used to convert value to bytes (integers) array.
function getbytes($value)
{
    switch (gettype($value)) {
        case 'integer':
            return pack("N", $value);
            //return unpack("C*", pack("L", $value));
            break;
        case 'string':
            return unpack("C*", $value);
            break;
        default:
            return throw new InvalidArgumentException("getbytes() function supports only integers and strings!");
            break;
    }
}

// ? Used to convert bytes (integers) array to integer (something like reversed getbytes() function)
function intbytes($value)
{
    return unpack("N", $value)[1];
}

// ? Used to convert bytes (integers) array to string (something like reversed getbytes() function)
function strbytes($value)
{
    $result = implode(array_map("chr", $value));

    return $result;

    // ! Use this if variant with implode and array_map not work.
    // * call_user_func_array('pack', array_merge(array('C*'), $value))
}

// TODO: Working with float and double values
// todo ------------------------------- todo
/*
// ? Used to convert bytes (integers) array to float (something like reversed getbytes() function)
// ! Possible dublicate of doublebytes() function
function floatbytes($value)
{
    return pack('i', $value); // ! Not work
}

// ? Used to convert bytes (integers) array to double (something like reversed getbytes() function)
// ! Possible dublicate of floatbytes() function
function doublebytes($value)
{
    return unpack('f', $value); // ! Not work too
} */
// todo ------------------------------- todo

// ? Used to repair indexes in bytes array
// ? Example: when indexes starts from 1 or used strings as array keys
function repairindexes($value)
{
    array_unshift($value, 0);
    array_shift($value);

    return $value;
}

// ? Alternative name of repairindexes() functions.
function fixarray($value)
{
    return repairindexes($value);
}