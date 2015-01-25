<?php

namespace tklovett\barcodes;


use tklovett\barcodes\barcodes\Codabar;
use tklovett\barcodes\barcodes\Code11;
use tklovett\barcodes\barcodes\Code128;
use tklovett\barcodes\barcodes\Code39;
use tklovett\barcodes\barcodes\Code93;
use tklovett\barcodes\barcodes\DataMatrix;
use tklovett\barcodes\barcodes\EanUpc;
use tklovett\barcodes\barcodes\IntelligentMail;
use tklovett\barcodes\barcodes\Interleaved2Of5;
use tklovett\barcodes\barcodes\MSI;
use tklovett\barcodes\barcodes\PDF417;
use tklovett\barcodes\barcodes\Pharmacode;
use tklovett\barcodes\barcodes\POSTNET;
use tklovett\barcodes\barcodes\QRCode;
use tklovett\barcodes\barcodes\RMS4CC;
use tklovett\barcodes\barcodes\Standard2Of5;
use tklovett\barcodes\barcodes\UPCExtensions;

/**
 * BarcodeGenerator
 * A factory class for creating barcodes of various types
 * @package tklovett\barcodes
 * @author tklovett <tklovett@gmail.com>
 */
class BarcodeGenerator
{
    /**
     * @param string $barcodeType The type of barcode to generate
     * @param string $code The code to be represented by this barcode.
     * @return Barcode A barcode of the specified type representing the code
     */
    public function generate($barcodeType, $code)
    {
        switch ($barcodeType) {
            case BarcodeType::CODE_11:
                return new Code11($code);
            case BarcodeType::CODE_39:
                return new Code39($code);
            case BarcodeType::CODE_39_CHECK_DIGIT:
                return new Code39($code, true);
            case BarcodeType::CODE_39_EXTENDED:
                return new Code39($code, false, true);
            case BarcodeType::CODE_39_CHECK_DIGIT_EXTENDED:
                return new Code39($code, true, true);
            case BarcodeType::CODE_93:
                return new Code93($code);
            case BarcodeType::STANDARD_2_OF_5:
                return new Standard2Of5($code);
            case BarcodeType::STANDARD_2_OF_5_CHECK_DIGIT:
                return new Standard2Of5($code, true);
            case BarcodeType::INTERLEAVED_2_OF_5:
                return new Interleaved2Of5($code);
            case BarcodeType::INTERLEAVED_2_OF_5_CHECK_DIGIT:
                return new Interleaved2Of5($code, true);
            case BarcodeType::CODE_128:
                return new Code128($code);
            case BarcodeType::CODE_128A:
                return new Code128($code, 'A');
            case BarcodeType::CODE_128B:
                return new Code128($code, 'B');
            case BarcodeType::CODE_128C:
                return new Code128($code, 'C');
            case BarcodeType::EAN_2:
                return new UPCExtensions($code, 2);
            case BarcodeType::EAN_5:
                return new UPCExtensions($code, 5);
            case BarcodeType::EAN_13:
                return new EanUpc($code, 13);
            case BarcodeType::UPC_A:
                return new EanUpc($code, 12);
            case BarcodeType::UPC_E:
                return new EanUpc($code, 6);
            case BarcodeType::MSI:
                return new MSI($code);
            case BarcodeType::MSI_CHECK_DIGIT:
                return new MSI($code, true);
            case BarcodeType::POSTNET:
                return new POSTNET($code);
            case BarcodeType::PLANET:
                return new POSTNET($code, true);
            case BarcodeType::RMS4CC:
                return new RMS4CC($code);
            case BarcodeType::KIX:
                return new RMS4CC($code, true);
            case BarcodeType::IMB:
                return new IntelligentMail($code);
            case BarcodeType::CODABAR:
                return new Codabar($code);
            case BarcodeType::PHARMACODE:
                return new Pharmacode($code);
            case BarcodeType::PHARMACODE_TWO_TRACK:
                return new Pharmacode($code, true);
            case BarcodeType::DATA_MATRIX:
                return new DataMatrix($code);
            case BarcodeType::PDF417:
                return new PDF417($code);
            case BarcodeType::QR_CODE:
                return new QRCode($code);
        }
    }
}