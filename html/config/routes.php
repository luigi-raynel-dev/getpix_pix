<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::addGroup('/api', function () {
    Router::get('/ping', function () {
        return 'pong';
    });
});

Router::addServer('grpc', function () {
    Router::addGroup('/grpc.pix', function () {
        Router::post('/createPixKey', 'App\Controller\PixKeyController@createPixKey');
        Router::post('/updatePixKey', 'App\Controller\PixKeyController@updatePixKey');
        Router::post('/getPixKeys', 'App\Controller\PixKeyController@getPixKeys');
        Router::post('/getPixKey', 'App\Controller\PixKeyController@getPixKey');
        Router::post('/deletePixKey', 'App\Controller\PixKeyController@deletePixKey');
    });
});
