<?php

declare(strict_types=1);

$header = <<<'EOF'
This file is part of PHP CS Fixer.
(c) Fabien Potencier <fabien@symfony.com>
    Dariusz Rumiński <dariusz.ruminski@gmail.com>
This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->ignoreDotFiles(false)
    ->ignoreVCSIgnored(true)
    ->exclude('tests/Fixtures')
    ->exclude('vendor')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        'blank_line_before_statement' => ['statements' => [
            'continue',
            'declare',
            'return',
            'throw',
            'try',
        ]],
        'cast_spaces' => ['space' => 'none'],
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => ['style' => 'post'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'no_leading_import_slash' => true,
        'no_superfluous_phpdoc_tags' => false,
        'ordered_class_elements' => false,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
        'phpdoc_to_comment' => false,
        'yoda_style' => false,
        'is_null' => true,
        'no_alias_functions' => true,
        'non_printable_character' => ['use_escape_sequences_in_strings' => true],
        'no_unused_imports' => true,
        'php_unit_test_class_requires_covers' => false,
    ])
    ->setFinder($finder)
    ->setUsingCache(false);

return $config;