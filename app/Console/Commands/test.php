<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ChsController;
use Illuminate\Support\Facades\DB;
use App\Events\CommentCreated;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        /*
        $comment = "saodiaw";

        $comment = \App\Talkinfos::create([
            'comment' => $comment
        ]);

        var_dump(get_class ( $comment ));
*/
/*
        $data = \App\Talkinfos::create([
            'comment' => "aaaa",
            'groupid' => 12
        ]);

        var_dump($data->attributes);
*/

/*
$userId = "2";

$pdo = DB::connection('pgsql');

//ユーザーIDを参照し、登録されてるパスワードをDBから取ってくる
$regPass = $pdo->select("select password from userinfo where id = '$userId'");

//$array   = fetch_assoc($regPass);

var_dump($regPass[0]->password);
*/

/*
$Id_split = array(
    '1',
    '2',
    '3',
    '8',
);

$pdo = DB::connection('pgsql');

for ($i = 0; $i < 4; $i++) {
    $check = $pdo->select("select * from userinfo where id = '$Id_split[$i]'");
    var_dump($check);
}
*/

$pdo = DB::connection('pgsql');
$GroupIds = "1,2,3";
$newId = "4";

$GroupIds .= ",".$newId;

var_dump($GroupIds);


$newId = $pdo->select("select max (id) from groupinfo");
var_dump($newId);

    


    }
}
