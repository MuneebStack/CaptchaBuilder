# CaptchaBuilder

**CaptchaBuilder** is an open-source PHP library for generating CAPTCHA images using the GD extension.

### Features
- CAPTCHA image generation
- Configurable text length and font size
- Session-friendly CAPTCHA validation
- Simple API for refreshing CAPTCHA challenges
- Composer-based installation

## Prerequisites

Before using CaptchaBuilder, please make sure that the GD extension for PHP is installed and enabled. To enable it, follow these steps:

1. Open your `php.ini` file.

2. Search for the following line:

   ```plaintext
   ;extension=gd
   ```

3. Remove the semicolon (;) from the beginning of the line to enable the GD extension:

   ```plaintext
   extension=gd
   ```

4. Save the `php.ini` file and restart your web server to apply the changes.

## Installation

To install the CaptchaBuilder library in your project, use Composer:

```bash
composer require muneebstack/captcha-builder
```

## Usage
   
1. Create an instance of `CaptchaBuilder\Captcha`:

   ```bash
   use CaptchaBuilder\Captcha;

   $captcha = new Captcha();
   ```

    The optional `length` parameter, passed as the first argument, and `fontSize`, passed as the second argument, can be specified. By default, the `length` of the captcha text is set to `6`, and `fontSize` to `20`.

3. To retrieve the CAPTCHA text, use the `getCaptchaText` method:

   ```bash
   $text = $captcha->getCaptchaText();
   ```

4. To retrieve the CAPTCHA image, use the `getCaptchaImage` method, which will return the image data:

    ```bash
    $imageData = $captcha->getCaptchaImage();
    ```

5. To refresh the CAPTCHA, use the `refreshCaptcha` method:

    ```bash
    $captcha->refreshCaptcha();
    ```

    After calling the `refreshCaptcha` method, you can get the new text and image:

    ```bash
    $newText = $captcha->getCaptchaText();
    $newImageData = $captcha->getCaptchaImage();
    ```

## Example

Here's an example code to store the CAPTCHA text in the session and display a CAPTCHA image:

```bash
    require 'vendor/autoload.php';

    use CaptchaBuilder\Captcha;

    $captcha = new Captcha();
    $text = $captcha->getCaptchaText();
    $imageData = $captcha->getCaptchaImage();

    session_start();
    $_SESSION['captcha_text'] = $text;

    echo "<img src='$imageData' alt='CAPTCHA Image'>";
```

Here's an example code to verify the CAPTCHA:

```bash
    $userInput = $_POST['captcha_input'];
    $captchaText = isset($_SESSION['captcha_text']) ? $_SESSION['captcha_text'] : '';

    if ($userInput === $captchaText) {
        echo "CAPTCHA verification successful!";
    } else {
        echo "CAPTCHA verification failed. Please try again.";
    }
```

## License

CaptchaBuilder is released under the MIT License.
