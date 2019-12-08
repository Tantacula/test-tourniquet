<?php namespace Tourniquet\Persistence;

use Tourniquet\Contracts\TourniquetHardwareApiContract;

class TourniquetHardwareApi implements TourniquetHardwareApiContract
{
    private $tourniquets = [];

    public function open($id)
    {
        $this->tourniquets[(string)$id] = 'opened';
    }

    public function close($id)
    {
        $this->tourniquets[(string)$id] = 'closed';
    }

    public function isClosed($id): bool
    {
        return !$this->isOpened($id);
    }

    public function isOpened($id): bool
    {
        if (!array_key_exists((string)$id, $this->tourniquets)) {
            $this->tourniquets[(string)$id] = 'closed';
        }

        return $this->tourniquets[(string)$id] === 'opened';
    }
}