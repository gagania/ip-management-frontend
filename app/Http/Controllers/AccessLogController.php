<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{    
    public function __construct(Request $request) {
        if (!$request->session()->get('token')) {
            redirect('login')->send();
        }
    }

    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/access_log';
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $response   = json_decode($result, true);
        return view('access_log.index', ['results' => $response]);
    }
    

    function edit(Request $request,$id) {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/access_log/'.$id;
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response   = json_decode($result, true);
        if($httpcode == 200){
            $response['success'] = true;
            $response = $response["data"][0];
        }
        else{
            $response['success'] = false;
            $response['message'] = 'Update Fail.';
        }
        return view('access_log.edit', ['result' => $response]);
    }
}