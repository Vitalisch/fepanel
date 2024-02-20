<?php

namespace Arcadia\Fepanel\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

class Setting extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $name = '';

    /**
     * @var string
     */
    protected string $links = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var LazyLoadingProxy|FileReference|null
     * @Lazy
     */
    protected LazyLoadingProxy|FileReference|null $profileImage;

    /**
     * @var int|null
     */
    protected ?int $user = null;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return unserialize($this->links) ? unserialize($this->links) : [];
    }

    /**
     * @param array $links
     */
    public function setLinks(array $links): void
    {
        $this->links = serialize($links);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return FileReference|null
     */
    public function getProfileImage(): ?FileReference
    {
        if ($this->profileImage instanceof LazyLoadingProxy) {
            /** @var FileReference $profileImage */
            $profileImage = $this->profileImage->_loadRealInstance();
            $this->profileImage = $profileImage;
        }

        return $this->profileImage;
    }

    /**
     * @param FileReference $profileImage
     * @return void
     */
    public function setProfileImage(FileReference $profileImage): void
    {
        $this->profileImage = $profileImage;
    }

    /**
     * @return int|null
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @param int|null $user
     */
    public function setUser(?int $user): void
    {
        $this->user = $user;
    }
}
