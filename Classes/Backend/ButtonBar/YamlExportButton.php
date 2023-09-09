<?php
declare(strict_types = 1);
namespace Supseven\YamlConfiguration\Backend\ButtonBar;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\LinkButton;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class YamlExportButton
 */
class YamlExportButton
{
    /**
     * @param $params array
     * @param $buttonBar ButtonBar
     * @return mixed
     */
    public function addYamlExportButton($params, &$buttonBar)
    {
        $buttons = $params['buttons'];

        if (
            !($buttons[ButtonBar::BUTTON_POSITION_LEFT][6][0] ?? false) ||
            !$buttons[ButtonBar::BUTTON_POSITION_LEFT][6][0] instanceof LinkButton ||
            (!isset($buttons[ButtonBar::BUTTON_POSITION_LEFT][6][0]->getDataAttributes()['table']) || $buttons[ButtonBar::BUTTON_POSITION_LEFT][6][0]->getDataAttributes()['table'] !== 'be_groups')
        ) {
            return $buttons;
        }

        $table = $buttons[ButtonBar::BUTTON_POSITION_LEFT][6][0]->getDataAttributes()['table'];

        /** @var IconFactory $iconFactory */
        $iconFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconFactory::class);

        $yamlButton = $buttonBar->makeLinkButton()
            ->setTitle('Export Yaml File for ' . $table)
            ->setHref('#')
            ->setClasses('t3js-yaml-export')
            ->setShowLabelText(true)
            ->setIcon($iconFactory->getIcon('actions-document-export-t3d', \TYPO3\CMS\Core\Imaging\Icon::SIZE_SMALL));

        $buttons[\TYPO3\CMS\Backend\Template\Components\ButtonBar::BUTTON_POSITION_LEFT][1337] = [
            0 => $yamlButton,
        ];

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/YamlConfiguration/Backend');

        return $buttons;
    }
}
