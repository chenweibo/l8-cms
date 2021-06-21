<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $basic = [
            ['label' => '站点标题', 'column' => 'title', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '站点logo', 'column' => 'logo', 'note' => null, 'value' => null, 'type' => 'OneUpload', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '站点关键词', 'column' => 'keywords', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '站点描述', 'column' => 'description', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '公司地址', 'column' => 'address', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '座机', 'column' => 'landline', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '手机号码', 'column' => 'phone', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '邮箱', 'column' => 'email', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'icp备案号', 'column' => 'icp', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 0, 'created_at' => $now, 'updated_at' => $now],
        ];
        $banner = [
            ['label' => '幻灯片_标题', 'column' => 'banner_title', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '幻灯片_pc图片', 'column' => 'banner_url', 'note' => null, 'value' => null, 'type' => 'OneUpload', 'scope' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '幻灯片_mobile图片', 'column' => 'banner_m_url', 'note' => null, 'value' => null, 'type' => 'OneUpload', 'scope' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '幻灯片_链接', 'column' => 'banner_link', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '幻灯片_自定义文字', 'column' => 'banner_c_t', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 4, 'created_at' => $now, 'updated_at' => $now],
        ];

        $menu = [['label' => '栏目图', 'column' => 'img', 'note' => null, 'value' => null, 'type' => 'OneUpload', 'scope' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];

        $page = [
            ['label' => '页面关键词', 'column' => 'keywords', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '页面描述', 'column' => 'description', 'note' => null, 'value' => null, 'type' => 'FormInput', 'scope' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '内容', 'column' => 'info', 'note' => null, 'value' => null, 'type' => 'Tinymce', 'scope' => 2, 'created_at' => $now, 'updated_at' => $now],
        ];
        $content = [
            ['label' => '内容', 'column' => 'info', 'note' => null, 'value' => null, 'type' => 'Tinymce', 'scope' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '缩略图', 'column' => 'img', 'note' => null, 'value' => null, 'type' => 'OneUpload', 'scope' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['label' => '多图上传', 'column' => 'imgList', 'note' => null, 'value' => null, 'type' => 'MultiUpload', 'scope' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];

        $result = array_merge($basic, $banner, $menu, $page, $content);

        DB::table('components')->insert($result);
    }
}
