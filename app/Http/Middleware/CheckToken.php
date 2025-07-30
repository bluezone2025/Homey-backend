<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Middleware;


use App\FcmTokenModel;
use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CheckToken extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        //dd(\request()->header('fcm-token',null));
            $fcm_token = \request()->header('fcm-token',null);
            //check route has bearToken
            $authentaction = $request->header('auth-token');

            if ($authentaction){
                $request->headers->set('Authorization', 'Bearer '.$authentaction, true);
                try {
                    $user = JWTAuth::parseToken()->authenticate();

                } catch (Exception $e) {
                    $user = null;
                }

                //$user = JWTAuth::parseToken()->authenticate()??null;

            }else{
                $user = null;
            }

            if ($user){
                // get the token from database and add user id on it
                $token =  FcmTokenModel::where('user_id',$user->id)->first();
                if ($token){
                    if ($fcm_token){
                        $token->update(['token'=>$fcm_token,'user_id'=>$user->id]);
                    }
                }else{
                    $token =  FcmTokenModel::where('token',$fcm_token)->first();
                    if ($token){
                        $token->update(['user_id'=>$user->id]);
                    }else{
                        if ($fcm_token){
                            FcmTokenModel::create([
                                'token' => $fcm_token,
                                'user_id'   => $user->id,
                            ]);
                        }
                    }
                }
            }
            else{
                // get the token from database and add user id on it
                $token =  FcmTokenModel::where('token',$fcm_token)->first();
                if ($token){
                    return $next($request);
                }else{
                    if ($fcm_token){
                        FcmTokenModel::create([
                            'token' => $fcm_token,
                            'user_id'   => null,
                        ]);
                    }
                }
            }

        return $next($request);
    }

}
