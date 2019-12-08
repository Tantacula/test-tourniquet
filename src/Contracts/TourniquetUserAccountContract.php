<?php namespace Tourniquet\Contracts;

interface TourniquetUserAccountContract
{
    public function getAccountId(): int;

    public function initiateTourniquetOpeningRequirements(TourniquetEntryContract $entry): bool;

    public function getBalance(): int;

    public function setBalance(int $amount): void;

    public function addToBalance(int $amount);

    public function deductFromBalance(int $amount);

    public function canActivateTourniquetForFree(): bool;
}