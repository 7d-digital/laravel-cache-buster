<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheBuster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:bust';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment the cache buster';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Busting cache...');

        $wasUpdated = false;
        $file = file('.env');
        foreach ($file as $i => $line) {
            if (strpos($line, 'CACHE_BUSTER') !== false) {
                list($name, $value) = explode('=', $line);
                $file[$i] = sprintf("%s=%d\n", $name, intval($value) + 1);
                $wasUpdated = true;
            }
        }

        if ($wasUpdated === false) {
            $file[] = sprintf("\nCACHE_BUSTER=%d\n", 1);
        }

        file_put_contents('.env', implode("", $file));

        $this->info('Cache busted!');
    }
}

