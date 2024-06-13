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

        $data = $response->getBody();

        if ($response->getStatusCode() === 200) {
            if (isset($data['code']) && $data['code'] === 0) {
                $result->isOK = true;
                $result->data = $data['data'];
                return $result;
            }
        }

        if (!empty($data['Message'])) {
            $result->errorMessage = $data['Message'];
        } else if (!empty($data['errors'])) {
            $result->errorMessage = implode(', ', array_column($data['errors'], 'message'));
        } else {
            $result->errorMessage = is_scalar($data) ? (string) $data : json_encode($data);
        }

        if (!empty($data['errors'])) {
            $result->errorCode = implode(', ', array_column($data['errors'], 'code'));
        } else {
            $result->errorCode = $response->getStatusCode();
        }

        return $result;
    }
}
