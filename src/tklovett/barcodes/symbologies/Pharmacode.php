<?php

namespace tklovett\barcodes\symbologies;


use tklovett\barcodes\OneDimensionalBarcode;

/**
 * Pharmacode (One-track or two-track)
 * Used in the pharmaceutical industry as a packing control system, designed to be readable despite printing errors.
 * @package tklovett\barcodes\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
class Pharmacode extends OneDimensionalBarcode
{
    /**
     * Construct a one-track or two-track Pharmacode barcode array
     * @param string $code The code to be represented by this barcode.
     * @param bool $twoTrack create a two-track Pharmacode barcode array
     */
    function __construct($code, $twoTrack = false)
    {
        if (!$twoTrack) {
            $seq = '';
            $code = intval($code);
            while ($code > 0) {
                if (($code % 2) == 0) {
                    $seq .= '11100';
                    $code -= 2;
                } else {
                    $seq .= '100';
                    $code -= 1;
                }
                $code /= 2;
            }
            $seq = substr($seq, 0, -2);
            $seq = strrev($seq);
            $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => array());
            $this->barcode_array = $this->binseq_to_array($seq, $this->barcode_array);
        } else if ($twoTrack) {
            $seq = '';
            $code = intval($code);
            do {
                switch ($code % 3) {
                    case 0: {
                        $seq .= '3';
                        $code = ($code - 3) / 3;
                        break;
                    }
                    case 1: {
                        $seq .= '1';
                        $code = ($code - 1) / 3;
                        break;
                    }
                    case 2: {
                        $seq .= '2';
                        $code = ($code - 2) / 3;
                        break;
                    }
                }
            } while ($code != 0);
            $seq = strrev($seq);
            $k = 0;
            $this->barcode_array = array('code' => $code, 'maxw' => 0, 'maxh' => 2, 'bcode' => array());
            $len = strlen($seq);
            for ($i = 0; $i < $len; ++$i) {
                switch ($seq{$i}) {
                    case '1': {
                        $p = 1;
                        $h = 1;
                        break;
                    }
                    case '2': {
                        $p = 0;
                        $h = 1;
                        break;
                    }
                    case '3': {
                        $p = 0;
                        $h = 2;
                        break;
                    }
                }
                $this->barcode_array['bcode'][$k++] = array('t' => 1, 'w' => 1, 'h' => $h, 'p' => $p);
                $this->barcode_array['bcode'][$k++] = array('t' => 0, 'w' => 1, 'h' => 2, 'p' => 0);
                $this->barcode_array['maxw'] += 2;
            }
            unset($this->barcode_array['bcode'][($k - 1)]);
            --$this->barcode_array['maxw'];
        }
    }
}