<?php

use Illuminate\Database\Capsule\Manager as DB;
class IndexController extends Yaf_Controller_Abstract
{
    public function indexAction()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'https://www.baidu.com', [
            'auth' => ['user', 'pass']
        ]);
        echo $res->getStatusCode();


        print_r(DB::table('2016_yuxiu_anchor')->where('status',0)->first());

        $this->getView()->assign("content", "Hello World");
    }
}
