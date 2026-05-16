<?php
// Tambahkan di config/app.php dalam array return,
// atau buat file config/shop.php baru:

return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Toko Rajutan
    |--------------------------------------------------------------------------
    */

    // Nomor WhatsApp admin (format: kode negara tanpa +)
    // Contoh: 6281234567890 (untuk +62 812 3456 7890)
    'whatsapp_number' => env('WHATSAPP_NUMBER', '6281234567890'),

    // Nama toko
    'shop_name' => env('SHOP_NAME', 'Benang & Kasih'),

    // Tagline
    'shop_tagline' => env('SHOP_TAGLINE', 'Handmade Crochet'),
];