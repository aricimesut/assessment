<?php

namespace App\Console\Commands;

use App\Models\Integration;
use App\Repository\IntegrationRepository;
use Illuminate\Console\Command;

class IntegrationDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        $repository = new IntegrationRepository(new Integration());

        try {
            $response = $repository->destroy($id);
        }catch (\Exception $e){
            $this->error($e->getMessage());
            return;
        }
        //give info to the user
        $this->info("Integration silindi.");
    }
}
