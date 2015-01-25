<?php

namespace tklovett\barcodes_tests;

use PHPUnit_Framework_TestCase;
use tklovett\barcodes\BarcodeGenerator;
use tklovett\barcodes\BarcodeType;

/**
 * Class BarcodeGeneratorTest
 * @package tklovett\barcodes_tests
 */
class BarcodeGeneratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var BarcodeGenerator used for testing
     */
    private $generator;

    /**
     * Construct a BarcodeGenerator for testing
     */
    function __construct()
    {
        $this->generator = new BarcodeGenerator();
    }

    /**
     * @test
     */
    public function shouldReturnCodabar()
    {
        $barcode = $this->generator->generate(BarcodeType::CODABAR, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Codabar', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnCode11()
    {
        $barcode = $this->generator->generate(BarcodeType::CODE_11, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code11', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnCode39()
    {
        $barcode = $this->generator->generate(BarcodeType::CODE_39, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code39', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_39_CHECK_DIGIT, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code39', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_39_EXTENDED, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code39', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_39_CHECK_DIGIT_EXTENDED, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code39', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnCode93()
    {
        $barcode = $this->generator->generate(BarcodeType::CODE_93, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code93', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnCode128()
    {
        $barcode = $this->generator->generate(BarcodeType::CODE_128, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code128', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_128A, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code128', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_128B, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code128', $barcode);

        $barcode = $this->generator->generate(BarcodeType::CODE_128C, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Code128', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnDataMatrix()
    {
        $barcode = $this->generator->generate(BarcodeType::DATA_MATRIX, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\DataMatrix', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnEanUpc()
    {
        $barcode = $this->generator->generate(BarcodeType::EAN_13, "5901234123457");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\EanUpc', $barcode);

        $barcode = $this->generator->generate(BarcodeType::UPC_A, "123456789012");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\EanUpc', $barcode);

        $barcode = $this->generator->generate(BarcodeType::UPC_E, "123456");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\EanUpc', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnIntelligentMail()
    {
        $barcode = $this->generator->generate(BarcodeType::IMB, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\IntelligentMail', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnInterleaved2of5()
    {
        $barcode = $this->generator->generate(BarcodeType::INTERLEAVED_2_OF_5, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Interleaved2of5', $barcode);

        $barcode = $this->generator->generate(BarcodeType::INTERLEAVED_2_OF_5_CHECK_DIGIT, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Interleaved2of5', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnMSI()
    {
        $barcode = $this->generator->generate(BarcodeType::MSI, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\MSI', $barcode);

        $barcode = $this->generator->generate(BarcodeType::MSI_CHECK_DIGIT, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\MSI', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnPDF417()
    {
        $barcode = $this->generator->generate(BarcodeType::PDF417, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\PDF417', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnPharmacode()
    {
        $barcode = $this->generator->generate(BarcodeType::PHARMACODE, "131070");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Pharmacode', $barcode);

        $barcode = $this->generator->generate(BarcodeType::PHARMACODE_TWO_TRACK, "131070");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Pharmacode', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnPOSTNET()
    {
        $barcode = $this->generator->generate(BarcodeType::POSTNET, "97231-2623");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\POSTNET', $barcode);

        $barcode = $this->generator->generate(BarcodeType::PLANET, "97231-2623");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\POSTNET', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnQRCode()
    {
        $barcode = $this->generator->generate(BarcodeType::QR_CODE, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\QRCode', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnRMS4CC()
    {
        $barcode = $this->generator->generate(BarcodeType::RMS4CC, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\RMS4CC', $barcode);

        $barcode = $this->generator->generate(BarcodeType::KIX, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\RMS4CC', $barcode);
    }

    /**
     * @test
     */
    public function shouldReturnStandard2of5()
    {
        $barcode = $this->generator->generate(BarcodeType::STANDARD_2_OF_5, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Standard2Of5', $barcode);

        $barcode = $this->generator->generate(BarcodeType::STANDARD_2_OF_5_CHECK_DIGIT, "A123456B");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\Standard2Of5', $barcode);
    }


    /**
     * @test
     */
    public function shouldReturnUPCExtensions()
    {
        $barcode = $this->generator->generate(BarcodeType::EAN_2, "91");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\UPCExtensions', $barcode);

        $barcode = $this->generator->generate(BarcodeType::EAN_5, "54495");
        $this->assertInstanceOf('tklovett\barcodes\barcodes\UPCExtensions', $barcode);
    }


}
