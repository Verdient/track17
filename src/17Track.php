<?php

declare(strict_types=1);

namespace Verdient\Track17;

use Verdient\HttpAPI\AbstractClient;

/**
 * 17Track
 * @author Verdient。
 */
class Track17 extends AbstractClient
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $protocol = 'https';

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $host = 'api.17track.net';

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $routePrefix = 'track/v2.2';

    /**
     * @var string 访问秘钥
     * @author Verdient。
     */
    public $accessToken = null;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $request = Request::class;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function request($path): Request
    {
        /** @var Request*/
        $request = parent::request($path);
        $request->addHeader('17token', $this->accessToken);
        return $request;
    }
}
