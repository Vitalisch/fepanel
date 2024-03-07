<?php

namespace Arcadia\Fepanel\Controller;

use Arcadia\Fepanel\Domain\Model\Setting;
use Arcadia\Fepanel\Domain\Repository\SettingRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException;
use TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class SettingsController extends ActionController
{
    /**
     * @param ResourceFactory $resourceFactory
     * @param SettingRepository $settingRepository
     * @param PersistenceManager $persistenceManager
     * @param Context $context
     */
    public function __construct(
        private readonly ResourceFactory $resourceFactory,
        private readonly SettingRepository $settingRepository,
        private readonly PersistenceManager $persistenceManager,
        private readonly Context $context
    ) {}

    /**
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $this->view->assign('settings', $this->settingRepository->findAll());
        return $this->htmlResponse();
    }

    /**
     * @param Setting|null $setting
     * @return ResponseInterface
     * @throws AspectNotFoundException
     */
    public function showAction(Setting $setting = null): ResponseInterface
    {
        if ($setting === null) {
            $userUid = $this->context->getPropertyFromAspect('frontend.user', 'id');
            $setting = $this->settingRepository->findOneByUser($userUid);
        }

        $this->view->assign('setting', $setting);
        return $this->htmlResponse();
    }

    /**
     * @param Setting|null $setting
     * @return ResponseInterface
     * @throws AspectNotFoundException
     */
    public function addFormAction(Setting $setting = null): ResponseInterface
    {
        if ($setting === null) {
            $userUid = $this->context->getPropertyFromAspect('frontend.user', 'id');
            $setting = $this->settingRepository->findOneByUser($userUid);
        }

        $this->view->assign('userUid', $userUid ?? null);
        $this->view->assign('setting', $setting);

        return $this->htmlResponse();
    }

    /**
     * @param Setting $setting
     * @return ResponseInterface
     * @throws ExistingTargetFileNameException
     * @throws IllegalObjectTypeException
     * @throws InsufficientFolderAccessPermissionsException
     */
    public function addAction(Setting $setting): ResponseInterface
    {
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
            $originalFilePath = $_FILES['file']['tmp_name'];
            $newFileName = $_FILES['file']['name'];

            $storage = $this->resourceFactory->getDefaultStorage();
            $targetFolder = $storage->getFolder('user_upload/');
            $file = $storage->addFile($originalFilePath, $targetFolder, $newFileName, DuplicationBehavior::REPLACE);
            $fileReference = $this->resourceFactory->createFileReferenceObject(
                [
                    'uid_local' => $file->getUid(),
                    'uid_foreign' => uniqid('NEW_'),
                    'uid' => uniqid('NEW_'),
                    'crop' => null,
                ]
            );
            /** @var FileReference $modelFileReference */
            $modelFileReference = GeneralUtility::makeInstance(FileReference::class);
            $modelFileReference->setOriginalResource($fileReference);
            $setting->setProfileImage($modelFileReference);
        }

        $arguments = $this->request->getArguments();

        if (isset($arguments['title']) && isset($arguments['url'])) {
            $setting->setLinks([
                'title' => $arguments['title'],
                'url' => $arguments['url']
            ]);
        }

        $this->settingRepository->add($setting);
        $this->persistenceManager->persistAll();

        return (new ForwardResponse('show'))
            ->withArguments(['setting' => $setting]);
    }
}
