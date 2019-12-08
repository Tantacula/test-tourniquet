<?php namespace Tourniquet\Contracts;

interface TourniquetConfigurationManagerContract
{
    public function getConfigForEntryId(string $entryId);
}