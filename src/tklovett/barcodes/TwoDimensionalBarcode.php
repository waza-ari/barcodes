<?php

namespace tklovett\barcodes;


/**
 * TwoDimensionalBarcode
 * An abstract class representing a two-dimensional barcode
 * @package tklovett\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
abstract class TwoDimensionalBarcode implements Barcode {

    /**
     * @var string The code represented by this barcode
     */
    protected $code;

    /**
     * Array representation of barcode.
     * @protected
     */
    protected $barcode_array = false;

    /**
     * Sets the code for this barcode
     * @param string $code The code to be represented by this barcode.
     */
    function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Returns a PNG representation of the barcode
     * @param int $width The width of a single rectangle element in pixels
     * @param int $height The height of a single rectangle element in pixels
     * @param array $color RGB (0-255) foreground color for rectangle elements (background is transparent)
     * @return string An base64 encoded image string representing the barcode
     */
    public function toPNG($width = 3, $height = 3, $color = array(0, 0, 0)) {
        // calculate image size
        $imageWidth = ($this->barcode_array['num_cols'] * $width);
        $imageHeight = ($this->barcode_array['num_rows'] * $height);
        if (function_exists('imagecreate')) {
            // GD library
            $imagick = false;
            $png = imagecreate($imageWidth, $imageHeight);
            $bgcol = imagecolorallocate($png, 255, 255, 255);
            imagecolortransparent($png, $bgcol);
            $fgcol = imagecolorallocate($png, $color[0], $color[1], $color[2]);
        } elseif (extension_loaded('imagick')) {
            $imagick = true;
            $bgcol = new \imagickpixel('rgb(255,255,255');
            $fgcol = new \imagickpixel('rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')');
            $png = new \Imagick();
            $png->newImage($imageWidth, $imageHeight, 'none', 'png');
            $bar = new \imagickdraw();
            $bar->setfillcolor($fgcol);
        } else {
            throw new \RuntimeException("PHP 4+ or the imagick extension is required to generate PNG barcodes.");
        }
        // print barcode elements
        $y = 0;
        // for each row
        for ($r = 0; $r < $this->barcode_array['num_rows']; ++$r) {
            $x = 0;
            // for each column
            for ($c = 0; $c < $this->barcode_array['num_cols']; ++$c) {
                if ($this->barcode_array['bcode'][$r][$c] == 1) {
                    // draw a single barcode cell
                    if ($imagick) {
                        $bar->rectangle($x, $y, ($x + $width), ($y + $height));
                    } else {
                        imagefilledrectangle($png, $x, $y, ($x + $width), ($y + $height), $fgcol);
                    }
                }
                $x += $width;
            }
            $y += $height;
        }
        ob_start();
        // get image out put

        if ($imagick) {
            $png->drawimage($bar);
            echo $png;
        } else {
            imagepng($png);
            imagedestroy($png);
        }
        $image = ob_get_clean();
        $image = base64_encode($image);
        //$image = 'data:image/png;base64,' . base64_encode($image);
        return $image;
    }

    /**
     * Returns an HTML representation of the barcode
     * @param int $width The width of a single rectangle element in pixels
     * @param int $height The height of a single rectangle element in pixels
     * @param string $color CSS foreground color for rectangle elements (background is transparent)
     * @return string The HTML representation of the barcode
     */
    public function toHTML($width = 10, $height = 10, $color = 'black') {
        $html = '<div style="font-size:0;position:relative;width:' . ($width * $this->barcode_array['num_cols']) . 'px;height:' . ($height * $this->barcode_array['num_rows']) . 'px;">' . "\n";
        // print barcode elements
        $y = 0;
        // for each row
        for ($row = 0; $row < $this->barcode_array['num_rows']; ++$row) {
            $x = 0;
            // for each column
            for ($col = 0; $col < $this->barcode_array['num_cols']; ++$col) {
                if ($this->barcode_array['bcode'][$row][$col] == 1) {
                    // draw a single barcode cell
                    $html .= '<div style="background-color:' . $color . ';width:' . $width . 'px;height:' . $height . 'px;position:absolute;left:' . $x . 'px;top:' . $y . 'px;">&nbsp;</div>' . "\n";
                }
                $x += $width;
            }
            $y += $height;
        }
        $html .= '</div>' . "\n";
        return $html;
    }

    /**
     * Returns an SVG representation of the barcode
     * @param int $width The width of a single rectangle element in user units
     * @param int $height The height of a single rectangle element in user units
     * @param string $color SVG foreground color for rectangle elements (background is transparent)
     * @return string The code represented by this barcode.
     */
    public function toSVG($width = 3, $height = 3, $color = 'black') {
        // replace table for special characters
        $repstr = array("\0" => '', '&' => '&amp;', '<' => '&lt;', '>' => '&gt;');
        $svg = '<' . '?' . 'xml version="1.0" standalone="no"' . '?' . '>' . "\n";
        $svg .= '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">' . "\n";
        $svg .= '<svg width="' . round(($this->barcode_array['num_cols'] * $width), 3) . '" height="' . round(($this->barcode_array['num_rows'] * $height), 3) . '" version="1.1" xmlns="http://www.w3.org/2000/svg">' . "\n";
        $svg .= "\t" . '<desc>' . strtr($this->barcode_array['code'], $repstr) . '</desc>' . "\n";
        $svg .= "\t" . '<g id="elements" fill="' . $color . '" stroke="none">' . "\n";
        // print barcode elements
        $y = 0;
        // for each row
        for ($row = 0; $row < $this->barcode_array['num_rows']; ++$row) {
            $x = 0;
            // for each column
            for ($col = 0; $col < $this->barcode_array['num_cols']; ++$col) {
                if ($this->barcode_array['bcode'][$row][$col] == 1) {
                    // draw a single barcode cell
                    $svg .= "\t\t" . '<rect x="' . $x . '" y="' . $y . '" width="' . $width . '" height="' . $height . '" />' . "\n";
                }
                $x += $width;
            }
            $y += $height;
        }
        $svg .= "\t" . '</g>' . "\n";
        $svg .= '</svg>' . "\n";
        return $svg;
    }

    /**
     * Returns the code represented by this barcode
     * @return string The code represented by this barcode.
     */
    public function getCode()
    {
        return $this->code;
    }

}