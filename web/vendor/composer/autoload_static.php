<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c565e29c95a93937837ab26977503c5
{
    public static $files = array (
        '6124b4c8570aa390c21fafd04a26c69f' => __DIR__ . '/..' . '/myclabs/deep-copy/src/DeepCopy/deep_copy.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
        'c' => 
        array (
            'chillerlan\\Settings\\' => 20,
            'chillerlan\\QRCode\\' => 18,
        ),
        'b' => 
        array (
            'benhall14\\' => 10,
        ),
        'S' => 
        array (
            'Sounoob\\pagseguro\\' => 18,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Mpdf\\' => 5,
        ),
        'D' => 
        array (
            'DeepCopy\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
        'chillerlan\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-settings-container/src',
        ),
        'chillerlan\\QRCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-qrcode/src',
        ),
        'benhall14\\' => 
        array (
            0 => __DIR__ . '/..' . '/benhall14/php-calendar/src',
        ),
        'Sounoob\\pagseguro\\' => 
        array (
            0 => __DIR__ . '/..' . '/sounoob/pagseguro-php-sdk/source',
            1 => __DIR__ . '/..' . '/sounoob/pagseguro-php-sdk-boleto/source',
            2 => __DIR__ . '/..' . '/sounoob/pagseguro-php-sdk-core/source',
            3 => __DIR__ . '/..' . '/sounoob/pagseguro-php-sdk-search-transaction/source',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Mpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/mpdf/mpdf/src',
        ),
        'DeepCopy\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/deep-copy/src/DeepCopy',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c565e29c95a93937837ab26977503c5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c565e29c95a93937837ab26977503c5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
