<?php

declare(strict_types=1);

namespace ErdmannFreunde\ContaoMemberMapBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ErdmannFreunde\ContaoMemberMapBundle\ErdmannFreundeContaoMemberMapBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ErdmannFreundeContaoMemberMapBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}
