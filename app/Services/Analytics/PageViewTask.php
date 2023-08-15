<?php

namespace App\Services\Analytics {

    use App\Services\Task\Task;
    use Excecption;

    abstract class PageViewTask extends Task
    {
        public static string $taskName = 'nova_page_view_task';

        protected function handle($updatesList)
        {
            foreach ($updatesList as $postId => $args) {
                try {
                    $views = $this->getPostView($args);
                    Analytics::setPageViews($postId, $views);

                    // 删掉
                    unset($updatesList[$postId]);
                } catch (\Exception $e) {
                    // 无视
                }
            }
            return $updatesList;
        }

        abstract protected function getPostView($args): int;
    }
}
