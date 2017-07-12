<?php

namespace App\Console\Commands;

use function foo\func;
use Illuminate\Console\Command;
use Sco\Admin\Models\Permission;

class RouteGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $list = (new Permission())->getMenuList();
        $routes = $this->parseRoute($list);
        dd($routes->toArray());
    }

    private function parseRoute($routes)
    {
        $return = $routes->map(function ($route, $key) {
            $data = collect();
            $data->put('path', $route->name == '#' ? '#' : route($route->name, [], false));
            $data->put('name', $route->name);
            $data->put('title', $route->display_name);
            if (!$route->child->isEmpty()) {
                $data->put('children', $this->parseRoute($route->child));
            }
            return $data;
        });
        return $return;
    }
}
