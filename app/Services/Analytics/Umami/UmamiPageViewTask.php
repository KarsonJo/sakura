<?php

namespace App\Services\Analytics\Umami {

    use Exception;
    use App\Services\Analytics\PageViewTask;

    class UmamiPageViewTask extends PageViewTask
    {
        protected function getPostView($args): int
        {
            // 获取secret
            $baseUrl = of_get_option('analytics_api_domain', '');
            $authToken = of_get_option('analytics_api_token', '');

            // header
            $headers = array(
                'Authorization' => "Bearer $authToken",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            );

            // 向umami发送请求
            $umami_url = trailingslashit($baseUrl) . 'stats' . '?' . http_build_query([
                'startAt' => '0',
                'endAt' => time() . '000',
                'url' => $args['path'],
            ]);


            $response = wp_remote_get($umami_url, ["headers" => $headers]);

            if (is_wp_error($response))
                throw new Exception($response->get_error_message());
            // if (rand(1, 10) <= 10)
            //     throw new Exception("mock network error");


            if (!empty($response['body']))
                $data = json_decode($response['body'], true);

            return \intval($data['uniques']['value']) ?? 0;
        }
    }
}
