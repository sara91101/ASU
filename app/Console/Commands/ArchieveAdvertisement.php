<?php

namespace App\Console\Commands;

use App\Models\Advertisement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class ArchieveAdvertisement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archieve-advertisement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive finished Advertisments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = date("Y-m-d");
        Advertisement::whereNot("archieve",1)->whereDate('end_time', "<", $today)->update(["archieve" => 1]);

        return $this->info('advertisment has been archived');
    }
}
