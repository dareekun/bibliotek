<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Mail\InternalSender;
use Illuminate\Support\Facades\Mail;

class MailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:sender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail Job Sender';

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
        $records = DB::table('email_job')->join('document', 'document.id', '=', 'email_job.refer')->where('email_job.condition', 0)
        ->select('email_job.id as id', 'email_job.refer as refer', 'document.pic as pic', 'document.creator as creator', 
        'document.category as category', 'document.expireddate as expireddate', 'document.department as department')
        ->get();
        foreach ($records as $rcds) {
            $cc  = DB::table('notify')->where('refer', $rcds->refer)->join('users', 'users.id', '=', 'notify.user')->pluck('users.email')->toArray();
            $crt = DB::table('users')->where('id', $rcds->creator)->value('email');
            $nma = DB::table('users')->where('id', $rcds->creator)->value('name');
            $ndc = DB::table('history')->where('refer', $rcds->refer)->orderBy('created_at', 'desc')->limit(1)->value('code');
            $mgr = DB::table('users')->where('role', 'manager')->where('department', $rcds->department)->pluck('email')->toArray();
            $cat = DB::table('category')->where('id', $rcds->category)->value('desc');
            array_merge($cc, $mgr);
            array_push($cc, $rcds->pic);
            $cc  = array_filter($cc);
            Mail::to($crt)
            ->cc($cc)
            ->queue(new InternalSender($rcds->refer, $nma, $cat, $rcds->expireddate, $ndc));
            DB::table('email_job')->where('id', $rcds->id)->update([
                'condition' => time()
            ]);
        }
        // return Command::SUCCESS;
        $this->info('Successfully sent REMINDER to everyone.');
    }
}
