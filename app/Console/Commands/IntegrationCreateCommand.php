<?php

namespace App\Console\Commands;

use App\Models\Integration;
use App\Repository\IntegrationRepository;
use Illuminate\Console\Command;

class IntegrationCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:create {marketplace} {username?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $marketplace = $this->argument('marketplace');
        $username = $this->argument('username');
        $password = $this->argument('password');

        $repository = new IntegrationRepository(new Integration());

        try {
            $response = $repository->store([
                'marketplace' => $marketplace,
                'username' => $username,
                'password' => $password,
            ]);
        }catch (\Exception $e){
            $this->error($e->getMessage());
            return;
        }
        //give info to the user
        $this->info("Integration ID: {$response['data']['id']}");
    }
}
