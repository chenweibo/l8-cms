<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string = '[[{"id":10,"label":"\u5e7b\u706f\u7247_\u6807\u9898","column":"banner_title","note":null,"value":"1","type":"FormInput","scope":4},{"id":11,"label":"\u5e7b\u706f\u7247_pc\u56fe\u7247","column":"banner_url","note":null,"value":"\/static\/uploads\/2021\/09\/07\/49d36c473c096e4032ad40af360d8fa6.jpeg","type":"OneUpload","scope":4},{"id":12,"label":"\u5e7b\u706f\u7247_mobile\u56fe\u7247","column":"banner_m_url","note":null,"value":null,"type":"OneUpload","scope":4},{"id":13,"label":"\u5e7b\u706f\u7247_\u94fe\u63a5","column":"banner_link","note":null,"value":null,"type":"FormInput","scope":4},{"id":14,"label":"\u5e7b\u706f\u7247_\u81ea\u5b9a\u4e49\u6587\u5b57","column":"banner_c_t","note":null,"value":null,"type":"FormInput","scope":4}],[{"id":10,"label":"\u5e7b\u706f\u7247_\u6807\u9898","column":"banner_title","note":null,"value":"2","type":"FormInput","scope":4},{"id":11,"label":"\u5e7b\u706f\u7247_pc\u56fe\u7247","column":"banner_url","note":null,"value":"\/static\/uploads\/2021\/09\/07\/49d36c473c096e4032ad40af360d8fa6.jpeg","type":"OneUpload","scope":4},{"id":12,"label":"\u5e7b\u706f\u7247_mobile\u56fe\u7247","column":"banner_m_url","note":null,"value":null,"type":"OneUpload","scope":4},{"id":13,"label":"\u5e7b\u706f\u7247_\u94fe\u63a5","column":"banner_link","note":null,"value":null,"type":"FormInput","scope":4},{"id":14,"label":"\u5e7b\u706f\u7247_\u81ea\u5b9a\u4e49\u6587\u5b57","column":"banner_c_t","note":null,"value":null,"type":"FormInput","scope":4}]]';
        Banner::create(['name' => '首页', 'description' => 0, 'banners' => json_decode($string)]);
    }
}
