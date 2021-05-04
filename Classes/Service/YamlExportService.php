<?php
declare(strict_types=1);

namespace Supseven\YamlConfiguration\Service;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class YamlExportButton
 */
class YamlExportService
{
    /**
     * @var string
     */
    private $extensionName = 'yaml_configuration';

    /**
     * @var string
     */
    private $path = 'Exports/';

    /**
     * @var string
     */
    private $table = 'be_groups';

    /**
     * @var string
     */
    private $force = '';

    /**
     * @var string
     */
    private $cliCommand = '';

    /**
     * @var array
     */
    private $config = [];

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function export(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $this->config = $this->getExtensionConfiguration();
        } catch (Exception $e) {
            return $this->sendResponse(new JsonResponse(), [
                'status' => '500',
                'title' => 'Configuration Error',
                'message' => $e->getMessage(),
            ]);
        }

        $output = '';
        $returnValue = 0;
        $pathAndFileName = ExtensionManagementUtility::extPath($this->config['extensionName']) . $this->config['path'] . $this->config['table'] . '.yaml';

        if (is_dir(pathinfo($pathAndFileName)['dirname']) === false) {
            return $this->sendResponse(new JsonResponse(), [
                'status' => 1,
                'title' => 'Configuration Error',
                'message' => $this->getTranslation(1, 'message', [ pathinfo($pathAndFileName)['dirname'] ]),
            ]);
        }

        CommandUtility::exec($this->config['cliCommand'] . ' yaml:export ' . $this->config['table'] . ' ' . $pathAndFileName .' '. $this->config['force'],
            $output, $returnValue);
        $responseMessage = [
            'status' => $returnValue,
            'title' => $this->getTranslation($returnValue, 'title'),
            'message' => $this->getTranslation($returnValue, 'message', [ $this->config['table'] .'.yaml' ]),
        ];

        return $this->sendResponse(new JsonResponse(), $responseMessage);
    }

    /**
     * @param ResponseInterface $response
     * @param array $responseMessage
     * @return ResponseInterface
     */
    private function sendResponse(ResponseInterface $response, $responseMessage = []): ResponseInterface
    {
        $response->getBody()->write(\json_encode($responseMessage));
        $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    /**
     * @param $returnValue
     * @param $key
     * @param array $arguments
     * @return string|null
     */
    private function getTranslation($returnValue, $key, $arguments = []): ?string
    {
        return LocalizationUtility::translate('status.'. $returnValue .'.'. $key, $this->config['extensionName'], $arguments) ?: LocalizationUtility::translate('status.'. $returnValue .'.'. $key, $this->extensionName, $arguments);
    }

    /**
     * @return array
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
     * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
     */
    private function getExtensionConfiguration(): array
    {
        $conf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get($this->extensionName);
        return [
            'table' => $conf['table'] ?: $this->table,
            'extensionName' => $conf['extensionName'] ?: $this->extensionName,
            'path' => $conf['path'] ?: $this->path,
            'force' => $conf['force'] ?: $this->force,
            'cliCommand' => $conf['cliCommand'] ?: $this->cliCommand,
        ];
    }
}
