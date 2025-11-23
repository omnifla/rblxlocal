<?php
namespace Roblox\Economy\Common;

use Roblox\Economy\Common\RobuxBalance;
use Roblox\Economy\Common\TicketsBalance;

class UserBalance
{
    private int $userId;
    private RobuxBalance $robuxBalance;
    private TicketsBalance $ticketsBalance;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->robuxBalance = new RobuxBalance($userId);
        $this->ticketsBalance = new TicketsBalance($userId);
    }

    public function GetRobuxBalance(): int
    {
        return $this->robuxBalance->Value;
    }

    public function GetTicketsBalance(): int
    {
        return $this->ticketsBalance->Value;
    }

    public function CreditRobux(int $amount): void
    {
        $this->robuxBalance->Credit($amount);
    }

    public function TryDebitRobux(int $amount): bool
    {
        return $this->robuxBalance->TryDebit($amount);
    }

    public function CreditTickets(int $amount): void
    {
        $this->ticketsBalance->Credit($amount);
    }

    public function TryDebitTickets(int $amount): bool
    {
        return $this->ticketsBalance->TryDebit($amount);
    }

    public function getSummary(): array
    {
        return [
            "robux" => $this->getRobux(),
            "tickets" => $this->getTickets()
        ];
    }
}
