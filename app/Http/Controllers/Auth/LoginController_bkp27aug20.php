<?php
namespace App\Http\Controllers\Auth;
ini_set('max_execution_time', 300);
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use Exception;
use App\User;
use Google_Service_People;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Session;
use App\LoginRecords;
use App\ApiCredential;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')
            ->except('logout');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try
        {
            $user = Socialite::driver('google')->user();
            $checkEmail = User::where('email', $user->email)->where('google_id',$user->id)
                ->first();
            if (!empty($checkEmail))
            {
                User::where('id', $checkEmail->id)
                    ->update(['socialite_token' => $user->token, 'google_id' => $user->id, 'new_user' => 1, 'user_image' => !empty($user->user['picture']) ? $user->user['picture'] : '']);
                Auth::login($checkEmail);
                return redirect('/dashboard');
            }
            else
            {
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->socialite_token = $user->token;
                $newUser->user_image = !empty($user->user['picture']) ? $user->user['picture'] : '';
                $newUser->save();
                auth()
                    ->login($newUser, true);
                return redirect('/dashboard');
            }

        }
        catch(Exception $e)
        {
            return redirect('auth/google');
        }
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email', 'gender', 'birthday'])
            ->scopes(['user_friends'])
            ->redirect();
    }

    public function handleFacebookCallback()
    {
        try
        {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('fb_id', $user->getId())
                ->first();

            $checkEmail = User::where('email', $user->getEmail())
                ->first();
            if (!empty($checkEmail))
            {
                User::where('id', $checkEmail->id)
                    ->update(['socialite_token' => $user->token, 'fb_id' => $user->getId() , 'new_user' => 1]);
                Auth::login($checkEmail);
                return redirect('/dashboard');

                // if ($finduser) {
                // User::where('id',$finduser->id)->first()->update(['socialite_token' =>$user->token]);
                // Auth::login($finduser);
                // return redirect('/dashboard');
                
            }
            else
            {
                $newUser = new User;
                $newUser->name = $user->getName();
                $newUser->email = $user->getEmail();
                $newUser->fb_id = $user->getId();
                $newUser->socialite_token = $user->token;
                $newUser->save();
                auth()
                    ->login($newUser, true);
                return redirect('/dashboard');
            }
        }
        catch(Exception $e)
        {
            return redirect('auth/fb');
        }
    }

    public function handleOutlookCallback(Request $request)
    {
        $objApiGoogleClientIdCredential = ApiCredential::where('api_key', 'GOOGLE_CLIENT_ID')->first();
        $objApiGoogleClientSecretCredential = ApiCredential::where('api_key', 'GOOGLE_CLIENT_SECRET')->first();
        $objApiGoogleRedirectCredential = ApiCredential::where('api_key', 'GOOGLE_REDIRECT')->first();
        $objApiFacebookClientIdCredential = ApiCredential::where('api_key', 'FACEBOOK_CLIENT_ID')->first();
        $objApiFacebookClientSecretCredential = ApiCredential::where('api_key', 'FACEBOOK_CLIENT_SECRET')->first();
        $objApiFacebookCallbackUrlCredential = ApiCredential::where('api_key', 'FACEBOOK_CALLBACK_URL')->first();
        $objApiOauthIdCredential = ApiCredential::where('api_key', 'OAUTH_APP_ID')->first();
        $objApiOauthAppPasswordCredential = ApiCredential::where('api_key', 'OAUTH_APP_PASSWORD')->first();
        $objApiOauthRedirectUrlCredential = ApiCredential::where('api_key', 'OAUTH_REDIRECT_URI')->first();
        $objApiOauthScopesCredential = ApiCredential::where('api_key', 'OAUTH_SCOPES')->first();
        $objApiOauthAuthorityCredential = ApiCredential::where('api_key', 'OAUTH_AUTHORITY')->first();
        $objApiOauthAuthorizeEndpointCredential = ApiCredential::where('api_key', 'OAUTH_AUTHORIZE_ENDPOINT')->first();
        $objApiOauthTokenEndpointCredential = ApiCredential::where('api_key', 'OAUTH_TOKEN_ENDPOINT')->first();
        $expectedState = session('oauthState');
        $request->session()
            ->forget('oauthState');
        $providedState = $request->query('state');

        if (!isset($expectedState))
        {
            // If there is no expected state in the session,
            // do nothing and redirect to the home page.
            return redirect('/');
        }

        if (!isset($providedState) || $expectedState != $providedState)
        {

            return redirect('/')->with('error', 'Invalid auth state')
                ->with('errorDetail', 'The provided auth state did not match the expected value');
        }

        // Authorization code should be in the "code" query param
        $authCode = $request->query('code');
        if (isset($authCode))
        {
            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider(['clientId' => !empty($objApiOauthIdCredential->api_value) ? $objApiOauthIdCredential->api_value : '', 'clientSecret' => !empty($objApiOauthAppPasswordCredential->api_value) ? $objApiOauthAppPasswordCredential->api_value : '', 'redirectUri' => !empty($objApiOauthRedirectUrlCredential->api_value) ? $objApiOauthRedirectUrlCredential->api_value : '', 'urlAuthorize' => $objApiOauthAuthorityCredential->api_value . $objApiOauthAuthorizeEndpointCredential->api_value, 'urlAccessToken' => $objApiOauthAuthorityCredential->api_value . $objApiOauthTokenEndpointCredential->api_value, 'urlResourceOwnerDetails' => '', 'scopes' => $objApiOauthScopesCredential->api_value]);

            try
            {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', ['code' => $authCode]);

                $graph = new Graph();
                $graph->setAccessToken($accessToken->getToken());

                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();
                if (null !== $user->getMail())
                {
                    $getEmail = $user->getMail();
                }
                else
                {
                    $getEmail = $user->getUserPrincipalName();
                }

                $checkEmail = User::where('email', $getEmail)->where('outlook_id',$user->getId())->first();

                if (!empty($checkEmail))
                {
                    User::where('id', $checkEmail->id)
                        ->update(['socialite_token' => $accessToken->getToken() , 'outlook_id' => $user->getId() ]);
                    Auth::login($checkEmail);
                    return redirect('/dashboard');
                }
                else
                {
                    $newUser = new User;
                    $newUser->name = !empty($user->getDisplayName()) ? $user->getDisplayName() : '';
                    $newUser->email = (null !== $user->getMail() ? $user->getMail() : $user->getUserPrincipalName());
                    $newUser->outlook_id = $user->getId();
                    $newUser->socialite_token = $accessToken->getToken();
                    $newUser->save();
                    auth()
                        ->login($newUser, true);
                    return redirect('/dashboard');
                }

            }
            catch(\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e)
            {
                return redirect('/')->with('error', 'Error requesting access token')
                    ->with('errorDetail', $e->getMessage());
            }
        }
        else
        {
            var_dump($request->query('error'));
            exit;
        }

        return redirect('/')
            ->with('error', $request->query('error'))
            ->with('errorDetail', $request->query('error_description'));
    }

    public function outLookSingin()
    {
        $objApiGoogleClientIdCredential = ApiCredential::where('api_key', 'GOOGLE_CLIENT_ID')->first();
        $objApiGoogleClientSecretCredential = ApiCredential::where('api_key', 'GOOGLE_CLIENT_SECRET')->first();
        $objApiGoogleRedirectCredential = ApiCredential::where('api_key', 'GOOGLE_REDIRECT')->first();
        $objApiFacebookClientIdCredential = ApiCredential::where('api_key', 'FACEBOOK_CLIENT_ID')->first();
        $objApiFacebookClientSecretCredential = ApiCredential::where('api_key', 'FACEBOOK_CLIENT_SECRET')->first();
        $objApiFacebookCallbackUrlCredential = ApiCredential::where('api_key', 'FACEBOOK_CALLBACK_URL')->first();
        $objApiOauthIdCredential = ApiCredential::where('api_key', 'OAUTH_APP_ID')->first();
        $objApiOauthAppPasswordCredential = ApiCredential::where('api_key', 'OAUTH_APP_PASSWORD')->first();
        $objApiOauthRedirectUrlCredential = ApiCredential::where('api_key', 'OAUTH_REDIRECT_URI')->first();
        $objApiOauthScopesCredential = ApiCredential::where('api_key', 'OAUTH_SCOPES')->first();
        $objApiOauthAuthorityCredential = ApiCredential::where('api_key', 'OAUTH_AUTHORITY')->first();
        $objApiOauthAuthorizeEndpointCredential = ApiCredential::where('api_key', 'OAUTH_AUTHORIZE_ENDPOINT')->first();
        $objApiOauthTokenEndpointCredential = ApiCredential::where('api_key', 'OAUTH_TOKEN_ENDPOINT')->first();
        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider(['clientId' => !empty($objApiOauthIdCredential->api_value) ? $objApiOauthIdCredential->api_value : '', 'clientSecret' => !empty($objApiOauthAppPasswordCredential->api_value) ? $objApiOauthAppPasswordCredential->api_value : '', 'redirectUri' => !empty($objApiOauthRedirectUrlCredential->api_value) ? $objApiOauthRedirectUrlCredential->api_value : '', 'urlAuthorize' => $objApiOauthAuthorityCredential->api_value . $objApiOauthAuthorizeEndpointCredential->api_value, 'urlAccessToken' => $objApiOauthAuthorityCredential->api_value . $objApiOauthTokenEndpointCredential->api_value, 'urlResourceOwnerDetails' => '', 'scopes' => $objApiOauthScopesCredential->api_value]);

        $authUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState() ]);

        // Redirect to AAD signin page
        return redirect()
            ->away($authUrl);
    }

    public function postLogin(Request $request)
    {
        $user = auth()->user();

        $credentials = $request->only('email', 'password');
        $email = $credentials['email'];
        $password = $credentials['password'];
        $user = User::where('email', '=', $email)->first();
        if ($user !== Null)
        {
            if ($user->verified == 1)
            {
                if (Hash::check($password, $user->password))
                {
                    if (Auth::attempt($credentials))
                    {
                        // Authentication passed...
                        if (Auth::user()->user_type == 1)
                        {
                            $userType = 1;
                        }
                        else
                        {
                            $userType = 2;
                        }
                        $time = date('Y-m-d H:i:s');
                        $ip = $request->ip();

                        $records = new LoginRecords;
                        $records->auth_id = $user->id;
                        $records->user_type = Auth::user()->user_type;
                        $records->ip_address = $ip;
                        $records->browser = '';
                        $records->platform = '';
                        $records->device = '';
                        $records->start_time = $time;
                        $records->save();

                        $info = User::find($user->id);
                        $info->last_login = $time;
                        $info->update();

                        Session::put('session_start', $time);
                        Session::put('login_record', $records->id);
                        return response()
                            ->json(array(
                            'status' => 200,
                            'message' => 'Login Successfully!',
                            'userType' => $userType
                        ));
                    }
                    else
                    {
                        return redirect('/');
                    }
                }
                else
                {
                    return response()->json(array(
                        'status' => 201,
                        'message' => 'Incorrect Password!'
                    ));
                }
            }
            else
            {
                return response()
                    ->json(array(
                    'status' => 201,
                    'message' => 'Your email id is not verified.<a href="javascript:;" data-user-id="' . $user->id . '" class="verify-user"> Click here</a> to resend the verification mail'
                ));
            }
        }
        else
        {
            return response()
                ->json(array(
                'status' => 201,
                'message' => 'Email Id Not Exist!'
            ));
        }
    }
    public function logout()
    {
        if (Session::get('login_record'))
        {
            $record_id = Session::get('login_record');
            $time = date('y-m-d H:i:s', time());
            $records = LoginRecords::find($record_id);
            if ($records)
            {
                $records->end_time = $time;
                $records->update();
            }
        }
        Auth::logout(); // log the user out of our application
        return redirect()
            ->back();
    }

}

