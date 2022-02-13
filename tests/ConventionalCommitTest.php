<?php

declare(strict_types=1);

use Changelog\CommitParser\ConventionalCommit;

it('parses messages with a scope', function (string $type) {
    $actual = (new ConventionalCommit())->parse("$type(scope)!: this is my long commit message #123");

    expect($actual->type)->toBe($type);
    expect($actual->scope)->toBe('scope');
    expect($actual->breaking)->toBe(true);
    expect($actual->message)->toBe('this is my long commit message');
    expect($actual->ticket)->toBe(123);
})->with(['build', 'chore', 'ci', 'docs', 'feat', 'fix', 'perf', 'refactor', 'revert', 'style', 'test']);

it('parses messages without a scope', function (string $type) {
    $actual = (new ConventionalCommit())->parse("$type: this is my long commit message #123");

    expect($actual->type)->toBe($type);
    expect($actual->scope)->toBe(null);
    expect($actual->breaking)->toBe(false);
    expect($actual->message)->toBe('this is my long commit message');
    expect($actual->ticket)->toBe(123);
})->with(['build', 'chore', 'ci', 'docs', 'feat', 'fix', 'perf', 'refactor', 'revert', 'style', 'test']);

it('parses messages without a ticket', function (string $type) {
    $actual = (new ConventionalCommit())->parse("$type: this is my long commit message");

    expect($actual->type)->toBe($type);
    expect($actual->scope)->toBe(null);
    expect($actual->breaking)->toBe(false);
    expect($actual->message)->toBe('this is my long commit message');
    expect($actual->ticket)->toBe(null);
})->with(['build', 'chore', 'ci', 'docs', 'feat', 'fix', 'perf', 'refactor', 'revert', 'style', 'test']);
