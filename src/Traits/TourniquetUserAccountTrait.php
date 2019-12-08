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
        if($this->canActivateTourniquetForFree()) {
            return true;
        }

        $cost = $entry->getCostForAccount($this->getAccountId());
        if ($cost > 0) {
            $this->deductFromBalance($cost);
        }

        return true;
    }

    public function canActivateTourniquetForFree(): bool
    {
        // todo: на случай, если пользователь по той или иной причине может проходить бесплатно
        return false;
    }
}