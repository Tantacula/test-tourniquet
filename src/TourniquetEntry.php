<?php namespace Tourniquet;

use Tourniquet\Contracts\TourniquetConfigurationManagerContract;
use Tourniquet\Contracts\TourniquetEntryContract;
use Tourniquet\Contracts\TourniquetHardwareApiContract;
use Tourniquet\Contracts\UserAccountRepositoryContract;
use Tourniquet\Exceptions\InvalidEntryIdException;

/**
 * Class TourniquetEntry
 *
 * @package Tourniquet
 */
class TourniquetEntry implements TourniquetEntryContract
{
    /**
     * @var string
     */
    private $entryId = null;

    /**
     * @var TourniquetConfigurationManagerContract
     */
    private $config;

    /**
     * @var TourniquetHardwareApiContract
     */
    private $hw;

    /**
     * TourniquetEntry constructor.
     *
     * @param TourniquetConfigurationManagerContract $config
     * @param TourniquetHardwareApiContract          $hw
     */
    public function __construct(
        TourniquetConfigurationManagerContract $config,
        TourniquetHardwareApiContract $hw
    ) {
        $this->config = $config;
        $this->hw = $hw;
    }

    /**
     * @param string $entryId
     *
     * @throws InvalidEntryIdException
     */
    public function setEntryId(string $entryId): void
    {
        $this->entryId = $entryId;
    }

    public function getEntryId(): ?string
    {
        return $this->entryId;
    }

    public function openEntry()
    {
        $this->hw->open($this->entryId);
    }

    public function closeEntry(): void
    {
        $this->hw->close($this->entryId);
    }

    public function isOpened(): bool
    {
        return (bool)$this->hw->isOpened($this->entryId);
    }

    public function isClosed(): bool
    {
        return (bool)!$this->hw->isOpened($this->entryId);
    }

    public function getEntryConfig()
    {
        return $this->config->getConfigForEntryId($this->entryId);
    }

    public function getPassCost(): int
    {
        $entryConfig = $this->getEntryConfig();
        if (!$entryConfig || !$entryConfig->cost) {
            return 0;
        }

        return $entryConfig->cost;
    }
}