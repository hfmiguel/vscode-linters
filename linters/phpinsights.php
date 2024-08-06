<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;

return [
    'preset' => 'laravel',
    'ide' => 'vscode',
    'diff_context' => 3,
    'exclude' => [
        'database/*',
        'public/*',
        'resources/*',
        'routes/*',
        'storage/*',
        'tests/*',
        'vendor/*',
    ],
    'config' => [
        LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 160,
        ],
    ],
    'requirements' => [
        'min-quality' => 80,
        'min-complexity' => 90,
        'min-architecture' => 75,
        'min-style' => 95,
        'disable-security-check' => false,
    ],
];
