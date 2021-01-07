<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use FireBender\Laravel\PictureWorks\Services\UserService;

class SeedUsersCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:seed {count : Count of entries to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds users table';

    /**
     * The UserService
     *
     * @var FireBender\Laravel\PictureWorks\Services\UserService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');

        if (!is_numeric($count))
        {
            $message = 'Count must be a numeric value';
            $this->error($message);
            return Command::FAILURE;
        }

        $this->service->seed($count);

        $format = 'Success. Seeded users table with %d rows';
        $message = sprintf($format, $count);
        $this->success($message);

        return Command::SUCCESS;
    }
}
