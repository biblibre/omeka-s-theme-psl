<?php
namespace OmekaTheme\Helper;

use Zend\View\Helper\AbstractHelper;

class FrontPageImage extends AbstractHelper
{
    /**
     * Select a random asset url from the settings and add it to the css.
     *
     * @param string $id Name of the tag where to set the image (with # if needed).
     */
    public function __invoke($id)
    {
        $view = $this->getView();

        $frontPageImages = [];
        for ($i = 1; $i < 11; $i++) {
            $frontPageImage = $view->themeSettingAssetUrl("front_page_image_$i");
            if ($frontPageImage) {
                $frontPageImages[] = $frontPageImage;
            }
        }

        if (!count($frontPageImages)) {
            return;
        }

        $index = rand(0, count($frontPageImages) - 1);
        $url = $frontPageImages[$index];
        $view->headStyle()
            ->appendStyle($id . '{ background-image: url("' . $url . '"); }');
    }
}
