<?php 

namespace Arcadia\Fepanel\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class SettingsController extends ActionController
{
    public function addFormAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}