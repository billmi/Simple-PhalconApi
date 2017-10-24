<?php

namespace Marser\App\Interceptor;

use Phalcon\Http\Request;

interface InterceptorInterface
{

    function exec(Request $req);

}