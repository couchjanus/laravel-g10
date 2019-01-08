<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Social;
use App\User;
use Auth;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirect($provider)
    {
        $providerKey = Config::get('services.'.$provider);

        if (empty($providerKey)) {

            return redirect('/login')
            ->withError('No such provider yet');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUserObject = Socialite::driver($provider)->stateless()->user();
            
            // Check if email is already registered
            $userCheck = User::where(['email' => $socialUserObject->getEmail()])->first();
            
            if($userCheck) {
                Auth::login($userCheck);
                return redirect('/home');
            } else {
                $socialId = Social::where('social_id', '=', $socialUserObject->id)->where('provider', '=', $provider)->first();

                if (empty($socialId)) {
                    $socialData = new Social();
                    $profile = new Profile();
                    $fullname = explode(' ', $socialUserObject->getName());
                    if (count($fullname) == 1) {
                        $fullname[1] = 'Nicname';
                    }
                    $profile->first_name = $fullname[0];
                    $profile->last_name = $fullname[1];
                    // Twitter User Object details: https://developer.twitter.com/en/docs/tweets/data-dictionary/overview/user-object
                    if ($provider == 'twitter') {
                        $username = $socialUserObject->getScreen_name();
                    } else {
                        $username = $socialUserObject->getNickname();
                    }
                    $profile->username = $username;
                    $profile->avatar = $socialUserObject->getAvatar();

                    if (!$socialUserObject->getEmail()) {
                        $email = 'missing'.str_random(10).'@'.str_random(10).'.example.org';
                    } else {
                        $email = $socialUserObject->getEmail();
                    }
                    // dd($email);

                    $user = User::create(
                        [
                        'name'                 => $username,
                        'email'                => $email,
                        'password'             => bcrypt(str_random(40)),
                        // 'verified'             => true,
                        ]
                    );

                    $socialData->social_id = $socialId;
                    $socialData->provider = $provider;
                    $user->social()->save($socialData);
                    // $user->verified = true;
                    $user->profile()->save($profile);
                    // $user->save();

                    auth()->login($user, true);
                    return redirect('home')->with('success', 'You have successfully registered! ');
                }
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
        }
        dd($profile);
    }
}
