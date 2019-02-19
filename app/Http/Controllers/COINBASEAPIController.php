<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

class COINBASEAPIController extends Controller
{
    public function demo(){
        
        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/info/',
            [
            'query' => [
                'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=>'144860'
                ]
            ]
        );
  
         $response = json_decode($res->getBody()->getContents());
 
         //var_dump($response->data);
    
         return response()->json(
             ['msg'=>'Datos de la cuenta',
              'datos'=>$response->data,
             'code'=>200
             ],
            200);
    }
    
    public function prueba_token(){
        
        $client = new \GuzzleHttp\Client();
        
        $response = $client->request('GET', '/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);
        
        $response = json_decode($res->getBody()->getContents());
 
         //var_dump($response->data);
    
         return response()->json(
             ['msg'=>'Datos de la cuenta',
              'datos'=>$response->data,
             'code'=>200
             ],
            200);
    }
    
    public function token(){
        
        $client = new \GuzzleHttp\Client();
        
        

        $response = $client->post('https://api.coinbase.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code'=>'e1241b1e8f617deb81620d35652f67bad8dc10254889860b3030f3c49fbb274d',
                'client_id' => '6014bca386af34d55bcd09680d9a8c3b437278be826d0b903e4362a10300fb88',
                'client_secret' => 'd38cc07e2f3af8d7cb1d9ac250ba13854f4a4f76c915c83215d64d40cf78ba54',
                'redirect_uri' => 'https://coinnomina-katla20.c9users.io/coinnominadesarrollo/public/api/admin',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true)['access_token'];   
        
        
        
  
    }
    

    public function token_auth2(){
        
        $provider = new \Openclerk\OAuth2\Client\Provider\Coinbase([
          'clientId'      => '6014bca386af34d55bcd09680d9a8c3b437278be826d0b903e4362a10300fb88',
          'clientSecret'  => 'd38cc07e2f3af8d7cb1d9ac250ba13854f4a4f76c915c83215d64d40cf78ba54',
          'redirectUri'   => 'https://coinnomina-katla20.c9users.io/coinnominadesarrollo/public/api/admin',
          'scopes'        => ['user', 'balance'],
        ]);
        
        if (!isset($_GET['code'])) {
        
          // If we don't have an authorization code then get one
          $authUrl = $provider->getAuthorizationUrl();
          $_SESSION['oauth2state'] = $provider->state;
          header('Location: '.$authUrl);
          exit;
        
        // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        
          unset($_SESSION['oauth2state']);
          exit('Invalid state');
        
        } else {
        
          // Try to get an access token (using the authorization code grant)
          $token = $provider->getAccessToken('authorization_code', [
              'code' => $_GET['code']
          ]);
        
          // Optional: Now you have a token you can look up a users profile data
          try {
        
            // We got an access token, let's now get the user's details
            $userDetails = $provider->getUserDetails($token);
        
            // Use these details to create a new profile
            //printf('Hello %s!', $userDetails->firstName);
        
            // You can also get Coinbase balances
            $balanceDetails = $provider->getBalanceDetails($token);
        
            //printf('You have %f %s', $balanceDetails['amount'], $balanceDetails['currency']);
        
          } catch (Exception $e) {
        
            // Failed to get user details
            exit('Oh dear...');
          }
          
                 $datos['token']=$token->accessToken;
                 $datos['refreshToken']=$token->refreshToken;
                 $datos['expires']=$token->expires; 
                 
                 return $datos;
 
        }   
        
        
        
        
        
        
        
    }
    
    
}
