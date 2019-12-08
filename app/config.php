<?php

use function DI\create;
use function DI\get;
use Tourniquet\Contracts\TourniquetEntryContract;
use Tourniquet\TourniquetEntry;
use Tourniquet\Contracts\TourniquetUserAccountContract;
use Tourniquet\UserAccount;
use Tourniquet\Contracts\TourniquetConfigurationManagerContract;
use Tourniquet\Persistence\TourniquetEntryConfigurations;
use Tourniquet\TourniquetService;
use Tourniquet\Persistence\UserAccountRepository;
use Tourniquet\Contracts\UserAccountRepositoryContract;
use Tourniquet\Contracts\TourniquetHardwareApiContract;
use Tourniquet\Persistence\TourniquetHardwareApi;

return [
    TourniquetEntryContract::class                => create(TourniquetEntry::class)
        ->constructor(
            get(TourniquetConfigurationManagerContract::class),
            get(TourniquetHardwareApiContract::class)
        ),
    UserAccountRepositoryContract::class          => create(UserAccountRepository::class),
    TourniquetUserAccountContract::class          => create(UserAccount::class),
    TourniquetConfigurationManagerContract::class => create(TourniquetEntryConfigurations::class),
    TourniquetHardwareApiContract::class          => create(TourniquetHardwareApi::class),
    'tservice'                                    => create(TourniquetService::class)
        ->constructor(
            get(TourniquetEntryContract::class),
            get(UserAccountRepositoryContract::class)
        ),
];