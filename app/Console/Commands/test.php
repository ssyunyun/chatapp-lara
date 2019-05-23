<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Controllers\ChsController;
use Illuminate\Support\Facades\DB;
use App\Events\CommentCreated;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Str;

class test extends Command
{
    protected $signature = 't';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $time = Carbon::now();
        $token = str::random(10);
        
        $userId = '1';
        $token = 'CRn2gycUNt';

        $controller = new SessionController;//インスタンス化
        var_dump($controller->checkSession($userId, $token));

    }
}
