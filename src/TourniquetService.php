<?php namespace Tourniquet;

use Tourniquet\Contracts\TourniquetEntryContract;
use Tourniquet\Contracts\TourniquetUserAccountContract;
use Tourniquet\Contracts\UserAccountRepositoryContract;

class TourniquetService
{
    /**
     * @var TourniquetEntryContract
     */
    private $entry;
    /**
     * @var TourniquetUserAccountContract
     */
    private $userAccountRepository;

    /**
     * TourniquetManager constructor.
     *
     * @param TourniquetEntryContract       $entry
     * @param TourniquetUserAccountContract $userAccount
     */
    public function __construct(TourniquetEntryContract $entry, UserAccountRepositoryContract $userAccountRepository)
    {
        $this->entry = $entry;
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * @param string $entryId
     * @param int    $userAccountId
     */
    public function openEntry(string $entryId, int $userAccountId)
    {
        $entry = $this->getEntry($entryId);
        /** @var UserAccount $userAccount */
        $userAccount = $this->userAccountRepository->getById($userAccountId);

        if ($entry->isOpened()) {
            return;
        }

        $userAccount->initiateTourniquetOpeningRequirements($entry);
        $entry->openEntry();
    }

    public function closeEntry(string $entryId)
    {
        $entry = $this->getEntry($entryId);
        $entry->closeEntry();
    }

    /**
     * @param string $entryId
     *
     * @return TourniquetEntryContract
     */
    private function getEntry(string $entryId): TourniquetEntryContract
    {
        $this->entry->setEntryId($entryId);

        return $this->entry;
    }

    public function isEntryOpened(string $entryId): bool
    {
        $entry = $this->getEntry($entryId);

        return $entry->isOpened();
    }

}