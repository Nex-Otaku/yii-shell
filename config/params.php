<?php

declare(strict_types=1);

use NexOtaku\YiiShell\ShellCommand;

/**
 * @var $params array
 */

return [
    'nex-otaku/yii-shell' => [
        'commands' => [
            'shell' => ShellCommand::class,
        ],
    ],
];
