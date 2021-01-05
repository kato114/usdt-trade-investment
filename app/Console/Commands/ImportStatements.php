<?php

namespace App\Console\Commands;

use App\Foundation\Statement\DomExtract;
use Illuminate\Console\Command;

class ImportStatements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:statements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap data from meta trader statements';

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
        $dir = env("FTP_DIR");
        $files = files_in_dir($dir, ["htm"]);
        foreach ($files as $file) {
            try {
                DomExtract::process($file);
            } catch (\Throwable $e) {
                report($e);
            }
        }
        $this->comment("Peak Memory:" . memory_get_peak_usage());
    }
}
