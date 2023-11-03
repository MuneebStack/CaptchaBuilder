<?php

namespace CaptchaBuilder;

class Captcha
{
    private $fontPath;
    private $captchaText;

    public function __construct($length = 6)
    {
        $this->fontPath = dirname(__FILE__) . '/fonts/';
        $this->captchaText = $this->generateRandomText($length);
    }

    public function renderCaptchaImage($fontSize = 20)
    {
        $image = $this->createCaptchaImage($fontSize);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);
        return 'data:image/png;base64,' . base64_encode($imageData);
    }
    
    public function getCaptchaText()
    {
        return $this->captchaText;
    }

    public function refreshCaptchaText($length = 6)
    {
        $this->captchaText = $this->generateRandomText($length);
        return $this->renderCaptchaImage();
    }

    private function generateRandomText($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $text = '';
        for ($i = 0; $i < $length; $i++) {
            $text .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $text;
    }

    private function createCaptchaImage($fontSize)
    {
        $image = imagecreatetruecolor(150, 50);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagefill($image, 0, 0, $backgroundColor);

        for ($i = 0; $i < strlen($this->captchaText); $i++) {
            $fontNumber = rand(1, 10);
            $fontFile = $this->fontPath . $fontNumber . '.ttf';
            imagettftext($image, $fontSize, 0, 20 + ($i * $fontSize), 30, $textColor, $fontFile, $this->captchaText[$i]);
        }

        return $image;
    }
}
