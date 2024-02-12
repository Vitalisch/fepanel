<?php

namespace Arcadia\Fepanel\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class SettingRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array('sorting' => QueryInterface::ORDER_ASCENDING);

    /**
     * @return void
     */
    public function initializeObject(): void
    {
        /** @var $querySettings Typo3QuerySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);

        $querySettings
            ->setRespectStoragePage(true)
            ->setStoragePageIds([14]);

        $this->setDefaultQuerySettings($querySettings);
    }
}
