<?php
/**
 * FileName:Http.php
 * Author:ZhangZhe
 * Email:1061180002@qq.com
 * Date:2022/6/29 0029
 * Time:16:15
 */
declare(strict_types=1);

namespace Huyingkeji\Qdgsdk;

/**
 * NameSpace: HuYing\Qdgapisdk
 * ClassName: Http
 * 描述:http工具类
 */
class Http {
    public static function httpGet(string $url, array $data = [], array $header = []) {
        return self::httpRequest("get", $url, $data, $header);
    }

    public static function httpPost(string $url, array $data = [], array $header = []) {
        return self::httpRequest("post", $url, $data, $header);
    }

    private static function httpRequest(string $method, string $url, array $data, array $header = []) {
        $newHeader = [];
        foreach ($header as $k => $v) {
            $newHeader[] = $k . ": " . $v;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ("post" === strtolower($method)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["content" => $data], 256));
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($data));
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $newHeader);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $errmsg = curl_error($ch);
        $errcode = curl_errno($ch);
        $curlInfo = curl_getinfo($ch);
        if ($curlInfo['http_code'] !== 200) {
            curl_close($ch);
            throw new \RuntimeException($errmsg ?: "响应出现错误!请检查参数设置");
        }
        if (curl_error($ch) || $output == false || $errcode != 0) {
            curl_close($ch);
            throw new \RuntimeException($errmsg ?: "请求出现错误!请检查参数设置");
        }
        curl_close($ch);
        return $output;
    }
}

















