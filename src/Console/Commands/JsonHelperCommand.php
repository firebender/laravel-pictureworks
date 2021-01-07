<?php

namespace FireBender\Laravel\PictureWorks\Console\Commands;

use Illuminate\Console\Command;

class JsonHelperCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'z:encode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Helper command to encode comments to json. Interactive';

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
     * @return int
     */
    public function handle()
    {
        $comments = $this->ask('Enter comments text');

        $comments = serialize($comments);

        $object = new \stdClass();
        $object->comments = $comments;

        // $data = ['comments' => $comments];

        $json = json_encode($object);

        $message = 'Success. Json Output:';
        $this->success($message);
        $this->line('');

        $this->line($json);
        $this->line('');

        return Command::SUCCESS;
    }
}
