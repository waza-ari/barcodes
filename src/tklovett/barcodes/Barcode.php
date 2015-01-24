<?php

namespace tklovett\barcodes;


/**
 * Barcode
 * A interface specifying the public methods for all Barcode types
 * @package tklovett\barcodes
 * @author tklovett <tklovett@gmail.com>
 */
interface Barcode {

    /**
     * Constructs a barcode array
     * @param string $code The code to be represented by this barcode.
     */
    function __construct($code);

    /**
     * Returns a PNG representation of the barcode
     * @return string An base64 encoded image string representing the barcode
     */
    public function toPNG();

    /**
     * Returns an HTML representation of the barcode
     * @return string The HTML representation of the barcode
     */
    public function toHTML();

    /**
     * Returns an SVG representation of the barcode
     * @return string The SVG representation of the barcode
     */
    public function toSVG();

    /**
     * Returns the code represented by this barcode
     * @return string The code represented by this barcode.
     */
    public function getCode();

}