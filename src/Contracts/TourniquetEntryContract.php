<?php namespace Tourniquet\Contracts;

/**
 * Отвечает за доступ к информации о проходе
 */
interface TourniquetEntryContract
{
    public function setEntryId(string $entryId);

    public function getEntryId(): ?string;

    public function openEntry();

    public function closeEntry();

    public function isOpened(): bool;

    public function isClosed(): bool;

    public function getPassCost(): int;
}