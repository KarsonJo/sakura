<?php

namespace App\Services\Analytics {
    use Closure;
    use WP_Post;
    class Analytics
    {
        protected static string $pageViewMetaKey = 'page_views';
        protected static int $pageViewCacheTime = 3 * HOUR_IN_SECONDS;
        private static Closure|AnalyticsProvider $_provider;

        /**
         * 为统计数据绑定一个数据源
         * 当需要获取外界数据时使用
         * @param callable|AnalyticsProvider $provider 数据源，或返回数据源的函数
         */
        public static function setProvider(callable|AnalyticsProvider $provider)
        {
            if (is_callable($provider))
                static::$_provider = Closure::fromCallable($provider);
            else
                static::$_provider = $provider;
        }

        /**
         * 获取绑定的数据源
         * 第一次用到时生成并初始化
         */
        protected static function getProvider(): AnalyticsProvider
        {
            // error_log(111);
            // error_log(gettype(static::$_provider));
            if (static::$_provider instanceof Closure)
                static::$_provider = (static::$_provider)();
            return static::$_provider;
        }

        /**
         * 暂时只支持post/page
         * 如果需要支持所有url，得自建表，开摆
         * @param WP_Post|int $post 
         * @return mixed 
         */
        public static function getPageViews(WP_Post|int $post)
        {
            if (!($post instanceof WP_Post))
                $post = get_post($post);

            if (empty($post)) return 0;


            // 尝试获取缓存
            $pageViews = get_transient(Analytics::pageViewsCacheKey($post->ID));
            if ($pageViews !== false) return $pageViews;


            // 1. 记录更新请求
            static::getProvider()->pushUpdatePostViews($post);
            // 2. 读取数据库记录，这将是最后能够返回的值
            $pageViews = get_post_meta($post->ID, Analytics::$pageViewMetaKey, true) ?: 0;
            // 3. 重写缓存
            set_transient(Analytics::pageViewsCacheKey($post->ID), $pageViews, static::$pageViewCacheTime);
            return $pageViews;
        }

        public static function setPageViews(WP_Post|int $postId, $newViews)
        {
            if ($postId instanceof WP_Post)
                $postId = $postId->ID;

            // 更新缓存
            set_transient(Analytics::pageViewsCacheKey($postId), $newViews, static::$pageViewCacheTime);
            // 写到数据库
            update_post_meta($postId, Analytics::$pageViewMetaKey, $newViews);
        }

        protected static function pageViewsCacheKey(int $postId)
        {
            return static::$pageViewMetaKey . '_' . $postId;
        }
    }
}
