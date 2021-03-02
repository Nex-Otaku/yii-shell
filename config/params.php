<?php

declare(strict_types=1);

use NexOtaku\YiiShell\ShellCommand;

/**
 * @var $params array
 */

return [
    'yiisoft/yii-console' => [
        'commands' => [
            'shell' => ShellCommand::class,
        ],
    ],
];
