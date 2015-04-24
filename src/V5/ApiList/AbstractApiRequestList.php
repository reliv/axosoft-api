<?php

namespace Reliv\AxosoftApi\V5\ApiList;

use Reliv\AxosoftApi\Model\AbstractApiRequest;
use Reliv\AxosoftApi\Model\GenericApiError;

/**
 * Class AbstractApiRequestList
 *
 * AbstractApiRequestList
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
abstract class AbstractApiRequestList extends AbstractApiRequest
{
    /**
     * page    (integer) The page number to returned
     *
     * @param $value
     *
     * @return void
     */
    public function setPage($value)
    {
        $this->requestParameters['page'] = (int)$value;
    }

    /**
     * page_size    (integer)
     * The number of rows to return per page
     *
     * @param $value
     *
     * @return void
     */
    public function setPageSize($value)
    {
        $this->requestParameters['page_size'] = (int)$value;
    }

    /*
     * project_id	(integer)
     * The ID of the project to filter by.
     * Defaults to 0 which is all projects
     */
    public function setProjectId($value)
    {
        $this->requestParameters['project_id'] = (int)$value;
    }

    /*
     * include_sub_projects_items	(boolean)
     * When filtering using 'project_id',
     * whether to include items belonging to the sub-projects of the project.
     * Defaults to false
     */
    public function setIncludeSubProjectsItems($value)
    {
        $this->requestParameters['include_sub_projects_items'] = (bool)$value;
    }

    /**
     * include_inactive_projects    (boolean)
     * When filtering using 'project_id',
     * whether to include items belonging to inactive projects.
     * Defaults to false
     *
     * @param $value
     *
     * @return void
     */
    public function setIncludeInactiveProjects($value)
    {
        $this->requestParameters['include_inactive_projects'] = (bool)$value;
    }

    /**
     * release_id    (integer)
     * The ID of the release to filter by. Defaults to 0 which is all releases
     *
     * @param $value
     *
     * @return void
     */
    public function setReleaseId($value)
    {
        $this->requestParameters['release_id'] = (int)$value;
    }

    /**
     * include_sub_releases_items    (boolean)
     * When filtering using 'release_id',
     * whether to include items belonging to the sub-releases of the release.
     * Defaults to false
     *
     * @param $value
     *
     * @return void
     */
    public function setIncludeSubReleasesItems($value)
    {
        $this->requestParameters['include_sub_releases_items'] = (bool)$value;
    }

    /**
     * include_inactive_releases    (boolean)
     * When filtering using 'release_id',
     * whether to include items belonging to inactive releases.
     * Defaults to false
     *
     * @param $value
     *
     * @return void
     */
    public function setIncludeInactiveReleases($value)
    {
        $this->requestParameters['include_inactive_releases'] = (bool)$value;
    }

    /**
     * assigned_to_id    (integer)
     * The ID of the user or team to filter by.
     * This filters by the Assigned To field.
     * Defaults to 0 which is all users
     *
     * @param $value
     *
     * @return void
     */
    public function setAssignedToId($value)
    {
        $this->requestParameters['assigned_to_id'] = (int)$value;
    }

    /**
     * assigned_to_type    (string)
     * Defines the type (either user or team) that the item is assigned to.
     * This works in conjunction with 'assigned_to_id'.
     * Values can be either 'user' or 'team'.
     * If omitted, then this field defaults to 'user'.
     *
     * @param $value
     *
     * @return void
     */
    public function setAssignedToType($value)
    {
        $this->requestParameters['assigned_to_type'] = (string)$value;
    }

    /**
     * customer_id    (integer)
     * ID of the customer to filter by.
     * This filters by the Reported By Customer Contact field.
     * Defaults to 0 which is all customers
     *
     * @param $value
     *
     * @return void
     */
    public function setCustomerId($value)
    {
        $this->requestParameters['customer_id'] = (int)$value;
    }

    /**
     * customer_type    (string)
     * Defines the type (either customer or contact) for filter.
     * This works in conjunction with 'customer_id'.
     * Values can be either 'customers' or 'contacts'.
     * If omitted, then this field defaults to 'customers'.
     *
     * @param $value
     *
     * @return void
     */
    public function setCustomerType($value)
    {
        $this->requestParameters['customer_type'] = (string)$value;
    }

    /**
     * filter_id    (integer)
     * ID of the filter to use for filtering.
     * Defaults to 0 which is no filter
     *
     * @param $value
     *
     * @return void
     */
    public function setFilterId($value)
    {
        $this->requestParameters['filter_id'] = (int)$value;
    }

    /**
     * include_archived    (boolean)
     * Whether to include archived items. Defaults to false
     *
     * @param $value
     *
     * @return void
     */
    public function setIncludeArchived($value)
    {
        $this->requestParameters['include_archived'] = (bool)$value;
    }

    /**
     * sort_fields    (comma seperated string)
     * The names of the columns to sort by.
     *
     * @param $value
     *
     * @return void
     */
    public function setSortFields($value)
    {
        $this->requestParameters['sort_fields'] = (string)$value;
    }


    /**
     * search_string    (string)
     * The term to search for within the column specified in search_field
     *
     * @param $value
     *
     * @return void
     */
    public function setSearchString($value)
    {
        $this->requestParameters['search_string'] = (string)$value;
    }

    /**
     * search_field    (string)
     * The name of the column to search in.
     * Defaults to 'all' which is all fields
     *
     * @param $value
     *
     * @return void
     */
    public function setSearchField($value)
    {
        $this->requestParameters['search_field'] = (string)$value;
    }

    /**
     * columns (comma separated string)
     * Contains the names of the columns to return for each item.
     * Defaults to all columns.
     * However, please note that for performance reasons long text fields
     * (such as 'Description') are not returned by this API call.
     * To get the values of long text fields,
     * use the GET /defects/{id} call to retrieve a single item.
     *
     * @param $value
     *
     * @return void
     */
    public function setColumns($value)
    {
        $this->requestParameters['columns'] = (string)$value;
    }

    /**
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
     */
    public function getResponse($responseData)
    {
        if (isset($responseData['error'])) {

            return new GenericApiError($responseData);
        }

        return new ApiResponse($responseData);
    }
}