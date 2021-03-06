<?php
/** 
 * A parser to parse the skiptoken option
 * 
 * The syntax of skiptoken clause is:
 * 
 * skiptokenClause       : [literal [, literal]{orderByPathCount}]{orderByFlag} literal [, literal] {keyCount}
 * orderByFlag           : if orderby option is present, this this is 1 else 0
 * orderByPathCount      : if orderby option is present, then this is one less 
 *                         than the orderby path count
 * keyCount              : One less than the number of keys defined for the type
 *                         of the resource set identified by the Resource Path 
 *                         section of the URI
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_SkipTokenParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\UriProcessor\QueryProcessor\SkipTokenParser;
use ODataProducer\Common\ODataException;
use ODataProducer\Common\Messages;
use ODataProducer\Providers\Metadata\Type\Null1;
use ODataProducer\Providers\Metadata\ResourceType;
use ODataProducer\UriProcessor\ResourcePathProcessor\SegmentParser\KeyDescriptor;
use ODataProducer\UriProcessor\QueryProcessor\OrderByParser\OrderByInfo;
use ODataProducer\UriProcessor\QueryProcessor\OrderByParser\InternalOrderByInfo;
/**
 * $skiptoken option parser.
 *
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_SkipTokenParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class SkipTokenParser
{
    /**
     * Parse the given skiptoken, validate it using the given InternalOrderByInfo 
     * and generates instance of InternalSkipTokenInfo.
     * 
     * @param ResourceType        &$resourceType        The resource type of the
     *                                                  resource targetted by the
     *                                                  resource path.
     * @param InternalOrderByInfo &$internalOrderByInfo The $orderby details.
     * @param string              $skipToken            The $skiptoken value.
     * 
     * @return InternalSkipTokenInfo
     * 
     * @throws ODataException
     */
    public static function parseSkipTokenClause(
        ResourceType &$resourceType, 
        InternalOrderByInfo &$internalOrderByInfo, 
        $skipToken
    ) {
        $tokenValueDescriptor = null;
        if (!KeyDescriptor::tryParseValuesFromSkipToken(
            $skipToken, 
            $tokenValueDescriptor
        )
        ) {
            ODataException::createSyntaxError(
                Messages::skipTokenParserSyntaxError($skipToken)
            );
        }

        $orderByPathSegments = null;
        //$positionalValues are of type array(int, array(string, IType))
        $positionalValues = &$tokenValueDescriptor->getPositionalValuesByRef();
        $count = count($positionalValues);
        $orderByPathSegments = $internalOrderByInfo->getOrderByPathSegments();
        $orderByPathCount = count($orderByPathSegments);
        if ($count != ($orderByPathCount)) {
                ODataException::createBadRequestError(
                    Messages::skipTokenParserSkipTokenNotMatchingOrdering(
                        $count, $skipToken, $orderByPathCount
                    )
                );
        }

        $i = 0;
        foreach ($orderByPathSegments as $orderByPathSegment) {
            $typeProvidedInSkipToken = $positionalValues[$i][1];
            if (!($typeProvidedInSkipToken instanceof Null1)) {
                $orderBySubPathSegments = $orderByPathSegment->getSubPathSegments();
                $j = count($orderBySubPathSegments) - 1;
                $expectedType = $orderBySubPathSegments[$j]->getInstanceType();
                if (!$expectedType->isCompatibleWith($typeProvidedInSkipToken)) {
                    ODataException::createSyntaxError(
                        Messages::skipTokenParserInCompatibleTypeAtPosition(
                            $skipToken, $expectedType->getFullTypeName(), $i,
                            $typeProvidedInSkipToken->getFullTypeName()
                        )
                    );
                }
            }

            $i++;
        }

        return  new InternalSkipTokenInfo(
            $internalOrderByInfo, 
            $positionalValues, 
            $resourceType
        );
    }
}
?>