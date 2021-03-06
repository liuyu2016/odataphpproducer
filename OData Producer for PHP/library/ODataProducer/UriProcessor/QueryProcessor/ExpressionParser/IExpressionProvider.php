<?php
/** 
 * The expression provider interface.
 * 
 * PHP version 5.3
 * 
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_ExpressionParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
namespace ODataProducer\UriProcessor\QueryProcessor\ExpressionParser;
use ODataProducer\Providers\Metadata\ResourceType;
use ODataProducer\Providers\Metadata\Type\IType;
/**
 * The expression provider interface.
 *
 * @category  ODataProducer
 * @package   ODataProducer_UriProcessor_QueryProcessor_ExpressionParser
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
interface IExpressionProvider
{
    /**
     * Get the name of the iterator
     * 
     * @return string
     */    
    public function getIteratorName();

    /**
     * call-back for setting the resource type.
     * 
     * @param ResourceType $resourceType The resource type on which the filter
     *                                   is going to be applied.
     *
     * @return void
     */
    public function setResourceType(ResourceType $resourceType);
    
    /**
     * Call-back for logical expression
     * 
     * @param ExpressionType $expressionType The type of logical expression
     * @param string         $left           The left expression
     * @param string         $right          The left expression
     * 
     * @return string
     */
    public function onLogicalExpression($expressionType, $left, $right);

    /**      
     * Call-back for arithmetic expression
     * 
     * @param ExpressionType $expressionType The type of arithmetic expression
     * @param string         $left           The left expression
     * @param string         $right          The left expression
     * 
     * @return string
     */
    public function onArithmeticExpression($expressionType, $left, $right);

    /**
     * Call-back for relational expression
     * 
     * @param ExpressionType $expressionType The type of relation expression
     * @param string         $left           The left expression
     * @param string         $right          The left expression
     * 
     * @return string
     */
    public function onRelationalExpression($expressionType, $left, $right);

    /**      
     * Call-back for unary expression
     * 
     * @param ExpressionType $expressionType The type of unary expression
     * @param string         $child          The child expression     
     * 
     * @return string
     */
    public function onUnaryExpression($expressionType, $child);
    
    /**
     * Call-back for constant expression
     * 
     * @param IType  $type  The type of constant
     * @param objetc $value The value of the constant
     * 
     * @return string
     */
    public function onConstantExpression(IType $type, $value);
    
    /**
     * Call-back for property access expression
     * 
     * @param PropertyAccessExpression $expression The property access expression
     * 
     * @return string
     */
    public function onPropertyAccessExpression($expression);

    /**
     * Call-back for function call expression
     * 
     * @param string        $functionDescription Description of the function.
     * @param array<string> $params              Arguments to the functions.
     * 
     * @return string
     */
    public function onFunctionCallExpression($functionDescription, $params);
}
?>