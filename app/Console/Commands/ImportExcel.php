<?php

namespace App\Console\Commands;

use App\Imports\ManifestImport;
use Illuminate\Console\Command;

class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Excel importer';

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
        $this->output->title('Starting Importing');
        (new ManifestImport)->withOutput($this->output)->import(request()->file('manifest_file'));
        $this->output->success('Manifest Imported successful');
    }
}
