<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use \GuzzleHttp\Client;

class AddToDoList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $client 			= new Client();
        $requestUrl         = 'https://jsonplaceholder.typicode.com/todos';
        $guzzleResponse  	= $client->request('get', $requestUrl);
        $apiResponse		= json_decode($guzzleResponse->getBody()->getContents());
        if (count($apiResponse) > 0 ) {
            foreach ($apiResponse as  $singleList) {
                
                $create_tdl = [];
                $create_tdl['id'] = $singleList->id;
                $create_tdl['completed'] = $singleList->completed;
                $create_tdl['title'] =  $singleList->title;
                $create_tdl['userId'] = $singleList->userId;
                $create_tdl['created_at'] = date('Y-m-d H:m:s');
                $create_tdl['updated_at'] = date('Y-m-d H:m:s');
                
                try {
                    DB::table('to_do_lists')->insert($create_tdl);
                }catch(\Exception $e) {
                    //var_dump($e->getMessage()); 
                }              
            }        
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $client 			= new Client();
        $requestUrl         = 'https://jsonplaceholder.typicode.com/todos';
        $guzzleResponse  	= $client->request('get', $requestUrl);
        $apiResponse		= json_decode($guzzleResponse->getBody()->getContents());
        if (count($apiResponse) > 0 ) {
            DB::table('to_do_lists')->where('id','<=',count($apiResponse))->delete();
        }
    }
}
