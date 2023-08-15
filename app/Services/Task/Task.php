<?php

namespace App\Services\Task {
    use Exception;
    abstract class Task
    {
        /**
         * 任务名 需要子类重写
         * @var string
         */
        public static string $taskName;

        /**
         * 提交一个该类型的任务，需要提供必要元数据和执行参数
         */
        public static function submitTask(int $maxRetry, array $taskParams)
        {
            $taskMeta = ['retry' => $maxRetry];
            TaskManager::submitTask(static::class, $taskMeta, $taskParams);
        }

        /**
         * 对应任务触发时的执行逻辑
         * @param mixed $taskMeta 任务元数据
         * @param mixed $taskParams 任务处理数据
         * @throws Exception 若任务未全部完成，抛出异常
         */
        public function handleTask(array $taskMeta, array $taskParams)
        {
            $pushBacks = $this->handle($taskParams);

            /**
             * 任务失败了，需要重新push任务：
             * 1. 有需要执行的东西
             * 2. 有retry的定义且不为0
             */
            if (!empty($pushBacks)) {
                if (!empty($taskMeta['retry'])) {
                    $taskMeta['retry'] -= 1;
                    TaskManager::submitTask(static::class, $taskMeta, $pushBacks);
                    throw new Exception("Retries have been scheduled for some uncompleted tasks. params are: " . var_export($pushBacks, true));
                } else
                    throw new Exception("Some of tasks failed. params are: " . var_export($pushBacks, true));
            }
        }

        /**
         * 任务逻辑主体
         * @param mixed $taskParams 传入给该任务的参数
         * @return mixed 
         */
        protected abstract function handle($taskParams);
    }
}