<?php

namespace App\Services\Analytics {
    use WP_Post;
    abstract class AnalyticsProvider
    {
        protected array $updatesList = [];

        public function __construct()
        {
            add_action('shutdown', [$this, 'submitTasks']);
        }

        /**
         * 将目标加入浏览量更新任务队列
         * @param WP_Post|int $post 
         * @param array $args 查询需要的参数，与具体实现有关
         */
        public function pushUpdatePostViews(WP_Post $post, array $args = [])
        {
            $this->updatesList[$post->ID] = $args;
        }

        abstract public function submitTasks();
    }
}
