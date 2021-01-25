<?php

namespace Absolute\DotEnvManipulator\Commands;

use Illuminate\Console\Command;
use Absolute\DotEnvManipulator\Libs\DotEnv;
use Symfony\Component\Console\Input\InputArgument;

class DotEnvGet extends Command
{
    protected $name = 'dotenv:get';
    protected $description = 'Get the value of a specific dotenv variable.';

    public function handle()
    {
        $key = $this->argument('key');
        $path = $this->option('path');
        $file = $this->option('file');
        $dotenv = new DotEnv($path, $file);
        if ($dotenv->has($key)) {
            $this->comment($dotenv->get($key));

            return true;
        }
        $this->error('The dotenv variable "'.$key.'" doesn\'t exist!');
    }

    protected function getArguments()
    {
        return [
            ['key', InputArgument::REQUIRED, 'The ENV_VAR to handle'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['path', null, InputArgument::OPTIONAL, 'The path to the env file', base_path()],
            ['file', null, InputArgument::OPTIONAL, 'The name of the env file', '.env'],
        ];
    }
}
