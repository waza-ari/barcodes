<?php

namespace tklovett\barcodes\symbologies;


use tklovett\barcodes\OneDimensionalBarcode;

/**
 * UPC-Based Extensions
 * 2-Digit Ext.: Used to indicate magazines and newspaper issue numbers
 * 5-Digit Ext.: Used to mark suggested retail price of books
 * @package tklovett\barcodes\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
class UPCExtensions extends OneDimensionalBarcode
{
    /**
     * Construct a UPC 2-digit or 5-digit extension barcode array
     * @param string $code The code to be represented by this barcode.
     * @param int $len barcode type: 2 = 2-Digit, 5 = 5-Digit
     */
    function __construct($code, $len = 5)
    {
        //Padding
        $code = str_pad($code, $len, '0', STR_PAD_LEFT);
        // calculate check digit
        if ($len == 2) {
            $r = $code % 4;
        } elseif ($len == 5) {
            $r = (3 * ($code{0} + $code{2} + $code{4})) + (9 * ($code{1} + $code{3}));
            $r %= 10;
        } else {
            return;
        }
        //Convert digits to bars
        $codes = array(
            'A' => array(// left odd parity
                '0' => '0001101',
                '1' => '0011001',
                '2' => '0010011',
                '3' => '0111101',
                '4' => '0100011',
                '5' => '0110001',
                '6' => '0101111',
                '7' => '0111011',
                '8' => '0110111',
                '9' => '0001011'),
            'B' => array(// left even parity
                '0' => '0100111',
                '1' => '0110011',
                '2' => '0011011',
                '3' => '0100001',
                '4' => '0011101',
                '5' => '0111001',
                '6' => '0000101',
                '7' => '0010001',
                '8' => '0001001',
                '9' => '0010111')
        );
        $parities = array();
        $parities[2] = array(
            '0' => array('A', 'A'),
            '1' => array('A', 'B'),
            '2' => array('B', 'A'),
            '3' => array('B', 'B')
        );
        $parities[5] = array(
            '0' => array('B', 'B', 'A', 'A', 'A'),
            '1' => array('B', 'A', 'B', 'A', 'A'),
            '2' => array('B', 'A', 'A', 'B', 'A'),
            '3' => array('B', 'A', 'A', 'A', 'B'),
            '4' => array('A', 'B', 'B', 'A', 'A'),
            '5' => array('A', 'A', 'B', 'B', 'A'),
            '6' => array('A', 'A', 'A', 'B', 'B'),
            '7' => array('A', 'B', 'A', 'B', 'A'),
            '8' => array('A', 'B', 'A', 'A', 'B'),
            '9' => array('A', 'A', 'B', 'A', 'B')
        );
        $p = $parities[$len][$r];
        $seq = '1011'; // left guard bar
        $seq .= $codes[$p[0]][$code{0}];
        for ($i = 1; $i < $len; ++$i) {
            $seq .= '01'; // separator
            $seq .= $codes[$p[$i]][$code{$i}];
        }
        $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => array());
        $this->barcode_array = $this->binseq_to_array($seq, $this->barcode_array);
    }
}