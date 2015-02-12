<?php namespace Modules\Core\Console;

use Illuminate\Console\Command;

class PublishThemeAssetsCommand extends Command
{
    protected $name = 'asgard:publish:theme';
    protected $description = 'Publish theme assets';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $this->call('stylist:publish');
    }
}
