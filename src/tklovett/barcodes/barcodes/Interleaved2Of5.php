<?php

namespace tklovett\barcodes\barcodes;


use tklovett\barcodes\OneDimensionalBarcode;


/**
 * Interleaved 2 of 5
 * Compact numeric code, widely used in industry, air cargo
 * Contains digits (0 to 9) and encodes the data in the width of both bars and spaces.
 * @package tklovett\barcodes\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
class Interleaved2Of5 extends OneDimensionalBarcode
{
    /**
     * Construct an Interleaved 2 of 5 barcode array
     * @param string $code The code to be represented by this barcode.
     * @param bool $checkDigit add a check digit to the code
     */
    function __construct($code, $checkDigit = false)
    {
        $chr = array();
        $chr['0'] = '11221';
        $chr['1'] = '21112';
        $chr['2'] = '12112';
        $chr['3'] = '22111';
        $chr['4'] = '11212';
        $chr['5'] = '21211';
        $chr['6'] = '12211';
        $chr['7'] = '11122';
        $chr['8'] = '21121';
        $chr['9'] = '12121';
        $chr['A'] = '11';
        $chr['Z'] = '21';
        if ($checkDigit) {
            // add checksum
            $code .= $this->checksum_s25($code);
        }
        if ((strlen($code) % 2) != 0) {
            // add leading zero if code-length is odd
            $code = '0' . $code;
        }
        // add start and stop codes
        $code = 'AA' . strtolower($code) . 'ZA';

        $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => array());
        $k = 0;
        $clen = strlen($code);
        for ($i = 0; $i < $clen; $i = ($i + 2)) {
            $char_bar = $code{$i};
            $char_space = $code{$i + 1};
            if ((!isset($chr[$char_bar])) OR (!isset($chr[$char_space]))) {
                // invalid character
                return;
            }
            // create a bar-space sequence
            $seq = '';
            $chrlen = strlen($chr[$char_bar]);
            for ($s = 0; $s < $chrlen; $s++) {
                $seq .= $chr[$char_bar]{$s} . $chr[$char_space]{$s};
            }
            $seqlen = strlen($seq);
            for ($j = 0; $j < $seqlen; ++$j) {
                if (($j % 2) == 0) {
                    $t = true; // bar
                } else {
                    $t = false; // space
                }
                $w = $seq{$j};
                $this->barcode_array['bcode'][$k] = array('t' => $t, 'w' => $w, 'h' => 1, 'p' => 0);
                $this->barcode_array['maxw'] += $w;
                ++$k;
            }
        }
    }
}