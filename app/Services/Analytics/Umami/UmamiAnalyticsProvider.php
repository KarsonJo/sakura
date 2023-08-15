<?php

namespace App\Services\Analytics\Umami {

    use WP_Post;
    use App\Services\Analytics\AnalyticsProvider;
    use App\Services\Analytics\Umami\UmamiPageViewTask;

    class UmamiAnalyticsProvider extends AnalyticsProvider
    {
        public function submitTasks()
        {
            if ($this->updatesList) {
                UmamiPageViewTask::submitTask(1, $this->updatesList);
            }
        }

        /**
         * @param WP_Post|int $post 
         * @param array $args umami stats参数，不需要传入[url]（暂时传了也无效）
         */
        public function pushUpdatePostViews(WP_Post $post, array $args = [])
        {
            // $args['path'] = urldecode(parse_url(get_permalink($post))['path']);
            $args['path'] = parse_url(get_permalink($post))['path'];
            parent::pushUpdatePostViews($post, $args);
        }
    }
}
