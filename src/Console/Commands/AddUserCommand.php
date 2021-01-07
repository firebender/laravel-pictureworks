<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use FireBender\Laravel\PictureWorks\Services\UserService;

class AddUserCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'z:user:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a user. Interactive';

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
        $name = $this->ask('Name');

        $comments = $this->ask('Comments');

        $message = 'Will add a user with the following parameters';
        $this->line($message);

        $format = 'Name: %s';
        $message = sprintf($format, $name);
        $this->line($message);

        $format = 'Comments: %s';
        $message = sprintf($format, $name);
        $this->line($message);

        $continue = $this->confirm('Do you wish to continue?');

        if ($continue === false)
        {
            $this->info('Aborting...');
            return Command::SUCCESS;
        }

        $params = [
            'name' => $name,
            'comments' => $comments,
        ];

        $user = $this->service->addUser($params);

        $format = 'Success. Added the following user user with id %d';
        $message = sprintf($format, $user->id);
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
