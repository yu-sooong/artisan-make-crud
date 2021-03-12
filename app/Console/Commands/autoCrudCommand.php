<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class autoCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '建立crud範本';

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
     * @param Filesystem $files
     * @return void
     */
    public function handle(Filesystem $files)
    {
        $askInput = $this->ask('請輸入要創建的 Controller、Service、Repository 名稱為 ex: (Game)?');

        if (!preg_match('/^[A-Za-z0-9]+$/', $askInput)) {
            $this->error('請輸入正確的格式, 需符合英數字');
        }
        if ($askInput) {

            $nameController = $askInput . 'Controller';
            $nameService = $askInput . 'Service';
            $nameRepository = $askInput . 'Repository';

            if ($this->confirm("請確認是否創建 $nameController 、 $nameService 、 $nameRepository ?")) {

                Artisan::call('make:custom-controller', ['name' => $nameController]);
                $this->info(Artisan::output());

                Artisan::call('make:service', ['name' => $nameService]);
                $this->info(Artisan::output());

                Artisan::call('make:repository', ['name' => $nameRepository]);
                $this->info(Artisan::output());

                if ($askApiName = $this->ask('請輸入 api 路由名稱?')) {
                    $apiName = Str::plural(strtolower($askApiName));
                    $files->append(
                        base_path('routes/api.php'),
                        'Route::resource(\'' . $apiName . "', '$nameController');"
                    );
                    $this->info('建立完成');
                }
            }
        }

    }
}
