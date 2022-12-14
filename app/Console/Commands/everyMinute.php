<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'it will delete the columns';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('investments')
        ->where('applied_price','=','5000')
        ->update([
            
            'applied_income' => DB::raw('applied_income + 500'),
        
        ]);
        return 'Data updated';
    }
}
