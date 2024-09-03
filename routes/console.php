<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('app:archieve-advertisement', function () {
    $this->info('advertisment has been archived');
})->cron('* 00,* * * *')->timezone('Asia/Riyadh');
