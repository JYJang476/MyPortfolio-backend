<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TokenModel;
use Carbon\Carbon;

class UserController extends Controller
{
    public function GenerateToken($id, $pw){
        $header = [
            "typ" => "JWT",
            "alg" => "HS256"
        ];
        $thisTime = Carbon::now()->addMinutes(1);
        $payload = [
            "exp" => $thisTime->timestamp,
            "userId" => $id,
        ];

        $jwtHeaderHash = str_replace("=", "", base64_encode(json_encode($header)));
        $jwtPayloadHash = str_replace("=", "", base64_encode(json_encode($payload)));
        $jwtStructureHash = base64_encode(
            hash_hmac('sha256', $jwtHeaderHash.".".$jwtPayloadHash, "secret"));

        return $jwtHeaderHash.".".$jwtPayloadHash.".".$jwtStructureHash;
    }

    public function Register(Request $request) {
        $user = User::where('userid', '=', $request->id);
        if($user->count() != 0)
            return response('이미 있음', 403);

        User::insert([
           'userid' => $request->id,
           'userpw' => hash_hmac('sha256', $request->pw, 'secret'),
            'level' => 1
        ]);

        return response('성공');
    }

    public function CheckAuth(Request $request) {
        $result = TokenModel::where('token', '=', $request->token);

        if($result->count() == 0)
            return response('없음', 404);

        return response('있음', 200);
    }

    public function IsLogin(Request $request) {
        $authHeader = $request->header('Authorization');
        $token = explode(' ', $authHeader)[1];
        $tokenSplit = explode('.', $token);
        $payload = json_decode(base64_decode($tokenSplit[1]));

        return response($payload->userId, 200);
    }

    public function Login(Request $request) {
        $result = User::where([
            'userid' => $request->id,
            'userpw' => hash_hmac('sha256', $request->pw, 'secret')
        ]);

        if($result->count() == 0)
            return response('로그인 실패', 404);

        $token = $this->GenerateToken($request->id, $request->pw);

        return response($token, 200);
    }
}
