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
            if (strtotime('now') >= $dcm1->epoch) {
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 0
                ]);
                DB::table('email_job')->insert([
                    'refer' => $dcm1->id,
                    'condition' => 0,
                ]);
            } elseif (strtotime('now') >= ($dcm1->epoch - ($dcm1->reminder*60)) && $dcm1->statusdoc == 1){
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 2
                ]);
            }
        }
        $document2 = DB::table('document')->where('statusdoc', '>', 1)->get();
        foreach($document2 as $dcm2) {
            if (($dcm2->epoch - (7*60)) <= strtotime('now') && strtotime('now') < $dcm2->epoch){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            }
            elseif (($dcm2->epoch. - (28*60)) == strtotime('now') || ($dcm2->epoch - (21*60)) == strtotime('now') || ($dcm2->epoch - (14*60)) == strtotime('now')){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            } 
            elseif (($dcm2->epoch - ($dcm2->reminder *60)) <= strtotime('now') && ($dcm2->epoch - (30*60)) >= strtotime('now')) {
                for($i = $dcm2->reminder; $i >= 30; $i=$i-30)
                {
                    if(($dcm2->epoch - ($i*60)) == strtotime('now')){
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
        $history = DB::table('history')->where('statusdoc', '>', 0)->get();
        foreach($history as $hst) {
            if (strtotime('now') >= $hst->epoch) {
                DB::table('history')->where('id', $hst->id)->update([
                    'statusdoc' => 0
                ]);
            } else {
                // Do Nothing
            }
        }
        // return Command::SUCCESS;
        $this->info('Successfully checcking document condition.');
    }
}
