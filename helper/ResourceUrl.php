<?php
namespace OmekaTheme\Helper;

use Zend\View\Helper\AbstractHelper;
use Omeka\Api\Representation\AbstractResourceEntityRepresentation;

class ResourceUrl extends AbstractHelper
{
    public function __invoke(AbstractResourceEntityRepresentation $resource)
    {
        $view = $this->getView();
        $pluginManager = $view->getHelperPluginManager();
        $url = null;

        if ($pluginManager->has('ark')) {
            $arkPlugin = $view->plugin('ark');
            $url = $arkPlugin->getAbsoluteUrl($resource);
        }

        if (empty($url) && $pluginManager->has('getResourceFullIdentifier')) {
            $getResourceFullIdentifierPlugin = $view->plugin('getResourceFullIdentifier');
            $url = $getResourceFullIdentifierPlugin($resource);
        }

        if (empty($url)) {
            $url = $resource->url();
        }

        return $url;
    }
}
