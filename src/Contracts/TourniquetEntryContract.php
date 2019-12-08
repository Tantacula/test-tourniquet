<?php namespace Tourniquet\Contracts;

/**
 * Отвечает за доступ к информации о проходе
 */
interface TourniquetEntryContract
{
    public function setEntryId(string $entryId);

    public function getEntryId();

    public function openEntry();

    public function closeEntry();

    public function isOpened();

    public function isClosed();

    public function getCostForAccount($accountId);
}