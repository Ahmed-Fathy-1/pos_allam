<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class SiteMapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'Generate sitemap to all route to seo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SitemapGenerator::create('https://aitech.net.au/butcher/')
            ->writeToFile(storage_path('app/public/sitemap/sitemap.xml'));
    }
}
