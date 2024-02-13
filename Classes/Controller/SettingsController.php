<?php

namespace Arcadia\Fepanel\Controller;

use Arcadia\Fepanel\Domain\Model\Setting;
use Arcadia\Fepanel\Domain\Repository\SettingRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class SettingsController extends ActionController
{
    /**
     * @param SettingRepository $settingRepository
     * @param PersistenceManager $persistenceManager
     * @param Context $context
     */
    public function __construct(
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
     * @param Setting $setting
     * @return ResponseInterface
     */
    public function showAction(Setting $setting): ResponseInterface
    {
        $this->view->assign('setting', $setting);
        return $this->htmlResponse();
    }

    /**
     * @return ResponseInterface
     * @throws AspectNotFoundException
     */
    public function addFormAction(): ResponseInterface
    {
        $userUid = $this->context->getPropertyFromAspect('frontend.user', 'id');
        $setting = $this->settingRepository->findOneByUser($userUid);

        $this->view->assign('userUid', $userUid);
        $this->view->assign('setting', $setting);

        return $this->htmlResponse();
    }

    /**
     * @param Setting $setting
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     */
    public function addAction(Setting $setting): ResponseInterface
    {
        $this->settingRepository->add($setting);
        $this->persistenceManager->persistAll();

        return (new ForwardResponse('show'))
            ->withArguments(['setting' => $setting]);
    }
}
