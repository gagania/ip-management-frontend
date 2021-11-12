<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AuditTrailsController extends Controller
{    
    public function __construct(Request $request) {
        if (!$request->session()->get('token')) {
            redirect('login')->send();
        }
    }

    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/audit_trails';
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
        return view('audit_trails.index', ['results' => $response]);
    }
    

    function edit(Request $request,$id) {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/audit_trails/'.$id;
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
        return view('audit_trails.edit', ['result' => $response["data"][0]]);
    }
}