<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10001, 
                        'name_ar'             => 'كرسي فرح',
                        'name_en'             => 'Wedding Chair',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كرسي أنيق لحفلات الزفاف والمناسبات، مصنوع من خامات عالية الجودة ومناسب للديكور.',
                        'description_en'      => 'Elegant chair for weddings and events, made of high-quality materials and perfect for decoration.',
                        'about_brand_ar'      => 'هومي إيفنتس متخصصون في منتجات الأفراح والديكور.',
                        'about_brand_en'      => 'Homey Events specializes in wedding and decoration products.',

                        'regular_price'       => 500, 
                        'sale_price'          => 400, 
                        'discount_percentage' => round((100 / 500) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 50, 
                        'alt'                 => 'كرسي فرح مزخرف باللون الأبيض',
                        'slug'                => 'wedding-chair',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => true,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10002, 
                        'name_ar'             => 'كرسي فرح أبيض مزين بورود بينك',
                        'name_en'             => 'White Wedding Chair with Pink Flowers',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كرسي فرح أنيق باللون الأبيض مزين بلمسة من الورود الوردية لإضافة جو من الرقي والرومانسية لحفلات الزفاف والمناسبات.',
                        'description_en'      => 'Elegant white wedding chair decorated with pink flowers, adding a touch of elegance and romance to weddings and events.',
                        'about_brand_ar'      => 'هومي إيفنتس متخصصون في منتجات الأفراح والديكور.',
                        'about_brand_en'      => 'Homey Events specializes in wedding and decoration products.',

                        'regular_price'       => 600, 
                        'sale_price'          => 480, 
                        'discount_percentage' => round((120 / 600) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 30, 
                        'alt'                 => 'كرسي فرح أبيض مزخرف بورد بينك أنيق',
                        'slug'                => 'white-wedding-chair-pink-flowers',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => true,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10005, 
                        'name_ar'             => 'كرسي تسريحة خشبي بمقعد وظهر قطن وقماش',
                        'name_en'             => 'Wooden Vanity Chair with Cotton Fabric Seat and Back',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كرسي تسريحة أنيق مصنوع من الخشب الطبيعي مع مقعد وظهر مبطنين بالقطن ومغطّين بالقماش الناعم لراحة إضافية أثناء الاستخدام اليومي.',
                        'description_en'      => 'Elegant wooden vanity chair with a cotton-padded seat and back, covered with soft fabric for extra comfort during daily use.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الكراسي والديكور العصري.',
                        'about_brand_en'      => 'Homey Furniture specializes in chairs and modern home décor.',

                        'regular_price'       => 200, 
                        'sale_price'          => 160, 
                        'discount_percentage' => round((40 / 200) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 25, 
                        'alt'                 => 'كرسي تسريحة خشبي بمقعد وظهر قطن وقماش مريح',
                        'slug'                => 'wooden-vanity-chair-cotton-fabric',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10006, 
                        'name_ar'             => 'كرسي أنتريه خشبي بمقعد وظهر قطن وقماش',
                        'name_en'             => 'Wooden Armchair with Cotton Fabric Seat and Back',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كرسي أنتريه أنيق مصنوع من الخشب المتين مع مقعد وظهر مبطنين بالقطن ومغطّين بالقماش الناعم لراحة إضافية وإطلالة عصرية لغرفة المعيشة أو الاستقبال.',
                        'description_en'      => 'Elegant wooden armchair with a cotton-padded seat and back, covered with soft fabric for extra comfort and a modern look for your living room or lounge.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الأنتريهات والديكور العصري.',
                        'about_brand_en'      => 'Homey Furniture specializes in armchairs and modern home décor.',

                        'regular_price'       => 200, 
                        'sale_price'          => 160, 
                        'discount_percentage' => round((40 / 200) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 25, 
                        'alt'                 => 'كرسي أنتريه خشبي بمقعد وظهر قطن وقماش مريح',
                        'slug'                => 'wooden-armchair-cotton-fabric',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10007, 
                        'name_ar'             => 'كرسي قماش بقاعدة خشبية',
                        'name_en'             => 'Fabric Chair with Wooden Legs',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كرسي أنيق بقاعدة خشبية قوية مع مقعد وظهر مبطنين بالكامل بالقطن ومغطّين بالقماش الناعم، مناسب لغرف المعيشة أو المكاتب.',
                        'description_en'      => 'Elegant chair with sturdy wooden legs, fully padded with cotton and upholstered in soft fabric, perfect for living rooms or offices.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الأنتريهات والديكور العصري.',
                        'about_brand_en'      => 'Homey Furniture specializes in armchairs and modern home décor.',

                        'regular_price'       => 180, 
                        'sale_price'          => 150, 
                        'discount_percentage' => round((30 / 180) * 100, 2), // 16.67%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 30, 
                        'alt'                 => 'كرسي قماش مريح بقاعدة خشبية',
                        'slug'                => 'fabric-chair-wooden-legs',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10008, 
                        'name_ar'             => 'كنبة مودرن قابلة للتحول إلى سرير',
                        'name_en'             => 'Modern Sofa Bed',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كنبة مودرن أنيقة متعددة الاستخدامات، يمكن استخدامها كأريكة مريحة للجلوس أو تحويلها بسهولة إلى سرير للنوم. تصميم عصري يناسب غرف المعيشة أو الضيوف.',
                        'description_en'      => 'Elegant modern sofa bed with versatile design, serving as a comfortable sofa for seating and easily convertible into a bed for sleeping. Perfect for living rooms or guest rooms.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الأنتريهات والديكور العصري.',
                        'about_brand_en'      => 'Homey Furniture specializes in modern sofas and home décor.',

                        'regular_price'       => 1200, 
                        'sale_price'          => 950, 
                        'discount_percentage' => round((250 / 1200) * 100, 2), // 20.83%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 15, 
                        'alt'                 => 'كنبة مودرن تتحول إلى سرير مريح',
                        'slug'                => 'modern-sofa-bed',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10009, 
                        'name_ar'             => 'كنبة خشب مع مخدات مريحة',
                        'name_en'             => 'Wooden Sofa with Cushions',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كنبة خشبية أنيقة مزودة بمخدات مريحة للجلوس والاتكاء. تصميم عملي يجمع بين المتانة والراحة، مناسب لغرف المعيشة أو الشرفات المغلقة.',
                        'description_en'      => 'Elegant wooden sofa with comfortable cushions for seating and lounging. A practical design combining durability and comfort, perfect for living rooms or enclosed balconies.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الأنتريهات والديكور العصري.',
                        'about_brand_en'      => 'Homey Furniture specializes in sofas and modern home décor.',

                        'regular_price'       => 950, 
                        'sale_price'          => 750, 
                        'discount_percentage' => round((200 / 950) * 100, 2), // 21.05%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 20, 
                        'alt'                 => 'كنبة خشب أنيقة مع مخدات مريحة',
                        'slug'                => 'wooden-sofa-with-cushions',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => true,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10010, 
                        'name_ar'             => 'كنبة كلاسيك باللون الأزرق',
                        'name_en'             => 'Classic Blue Sofa',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'كنبة كلاسيك أنيقة باللون الأزرق، تجمع بين التصميم التقليدي والراحة العالية. مناسبة لغرف المعيشة الراقية أو صالات الاستقبال.',
                        'description_en'      => 'Elegant classic sofa in blue, combining traditional design with high comfort. Perfect for stylish living rooms or reception areas.',
                        'about_brand_ar'      => 'هومي للأثاث متخصصون في الكلاسيكيات والديكور الراقي.',
                        'about_brand_en'      => 'Homey Furniture specializes in classic furniture and elegant décor.',

                        'regular_price'       => 1100, 
                        'sale_price'          => 880, 
                        'discount_percentage' => round((220 / 1100) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 12, 
                        'alt'                 => 'كنبة كلاسيك باللون الأزرق أنيقة ومريحة',
                        'slug'                => 'classic-blue-sofa',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10011, 
                        'name_ar'             => 'إطار حائط بطول الحائط',
                        'name_en'             => 'Full Wall Frame',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'إطار حائط أنيق بتصميم ممتد بطول الحائط، مثالي لإضافة لمسة ديكور فاخرة وعصرية لغرف المعيشة أو المكاتب.',
                        'description_en'      => 'Elegant wall frame with a full-length design, perfect for adding a luxurious and modern decorative touch to living rooms or offices.',
                        'about_brand_ar'      => 'هومي للديكور متخصصون في إطارات الحائط والديكورات العصرية.',
                        'about_brand_en'      => 'Homey Décor specializes in wall frames and modern decorations.',

                        'regular_price'       => 900, 
                        'sale_price'          => 750, 
                        'discount_percentage' => round((150 / 900) * 100, 2), // 16.67%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 8, 
                        'alt'                 => 'إطار حائط بطول الحائط بتصميم عصري',
                        'slug'                => 'full-wall-frame',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10012, 
                        'name_ar'             => 'طقم 6 إطارات حائط بمقاسات مختلفة باللون الزيتوني والمينت جرين',
                        'name_en'             => 'Set of 6 Wall Frames in Olive and Mint Green',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'طقم مكون من 6 إطارات حائط أنيقة بأحجام مختلفة، باللون الزيتوني والمينت جرين لإضافة لمسة عصرية وحيوية لديكور المنزل أو المكتب.',
                        'description_en'      => 'A set of 6 elegant wall frames in various sizes, designed in olive and mint green colors to add a modern and lively touch to your home or office décor.',
                        'about_brand_ar'      => 'هومي ديكور متخصصون في إطارات الحائط والديكورات المودرن.',
                        'about_brand_en'      => 'Homey Décor specializes in modern wall frames and stylish decorations.',

                        'regular_price'       => 600, 
                        'sale_price'          => 480, 
                        'discount_percentage' => round((120 / 600) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 20, 
                        'alt'                 => 'طقم 6 إطارات حائط بمقاسات مختلفة باللون الزيتوني والمينت جرين',
                        'slug'                => 'set-6-wall-frames-olive-mint-green',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10013, 
                        'name_ar'             => 'طقم 5 إطارات طاولة بألوان ومقاسات مختلفة مع حدود بيضاء',
                        'name_en'             => 'Set of 5 Table Frames in Different Colors and Sizes with White Borders',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'طقم مكون من 5 إطارات طاولة أنيقة بألوان ومقاسات مختلفة، مزودة بحدود خارجية باللون الأبيض لإضافة لمسة جمالية وعصرية للمكاتب وغرف المعيشة.',
                        'description_en'      => 'A set of 5 elegant table frames in different colors and sizes, featuring white outer borders to add a stylish and modern touch to offices and living rooms.',
                        'about_brand_ar'      => 'هومي ديكور متخصصون في إطارات الطاولات والديكورات العصرية.',
                        'about_brand_en'      => 'Homey Décor specializes in modern table frames and stylish decorations.',

                        'regular_price'       => 400, 
                        'sale_price'          => 320, 
                        'discount_percentage' => round((80 / 400) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 25, 
                        'alt'                 => 'طقم 5 إطارات طاولة بألوان ومقاسات مختلفة مع حدود خارجية بيضاء',
                        'slug'                => 'set-5-table-frames-white-borders',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10014, 
                        'name_ar'             => 'إطارات طاولة بألوان ومقاسات مختلفة مع حدود سوداء',
                        'name_en'             => 'Table Frames in Different Colors and Sizes with Black Borders',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'إطارات طاولة أنيقة بألوان ومقاسات متنوعة، مصممة بحدود خارجية باللون الأسود لإضفاء لمسة من الفخامة والعصرية على ديكور غرف المعيشة والمكاتب.',
                        'description_en'      => 'Elegant table frames in different colors and sizes, designed with black outer borders to add a touch of luxury and modernity to living rooms and office décor.',
                        'about_brand_ar'      => 'هومي ديكور متخصصون في إطارات الطاولات والديكورات العصرية.',
                        'about_brand_en'      => 'Homey Décor specializes in modern table frames and stylish decorations.',

                        'regular_price'       => 420, 
                        'sale_price'          => 340, 
                        'discount_percentage' => round((80 / 420) * 100, 2), // 19.05%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 20, 
                        'alt'                 => 'إطارات طاولة بألوان ومقاسات مختلفة مع حدود سوداء',
                        'slug'                => 'table-frames-black-borders',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10015, 
                        'name_ar'             => 'شجرة ديكور قصيرة مزينة بورود بينك وأخضر',
                        'name_en'             => 'Short Decorative Tree with Pink and Green Flowers',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'شجرة ديكور قصيرة أنيقة مزينة بورود باللون الوردي والأخضر، تضيف لمسة جمالية وحيوية للمنازل، المكاتب، وقاعات المناسبات.',
                        'description_en'      => 'Elegant short decorative tree adorned with pink and green flowers, adding beauty and liveliness to homes, offices, and event halls.',
                        'about_brand_ar'      => 'هومي ديكور متخصصون في الأشجار الصناعية والديكورات العصرية.',
                        'about_brand_en'      => 'Homey Décor specializes in artificial trees and modern decorations.',

                        'regular_price'       => 350, 
                        'sale_price'          => 280, 
                        'discount_percentage' => round((70 / 350) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 18, 
                        'alt'                 => 'شجرة ديكور قصيرة مزينة بورود بينك وأخضر',
                        'slug'                => 'short-decor-tree-pink-green',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10016, 
                        'name_ar'             => 'شجرة ديكور طويلة في إناء بني',
                        'name_en'             => 'Tall Decorative Tree in Brown Pot',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'شجرة ديكور طويلة أنيقة موضوعة في إناء بني أنيق، تضيف لمسة طبيعية وجمالية للمنازل، المكاتب، والفنادق.',
                        'description_en'      => 'Elegant tall decorative tree placed in a stylish brown pot, adding a natural and aesthetic touch to homes, offices, and hotels.',
                        'about_brand_ar'      => 'هومي ديكور متخصصون في الأشجار الصناعية والديكورات العصرية.',
                        'about_brand_en'      => 'Homey Décor specializes in artificial trees and modern decorations.',

                        'regular_price'       => 600, 
                        'sale_price'          => 480, 
                        'discount_percentage' => round((120 / 600) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 12, 
                        'alt'                 => 'شجرة ديكور طويلة في إناء بني أنيق',
                        'slug'                => 'tall-decor-tree-brown-pot',
                        'is_brand'            => 0,
                        'indoor'              => true,
                        'outdoor'             => false,
                        'unique'              => true, 
                       ],
                       [
                        'img'                 => 'images/products',
                        'barcode'             => 10017, 
                        'name_ar'             => 'شجرة ديكور خارجية طويلة بأوراق كثيفة',
                        'name_en'             => 'Tall Outdoor Decorative Tree with Dense Leaves',

                        'seller_name'         => 'Homey',
                        'brand_name'          => 'Homey',
                        'day_order'           => 0,
                        'is_order'            => 1,

                        'description_ar'      => 'شجرة ديكور خارجية طويلة بأوراق خضراء كثيفة تضفي مظهراً طبيعياً وحيوياً على الحدائق، الشرفات والمساحات المفتوحة.',
                        'description_en'      => 'Tall outdoor decorative tree with dense green leaves, adding a natural and lively look to gardens, balconies, and open spaces.',
                        'about_brand_ar'      => 'هومي ديكور تقدم مجموعة مميزة من الأشجار الصناعية المقاومة للعوامل الخارجية.',
                        'about_brand_en'      => 'Homey Décor offers a wide collection of artificial trees resistant to outdoor conditions.',

                        'regular_price'       => 750, 
                        'sale_price'          => 600, 
                        'discount_percentage' => round((150 / 750) * 100, 2), // 20%
                        'in_sale'             => 1,
                        'is_best'             => 1,
                        'is_recommended'      => 1, 
                        'is_clothes'          => 0, 
                        'has_options'         => 0, 
                        'start_sale'          => '2025-09-20',
                        'end_sale'            => '2025-09-30',
                        'quantity'            => 8, 
                        'alt'                 => 'شجرة ديكور خارجية طويلة بأوراق كثيفة',
                        'slug'                => 'tall-outdoor-decor-tree-dense-leaves',
                        'is_brand'            => 0,
                        'indoor'              => false,
                        'outdoor'             => true,
                        'unique'              => true, 
                       ]


 













           
        ];


        Product::insert($products);
    }
}
