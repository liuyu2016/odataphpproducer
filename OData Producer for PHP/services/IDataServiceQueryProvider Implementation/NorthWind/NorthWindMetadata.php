<?php
/** 
 * Implementation of IDataServiceMetadataProvider.
 * 
 * PHP version 5.3
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   SVN: 1.0
 * @link      http://odataphpproducer.codeplex.com
 * 
 */
use ODataProducer\Providers\Metadata\ResourceStreamInfo;
use ODataProducer\Providers\Metadata\ResourceAssociationSetEnd;
use ODataProducer\Providers\Metadata\ResourceAssociationSet;
use ODataProducer\Common\NotImplementedException;
use ODataProducer\Providers\Metadata\Type\EdmPrimitiveType;
use ODataProducer\Providers\Metadata\ResourceSet;
use ODataProducer\Providers\Metadata\ResourcePropertyKind;
use ODataProducer\Providers\Metadata\ResourceProperty;
use ODataProducer\Providers\Metadata\ResourceTypeKind;
use ODataProducer\Providers\Metadata\ResourceType;
use ODataProducer\Common\InvalidOperationException;
use ODataProducer\Providers\Metadata\IDataServiceMetadataProvider;
require_once 'ODataProducer\Providers\Metadata\IDataServiceMetadataProvider.php';
use ODataProducer\Providers\Metadata\ServiceBaseMetadata;
//Begin Resource Classes

/**
 * Complex class for Address.
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class Address
{
    //Edm.String
    public $StreetName;
    //Edm.String
    public $City;
    //Edm.String
    public $Region;
    //Edm.String
    public $PostalCode;
    //Edm.String
    public $Country;
    //NorthWind.Address
    public $AltAddress;
}

/**
 * Customer entity type.
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class Customer
{
    //Key Edm.String
    public $CustomerID;
    //Edm.String
    public $CompanyName;
    //Edm.String
    public $ContactName;
    //Edm.String
    public $ContactTitle;
    //Edm.String
    public $Phone;
    //Edm.String
    public $Fax;
    //NorthWind.Address
    public $Address;
    //array(string)
    public $EmailAddresses;
    //array(Address)
    public $OtherAddresses;
    //Navigation Property Orders (ResourceSetReference)
    public $Orders;
}

/**
 * Order entity type.
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class Order
{
    //Key Edm.Int32
    public $OrderID;
    //Edm.String
    public $CustomerID;
    //Edm.Int32
    public $EmployeeID;
    //Edm.DateTime
    public $OrderDate;
    //Edm.DateTime
    public $RequiredDate;
    //Edm.DateTime
    public $ShippedDate;
    //Edm.Int32
    public $ShipVia;
    //Edm.Decimal
    public $Freight;
    //Edm.String
    public $ShipName;
    //Edm.String
    public $ShipAddress;
    //Edm.String
    public $ShipCity;
    //Edm.String
    public $ShipRegion;
    //Edm.String
    public $ShipPostalCode;
    //Edm.String
    public $ShipCountry;
    //Navigation Property Customer (ResourceReference)
    public $Customer;
    //Navigation Property Order_Details (ResourceSetReference)
    public $Order_Details;
}

/**
 * Order_Detail Entity Type.
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class Order_Details
{
    //Edm.Single
    public $Discount;
    //Edm.Int32
    public $OrderID;
    //Edm.Int32
    public $ProductID;
    //Edm.Int16
    public $Quantity;
    //Edm.Decimal
    public $UnitPrice;
    //Navigation Property Order (ResourceReference)
    public $Order;

}

/**
 * Employee Entity Type.
 * Employee entity type, MLE and has named stream as Thumnails_48x48
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class Employee
{
    //Key Edm.Int32
     public $EmployeeID;
     //Edm.String
     public $FirstName;
     //Edm.String
     public $LastName;
     //Edm.String
     public $Title;
     //Edm.String
     public $TitleOfCourtesy;
     //Edm.DateTime
     public $BirthDate;
     //Edm.DateTime
     public $HireDate;
     //Edm.String
     public $Address;
     //Edm.String
     public $City;
     //Edm.String
     public $Region;
     //Edm.String
     public $PostalCode;
     //Edm.String
     public $Country;
     //Edm.String
     public $HomePhone;
     //Edm.String
     public $Extension;
     //Edm.String
     public $Notes;
     //Bag of strings
     public $Emails;
     //Edm.Int32
     public $ReportsTo;
     //Edm.Binary
     public $Photo;
     //Edm.String
     public $PhotoPath;
     //Navigation Property to associated instance of Employee instance 
     //representing manager (ResourceReference)
     //public $Manager; 
     //Navigation Property to associated instance of Employee instances 
     //representing subordinates (ResourceSetReference)
     //public $Subordinates;
}
//End Resource Classes


/**
 * Create NorthWind metadata.
 * 
 * @category  Service
 * @package   NorthWind
 * @author    Anu T Chandy <odataphpproducer_alias@microsoft.com>
 * @copyright 2011 Microsoft Corp. (http://www.microsoft.com)
 * @license   New BSD license, (http://www.opensource.org/licenses/bsd-license.php)
 * @version   Release: 1.0
 * @link      http://odataphpproducer.codeplex.com
 */
class CreateNorthWindMetadata
{
    /**
     * create metadata
     * 
     * @throws InvalidOperationException
     * 
     * @return NorthWindMetadata
     */
    public static function create()
    {
        $metadata = new ServiceBaseMetadata('NorthWindEntities', 'NorthWind');
        
        //Register the complex type 'Address' having a property of same type.
        $addressComplexType = $metadata->addComplexType(new ReflectionClass('Address'), 'Address', 'NorthWind', null);
        $metadata->addPrimitiveProperty($addressComplexType, 'StreetName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($addressComplexType, 'City', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($addressComplexType, 'Region', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($addressComplexType, 'PostalCode', EdmPrimitiveType::STRING);		
        $metadata->addPrimitiveProperty($addressComplexType, 'Country', EdmPrimitiveType::STRING);
        //A complex sub property to hold alternate address
        $metadata->addComplexProperty($addressComplexType, 'AltAddress', $addressComplexType);
        
        //Register the entity (resource) type 'Customer'
        $customersEntityType = $metadata->addEntityType(new ReflectionClass('Customer'), 'Customer', 'NorthWind');
        $metadata->addKeyProperty($customersEntityType, 'CustomerID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($customersEntityType, 'CompanyName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($customersEntityType, 'ContactName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($customersEntityType, 'ContactTitle', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($customersEntityType, 'Phone', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($customersEntityType, 'Fax', EdmPrimitiveType::STRING);
        $metadata->addComplexProperty($customersEntityType, 'Address', $addressComplexType);
        //Add a bag property (bag of complex type) to hold array of other addresses
        $metadata->addComplexProperty($customersEntityType, 'OtherAddresses', $addressComplexType, true);
        //Add a bag property (bag of primitve type) to hold array of email addresses
        $metadata->addPrimitiveProperty($customersEntityType, 'EmailAddresses', EdmPrimitiveType::STRING, true);

        //Register the entity (resource) type 'Order'
        $orderEntityType = $metadata->addEntityType(new ReflectionClass('Order'), 'Order', 'NorthWind');
        $metadata->addKeyProperty($orderEntityType, 'OrderID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($orderEntityType, 'CustomerID', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'EmployeeID', EdmPrimitiveType::INT32);
        //Adding an etag property
        $metadata->addETagProperty($orderEntityType, 'OrderDate', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($orderEntityType, 'RequiredDate', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShippedDate', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipVia', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($orderEntityType, 'Freight', EdmPrimitiveType::DECIMAL);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipAddress', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipCity', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipRegion', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipPostalCode', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($orderEntityType, 'ShipCountry', EdmPrimitiveType::STRING);
      
        //Register the entity (resource) type 'Order_Details'
        $orderDetailsEntityType = $metadata->addEntityType(new ReflectionClass('Order_Details'), 'Order_Details', 'NorthWind');
        $metadata->addKeyProperty($orderDetailsEntityType, 'ProductID', EdmPrimitiveType::INT32);
        $metadata->addKeyProperty($orderDetailsEntityType, 'OrderID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($orderDetailsEntityType, 'UnitPrice', EdmPrimitiveType::DECIMAL);
        $metadata->addPrimitiveProperty($orderDetailsEntityType, 'Quantity', EdmPrimitiveType::INT16);
        $metadata->addPrimitiveProperty($orderDetailsEntityType, 'Discount', EdmPrimitiveType::SINGLE);
     
        //Register the entity (resource) type 'Employee'
        $employeeEntityType = $metadata->addEntityType(new ReflectionClass('Employee'), 'Employee', 'NorthWind');
        $metadata->addKeyProperty($employeeEntityType, 'EmployeeID', EdmPrimitiveType::INT32);
        $metadata->addPrimitiveProperty($employeeEntityType, 'FirstName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'LastName', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Title', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'TitleOfCourtesy', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'BirthDate', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($employeeEntityType, 'HireDate', EdmPrimitiveType::DATETIME);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Address', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'City', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Region', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'PostalCode', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Country', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'HomePhone', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Extension', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Notes', EdmPrimitiveType::STRING);
        $metadata->addPrimitiveProperty($employeeEntityType, 'ReportsTo', EdmPrimitiveType::INT32);
        //$metadata->addPrimitiveProperty($employeeEntityType, 'Photo', EdmPrimitiveType::BINARY);
        $metadata->addPrimitiveProperty($employeeEntityType, 'Emails', EdmPrimitiveType::STRING, true);
        $metadata->addPrimitiveProperty($employeeEntityType, 'PhotoPath', EdmPrimitiveType::STRING);
        //Set Employee entity type as MLE thus the url http://host/NorthWind.svc/Employee(1875)/$value will give the stream associated with employee with id 1875
        $employeeEntityType->setMediaLinkEntry(true);
        //Add a named stream property to the employee entity type
        //so the url http://host/NorthWind.svc/Employee(9831)/TumbNail_48X48 will give stream associated with employee's thumbnail (of size 48 x 48) image
        //$streamInfo = new ResourceStreamInfo('TumbNail_48X48');
        //$employeeEntityType->addNamedStream($streamInfo);
        
        $customersResourceSet = $metadata->addResourceSet('Customers', $customersEntityType);
        $ordersResourceSet = $metadata->addResourceSet('Orders', $orderEntityType);
        $orderDetialsResourceSet = $metadata->addResourceSet('Order_Details', $orderDetailsEntityType);
        $employeeResourceSet = $metadata->addResourceSet('Employees', $employeeEntityType);

        //Register the assoications (navigations)
        //Customers (1) <==> Orders (0-*)
        $metadata->addResourceSetReferenceProperty($customersEntityType, 'Orders', $ordersResourceSet);
        $metadata->addResourceReferenceProperty($orderEntityType, 'Customer', $customersResourceSet);

        //Register the assoications (navigations)
        //Orders (1) <==> Orders_Details (0-*)
        $metadata->addResourceReferenceProperty($orderDetailsEntityType, 'Order', $ordersResourceSet);
        $metadata->addResourceSetReferenceProperty($orderEntityType, 'Order_Details', $orderDetialsResourceSet);

        return $metadata;
    }
}


