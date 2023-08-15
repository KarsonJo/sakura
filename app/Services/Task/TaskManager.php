<?php

namespace App\Services\Task {
    class TaskManager
    {
        protected static array $taskList;
        public static function init()
        {
            require_once(get_template_directory() . '/vendor/woocommerce/action-scheduler/action-scheduler.php');
            /**
             * 监听事件触发并转交给handler
             */
            foreach (static::$taskList as $taskName) {
                add_action($taskName, [__CLASS__, 'taskActionSubscriber'], 10, 3);
            }
        }

        public static function taskActionSubscriber(string $handlerType, array $meta, array $params)
        {
            $provider = new $handlerType();
            $provider->handleTask($meta, $params);
        }

        public static function registerTask($taskName)
        {
            static::$taskList[] = $taskName;
        }

        public static function submitTask(string $handlerType, array $taskMeta, array $taskParams): int
        {
            if (!$handlerType) return 0;

            $args = ['handler' => $handlerType, 'meta' => $taskMeta, 'params' => $taskParams];
            return as_enqueue_async_action($handlerType::$taskName, $args, md5(json_encode($args)), true);
        }
    }
}
