<?php namespace Tourniquet;

use Tourniquet\Contracts\TourniquetUserAccountContract;
use Tourniquet\Exceptions\NotEnoughMoneyException;
use Tourniquet\Traits\TourniquetUserAccountTrait;

class UserAccount implements TourniquetUserAccountContract
{
    use TourniquetUserAccountTrait;

    private $balance = 0;
    private $accountId;

    /**
     * @param int $id
     */
    public function setAccountId(int $id): void
    {
        $this->accountId = $id;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function setBalance(int $amount): void
    {
        $this->balance = $amount;
    }

    public function addToBalance(int $amount): void
    {
        $this->balance += $amount;
    }

    /**
     * @param int $amount
     *
     * @throws NotEnoughMoneyException
     */
    public function deductFromBalance(int $amount): void
    {
        if ($this->balance < $amount) {
            throw new NotEnoughMoneyException('На балансе недостаточно средств.');
        }

        $this->balance -= $amount;
    }
}