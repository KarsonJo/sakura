<?php

namespace App\Services\Analytics {

    use Closure;
    use Exception;
    use WP_Post;

    /**
     * 读取并缓存文章阅读次数
     * 懒更新，虽然读取的永远是旧一次数据，但只按需调用流量分析API
     * 在缓存生效期间：
     * 1. 只读取缓存，避免频繁访问API
     * 
     * 缓存失效时：
     * 1. 从数据库中读取
     * 2. （异步）发送更新请求
     * 3. 存入数据库
     * 4. 存入缓存
     */
    function get_page_view(WP_Post|int $post)
    {
        // return 0;
        return Analytics::getPageViews($post);
    }


    // class Statistics
    // {
    //     protected static string $pageViewMetaKey = 'page_views';
    //     protected static int $pageViewCacheTime = 3 * HOUR_IN_SECONDS;
    //     private static Closure|StatisticsProvider $_provider;

    //     /**
    //      * 为统计数据绑定一个数据源
    //      * 当需要获取外界数据时使用
    //      * @param callable|StatisticsProvider $provider 数据源，或返回数据源的函数
    //      */
    //     public static function setProvider(callable|StatisticsProvider $provider)
    //     {
    //         if (is_callable($provider))
    //             static::$_provider = Closure::fromCallable($provider);
    //         else
    //             static::$_provider = $provider;
    //     }

    //     /**
    //      * 获取绑定的数据源
    //      * 第一次用到时生成并初始化
    //      */
    //     protected static function getProvider(): StatisticsProvider
    //     {
    //         // error_log(111);
    //         // error_log(gettype(static::$_provider));
    //         if (static::$_provider instanceof Closure)
    //             static::$_provider = (static::$_provider)();
    //         return static::$_provider;
    //     }

    //     /**
    //      * 暂时只支持post/page
    //      * 如果需要支持所有url，得自建表，开摆
    //      * @param WP_Post|int $post 
    //      * @return mixed 
    //      */
    //     public static function getPageViews(WP_Post|int $post)
    //     {
    //         if (!($post instanceof WP_Post))
    //             $post = get_post($post);

    //         if (empty($post)) return;


    //         // 尝试获取缓存
    //         $pageViews = get_transient(Statistics::pageViewsCacheKey($post->ID));
    //         if ($pageViews !== false) return $pageViews;


    //         // 1. 记录更新请求
    //         static::getProvider()->pushUpdatePostViews($post);
    //         // 2. 读取数据库记录，这将是最后能够返回的值
    //         $pageViews = get_post_meta($post->ID, Statistics::$pageViewMetaKey, true) ?: 0;
    //         // 3. 重写缓存
    //         set_transient(Statistics::pageViewsCacheKey($post->ID), $pageViews, static::$pageViewCacheTime);
    //         return $pageViews;
    //     }

    //     public static function setPageViews(WP_Post|int $postId, $newViews)
    //     {
    //         if ($postId instanceof WP_Post)
    //             $postId = $postId->ID;

    //         // 更新缓存
    //         set_transient(Statistics::pageViewsCacheKey($postId), $newViews, static::$pageViewCacheTime);
    //         // 写到数据库
    //         update_post_meta($postId, Statistics::$pageViewMetaKey, $newViews);
    //     }

    //     protected static function pageViewsCacheKey(int $postId)
    //     {
    //         return  static::$pageViewMetaKey . '_' . $postId;
    //     }
    // }


    // abstract class StatisticsProvider
    // {
    //     public const PAGE_VIEW_JOB_KEY = 'knc_page_view_bg_job';
    //     protected array $updatesList = [];

    //     public function __construct()
    //     {
    //         add_action('shutdown', [$this, 'submitTasks']);
    //     }

    //     /**
    //      * 将目标加入浏览量更新任务队列
    //      * @param WP_Post|int $post 
    //      * @param array $args 查询需要的参数，与具体实现有关
    //      */
    //     public function pushUpdatePostViews(WP_Post $post, array $args = [])
    //     {
    //         $this->updatesList[$post->ID] = $args;
    //     }
    // }

    // class UmamiStatisticsProvider extends StatisticsProvider
    // {
    //     public function submitTasks()
    //     {
    //         if ($this->updatesList) {
    //             UmamiPageViewTask::submitTask(3, $this->updatesList);
    //         }
    //     }

    //     /**
    //      * @param WP_Post|int $post 
    //      * @param array $args umami stats参数，不需要传入[url]（暂时传了也无效）
    //      */
    //     public function pushUpdatePostViews(WP_Post $post, array $args = [])
    //     {
    //         $args['path'] = parse_url(get_permalink($post))['path'];
    //         parent::pushUpdatePostViews($post, $args);
    //     }
    // }


    // abstract class PageViewTask extends Task
    // {
    //     public static string $taskName = 'nova_page_view_task';

    //     protected function handle($updatesList)
    //     {
    //         foreach ($updatesList as $postId => $args) {
    //             try {
    //                 $views = $this->getPostView($args);
    //                 Statistics::setPageViews($postId, $views);

    //                 // 删掉
    //                 unset($updatesList[$postId]);
    //             } catch (Exception $e) {
    //                 // 无视
    //             }
    //         }
    //         return $updatesList;
    //     }

    //     abstract protected function getPostView($args): int;
    // }

    // class UmamiPageViewTask extends PageViewTask
    // {
    //     protected function getPostView($args): int
    //     {
    //         // 获取secret
    //         $baseUrl = of_get_option('analytics_api_domain', '');
    //         $authToken = of_get_option('analytics_api_token', '');

    //         // header
    //         $headers = array(
    //             'Authorization' => "Bearer $authToken",
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json',
    //         );

    //         // 向umami发送请求
    //         $umami_url = trailingslashit($baseUrl) . 'stats' . '?' . http_build_query([
    //             'startAt' => '0',
    //             'endAt' => time() . '000',
    //             'url' => $args['path'],
    //         ]);


    //         $response = wp_remote_get($umami_url, ["headers" => $headers]);

    //         if (is_wp_error($response))
    //             throw new Exception($response->get_error_message());
    //         if (rand(1, 10) <= 2)
    //             throw new Exception("mock network error");


    //         if (!empty($response['body']))
    //             $data = json_decode($response['body'], true);

    //         return \intval($data['uniques']['value']) ?? 0;
    //     }
    // }


    // Statistics::setProvider(new UmamiStatisticsProvider());
    // // setupStaticstics(StatisticsProvider::PAGE_VIEW_JOB_KEY);
    // TaskManager::registerTask(PageViewTask::$taskName);
    // TaskManager::init();
}
