<?php
use PHPUnit\Framework\TestCase;
use Tourniquet\Exceptions\NotEnoughMoneyException;
use Tourniquet\UserAccount;
use \Tourniquet\Contracts\UserAccountRepositoryContract;

class TourniquetServiceTest extends TestCase
{
    private $container;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->container = require __DIR__ . '/../app/bootstrap.php';
    }

    public function testOpenEntry()
    {
        $this->createAccount(1, 35);

        /** @var \Tourniquet\Persistence\UserAccountRepository $accountRepo */
        $accountRepo = $this->container->get(UserAccountRepositoryContract::class);

        /** @var \Tourniquet\TourniquetService $tservice */
        $tservice = $this->container->get('tservice');
        $tservice->openEntry('one-side-entry', 1);

        $userAccount = $accountRepo->getById(1);
        $this->assertEquals(5, $userAccount->getBalance(), 'Проверка баланса после использования турникета.');
        $this->assertEquals(true, $tservice->isEntryOpened('one-side-entry'), 'Проверка, открыт ли проход.');

        $tservice->openEntry('two-sided-exit', 1);
        $this->assertEquals(true, $tservice->isEntryOpened('two-sided-exit'), 'Проверка открытия выходв.');

        $this->expectException(NotEnoughMoneyException::class);
        $tservice->openEntry('two-sided-entrance', 1);
    }

    private function createAccount(int $id, int $balance) {
        /** @var \Tourniquet\Persistence\UserAccountRepository $accountRepo */
        $accountRepo = $this->container->get(UserAccountRepositoryContract::class);

        $userAccount = new UserAccount();
        $userAccount->setAccountId($id);
        $userAccount->setBalance($balance);
        $accountRepo->save($userAccount);
    }
}