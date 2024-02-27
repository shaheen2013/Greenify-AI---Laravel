<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    $start_date = now()->subDay()->format('Y-m-d');
    $end_date = now()->addDay()->format('Y-m-d');
    $dateRange='ListDate = '. $start_date. ' - '. $end_date;

    $config = new \PHRETS\Configuration;
    $config->setLoginUrl('https://r_idx.gsmls.com/rets_idx/login.do')
            ->setUsername('Step1Solutions')
            ->setPassword('9RGKY8EFISQ9')
            ->setUserAgent('Step1Solutions/1.0')
            ->setUserAgentpassword('Q3TWmp4')
            ->setRetsVersion('1.7.2');

    $rets = new \PHRETS\Session($config);
    $connect = $rets->Login();

    $results = $rets->Search('Property', 'RES', $dateRange, ['MLStatus' => 'A', 'MLStatus' => 'US', 'MLStatus' => 'CS']);

    dd($results);
});
