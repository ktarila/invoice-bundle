<?php

if (!file_exists(__DIR__.'/src') || !file_exists(__DIR__.'/tests')) {
    exit(0);
}

$finder = (new PhpCsFixer\Finder())
    ->in([__DIR__.'/src', __DIR__.'/tests'])
;

return (new PhpCsFixer\Config())
    ->setRules(array(
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'header_comment' => [
            'header' => <<<EOF
This file is part of the Symfony Invoice Bundle package.
Copyright (c) Patrick Kenekayoro
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF
        ]
    ))
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;