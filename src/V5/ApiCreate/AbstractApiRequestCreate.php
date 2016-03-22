<?php

namespace Reliv\AxosoftApi\V5\ApiCreate;

use Reliv\AxosoftApi\Model\AbstractApiRequest;

/**
 * Class ApiRequestCreate
 *
 * ApiRequestCreate
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
abstract class AbstractApiRequestCreate extends AbstractApiRequest
{
    /**
     * @var string
     */
    protected $requestMethod = 'POST';

    /**
     * notify_customer: (boolean)
     * Whether or not a one-time notification
     * should be sent to the customer contact assigned to this item
     *
     * @param $value
     *
     * @return void
     */
    public function setNotifyCustomer($value)
    {
        $this->requestData['notify_customer'] = (bool)$value;
    }

    /**
     * setItemValue
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function setItemValue($key, $value)
    {

        if (!isset($this->requestData['item'])) {
            $this->requestData['item'] = [];
        }

        $this->requestData['item'][$key] = $value;
    }

    /**
     * name: (string)
     * The name of the item
     *
     * @param string $value
     *
     * @return void
     */
    public function setName($value)
    {
        $this->setItemValue('name', (string)$value);
    }

    /**
     * description: (string)
     * Description of the item
     *
     * @param string $value
     *
     * @return void
     */
    public function setDescription($value)
    {
        $this->setItemValue('description', (string)$value);
    }

    /**
     * notes: (string)
     * Additional notes for the item
     *
     * @param $value
     *
     * @return void
     */
    public function setNotes($value)
    {
        $this->setItemValue('notes', (string)$value);
    }

    /**
     * resolution: (string)
     * Description of the resolution when item is resolved
     *
     * @param string $value
     *
     * @return void
     */
    public function setResolution($value)
    {
        $this->setItemValue('resolution', (string)$value);
    }

    /**
     * replication_procedures: (string)
     * Description of the procedures to replicate the issue
     *
     * @param string $value
     *
     * @return void
     */
    public function setReplicationProcedures($value)
    {
        $this->setItemValue('replication_procedures', (string)$value);
    }


    /**
     * percent_complete: (integer)
     * A number between 0 and 100 representing the percent completion of the item
     *
     * @param string $value
     *
     * @return void
     */
    public function setPercentComplete($value)
    {
        $this->setItemValue('percent_complete', (string)$value);
    }

    /**
     * archived: (boolean)
     * Indicates whether the item is archived or not
     *
     * @param bool $value
     *
     * @return void
     */
    public function setArchived($value)
    {
        $this->setItemValue('archived', (bool)$value);
    }

    /**
     * publicly_viewable: (boolean)
     * Indicates whether the item is public and visible in Customer Portal
     *
     * @param bool $value
     *
     * @return void
     */
    public function setPubliclyViewable($value)
    {
        $this->setItemValue('publicly_viewable', (bool)$value);
    }

    /**
     * is_completed: (boolean)
     * Indicates whether the item is completed.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setIsCompleted($value)
    {
        $this->setItemValue('is_completed', (bool)$value);
    }

    /**
     * completion_date: (date)
     * Date when the item was completed
     *
     * @param \DateTime $value
     *
     * @return void
     */
    public function setCompletionDate(\DateTime $value)
    {
        $this->setItemValue('completion_date', (string)$value->getTimestamp());
    }

    /**
     * due_date: (date)
     * Date when the item is due
     *
     * @param \DateTime $value
     *
     * @return void
     */
    public function setDueDate(\DateTime $value)
    {
        $this->setItemValue('due_date', (string)$value->getTimestamp());
    }

    /**
     * reported_date: (date)
     * Date when the item was reported
     *
     * @param \DateTime $value
     *
     * @return void
     */
    public function setReportedDate(\DateTime $value)
    {
        $this->setItemValue('reported_date', (string)$value->getTimestamp());
    }

    /**
     * start_date: (date)
     * Date when work on the item was started
     *
     * @param \DateTime $value
     *
     * @return void
     */
    public function setStartDate(\DateTime $value)
    {
        $this->setItemValue('start_date', (string)$value->getTimestamp());
    }

    /**
     * assigned_to: (object)
     * The user or team this item is assigned to
     *  id: (integer) ID of the user or team
     *  type: (string) 'user' or 'team'
     *
     * @param int    $userTeamId
     * @param string $type
     *
     * @return void
     */
    public function setAssignedTo($userTeamId, $type = 'user')
    {
        $this->setItemValue(
            'assigned_to',
            [
                'id' => (int)$userTeamId,
                'type' => (string)$type,
            ]
        );
    }

    /**
     * category: (object)
     * Category this item belongs to. Only applies to 'tasks'
     * id: (integer) ID of the category
     *
     * @param int $value
     *
     * @return void
     */
    public function setCategory($value)
    {
        $this->setItemValue('category', ['id' => (int)$value]);
    }

    /**
     * escalation_level: (object)
     * Escalation level this item is in. Only applies to 'incidents'
     * id: (integer) ID of the escalation level
     *
     * @param int $value
     *
     * @return void
     */
    public function setEscalationLevel($value)
    {
        $this->setItemValue('escalation_level', ['id' => (int)$value]);
    }

    /**
     * priority: (object)
     * Priority of this item
     * id: (integer) ID of the priority
     *
     * @param int $value
     *
     * @return void
     */
    public function setPriority($value)
    {
        $this->setItemValue('priority', ['id' => (int)$value]);
    }

    /**
     * project: (object)
     * Project this item belongs to
     * id: (integer) ID of the project
     *
     * @param int $value
     *
     * @return void
     */
    public function setProject($value)
    {
        $this->setItemValue('project', ['id' => (int)$value]);
    }

    /**
     * parent: (object)
     * Parent item that this item belongs to
     * id: (integer) ID of the parent
     *
     * @param int $value
     *
     * @return void
     */
    public function setParent($value)
    {
        $this->setItemValue('parent', ['id' => (int)$value]);
    }

    /**
     * release: (object)
     * Release this item is assigned to
     * id: (integer) ID of the release
     *
     * @param int $value
     *
     * @return void
     */
    public function setRelease($value)
    {
        $this->setItemValue('release', ['id' => (int)$value]);
    }

    /**
     * reported_by: (object)
     * User this item was reported by
     * id: (integer) ID of the user
     *
     * @param int $value
     *
     * @return void
     */
    public function setReportedBy($value)
    {
        $this->setItemValue('reported_by', ['id' => (int)$value]);
    }

    /**
     * reported_by_customer_contact: (object)
     * Customer contact this item was reported by
     * id: (integer) ID of the customer contact
     *
     * @param int $value
     *
     * @return void
     */
    public function setReportedByCustomerContact($value)
    {
        $this->setItemValue('reported_by_customer_contact', ['id' => (int)$value]);
    }

    /**
     * severity: (object)
     * Severity of this item. Only applies to 'defects' and 'incidents'
     * id: (integer) ID of the severity
     *
     * @param $value
     *
     * @return void
     */
    public function setSeverity($value)
    {
        $this->setItemValue('severity', ['id' => (int)$value]);
    }

    /**
     * status: (object)
     * Status of this item
     * id: (integer) ID of the status
     *
     * @param $value
     *
     * @return void
     */
    public function setStatus($value)
    {
        $this->setItemValue('status', ['id' => (int)$value]);
    }

    /**
     * workflow_step: (object)
     * Workflow step this item is in
     * id: (integer) ID of the workflow step
     *
     * @param $value
     *
     * @return void
     */
    public function setWorkflowStep($value)
    {
        $this->setItemValue('workflow_step', ['id' => (int)$value]);
    }

    /**
     * actual_duration: (object)
     * Duration of work that was actually spent on this item so far
     * duration: (float) Duration of work, used in conjuction the the time_unit
     * time_unit: (object) Time unit the duration represents
     * id: (integer) ID of the time unit
     *
     * @param $duration
     * @param $timeUnitId
     *
     * @return void
     */
    public function setActualDuration($duration, $timeUnitId)
    {
        $this->setItemValue(
            'actual_duration',
            [
                'duration' => (float)$duration,
                'time_unit' => [
                    'id' => (int)$timeUnitId
                ]
            ]
        );
    }

    /**
     *     estimated_duration: (object)
     * Duration of work was originally estimated the item would take
     * duration: (float) Duration of work, used in conjuction the the time_unit
     * time_unit: (object) Time unit the duration represents
     * id: (integer) ID of the time unit
     *
     * @param $duration
     * @param $timeUnitId
     *
     * @return void
     */
    public function setEstimatedDuration($duration, $timeUnitId)
    {
        $this->setItemValue(
            'estimated_duration',
            [
                'duration' => (float)$duration,
                'time_unit' => [
                    'id' => (int)$timeUnitId
                ]
            ]
        );
    }

    /**
     * remaining_duration: (object)
     * Duration of work that remains to be done on the item
     * duration: (float) Duration of work, used in conjuction the the time_unit
     * time_unit: (object) Time unit the duration represents
     * id: (integer) ID of the time unit
     *
     * @param $duration
     * @param $timeUnitId
     *
     * @return void
     */
    public function setRemainingDuration($duration, $timeUnitId)
    {
        $this->setItemValue(
            'remaining_duration',
            [
                'duration' => (float)$duration,
                'time_unit' => [
                    'id' => (int)$timeUnitId
                ]
            ]
        );
    }

    /**
     * custom_fields: (object).
     * A collection of key value pairs with the key being the name of the custom field,
     * and the value being the new value of the field.
     * custom field name: custom field value
     *
     * @param $value
     *
     * @return void
     */
    public function setCustomFields($value)
    {
        $this->setItemValue('custom_fields', (array)$value);
    }

    /**
     * getResponse
     *
     * @param $responseData
     *
     * @return \Reliv\AxosoftApi\Model\AbstractApiResponse
     */
//    public function getResponse($responseData)
//    {
//        if (isset($responseData['error']) || isset($responseData['error_description'])) {
//            return new ApiError($responseData);
//        }
//
//        return new ApiResponse($responseData);
//    }
}
