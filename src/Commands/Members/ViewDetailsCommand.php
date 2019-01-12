<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\Commands\Members;

use App;
use Illuminate\Console\Command;

class ViewDetailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zuora:member:view
                            {zuoraGuid : Zuora\'s GUID}
                            --firstName
                            --accountId';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a secondary account to the member\'s account.';

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


        $zuoraGUID = '8a80aba7693a825401695a4a53663134';

        $account = $zuoraClient->account->fetch($zuoraGUID);

//        $json = $zuoraClient->callApi(
//            '/v1/accounts/' . $zuoraGUID,
//            'GET', [], [], []);
    }
}