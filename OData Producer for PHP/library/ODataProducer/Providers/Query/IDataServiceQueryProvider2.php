<?php
/** 
 * The class which implements this interface is responsible responding the optimized queries
 * for entity set, entity instance and related entities
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Providers_Query2
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @author    Neelesh Vijaivargia <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\Providers\Query;
use ODataProducer\Providers\Metadata\ResourceProperty;
use ODataProducer\UriProcessor\ResourcePathProcessor\SegmentParser\KeyDescriptor;
use ODataProducer\Providers\Metadata\ResourceSet;
/**
 * Query provider2 interface.
 * 
 * @category  ODataProducer
 * @package   ODataProducer_Providers_Query
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
interface IDataServiceQueryProvider2
{
  /**
   * Gets the custom expression provider.
   * 
   * @return IExpressionProvider
   */
  public function getExpressionProvider();

    /**
     * Gets collection of entities belongs to an entity set
     * 
     * @param ResourceSet $resourceSet The entity set whose entities needs 
     *                                 to be fetched
     * @param String      $filter      filter condition if any need to be apply in the query
     * @param String      $select      select field set Fields which need to be fetch from 
     *                                 the DB
     * @param String      $orderby     sorted order if we want to get the data in some 
     *                                 specific order
     * @param Number      $top         number of records which  need to be skip
     * @param String      $skiptoken   skiptoken value if we want to skip records till 
     *                                 that skiptoken value
     * 
     * @return array(Object)/array()
     */
    public function getResourceSet(ResourceSet $resourceSet, $filter = null,
        $select = null, 
        $orderby = null, 
        $top = null, 
        $skiptoken = null
    );

    /**
     * Gets an entity instance from an entity set identifed by a key
     * 
     * @param ResourceSet   $resourceSet   The entity set from which an entity
     *                                     needs to be fetched
     * @param KeyDescriptor $keyDescriptor The key to identify the entity to be 
     *                                     fetched
     * 
     * @return Object/NULL Returns entity instance if found else null
     */
    public function getResourceFromResourceSet(ResourceSet $resourceSet, 
        KeyDescriptor $keyDescriptor
    );

    /**
     * Gets a related entity instance from an entity set identifed by a key
     * 
     * @param ResourceSet      $sourceResourceSet    The entity set related to
     *                                               the entity to be fetched.
     * @param object           $sourceEntityInstance The related entity instance.
     * @param ResourceSet      $targetResourceSet    The entity set from which
     *                                               entity needs to be fetched.
     * @param ResourceProperty $targetProperty       The metadata of the target 
     *                                               property.
     * @param KeyDescriptor    $keyDescriptor        The key to identify the entity 
     *                                               to be fetched.
     * 
     * @return Object/NULL Returns entity instance if found else null
     */
    public function getResourceFromRelatedResourceSet(ResourceSet $sourceResourceSet,
        $sourceEntityInstance, 
        ResourceSet $targetResourceSet,
        ResourceProperty $targetProperty,
        KeyDescriptor $keyDescriptor
    );

    /**
     * Get related resource set for a resource
     * 
     * @param ResourceSet      $sourceResourceSet    The source resource set
     * @param mixed            $sourceEntityInstance The resource
     * @param ResourceSet      $targetResourceSet    The resource set of 
     *                                               the navigation property
     * @param ResourceProperty $targetProperty       The navigation property to be 
     *                                               retrieved
     * @param String           $filter               filter condition if any need to be apply in the query
     * @param String           $select               select field set Fields which need to be fetch from 
     *                                               the DB
     * @param String           $orderby              sorted order if we want to get the data in some 
     *                                               specific order
     * @param Number           $top                  number of records which  need to be skip
     * @param String           $skip                 skiptoken value if we want to skip records till 
     *                                               that skiptoken value
     *                                               
     * @return array(Objects)/array() Array of related resource if exists, if no 
     *                                related resources found returns empty array
     */
    public function  getRelatedResourceSet(ResourceSet $sourceResourceSet, 
        $sourceEntityInstance, 
        ResourceSet $targetResourceSet,
        ResourceProperty $targetProperty,
        $filter = null, 
        $select = null, 
        $orderby = null, 
        $top = null, 
        $skip=null 
    );

    /**
     * Get related resource for a resource
     * 
     * @param ResourceSet      $sourceResourceSet    The source resource set
     * @param mixed            $sourceEntityInstance The source resource
     * @param ResourceSet      $targetResourceSet    The resource set of 
     *                                               the navigation property
     * @param ResourceProperty $targetProperty       The navigation property to be 
     *                                               retrieved
     * 
     * @return Object/null The related resource if exists else null
     */
    public function getRelatedResourceReference(ResourceSet $sourceResourceSet, 
        $sourceEntityInstance, 
        ResourceSet $targetResourceSet,
        ResourceProperty $targetProperty
    );
}
?>