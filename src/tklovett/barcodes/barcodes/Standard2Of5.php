<?php

namespace tklovett\barcodes\barcodes;


use tklovett\barcodes\OneDimensionalBarcode;


/**
 * Standard 2 of 5
 * Used in airline ticket marking, photofinishing
 * Contains digits (0 to 9) and encodes the data only in the width of bars.
 * @package tklovett\barcodes\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
class Standard2Of5 extends OneDimensionalBarcode
{
    /**
     * Construct a Standard 2 of 5 barcode array
     * @param string $code The code to be represented by this barcode.
     * @param bool $checkDigit add a check digit to the code
     */
    function __construct($code, $checkDigit = false)
    {
        $chr['0'] = '10101110111010';
        $chr['1'] = '11101010101110';
        $chr['2'] = '10111010101110';
        $chr['3'] = '11101110101010';
        $chr['4'] = '10101110101110';
        $chr['5'] = '11101011101010';
        $chr['6'] = '10111011101010';
        $chr['7'] = '10101011101110';
        $chr['8'] = '10101110111010';
        $chr['9'] = '10111010111010';
        if ($checkDigit) {
            // add checksum
            $code .= $this->checksum_s25($code);
        }
        if ((strlen($code) % 2) != 0) {
            // add leading zero if code-length is odd
            $code = '0' . $code;
        }
        $seq = '11011010';
        $clen = strlen($code);
        for ($i = 0; $i < $clen; ++$i) {
            $digit = $code{$i};
            if (!isset($chr[$digit])) {
                // invalid character
                return;
            }
            $seq .= $chr[$digit];
        }
        $seq .= '1101011';
        $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => array());
        $this->barcode_array = $this->binseq_to_array($seq, $this->barcode_array);
    }
}