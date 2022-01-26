<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DocumentCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Document Condition Check';

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
        $document1 = DB::table('document')->where('statusdoc', '>', 0)->get();
        foreach($document1 as $dcm1) {
            if (strtotime('now') >= strtotime($dcm1->expireddate)) {
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 0
                ]);
                DB::table('email_job')->insert([
                    'refer' => $dcm1->id,
                    'condition' => 0,
                ]);
            } elseif (strtotime('now') >= strtotime($dcm1->expireddate.'-'.$dcm1->reminder.' days') && $dcm1->statusdoc == 1){
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 2
                ]);
            }
        }
        $document2 = DB::table('document')->where('statusdoc', '>', 1)->get();
        foreach($document2 as $dcm2) {
            if (strtotime($dcm2->expireddate.'-7 days') <= strtotime('now') && strtotime('now') < strtotime($dcm2->expireddate)){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            }
            elseif (strtotime($dcm2->expireddate.'-28 days') == strtotime('now') || strtotime($dcm2->expireddate.'-21 days') == strtotime('now') || strtotime($dcm2->expireddate.'-14 days') == strtotime('now')){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            } 
            elseif (strtotime($dcm2->expireddate.'-'.$dcm2->reminder.' days') <= strtotime('now') && strtotime($dcm2->expireddate.'-30 days') >= strtotime('now')) {
                for($i = $dcm2->reminder; $i >= 30; $i=$i-30)
                {
                    if(strtotime($dcm2->expireddate.'-'.$i.' days') == strtotime('now')){
                        DB::table('email_job')->insert([
                            'refer' => $dcm2->id,
                            'condition' => 0,
                        ]);
                    }
                    else {
                        // Do Nothing
                    }
                }
            }
        }
        // return Command::SUCCESS;
        $this->info('Successfully checcking document condition.');
    }
}
