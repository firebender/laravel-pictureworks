<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use FireBender\Laravel\PictureWorks\Services\UserService;

class GetUsersCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'z:users:get 
                            {--page= : Page to retrieve from the query} 
                            {--per-page= : Number of entries per page} 
                            {--seed= : Count of entries for seeding}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets users by page';

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
        $page = $this->option('page');
        if ($page === null)
        {
            $page = 1;
        }
        else
        {
            if (!is_numeric($page))
            {
                $message = 'Option page must be a numeric value';
                $this->error($message);
                return Command::FAILURE;
            }
        }

        $per_page = $this->option('per-page');
        if ($per_page === null)
        {
            $per_page = 10;
        }
        else
        {
            if (!is_numeric($per_page))
            {
                $message = 'Option per-page must be a numeric value';
                $this->error($message);
                return Command::FAILURE;
            }
        }

        $seed = $this->option('seed');

        if ($seed !== null && !is_numeric($seed))
        {
            $message = 'Option seed must be a numeric value';
            $this->error($message);
            return Command::FAILURE;
        }

        if ($seed !== null)
        {
            $this->service->seed($seed);
        }

        $users = $this->service->getPagedUsers($page, $per_page);

        if (count($users->items()) == 0)
        {
            $message = 'No users queried';
            $this->error($message);

            return Command::FAILURE;
        }

        $table = new Table($this->output);

        $table->setHeaderTitle('Users');

        $table->setHeaders(['ID', 'Name', 'Comments']);

        $table->setColumnMaxWidth(0, 5);
        $table->setColumnMaxWidth(2, 150);

        foreach ($users->items() as $user)
        {
            $table->addRow([
                $user->id,
                $user->name,
                $user->comments,
            ]);

            $table->addRow(new TableSeparator());
        }

        $format = 'Page %d';
        $title = sprintf($format, $page);
        $table->setFooterTitle($title);

        $table->render();

        return Command::SUCCESS;
    }
}
