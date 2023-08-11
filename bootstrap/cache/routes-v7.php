<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::e5JoYlr7cSVnNPgp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pAEp4Q3RDUk0f2Ga',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/registration' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::36NfbMkEBSbrFYFh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'email.verify',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y5y2TQYk5Yt3r34k',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F7ZWayx84qPoQkl8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/resend' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MUBd3LSCT7lQ0S4s',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fVJrbJs9Jaw7ra7S',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vhmhWyqsgSvWBZhZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N3lXg2eJEyENyn85',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xak2Ha6416chkdzj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fCBQVgISCkGNVReX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/links' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ho0oUST94yJZNdbd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u3O6ER0Z9PYcNTc4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/groups' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hI0T2mqB7CB6I5nc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IpP6RKkLWJJOnJVM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/auth/([^/]++)/(?|redirect(*:33)|callback(*:48))|/permissions/(?|([^/]++)(*:80)|sync(*:91))|/user/([^/]++)(?|(*:116))|/l(?|/([^/]++)(*:139)|inks/([^/]++)(?|(*:163)))|/groups/([^/]++)(?|(*:192)))/?$}sDu',
    ),
    3 => 
    array (
      33 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aQ47Cn2nZzyAqh72',
          ),
          1 => 
          array (
            0 => 'provider',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      48 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2F0PW9fCuJBYRc2F',
          ),
          1 => 
          array (
            0 => 'provider',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      80 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iy2N72TGngb7qnid',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      91 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xfmy1gNgtTXTODGP',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      116 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::moQFemUrW2OjJMi9',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7QtqU0mHm0VO7tc6',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eiPHjVSKSLI1IQgi',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      139 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'link.referral',
          ),
          1 => 
          array (
            0 => 'referral',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i2H3AGhEQJIpvKTw',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::reoThJnHbZT9Daf1',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tiE6js0Hl7BdwaEd',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3EfDbzTT0jMoZAie',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sslJ0QRlxCabjoCu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::35xhDUTO6uw3PBGq',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        3 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::e5JoYlr7cSVnNPgp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:44:"function () {
    return \\view(\'welcome\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000055d0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::e5JoYlr7cSVnNPgp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pAEp4Q3RDUk0f2Ga' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'auth',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@login',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@login',
        'as' => 'generated::pAEp4Q3RDUk0f2Ga',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aQ47Cn2nZzyAqh72' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auth/{provider}/redirect',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@oauth',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@oauth',
        'as' => 'generated::aQ47Cn2nZzyAqh72',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2F0PW9fCuJBYRc2F' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auth/{provider}/callback',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@callback',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@callback',
        'as' => 'generated::2F0PW9fCuJBYRc2F',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::36NfbMkEBSbrFYFh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'registration',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@registration',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@registration',
        'as' => 'generated::36NfbMkEBSbrFYFh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'email.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'email/verify',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@emailVerify',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@emailVerify',
        'as' => 'email.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@getResetPassword',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@getResetPassword',
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y5y2TQYk5Yt3r34k' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'change-password',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@resetPassword',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@resetPassword',
        'as' => 'generated::Y5y2TQYk5Yt3r34k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F7ZWayx84qPoQkl8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@forgotPassword',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@forgotPassword',
        'as' => 'generated::F7ZWayx84qPoQkl8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MUBd3LSCT7lQ0S4s' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'email/resend',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@resend',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@resend',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::MUBd3LSCT7lQ0S4s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fVJrbJs9Jaw7ra7S' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@logout',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fVJrbJs9Jaw7ra7S',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vhmhWyqsgSvWBZhZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@index',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@index',
        'namespace' => NULL,
        'prefix' => '/permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::vhmhWyqsgSvWBZhZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iy2N72TGngb7qnid' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'permissions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@show',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@show',
        'namespace' => NULL,
        'prefix' => '/permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::iy2N72TGngb7qnid',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xfmy1gNgtTXTODGP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'permissions/sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@sync',
        'controller' => 'App\\Modules\\Auth\\Http\\Controllers\\PermissionsController@sync',
        'namespace' => NULL,
        'prefix' => '/permissions',
        'where' => 
        array (
        ),
        'as' => 'generated::xfmy1gNgtTXTODGP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N3lXg2eJEyENyn85' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/info',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@getInfo',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@getInfo',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::N3lXg2eJEyENyn85',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xak2Ha6416chkdzj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@index',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@index',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::xak2Ha6416chkdzj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fCBQVgISCkGNVReX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@store',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@store',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::fCBQVgISCkGNVReX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::moQFemUrW2OjJMi9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@show',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@show',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::moQFemUrW2OjJMi9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7QtqU0mHm0VO7tc6' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'user/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@update',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@update',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::7QtqU0mHm0VO7tc6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eiPHjVSKSLI1IQgi' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'user/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
          1 => 'role:admin',
        ),
        'uses' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@delete',
        'controller' => 'App\\Modules\\Users\\Http\\Controllers\\UserController@delete',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::eiPHjVSKSLI1IQgi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'link.referral' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'l/{referral}',
      'action' => 
      array (
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@referral',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@referral',
        'as' => 'link.referral',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ho0oUST94yJZNdbd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'links',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@index',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@index',
        'namespace' => NULL,
        'prefix' => 'links',
        'where' => 
        array (
        ),
        'as' => 'generated::ho0oUST94yJZNdbd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u3O6ER0Z9PYcNTc4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'links',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@store',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@store',
        'namespace' => NULL,
        'prefix' => 'links',
        'where' => 
        array (
        ),
        'as' => 'generated::u3O6ER0Z9PYcNTc4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i2H3AGhEQJIpvKTw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'links/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@show',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@show',
        'namespace' => NULL,
        'prefix' => 'links',
        'where' => 
        array (
        ),
        'as' => 'generated::i2H3AGhEQJIpvKTw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::reoThJnHbZT9Daf1' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'links/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@update',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@update',
        'namespace' => NULL,
        'prefix' => 'links',
        'where' => 
        array (
        ),
        'as' => 'generated::reoThJnHbZT9Daf1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tiE6js0Hl7BdwaEd' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'links/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@delete',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\LinkController@delete',
        'namespace' => NULL,
        'prefix' => 'links',
        'where' => 
        array (
        ),
        'as' => 'generated::tiE6js0Hl7BdwaEd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hI0T2mqB7CB6I5nc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'groups',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@index',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@index',
        'namespace' => NULL,
        'prefix' => 'groups',
        'where' => 
        array (
        ),
        'as' => 'generated::hI0T2mqB7CB6I5nc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IpP6RKkLWJJOnJVM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'groups',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@store',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@store',
        'namespace' => NULL,
        'prefix' => 'groups',
        'where' => 
        array (
        ),
        'as' => 'generated::IpP6RKkLWJJOnJVM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3EfDbzTT0jMoZAie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'groups/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@show',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@show',
        'namespace' => NULL,
        'prefix' => 'groups',
        'where' => 
        array (
        ),
        'as' => 'generated::3EfDbzTT0jMoZAie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sslJ0QRlxCabjoCu' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'groups/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@update',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@update',
        'namespace' => NULL,
        'prefix' => 'groups',
        'where' => 
        array (
        ),
        'as' => 'generated::sslJ0QRlxCabjoCu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::35xhDUTO6uw3PBGq' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'groups/{id}',
      'action' => 
      array (
        'middleware' => 'auth:sanctum',
        'uses' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@delete',
        'controller' => 'App\\Modules\\Links\\Http\\Controllers\\GroupController@delete',
        'namespace' => NULL,
        'prefix' => 'groups',
        'where' => 
        array (
        ),
        'as' => 'generated::35xhDUTO6uw3PBGq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
