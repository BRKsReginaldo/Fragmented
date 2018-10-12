<?php

namespace BRKsReginaldo\Fragmented\Console;


use BRKsReginaldo\Fragmented\FileStub;
use BRKsReginaldo\Fragmented\StubReplaces;
use Illuminate\Console\Command;
use Symfony\Component\VarDumper\Caster\ClassStub;

class FragmentMakeCommand extends Command
{
    protected $name = 'fragment:make';

    protected $signature = 'fragment:make {module}';

    protected $description = 'creates a new fragment';

    protected $files = [];

    public function __construct()
    {
        parent::__construct();
        $this->files = config('fragmented.generateFiles');
    }

    public function handle()
    {
        if (is_dir($this->getModuleFolder())) {
            return $this->error('Module already exists!');
        }

        mkdir($this->getModuleFolder());

        $this->copyFiles();
    }

    /**
     *  Get module folder based on its name
     */
    protected function getModuleFolder()
    {
        return base_path(config('fragmented.modules_folder')) . '/' . $this->argument('module');
    }

    /**
     *  Copy all stubs for module folder
     */
    protected function copyFiles()
    {
        // Iterate through each file on files array
        foreach ($this->files as $file => $destiny) {
            // Create a new stub based on the array
            $stub = FileStub::create(__DIR__ . '/stubs/' . $file, $this->getReplaces());
            // Copy the stub for the destiny folder
            if (!$stub->copy($this->getModuleFolder() . '/' . $this->parseDestinyFile($destiny))) {
                // Error message in case of being unable to copy the stub to destiny
                $this->error("Unable to copy $file file");
            }
        }
    }

    /**
     *  Return all string replaces for use in stub files
     * @return array
     */
    public function getReplaces()
    {
        return StubReplaces::getReplaces($this->argument('module'));
    }

    /**
     * Parse dinamic controller name
     */
    public function parseDestinyFile($destiny)
    {
        foreach ($this->getReplaces() as $key => $value) {
            $destiny = str_replace("$" . $key . "$", $value, $destiny);
        }

        return $destiny;
    }
}