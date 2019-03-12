<?php

declare(strict_types=1);

namespace ErdmannFreunde\ContaoMemberMapBundle\Module;

use Contao\{BackendTemplate, Module};
use Patchwork\Utf8;


class MemberMap extends Module
{

    protected $strTemplate = 'mod_member_map';

    public function generate(): string
    {
        if ('BE' === TL_MODE) {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD']['member_map'][0]) . ' ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href     = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    protected function compile(): void
    {
        $places = [
            ['Gifhorn', 52.484674, 10.544454],
            ['Alfeld', 51.986717, 9.824915],
            ['Paderborn', 51.718308, 8.755471],
            ['Linz', 48.3059078, 14.286198],
            ['Zell am Main', 49.8090598, 9.8717161],
            ['Bad Breisig', 50.5093, 7.298130000000015]
        ];

        $this->Template->placesJson = json_encode($places);
        $this->Template->apiKey = 'AIzaSyBWhf5ItmL745ISjJ2E0iXSzEoPJm1yp0A';
    }
}
