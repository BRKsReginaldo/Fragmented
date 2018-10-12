<?php

namespace BRKsReginaldo\Fragmented;


class FileStub
{
    /** The original stub path */
    public $path;
    /** The values to be replaced on the file */
    public $replaces;
    /** The file original text*/
    public $text;

    public function __construct($path, $replaces = [])
    {
        $this->path = $path;
        $this->replaces = $replaces;
        $this->text = file_get_contents($path);
    }

    public static function create()
    {
        return new self(...func_get_args());
    }

    public function copy($destiny)
    {
        $this->replaceValues();
        $destinyFolder = str_replace(strrchr($destiny, '/'), '', $destiny);

        if (!is_dir($destinyFolder)) mkdir($destinyFolder, 0777, true);

        try {
            file_put_contents($destiny, $this->text);
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    public function replaceValues()
    {
        foreach ($this->replaces as $key => $value) {
            $this->text = str_replace("$" . $key . "$", $value, $this->text);
        }
    }
}