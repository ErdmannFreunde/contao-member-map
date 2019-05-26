<?php

declare(strict_types=1);

namespace ErdmannFreunde\ContaoMemberMapBundle\Module;

use Contao\{BackendTemplate, Config, Module, PageModel, StringUtil, System};
use Doctrine\DBAL\Connection;
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
        $memberGroupIds = StringUtil::deserialize($this->mapMemberGroups, true);
        /** @var Connection $connection */
        $connection = System::getContainer()->get('database_connection');

        $statement = $connection->createQueryBuilder()
            ->select('*', 'm2g.group_id')
            ->from('tl_member', 'm')
            ->innerJoin('m', 'tl_member_to_group', 'm2g', 'm2g.member_id=m.id')
            ->where('m2g.group_id IN (:groups)')
            ->setParameter('groups', $memberGroupIds, Connection::PARAM_STR_ARRAY)
            ->execute();

        if (false === $statement) {
            $this->Template->message = 'Keine Einträge gefunden';
            return;
        }

        $places = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            try {
                $title = StringUtil::parseSimpleTokens($this->mapPlaceTitle, $row) ?: $row['city'];
            } catch (\Exception $e) {
                $title = $row['city'];
            }

            $places[$row->group_id][] = [$title, $row['geo_latitude'], $row['geo_longitude']];
        }

        $this->Template->placesJson = json_encode($places);
        $this->Template->apiKey     = $this->getApiKey();
    }

    private function getApiKey(): string
    {
        global $objPage;

        if (null !== ($rootPage = PageModel::findByPk($objPage->rootId))) {
            $key = $rootPage->dlh_googlemaps_apikey;
        }

        if (!$key) {
            $key = Config::get('dlh_googlemaps_apikey');
        }

        if (!$key) {
            $key = Config::get('googleMapsApiKey');
        }

        return (string) $key;
    }
}
