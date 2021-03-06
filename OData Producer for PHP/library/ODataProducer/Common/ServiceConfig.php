<?php
/**
 * Defines the ServiceConfig class
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Common
 * @author    Anu Chandy <odataphpproducer_alias@microsoft.com> 
 * @author    Neelesh Vijaivargia <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\Common;
/**
 * Helper class to read and velidate the service config file
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Common
 * @author    Anu Chandy <odataphpproducer_alias@microsoft.com> 
 * @author    Neelesh Vijaivargia <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class ServiceConfig
{
    /**
     * Read and validates the configuration for the given service.
     * 
     * @param string $serviceName  requested service name
     * @param string &$serviceInfo service info
     * @param string $configFile   config filename for all the services
     * 
     * @return void
     * 
     * @throws ODataException If configuration file 
     * does not exists or malformed.
     */
    public static function validateAndGetsServiceInfo($serviceName,  &$serviceInfo, $configFile = '../../../services/service.config.xml')
    {
        $xml = simplexml_load_file(dirname(__FILE__)."/".$configFile, null, LIBXML_NOCDATA);
        if (!$xml) {
            ODataException::createInternalServerError('service.config file is not in proper XML format');
        }

        if (count($xml->children()) != 1) {
            ODataException::createInternalServerError("Config file has more than one root entries");
        }

        $pathResult = $xml->xpath("/configuration/services/service[@name=\"$serviceName\"]");
        if (empty($pathResult)) {
             ODataException::createBadRequestError("No configuration info found for $serviceName");
        }
                
        $pathResult = $xml->xpath("/configuration/services/service[@name=\"$serviceName\"]/path");
        if (empty($pathResult)) {
            ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file");
        } else {
            $serviceInfo['SERVICE_PATH'] = strval($pathResult[0]);
            if (empty($serviceInfo['SERVICE_PATH'])) {
                ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file or config file is mail formed");
            }
        }
       
        unset($pathResult);
        $pathResult = $xml->xpath("/configuration/services/service[@name=\"$serviceName\"]/classname");
        if (empty($pathResult)) {
            ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file");
        } else {
            $serviceInfo['SERVICE_CLASS'] = strval($pathResult[0]);
            if (empty($serviceInfo['SERVICE_CLASS'])) {
                ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file or config file is mail formed");
            }
        }

        unset($pathResult);
        $pathResult = $xml->xpath("/configuration/services/service[@name=\"$serviceName\"]/baseURL");
        if (empty($pathResult)) {
            ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file");
        } else {
            $serviceInfo['SERVICE_BASEURL'] = strval($pathResult[0]);
            if (empty($serviceInfo['SERVICE_BASEURL'])) {
                ODataException::createInternalServerError("One of the mendatory configuration info were missing in the config file or config file is mail formed");
            }
        }
    }
}