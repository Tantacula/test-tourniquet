<?php namespace Tourniquet\Persistence;

use Tourniquet\Contracts\TourniquetConfigurationManagerContract;
use Tourniquet\Exceptions\InvalidEntryIdException;

class TourniquetEntryConfigurations implements TourniquetConfigurationManagerContract
{
    protected static $params
        = [
            'one-side-entry'     => [
                'cost' => 30,
            ],
            'two-sided-entrance' => [
                'cost' => 30,
            ],
            'two-sided-exit'     => [
                'cost' => 0,
            ]
        ];

    /**
     * @param string $entryId
     *
     * @return object
     * @throws InvalidEntryIdException
     */
    public function getConfigForEntryId(string $entryId): object
    {
        if (!array_key_exists($entryId, static::$params)) {
            throw new InvalidEntryIdException();
        }

        return (object)static::$params[$entryId];
    }
}