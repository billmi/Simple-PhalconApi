<?php

namespace Marser\App\Response;

interface HttpCode
{
    /**
     * 成功
     */
    const SUCCESS = 200;

    /**
     * 错误请求
     */
    const BAD_REQUEST = 400;

    /**
     * 未授权
     */
    const UN_AUTH = 401;

    /**
     * 禁止访问
     */
    const FORBIDDEN = 403;

    /**
     * 未找到
     */
    const NOT_FOUND = 404;

    /**
     * 服务器错误
     */
    const SERVER_ERR = 500;
}