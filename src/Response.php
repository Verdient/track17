<?php

declare(strict_types=1);

namespace Verdient\Track17;

use Verdient\http\Response as HttpResponse;
use Verdient\HttpAPI\Result;

/**
 * 响应
 * @author Verdient。
 */
class Response extends \Verdient\HttpAPI\AbstractResponse
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function normailze(HttpResponse $response): Result
    {
        $result = new Result;
        if ($response->getStatusCode() === 200) {
            $data = $response->getBody();
            if (isset($data['code']) && $data['code'] === 0) {
                $result->isOK = true;
                $result->data = $data['data'];
                return $result;
            }
        }
        $result->errorCode = implode(', ', array_column($data['errors'], 'code'));
        $result->errorMessage = implode(', ', array_column($data['errors'], 'message'));
        return $result;
    }
}
