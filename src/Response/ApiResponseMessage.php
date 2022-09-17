<?php

namespace App\Response;

Abstract class ApiResponseMessage
{

    public static array $messages = array(
        'NOT_STOCK' => "Ürün için yeterli stok bulunmuyor.",
        'SUCCESS' => "İşlem Başarılı!",
        'ERROR' => "İşlem Başarısız!",
    );

}