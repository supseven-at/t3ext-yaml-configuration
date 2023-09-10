<?php
declare(strict_types=1);

namespace Supseven\YamlConfiguration\Backend\ButtonBar;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\GenericButton;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Class YamlExportButton
 */
class YamlExportButton
{
    private IconFactory $iconFactory;
    private PageRenderer $pageRenderer;
    private GenericButton $genericButton;
    private ExtensionConfiguration $extensionConfiguration;

    protected array $tables = [
        'be_groups' => [
            'buttonBarPosition' => ButtonBar::BUTTON_POSITION_LEFT,
            'index' => 60,
            'extEmConfKey' => 'showYamlExportButtonForBeGroup'
        ]
    ];

    public function __construct(
        IconFactory $iconFactory,
        PageRenderer $pageRenderer,
        GenericButton $genericButton,
        ExtensionConfiguration $extensionConfiguration
    ) {
        $this->iconFactory = $iconFactory;
        $this->pageRenderer = $pageRenderer;
        $this->genericButton = $genericButton;
        $this->extensionConfiguration = $extensionConfiguration;
    }

    /**
     * @param ModifyButtonBarEvent $event
     * @return void
     */
    public function __invoke(ModifyButtonBarEvent $event): void
    {
        // Get existing buttons
        $buttons = $event->getButtons();

        // Add buttons
        foreach ($this->tables as $table => $options) {
            if (!$this->isButtonEnabled($table) || !$this->isApplicableTable($table, $buttons)) {
                break;
            }
            // Generate Export button
            $button = $this->genericButton
                ->setTag('a')
                ->setHref('#')
                ->setLabel('Export table to yaml')
                ->setTitle('Export the complete be_groups table into a yaml file. (part of EXT:yaml_configuration)')
                ->setShowLabelText(true)
                ->setIcon($this->iconFactory->getIcon('actions-document-export-t3d'))
                ->setClasses('t3js-yaml-export');

            // Add button directly to array instead of using ->getButtonBar as this needs too much memory
            $buttons[$options['buttonBarPosition']][$options['index']][] = $button;
        }
        // @todo: Load Javascript with native ES6 modules instead of RequireJs (which is deprecated)
        $this->pageRenderer->loadRequireJsModule('TYPO3/CMS/YamlConfiguration/Backend');

        // Persist final buttons configuration
        $event->setButtons($buttons);
    }

    /**
     * Check if button is enabled in extension configuration
     *
     * @param string $configOption
     * @return bool
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function isButtonEnabled(string $table): bool
    {
        try {
            return (bool)$this->extensionConfiguration->get(
                'yaml_configuration',
                trim($this->tables[$table]['extEmConfKey'])
            );
        } catch (ExtensionConfigurationExtensionNotConfiguredException $e) {
            throw new \RuntimeException(
                'EXT:yaml_configuration Configuration can not be accessed. Please set them up in the install tool: '
                . $e->getMessage()
            );
        }
    }

    /**
     * Check if single table mode of list module is activated
     *
     * @todo: Re-integrate the checks in a more readable way (check method body)
     *
     * @param string $table
     * @param array $buttons
     * @return bool
     */
    protected function isApplicableTable(string $table, array $buttons): bool
    {
        if (!array_key_exists('table', $this->getRequest()->getQueryParams())) {
            return false;
        }
        return ($this->getRequest()->getAttributes()['routing']->getRoute()->getPath() === '/module/web/list') &&
            ($this->getRequest()->getQueryParams()['table'] === $table);
    }

    private function getRequest(): ServerRequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}
