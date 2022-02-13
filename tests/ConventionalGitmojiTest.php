<?php

declare(strict_types=1);

use Changelog\CommitParser\ConventionalGitmoji;

it('can parse all components out of a commit message', function (string $message, ?int $ticket, ?string $scope) {
    $actual = (new ConventionalGitmoji())->parse("$message");

    expect($actual->type)->toBeString();
    expect($actual->scope)->toBe($scope);
    expect($actual->breaking)->toBeFalse();
    expect($actual->message)->toBeString();
    expect($actual->ticket)->toBe($ticket);
})->with([
    [':hello: test: test', null, null],
    [':start: chore(scope): test', null, 'scope'],
    [':start: chore(scope): test #123', 123, 'scope'],
    [':memo: docs: update README.md', null, null],
    [':start: chore(scope): i have a word #123', 123, 'scope'],
    [':package: feat(parser-opts): extract parser-opts packages', null, 'parser-opts'],
    [':sparkles: feat(changelog): 添加中文标题', null, 'changelog'],
    [':sparkles: feat(changelog): add chinese title', null, 'changelog'],
    ['⚡️ feat: add unicode support', null, null],
    ['⚡️ feat: add unicode support #123', 123, null],
    ['⚡️ feat: add unicode support (#123)', 123, null],
    ['⚡️ feat(unicode): add unicode support', null, 'unicode'],
    ['⚡️ feat(unicode): add unicode support #123', 123, 'unicode'],
    ['⚡️ feat(unicode): add unicode support (#123)', 123, 'unicode'],
]);
