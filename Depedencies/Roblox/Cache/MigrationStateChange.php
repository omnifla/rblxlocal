<?php

namespace Roblox\Cache;

class MigrationStateChange
{
    public readonly MigrationState $sourceState;
    public readonly MigrationState $destinationState;
    public int $rolloutPerThousand;

    public function __construct(MigrationState|string $sourceOrString, ?MigrationState $destinationState = null, ?int $rolloutPerThousand = null)
    {
        if (is_string($sourceOrString)) {
            $this->constructFromString($sourceOrString);
        } elseif ($sourceOrString instanceof MigrationState && $destinationState instanceof MigrationState && is_int($rolloutPerThousand)) {
            $this->validateAndAssign($sourceOrString, $destinationState, $rolloutPerThousand);
        } else {
            throw new \InvalidArgumentException("Invalid parameters passed to MigrationStateChange constructor.");
        }
    }

    private function validateAndAssign(MigrationState $source, MigrationState $destination, int $rolloutPerThousand): void
    {
        if ($rolloutPerThousand < 0 || $rolloutPerThousand > 1000) {
            throw new \InvalidArgumentException("rolloutPerThousand must be between 0 and 1000. Got: $rolloutPerThousand");
        }

        $this->sourceState = $source;
        $this->destinationState = $destination;
        $this->rolloutPerThousand = $rolloutPerThousand;
    }

    private function constructFromString(string $migrationStateChange): void
    {
        if (trim($migrationStateChange) === '') {
            $this->sourceState = MigrationState::NoMigration;
            $this->destinationState = MigrationState::NoMigration;
            $this->rolloutPerThousand = 0;
            return;
        }

        $parts = explode(',', $migrationStateChange);
        if (count($parts) !== 3) {
            throw new \InvalidArgumentException("Expected format: SourceState,DestinationState,RolloutPerThousand. Got: $migrationStateChange");
        }

        [$src, $dst, $rate] = $parts;

        $source = MigrationState::tryFromName($src);
        if (!$source) {
            throw new \InvalidArgumentException("Invalid SourceState: $src");
        }

        $destination = MigrationState::tryFromName($dst);
        if (!$destination) {
            throw new \InvalidArgumentException("Invalid DestinationState: $dst");
        }

        if (!ctype_digit($rate) || ($rate < 0 || $rate > 1000)) {
            throw new \InvalidArgumentException("Invalid RolloutPerThousand: $rate");
        }

        $this->validateAndAssign($source, $destination, (int)$rate);
    }

    public function isSourceAndDestinationStateSame(): bool
    {
        return $this->sourceState === $this->destinationState;
    }

    public function __toString(): string
    {
        return "{$this->sourceState->name},{$this->destinationState->name},{$this->rolloutPerThousand}";
    }

    public function equals(MigrationStateChange $other): bool
    {
        return $this->sourceState === $other->sourceState &&
               $this->destinationState === $other->destinationState &&
               $this->rolloutPerThousand === $other->rolloutPerThousand;
    }

    public function __equals(object $obj): bool
    {
        return $obj instanceof self && $this->equals($obj);
    }

    public function hashCode(): int
    {
        return (($this->sourceState->value * 397) ^ $this->destinationState->value) * 397 ^ $this->rolloutPerThousand;
    }
}
