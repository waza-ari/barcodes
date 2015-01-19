<?php

namespace tklovett\barcodes\barcodes;


use tklovett\barcodes\OneDimensionalBarcode;

/**
 * MSI (Modified Plessey)
 * Variation of Plessey code, with similar applications
 * Contains digits (0 to 9) and encodes the data only in the width of bars.
 * @package tklovett\barcodes\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
class MSI extends OneDimensionalBarcode
{
    /**
     * Construct an MSI barcode array
     * @param string $code The code to be represented by this barcode.
     * @param bool $checkDigit add a check digit to the code
     */
    function __construct($code, $checkDigit = false)
    {
        $chr['0'] = '100100100100';
        $chr['1'] = '100100100110';
        $chr['2'] = '100100110100';
        $chr['3'] = '100100110110';
        $chr['4'] = '100110100100';
        $chr['5'] = '100110100110';
        $chr['6'] = '100110110100';
        $chr['7'] = '100110110110';
        $chr['8'] = '110100100100';
        $chr['9'] = '110100100110';
        $chr['A'] = '110100110100';
        $chr['B'] = '110100110110';
        $chr['C'] = '110110100100';
        $chr['D'] = '110110100110';
        $chr['E'] = '110110110100';
        $chr['F'] = '110110110110';
        if ($checkDigit) {
            // add checksum
            $clen = strlen($code);
            $p = 2;
            $check = 0;
            for ($i = ($clen - 1); $i >= 0; --$i) {
                $check += (hexdec($code{$i}) * $p);
                ++$p;
                if ($p > 7) {
                    $p = 2;
                }
            }
            $check %= 11;
            if ($check > 0) {
                $check = 11 - $check;
            }
            $code .= $check;
        }
        $seq = '110'; // left guard
        $clen = strlen($code);
        for ($i = 0; $i < $clen; ++$i) {
            $digit = $code{$i};
            if (!isset($chr[$digit])) {
                // invalid character
                return;
            }
            $seq .= $chr[$digit];
        }
        $seq .= '1001'; // right guard
        $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => array());
        $this->barcode_array = $this->binseq_to_array($seq, $this->barcode_array);
    }
}