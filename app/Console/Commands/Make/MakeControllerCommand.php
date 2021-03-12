<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:custom-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';


    public function handle()
    {
        $name = $this->argument('name');

        // 處理建立 controller 邏輯
        $this->makeController($name);

        $this->info($this->type.' created successfully.');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        // TODO: Implement getStub() method.
        return file_get_contents(__DIR__ . '/Stubs/Controller.stub');
    }

    protected function makeController($name)
    {
        $explodeName = explode('_', str::snake($name))[0];
        $nameService = $explodeName . 'Service';

        $controllerTemplate = str_replace(
            [
                '{{NameController}}',
                '{{NameService}}',
                '{{NameLowerService}}',
            ],
            [
                $name,
                ucfirst($nameService),
                $nameService
            ],
            $this->getStub()
        );

        file_put_contents(app_path("/Http/Controllers/{$name}.php"), $controllerTemplate);
    }

}
