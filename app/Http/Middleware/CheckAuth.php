<?php

namespace App\Http\Middleware;

use Closure;
use App\TokenModel;
use Carbon\Carbon;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $auth = $request->header("Authorization");
        $tokenArray = explode(" ", $auth);

        if($tokenArray[0] != "Bearer")
            return response([
                'code' => 403,
                'msg' => 'Bearer형 토큰이 아닙니다.'
            ], 403);

        $tokenSplit = explode(".", $tokenArray[1]);
        if(count($tokenSplit) < 3)
            return response([
                'code' => 403,
                'msg' => '유효한 토큰이 아닙니다.'
            ], 403);

        $jwtStructureHash = hash_hmac('sha256', $tokenSplit[0].".".$tokenSplit[1], "secret");
        if($jwtStructureHash != base64_decode($tokenSplit[2]))
            return response([
                'code' => 403,
                'msg' => '유효한 토큰이 아닙니다.'
            ], 403);

        $payload = json_decode(base64_decode($tokenSplit[1]));
        $pTime = Carbon::createFromTimestamp($payload->exp);

        if(Carbon::now()->diffInMinutes($pTime) > 30)
            return response([
                'code' => 403,
                'msg' => '이미 만료된 토큰'
            ], 403);

        return $next($request);
    }
}
