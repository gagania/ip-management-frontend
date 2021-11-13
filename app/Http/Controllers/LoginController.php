<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LoginController extends Controller
{    
    public function index(Request $request)
    {
        if (!$request->session()->get('token')) {
            return view('login.index',['message'=>'']);
        }

        return redirect('dashboard');
    }

    public function auth(Request $request) {
        $token = $this->getToken($request);
        if ($token['success']) {
            $request->session()->put('token', 'Bearer '.$token["data"]['user']['token']);
            $this->setAccessLog($request);
            return redirect('dashboard');
        } else {
            return view('login.index',['message'=>$token['message']]);
        }
    }

    public function logout(Request $request) {
        $token = $request->session()->get('token');

        $url        = 'http://localhost:8000/logout';
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result     = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response   = json_decode($result, true);
        curl_close($ch);
        
        if($httpcode == 200){ 
            $request->session()->forget('token');
            $request->session()->flush();
            return view('login.index',['message'=>'logout']);
        }
    }

    private function getToken($request)
    {
        $url        = 'http://localhost:8000/login';
        $headers    = ['Content-Type: application/json'];

        $data       = array(
            'email'     => $request->input('user_name'),
            'password'  => $request->input('password'), 
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result     = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $response   = json_decode($result, true);
        if($httpcode == 200){
            $response['success'] = true;
            return $response;
        }
        else{
            $response['success'] = false;
            $response['message'] = 'User and passord is invalid.';
            return $response;
        }
    }

    public function register() {
        return view('login.register',['message'=>'']);
    }

    public function savereg(Request $request) {
        $url        = 'http://localhost:8000/register';
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $data       = array(
            'name'     => $request->input('name'),
            'email'     => $request->input('email'),
            'password'     => $request->input('password')
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
            return redirect('login');
            // return $response;
        }
        else{
            $response['success'] = false;
            $response['message'] = 'Register Fail.';
            return $response;
        }
    }

    public function setAccessLog($request) {
        $token = $request->session()->get('token');
        $url        = 'http://localhost:8000/access_log';
        $headers    = array();
        $headers[]  = 'Accept: application/json';
        $headers[]  = 'Content-Type: application/json';
        $headers[]  = 'Authorization: '.$token;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $httpcode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response   = json_decode($result, true);
        if($httpcode == 200){
            $response['success'] = true;
            $response['message'] = 'Access Log Success.';
            return $response;
        }
        else{
            $response['success'] = false;
            $response['message'] = 'Access Log Fail.';
            return $response;
        }
    }
}