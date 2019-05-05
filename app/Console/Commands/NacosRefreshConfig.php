<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NacosRefreshConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '立刻从nacos配置中心获取配置文件';

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
     * @return mixed
     */
    public function handle()
    {
        // load nacos config file
        (new \Dotenv\Loader([], new \Dotenv\Environment\DotenvFactory(), true))->loadDirect(
            \alibaba\nacos\Nacos::init(
                getenv("LARAVEL_NACOS_HOST"),
                getenv("LARAVEL_ENV"),
                getenv("LARAVEL_NACOS_DATAID"),
                getenv("LARAVEL_NACOS_GROUPID"),
                getenv("LARAVEL_NACOS_NAMESPACEID") ? : "",
            )->runOnce()
        );
    }
}
