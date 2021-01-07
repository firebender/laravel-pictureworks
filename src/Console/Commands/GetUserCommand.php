<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use FireBender\Laravel\PictureWorks\Services\UserService;
use FireBender\Laravel\PictureWorks\Database\Seeders\UserSeeder;

class GetUserCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:get {id : The ID of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a specified user row by ID';

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
        $id = $this->argument('id');

        if (!is_numeric($id))
        {
            $message = 'Argument ID must be a numeric value';
            $this->error($message);

            return Command::FAILURE;
        }

        $user = $this->service->getUserById($id);

        if ($user === null)
        {
            $format = 'User with id %d not found';
            $message = sprintf($format, $id);
            $this->error($message);

            return Command::FAILURE;
        }

        $format = 'Success. Showing user with id %d';
        $message = sprintf($format, $id);
        $this->success($message);

        $format = 'Name: %s';
        $message = sprintf($format, $user->name);
        $this->line($message);

        $format = 'Comments: %s';
        $message = sprintf($format, $user->comments);
        $this->line($message);

        return Command::SUCCESS;
    }
}
