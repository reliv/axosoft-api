Module for Axosoft On-Time API
==============================

## Description ##

PHP wrapper for Axosoft API

## Developers ##

This package contains a basic framework and a class structure for wrapping the API for AxoSoft (On-Time).

Please help us finish these API classes.  We have only written a limited number of classes to support our needs.

If you wish to use the API library and an API classe you require is missing, you may utilize the Generic classes to build requests.

## Example of standard list call ##

```php
    // Get AxosoftApi from ZF2 service manager
    $axosoftApi = $this->getServiceLocator()->get('Reliv\AxosoftApi\Service\AxosoftApi');

    // Build request
    $request = new ApiRequestList();
    $request->setProjectId(10);
    $request->setSearchString('search for me');
    $request->setSearchField('name');
    $request->setPage(1);
    $request->setPageSize(1);

    // Get Response
    $response = $axosoftApi->send($request);
    
    // Handle error
    if ($axosoftApi->hasError($response)) {
        throw new /Exception('Call Failed.');
    }
    
    $dataArray = $response->getResponseData();
    $someValue = $response->getResponseProperty('somekey');
```

## Example of generic list call ##

```php
    // Get AxosoftApi from ZF2 service manager
    $axosoftApi = $this->getServiceLocator()->get('Reliv\AxosoftApi\Service\AxosoftApi');

    // Build request
    $request = new GenericApiRequest('/api/v5/items');

    $request->setRequestParameter('project_id', 10);
    $request->setRequestParameter('search_string', 'search for me');
    $request->setRequestParameter('search_field', 'name');
    $request->setRequestParameter('page', 1);
    $request->setRequestParameter('page_size', 1);

    // Get Response
    $response = $axosoftApi->send($request);
    
    // Handle error
    if ($axosoftApi->hasError($response)) {
        throw new /Exception('Call Failed.');
    }
    
    $dataArray = $response->getResponseData();
    $someValue = $response->getResponseProperty('somekey');
```

## ToDo ##

 - Write the rest of the API classes
 - Create API request validators
 - May implement command pattern to simplify API calls
