<?php

namespace Yuanrang\LaravelShop\Wap\Member\Console\Commands;

use Illuminate\Console\Command;

class installCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wap-member:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '这个是wap下的member组件安装命令';

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
        $this->call('migrate');
        $this->call('vendor:publish', [
            '--provider' => 'Yuanrang\LaravelShop\Wap\Member\Providers\MemberServiceProviders'
        ]);
    }
}
