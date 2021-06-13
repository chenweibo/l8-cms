<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create system admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('输入账号( 邮箱格式 )');
        if (!User::where("email", $email)->get()->isEmpty()) {
            $this->error('用户已经存在.');
            return 'ok';
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $password = $this->ask('输入密码.');

            $isAdmin = $this->choice(
                '选择用户权限',
                ['普通管理员', '总管理员'],
                0
            );
            User::create([
                'name' => $email,
                'email' => $email,
                'isAdmin' => $isAdmin == '总管理员' ? 1 : 0,
                'password' => Hash::make($password),
            ]);
            $this->info('账号创建成功.');
            return 'ok';
        } else {
            $this->error('邮箱格式不合法.');
            return 'ok';
        }
    }
}
