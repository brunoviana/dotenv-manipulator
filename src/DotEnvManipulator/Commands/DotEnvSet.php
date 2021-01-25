<?php

namespace Absolute\DotEnvManipulator\Commands;

use Illuminate\Console\Command;
use Absolute\DotEnvManipulator\Libs\DotEnv;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DotEnvSet extends Command
{
    protected $name = 'dotenv:set';
    protected $description = 'Set the value of a specific dotenv variable.';

    public function handle()
    {
        $key = $this->argument('key');
        $value = $this->option('value');
        $path = $this->option('path');
        $file = $this->option('file');
        $dotenv = new DotEnv($path, $file);
        $dotenv->set($key, $value)->write();
    }

    protected function getOptions()
    {
        return [
            ['value', null, InputOption::VALUE_REQUIRED, 'The new value for the specified ENV_VAR'],
            ['path', null, InputArgument::OPTIONAL, 'The path to the env file', base_path()],
            ['file', null, InputArgument::OPTIONAL, 'The name of the env file', '.env'],
        ];
    }

    protected function getArguments()
    {
        return [
            ['key', InputArgument::REQUIRED, 'The ENV_VAR to handle'],
        ];
    }
}
