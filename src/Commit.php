<?php

declare(strict_types=1);

namespace Changelog\CommitParser;

use Spatie\DataTransferObject\DataTransferObject;

final class Commit extends DataTransferObject
{
    public string $type;

    public ?string $scope;

    public bool $breaking;

    public string $message;

    public ?int $ticket;
}
