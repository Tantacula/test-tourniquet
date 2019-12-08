<?php namespace Tourniquet\Contracts;

interface TourniquetHardwareApiContract
{
    public function open($id);

    public function close($id);

    public function isClosed($id): bool;

    public function isOpened($id): bool;
}