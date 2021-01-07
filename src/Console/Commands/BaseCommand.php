<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
    /**
     * Write a string as error output.
     *
     * @param  string  $string
     * @param  int|string|null  $verbosity
     * @return void
     */
    public function success($string, $verbosity = null)
    {
        $format = '<fg=green>%s';
        $message = sprintf($format, $string);
        $this->line($message);
    }    
}
