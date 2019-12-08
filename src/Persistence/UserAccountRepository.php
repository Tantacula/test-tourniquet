<?php namespace Tourniquet\Persistence;

use Tourniquet\Contracts\TourniquetUserAccountContract;
use Tourniquet\Contracts\UserAccountRepositoryContract;
use Tourniquet\UserAccount;

class UserAccountRepository implements UserAccountRepositoryContract
{
    private $accounts = [];

    public function __construct()
    {
        $this->generateAccounts();
    }

    private function generateAccounts()
    {
        $data = [
            ['id' => 1, 'balance' => 35],
            ['id' => 2, 'balance' => 0],
            ['id' => 3, 'balance' => 100],
        ];
        foreach ($data as $el) {
            $user = new UserAccount();
            $user->setAccountId($el['id']);
            $user->addToBalance($el['balance']);

            $this->accounts[(string)$el['id']] = $user;
        }
    }

    public function getById($id): ?TourniquetUserAccountContract
    {
        if (!array_key_exists((string)$id, $this->accounts)) {
            return null;
        }

        return $this->accounts[(string)$id];
    }

    public function save(TourniquetUserAccountContract $account)
    {
        $this->accounts[(string)$account->getAccountId()] = $account;
    }
}