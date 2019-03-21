<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\Commands\Members;

use App;
use Illuminate\Console\Command;
use PHPExperts\ZuoraClient\ZuoraClient;

class ViewDetailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zuora:member:view
                            {zuoraId : Zuora\'s GUID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Views a member\'s account info.';

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
        /** @var ZuoraClient $zuoraClient */
        $zuoraClient = app('zuora');

        $zuoraId = $this->argument('zuoraId');
        $account = $zuoraClient->account->fetch($zuoraId);

        dd($account);
    }
}
