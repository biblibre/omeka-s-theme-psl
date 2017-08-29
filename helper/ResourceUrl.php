<?php
namespace OmekaTheme\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Omeka\Api\Representation\AbstractResourceEntityRepresentation;
use Omeka\Module\Manager as ModuleManager;

class ResourceUrl extends AbstractHelper
{
    public function __invoke(AbstractResourceEntityRepresentation $resource)
    {
        $view = $this->getView();
        $url = null;

        try {
            $arkPlugin = $view->plugin('ark');
            $url = $arkPlugin->getAbsoluteUrl($resource);
        } catch (ServiceNotFoundException $e) {
        }

        if (!$url) {
            try {
                $getResourceFullIdentifierPlugin = $view->plugin('getResourceFullIdentifier');
                $url = $getResourceFullIdentifierPlugin($resource);
            } catch (ServiceNotFoundException $e) {
            }
        }

        if (!$url) {
            $url = $resource->url();
        }

        return $url;
    }
}
