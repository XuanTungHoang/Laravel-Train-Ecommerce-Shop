<?php

namespace App\Http\Middleware;

use Illuminate\Console\Application;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'localhost/learn_laravel/public/api/test'
    ];
    // public function __construct(FoundationApplication $app, Encrypter $encrypter)
    // {
    //     parent::__construct($app, $encrypter);
    //     $this->except = [
    //         route('logout')
    //     ];
    // }
}
