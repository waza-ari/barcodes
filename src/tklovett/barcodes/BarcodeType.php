<?php

namespace tklovett\barcodes;


/**
 * BarcodeType
 * A psuedo-enum class specifying the types of barcodes that can be generated
 * @package tklovett\barcodes
 * @author tklovett <tklovett@gmail.com>
 */
abstract class BarcodeType
{
    // One dimensional
    const CODABAR = "Codabar";
    const CODE_11 = "Code 11";
    const CODE_39 = "Code 39";
    const CODE_39_CHECK_DIGIT = "Code 39 (Check Digit)";
    const CODE_39_EXTENDED = "Code 39 (Extended)";
    const CODE_39_CHECK_DIGIT_EXTENDED = "Code 39 (Extended, Check Digit)";
    const CODE_93 = "Code 93";
    const STANDARD_2_OF_5 = "Standard 2 of 5";
    const STANDARD_2_OF_5_CHECK_DIGIT = "Standard 2 of 5 (Check Digit)";
    const INTERLEAVED_2_OF_5 = "Interleaved 2 of 5";
    const INTERLEAVED_2_OF_5_CHECK_DIGIT = "Interleaved 2 of 5 (Check Digit)";
    const CODE_128 = "Code 128";
    const CODE_128A = "Code 128A";
    const CODE_128B = "Code 128B";
    const CODE_128C = "Code 128C";
    const EAN_2 = "EAN-2";
    const EAN_5 = "EAN-5";
    const EAN_13 = "EAN-13";
    const UPC_A = "UPC-A";
    const UPC_E = "UPC-E";
    const MSI = "MSI";
    const MSI_CHECK_DIGIT = "MSI (Check Digit modulo 11)";
    const POSTNET = "POSTNET";
    const PLANET = "PLANET";
    const RMS4CC = "RMS4CC";
    const KIX = "KIX";
    const IMB = "IMB";
    const PHARMACODE = "Pharmacode";
    const PHARMACODE_TWO_TRACK = "Pharmacode Two-Track";

    // Two dimensional
    const DATA_MATRIX = "Data Matrix";
    const PDF417 = "PDF417";
    const QR_CODE = "QR CODE";
}