<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => '首页', 'type' => 0, 'url' => '/', 'detail' => [], 'columnTemplate' => 'index.blade.php', 'controller' => 'BusinessController', 'function' => 'index']);
        $about = Category::create(['name' => '关于我们', 'type' => 2, 'url' => 'about', 'detail' => [], 'columnTemplate' => 'index.blade.php', 'controller' => 'BusinessController', 'function' => 'page']);
        $about->article()->save(new Content(['name' => '关于我们']));
        $news = Category::create(['name' => '新闻资讯', 'type' => 3, 'url' => 'news', 'detail' => [], 'columnTemplate' => 'news.blade.php', 'controller' => 'BusinessController', 'function' => 'list']);
        Category::create(['name' => '公司新闻', 'type' => 3, 'url' => 'news', 'detail' => [], 'columnTemplate' => 'news.blade.php', 'contentTemplate' => 'newsView.blade.php', 'controller' => 'BusinessController', 'function' => 'list'], $news);
        Category::create(['name' => '行业新闻', 'type' => 3, 'url' => 'news', 'detail' => [], 'columnTemplate' => 'news.blade.php', 'contentTemplate' => 'newsView.blade.php', 'controller' => 'BusinessController', 'function' => 'list'], $news);
        $product = Category::create(['name' => '产品中心', 'type' => 3, 'url' => 'product', 'detail' => [], 'columnTemplate' => 'product.blade.php', 'contentTemplate' => 'productView.blade.php', 'controller' => 'BusinessController', 'function' => 'list']);
        Category::create(['name' => '产品类目一', 'type' => 3, 'url' => 'product', 'detail' => [], 'columnTemplate' => 'product.blade.php', 'contentTemplate' => 'productView.blade.php', 'controller' => 'BusinessController', 'function' => 'list'], $product);
        $contact = Category::create(['name' => '联系我们', 'type' => 2, 'url' => 'contact', 'detail' => [], 'columnTemplate' => 'contact.blade.php', 'controller' => 'BusinessController', 'function' => 'page']);
        $contact->article()->save(new Content(['name' => '联系我们']));
    }
}
