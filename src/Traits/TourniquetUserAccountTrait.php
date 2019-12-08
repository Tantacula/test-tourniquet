<?php namespace Tourniquet\Traits;

use Tourniquet\Contracts\TourniquetEntryContract;

trait TourniquetUserAccountTrait
{
    public function initiateTourniquetOpeningRequirements(TourniquetEntryContract $entry): bool
    {
        return $this->deductEntryCostFromBalance($entry);
    }

    public function deductEntryCostFromBalance(TourniquetEntryContract $entry): bool
    {
        if ($this->canActivateTourniquetForFree()) {
            return true;
        }

        $cost = $this->getTourniquetEntryCostForAccount($entry);
        if ($cost > 0) {
            $this->deductFromBalance($cost);
        }

        return true;
    }

    private function getTourniquetEntryCostForAccount(TourniquetEntryContract $entry): int
    {
        if ($this->canActivateTourniquetForFree()) {
            return 0;
        }
        if (!$entry->getPassCost()) {
            return 0;
        }

        return $entry->getPassCost();
    }

    public function canActivateTourniquetForFree(): bool
    {
        // todo: на случай, если пользователь по той или иной причине может проходить бесплатно
        return false;
    }
}