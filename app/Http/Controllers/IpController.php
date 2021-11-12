<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class IpController extends Controller
{    
    public function __construct(Request $request) {
        if (!$request->session()->get('token')) {
            redirect('login')->send();
        }
    }

    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/ip';
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
        return view('ip.index', ['results' => $response]);
    }

    function add(Request $request) {
        return view('ip.add');
    }

    function edit(Request $request,$id) {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/ip/'.$id;
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
        return view('ip.edit', ['result' => $response["data"][0]]);
    }

    public function create(Request $request) {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/ip';
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;
        $data       = array(
            'ip'     => $request->input('ip'),
            'label'     => $request->input('label')
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response   = json_decode($result, true);
        if($httpcode == 200){
            $response['success'] = true;
            return redirect('ip/index');
        }
        else{
            $response['success'] = false;
            $response['message'] = 'Update Fail.';
            return $response;
        }
    }

    public function update(Request $request) {
        $id = $request->id;
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/ip/'.$id;
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;
        $data       = array(
            'ip'     => $request->input('title'),
            'label'     => $request->input('label')
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response   = json_decode($result, true);
        if($httpcode == 200){
            $response['success'] = true;
            return redirect('ip/index');
            // return $response;
        }
        else{
            $response['success'] = false;
            $response['message'] = 'Update Fail.';
            return $response;
        }
    }
}