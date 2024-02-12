<?php

namespace Arcadia\Fepanel\Controller;

use Arcadia\Fepanel\Domain\Model\Setting;
use Arcadia\Fepanel\Domain\Repository\SettingRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class SettingsController extends ActionController
{
    /**
     * @var SettingRepository
     */
    protected SettingRepository $settingsRepository;

    /**
     * @param SettingRepository $settingsRepository
     */
    public function injectSettingsRepository(SettingRepository $settingsRepository): void
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $this->view->assign('settings', $this->settingsRepository->findAll());
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

    public function addFormAction(Setting $setting = null): ResponseInterface
    {
        $this->view->assign('setting', $setting);
        return $this->htmlResponse();
    }

    public function addAction(Setting $setting): ResponseInterface
    {
        $this->view->assign('setting', $setting);
        return $this->htmlResponse();
    }
}
