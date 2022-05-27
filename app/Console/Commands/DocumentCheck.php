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
            $now    = strtotime('now');
            $diff   = (strtotime($dcm1->expireddate) - strtotime('now')) / 86400;
            $newexp = strtotime('now') + ($diff * 60);
            if (strtotime('now') >= $newexp) {
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 0
                ]);
                DB::table('email_job')->insert([
                    'refer' => $dcm1->id,
                    'condition' => 0,
                ]);
            } elseif (strtotime('now') >= strtotime($newexp.'-'.$dcm1->reminder.' minutes') && $dcm1->statusdoc == 1){
                DB::table('document')->where('id', $dcm1->id)->update([
                    'statusdoc' => 2
                ]);
            }
        }
        $document2 = DB::table('document')->where('statusdoc', '>', 1)->get();
        foreach($document2 as $dcm2) {
            $now    = strtotime('now');
            $diff   = (strtotime($dcm2->expireddate) - strtotime('now')) / 86400;
            $newexp = strtotime('now') + ($diff * 60);
            if (strtotime($newexp.'-7 minutes') <= strtotime('now') && strtotime('now') < $newexp){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            }
            elseif (strtotime($newexp.'-28 minutes') == strtotime('now') || strtotime($newexp.'-21 minutes') == strtotime('now') || strtotime($newexp.'-14 minutes') == strtotime('now')){
                DB::table('email_job')->insert([
                    'refer' => $dcm2->id,
                    'condition' => 0,
                ]);
            } 
            elseif (strtotime($newexp.'-'.$dcm2->reminder.' minutes') <= strtotime('now') && strtotime($newexp.'-30 minutes') >= strtotime('now')) {
                for($i = $dcm2->reminder; $i >= 30; $i=$i-30)
                {
                    if(date('Ymd', strtotime($dcm2->expireddate.'-'.$i.' minutes')) == date('Ymd')){
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
            $now    = strtotime('now');
            $diff   = (strtotime($hst->expirdate) - strtotime('now')) / 86400;
            $newexp = strtotime('now') + ($diff * 60);
            if (strtotime('now') >= strtotime($hst->expirdate)) {
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
