<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use FireBender\Laravel\PictureWorks\Services\UserService;

class ModifyUserCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:modify {id} {--name=} {--comments=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifies a user';

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

        $name = $this->option('name');
        $comments = $this->option('comments');

        if ($name === false && $comments === false)
        {
            $message = 'Name and/or comments is required';
            $this->error($message);
            return Command::FAILURE;
        }

        $params['id'] = $id;

        if ($name !== false)
        {
            $params['name'] = $name;
        }

        if ($comments !== false)
        {
            $params['comments'] = $comments;
        }

        $user = $this->service->modifyUser($params);

        $format = 'Success. User with id %d modified';
        $message = sprintf($format, $id);
        $this->success($message);

        $message = 'New user data:';
        $this->line($message);

        $format = 'Name: %s';
        $message = sprintf($format, $user->name);
        $this->line($message);

        $format = 'Comments: %s';
        $message = sprintf($format, $user->comments);
        $this->line($message);

    }
}
