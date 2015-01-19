<?php

namespace tklovett\barcodes;


/**
 * OneDimensionalBarcode
 * An abstract class representing a one-dimensional barcode
 * @package tklovett\barcodes
 * @author dinesh
 * @author tklovett <tklovett@gmail.com>
 */
abstract class OneDimensionalBarcode implements Barcode
{

    /**
     * @var string The code represented by this barcode
     */
    protected $code;

    /**
     * Array representation of barcode.
     * @protected
     */
    protected $barcode_array;

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
     * @param int $width The width of a single bar element in pixels
     * @param int $height The height of a single bar element in pixels
     * @param array $color RGB (0-255) foreground color for bar elements (background is transparent)
     * @return resource An image resource identifier representing the barcode
     */
    public function toPNG($width = 2, $height = 30, $color = array(0, 0, 0))
    {
        // calculate image size
        $imageWidth = ($this->barcode_array['maxw'] * $width);
        $imageHeight = $height;
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
            return null;
        }
        // print bars
        $x = 0;
        foreach ($this->barcode_array['bcode'] as $k => $v) {
            $bw = round(($v['w'] * $width), 3);
            $bh = round(($v['h'] * $height / $this->barcode_array['maxh']), 3);
            if ($v['t']) {
                $y = round(($v['p'] * $height / $this->barcode_array['maxh']), 3);
                // draw a vertical bar
                if ($imagick) {
                    $bar->rectangle($x, $y, ($x + $bw), ($y + $bh));
                } else {
                    imagefilledrectangle($png, $x, $y, ($x + $bw) - 1, ($y + $bh), $fgcol);
                }
            }
            $x += $bw;
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
     * @param int $width The width of a single bar element in pixels
     * @param int $height The height of a single bar element in pixels
     * @param string $color CSS foreground color for bar elements (background is transparent)
     * @return string The HTML representation of the barcode
     */
    public function toHTML($width = 2, $height = 30, $color = 'black')
    {
        $html = '<div style="font-size:0;position:relative;width:' . ($this->barcode_array['maxw'] * $width) . 'px;height:' . ($height) . 'px;">' . "\n";
        // print bars
        $x = 0;
        foreach ($this->barcode_array['bcode'] as $key => $value) {
            $bw = round(($value['w'] * $width), 3);
            $bh = round(($value['h'] * $height / $this->barcode_array['maxh']), 3);
            if ($value['t']) {
                $y = round(($value['p'] * $height / $this->barcode_array['maxh']), 3);
                // draw a vertical bar
                $html .= '<div style="background-color:' . $color . ';width:' . $bw . 'px;height:' . $bh . 'px;position:absolute;left:' . $x . 'px;top:' . $y . 'px;">&nbsp;</div>' . "\n";
            }
            $x += $bw;
        }
        $html .= '</div>' . "\n";
        return $html;
    }

    /**
     * Returns an SVG representation of the barcode
     * @param int $width The width of a single bar element in user units
     * @param int $height The height of a single bar element in user units
     * @param string $color SVG foreground color for bar elements (background is transparent)
     * @return string The code represented by this barcode.
     */
    public function toSVG($width = 2, $height = 30, $color = 'black')
    {
        // replace table for special characters
        $repstr = array("\0" => '', '&' => '&amp;', '<' => '&lt;', '>' => '&gt;');
        $svg = '<' . '?' . 'xml version="1.0" standalone="no"' . '?' . '>' . "\n";
        $svg .= '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">' . "\n";
        $svg .= '<svg width="' . round(($this->barcode_array['maxw'] * $width), 3) . '" height="' . $height . '" version="1.1" xmlns="http://www.w3.org/2000/svg">' . "\n";
        $svg .= "\t" . '<desc>' . strtr($this->barcode_array['code'], $repstr) . '</desc>' . "\n";
        $svg .= "\t" . '<g id="bars" fill="' . $color . '" stroke="none">' . "\n";
        // print bars
        $x = 0;
        foreach ($this->barcode_array['bcode'] as $key => $value) {
            $bw = round(($value['w'] * $width), 3);
            $bh = round(($value['h'] * $height / $this->barcode_array['maxh']), 3);
            if ($value['t']) {
                $y = round(($value['p'] * $height / $this->barcode_array['maxh']), 3);
                // draw a vertical bar
                $svg .= "\t\t" . '<rect x="' . $x . '" y="' . $y . '" width="' . $bw . '" height="' . $bh . '" />' . "\n";
            }
            $x += $bw;
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

    /**
     * Convert binary barcode sequence to barcode array.
     * @param string $seq barcode as binary sequence.
     * @param array $bararray barcode array.
     * @return array barcode representation.
     */
    protected function binseq_to_array($seq, $bararray)
    {
        $len = strlen($seq);
        $w = 0;
        $k = 0;
        for ($i = 0; $i < $len; ++$i) {
            $w += 1;
            if (($i == ($len - 1)) OR (($i < ($len - 1)) AND ($seq{$i} != $seq{($i + 1)}))) {
                if ($seq{$i} == '1') {
                    $t = true; // bar
                } else {
                    $t = false; // space
                }
                $bararray['bcode'][$k] = array('t' => $t, 'w' => $w, 'h' => 1, 'p' => 0);
                $bararray['maxw'] += $w;
                ++$k;
                $w = 0;
            }
        }
        return $bararray;
    }

    /**
     * Checksum for standard 2 of 5 barcodes.
     * @param string $code code to process.
     * @return int checksum.
     */
    protected function checksum_s25($code)
    {
        $len = strlen($code);
        $sum = 0;
        for ($i = 0; $i < $len; $i += 2) {
            $sum += $code{$i};
        }
        $sum *= 3;
        for ($i = 1; $i < $len; $i += 2) {
            $sum += ($code{$i});
        }
        $r = $sum % 10;
        if ($r > 0) {
            $r = (10 - $r);
        }
        return $r;
    }

}