<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use FireBender\Laravel\PictureWorks\Services\UserService;

class ModifyCommentsCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'z:comments:modify 
                            {id : The ID of the user record to modify}
                            {password : Password (720DF6C2482218518FA20FDC52D4DED7ECC043AB)}
                            {comments : The new comments to overwrite with}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifies comments on a user entry';

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

        $password = $this->argument('password');
        $password = Str::upper($password);

        if ($password !== '720DF6C2482218518FA20FDC52D4DED7ECC043AB')
        {
            $format = 'Invalid password: %s';
            $message = sprintf($format, $password);
            $this->error($message);

            return Command::FAILURE;
        }

        $comments = $this->argument('comments');

        $params['id'] = $id;
        $params['comments'] = $comments;

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
