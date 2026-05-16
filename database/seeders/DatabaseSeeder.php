<?php
// database/seeders/DatabaseSeeder.php — REPLACE seluruh file ini

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ──────────────────────────────────────────────────────
        $categories = [
            ['name' => 'Tas',       'slug' => 'tas',       'icon' => '👜', 'description' => 'Tas rajutan handmade berbagai ukuran dan model'],
            ['name' => 'Pakaian',   'slug' => 'pakaian',   'icon' => '🧥', 'description' => 'Pakaian rajutan premium untuk semua usia'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'icon' => '🧣', 'description' => 'Aksesoris rajutan seperti topi, syal, dan gelang'],
            ['name' => 'Dekorasi',  'slug' => 'dekorasi',  'icon' => '🏠', 'description' => 'Dekorasi rumah rajutan yang cantik dan unik'],
            ['name' => 'Boneka',    'slug' => 'boneka',    'icon' => '🧸', 'description' => 'Amigurumi dan boneka rajutan lucu'],
        ];
        foreach ($categories as $cat) Category::create($cat);

        // ── Products ────────────────────────────────────────────────────────
        $products = [
            ['category_id'=>1,'name'=>'Tote Bag Rafi Sage','slug'=>'tote-bag-rafi-sage','description'=>'Tas tote rajutan dengan motif anyaman rapi menggunakan benang katun premium.','material'=>'Benang katun premium 100% cotton.','yarn_type'=>'Cotton Premium','yarn_weight'=>'Worsted Weight','price'=>185000,'status'=>'ready_stock','stock'=>5,'size'=>'30cm x 35cm','colors'=>['Sage Green','Cream','Dusty Rose'],'is_featured'=>true,'is_active'=>true],
            ['category_id'=>1,'name'=>'Mini Bucket Bag Terra','slug'=>'mini-bucket-bag-terra','description'=>'Bucket bag mini dengan sentuhan boho-chic.','material'=>'Benang macrame dan benang hias kombinasi.','yarn_type'=>'Macrame Cord','yarn_weight'=>'Bulky Weight','price'=>220000,'status'=>'pre_order','stock'=>0,'estimated_days'=>7,'size'=>'20cm x 25cm','colors'=>['Terracotta','Natural','Mocha'],'is_featured'=>true,'is_active'=>true],
            ['category_id'=>2,'name'=>'Cardigan Cozy Latte','slug'=>'cardigan-cozy-latte','description'=>'Cardigan rajutan dengan pola sederhana namun elegan.','material'=>'Benang wool blend 70% wool 30% acrylic.','yarn_type'=>'Wool Blend','yarn_weight'=>'DK Weight','price'=>450000,'status'=>'pre_order','stock'=>0,'estimated_days'=>14,'size'=>'S / M / L / XL','colors'=>['Latte','Oat','Sage'],'is_featured'=>true,'is_active'=>true],
            ['category_id'=>3,'name'=>'Bucket Hat Daisy','slug'=>'bucket-hat-daisy','description'=>'Topi bucket rajutan bermotif bunga daisy.','material'=>'Benang katun mercerized halus.','yarn_type'=>'Cotton Mercerized','yarn_weight'=>'Sport Weight','price'=>95000,'status'=>'ready_stock','stock'=>8,'size'=>'Free Size','colors'=>['Butter Yellow','Baby Pink','Mint'],'is_featured'=>false,'is_active'=>true],
            ['category_id'=>5,'name'=>'Amigurumi Beruang Boba','slug'=>'amigurumi-beruang-boba','description'=>'Boneka beruang lucu sedang memegang boba!','material'=>'Benang acrylic anti-alergi.','yarn_type'=>'Acrylic','yarn_weight'=>'DK Weight','price'=>135000,'status'=>'ready_stock','stock'=>3,'size'=>'±20cm','colors'=>['Brown','Cream'],'is_featured'=>true,'is_active'=>true],
            ['category_id'=>2,'name'=>'Crop Top Crochet Summer','slug'=>'crop-top-crochet-summer','description'=>'Atasan crop rajutan dengan pola openwork yang cantik.','material'=>'Benang katun mercerized halus.','yarn_type'=>'Cotton Mercerized','yarn_weight'=>'DK Weight','price'=>320000,'status'=>'pre_order','stock'=>0,'estimated_days'=>12,'size'=>'XS/S/M/L','colors'=>['White','Cream','Sky Blue'],'is_featured'=>true,'is_active'=>true],
        ];
        foreach ($products as $p) Product::create($p);

        // ── Users ────────────────────────────────────────────────────────────
        User::create(['name'=>'Admin Rajutan','email'=>'admin@rajutan.com','password'=>bcrypt('password'),'role'=>'admin']);
        User::create(['name'=>'Customer Demo','email'=>'customer@rajutan.com','password'=>bcrypt('password'),'role'=>'customer']);
    }
}