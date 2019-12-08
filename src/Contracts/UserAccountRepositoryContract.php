<?php

namespace Tourniquet\Contracts;

use Tourniquet\UserAccount;

interface UserAccountRepositoryContract
{
    public function getById($id): ?TourniquetUserAccountContract;

    public function save(TourniquetUserAccountContract $account);
}