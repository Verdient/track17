<?php

declare(strict_types=1);

namespace Verdient\Track17;

/**
 * 签名
 * @author Verdient。
 */
class Signature
{
    /**
     * 验证签名
     * @param string $content 消息内容
     * @param string $secret 秘钥
     * @param string $sign 签名内容
     * @return bool
     * @author Verdient。
     */
    public static function validate(string $content, string $secret, string $sign): bool
    {
        return hash_equals(hash('sha256', $content . '/' . $secret), $sign);
    }
}
