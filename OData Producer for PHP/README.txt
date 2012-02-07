OData Producer Library for PHP V1.1 release

Please refer to the User Guide documentation under the \Docs directory for setup instructions
The User Guide includes documentation on how to use the library in order to build a service that 
can expose data via an OData Feed.

The Library ships with two sample services: NorthWind and WordPress DB. The samples shows how the 
IServiceProvider, IDataServiceMetadata and IDataServiceQueryProvider interfaces can be used
in order to expose data from an arbitrary Data Source: SQL Server, MySQL or any other structured data.

The new release includes two new interfaces (IDataServiceQueryProvider2 and IExpressionProvider) that allow finer control on how queries to the data source is built.
   
