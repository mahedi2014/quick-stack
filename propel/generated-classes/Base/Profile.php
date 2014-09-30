<?php

namespace Base;

use \Profile as ChildProfile;
use \ProfileQuery as ChildProfileQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ProfileTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class Profile implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProfileTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the uuid field.
     * @var        string
     */
    protected $uuid;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the dealer_id field.
     * @var        int
     */
    protected $dealer_id;

    /**
     * The value for the first_name field.
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the gender field.
     * @var        int
     */
    protected $gender;

    /**
     * The value for the date_of_birth field.
     * @var        string
     */
    protected $date_of_birth;

    /**
     * The value for the phone_number field.
     * @var        string
     */
    protected $phone_number;

    /**
     * The value for the mobile_number field.
     * @var        string
     */
    protected $mobile_number;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

    /**
     * The value for the company_name field.
     * @var        string
     */
    protected $company_name;

    /**
     * The value for the primary_address_street field.
     * @var        string
     */
    protected $primary_address_street;

    /**
     * The value for the primary_address_street_2 field.
     * @var        string
     */
    protected $primary_address_street_2;

    /**
     * The value for the primary_address_city field.
     * @var        string
     */
    protected $primary_address_city;

    /**
     * The value for the primary_address_state field.
     * @var        string
     */
    protected $primary_address_state;

    /**
     * The value for the primary_address_post_code field.
     * @var        string
     */
    protected $primary_address_post_code;

    /**
     * The value for the primary_address_country field.
     * @var        string
     */
    protected $primary_address_country;

    /**
     * The value for the billing_address_street field.
     * @var        string
     */
    protected $billing_address_street;

    /**
     * The value for the billing_address_city field.
     * @var        string
     */
    protected $billing_address_city;

    /**
     * The value for the billing_address_state field.
     * @var        string
     */
    protected $billing_address_state;

    /**
     * The value for the billing_address_post_code field.
     * @var        string
     */
    protected $billing_address_post_code;

    /**
     * The value for the billing_address_country field.
     * @var        string
     */
    protected $billing_address_country;

    /**
     * The value for the security_question_1 field.
     * @var        string
     */
    protected $security_question_1;

    /**
     * The value for the security_answer_1 field.
     * @var        string
     */
    protected $security_answer_1;

    /**
     * The value for the security_question_2 field.
     * @var        string
     */
    protected $security_question_2;

    /**
     * The value for the security_answer_2 field.
     * @var        string
     */
    protected $security_answer_2;

    /**
     * The value for the security_question_custom field.
     * @var        string
     */
    protected $security_question_custom;

    /**
     * The value for the security_answer_custom field.
     * @var        string
     */
    protected $security_answer_custom;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        User
     */
    protected $aUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Profile object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !empty($this->modifiedColumns);
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return in_array($col, $this->modifiedColumns);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return array_unique($this->modifiedColumns);
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            while (false !== ($offset = array_search($col, $this->modifiedColumns))) {
                array_splice($this->modifiedColumns, $offset, 1);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Profile</code> instance.  If
     * <code>obj</code> is an instance of <code>Profile</code>, delegates to
     * <code>equals(Profile)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return Profile The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return Profile The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   int
     */
    public function getID()
    {

        return $this->id;
    }

    /**
     * Get the [uuid] column value.
     *
     * @return   string
     */
    public function getUUID()
    {

        return $this->uuid;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return   int
     */
    public function getUserID()
    {

        return $this->user_id;
    }

    /**
     * Get the [dealer_id] column value.
     *
     * @return   int
     */
    public function getDealerID()
    {

        return $this->dealer_id;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return   string
     */
    public function getFirstName()
    {

        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return   string
     */
    public function getLastName()
    {

        return $this->last_name;
    }

    /**
     * Get the [gender] column value.
     *
     * @return   int
     */
    public function getGender()
    {
        if (null === $this->gender) {
            return null;
        }
        $valueSet = ProfileTableMap::getValueSet(ProfileTableMap::GENDER);
        if (!isset($valueSet[$this->gender])) {
            throw new PropelException('Unknown stored enum key: ' . $this->gender);
        }

        return $valueSet[$this->gender];
    }

    /**
     * Get the [optionally formatted] temporal [date_of_birth] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateOfBirth($format = NULL)
    {
        if ($format === null) {
            return $this->date_of_birth;
        } else {
            return $this->date_of_birth instanceof \DateTime ? $this->date_of_birth->format($format) : null;
        }
    }

    /**
     * Get the [phone_number] column value.
     *
     * @return   string
     */
    public function getPhoneNumber()
    {

        return $this->phone_number;
    }

    /**
     * Get the [mobile_number] column value.
     *
     * @return   string
     */
    public function getMobileNumber()
    {

        return $this->mobile_number;
    }

    /**
     * Get the [image] column value.
     *
     * @return   string
     */
    public function getProfileImage()
    {

        return $this->image;
    }

    /**
     * Get the [company_name] column value.
     *
     * @return   string
     */
    public function getCompanyName()
    {

        return $this->company_name;
    }

    /**
     * Get the [primary_address_street] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressStreet()
    {

        return $this->primary_address_street;
    }

    /**
     * Get the [primary_address_street_2] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressStreet2()
    {

        return $this->primary_address_street_2;
    }

    /**
     * Get the [primary_address_city] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressCity()
    {

        return $this->primary_address_city;
    }

    /**
     * Get the [primary_address_state] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressState()
    {

        return $this->primary_address_state;
    }

    /**
     * Get the [primary_address_post_code] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressPostCode()
    {

        return $this->primary_address_post_code;
    }

    /**
     * Get the [primary_address_country] column value.
     *
     * @return   string
     */
    public function getPrimaryAddressCountry()
    {

        return $this->primary_address_country;
    }

    /**
     * Get the [billing_address_street] column value.
     *
     * @return   string
     */
    public function getBillingAddressStreet()
    {

        return $this->billing_address_street;
    }

    /**
     * Get the [billing_address_city] column value.
     *
     * @return   string
     */
    public function getBillingAddressCity()
    {

        return $this->billing_address_city;
    }

    /**
     * Get the [billing_address_state] column value.
     *
     * @return   string
     */
    public function getBillingAddressState()
    {

        return $this->billing_address_state;
    }

    /**
     * Get the [billing_address_post_code] column value.
     *
     * @return   string
     */
    public function getBillingAddressPostCode()
    {

        return $this->billing_address_post_code;
    }

    /**
     * Get the [billing_address_country] column value.
     *
     * @return   string
     */
    public function getBillingAddressCountry()
    {

        return $this->billing_address_country;
    }

    /**
     * Get the [security_question_1] column value.
     *
     * @return   string
     */
    public function getFirstSecurityQuestion()
    {

        return $this->security_question_1;
    }

    /**
     * Get the [security_answer_1] column value.
     *
     * @return   string
     */
    public function getFirstSecurityQuestionAnswer()
    {

        return $this->security_answer_1;
    }

    /**
     * Get the [security_question_2] column value.
     *
     * @return   string
     */
    public function getSecondSecurityQuestion()
    {

        return $this->security_question_2;
    }

    /**
     * Get the [security_answer_2] column value.
     *
     * @return   string
     */
    public function getSecondSecurityQuestionAnswer()
    {

        return $this->security_answer_2;
    }

    /**
     * Get the [security_question_custom] column value.
     *
     * @return   string
     */
    public function getCustomSecurityQuestion()
    {

        return $this->security_question_custom;
    }

    /**
     * Get the [security_answer_custom] column value.
     *
     * @return   string
     */
    public function getCustomSecurityAnswer()
    {

        return $this->security_answer_custom;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param      int $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ProfileTableMap::ID;
        }


        return $this;
    } // setID()

    /**
     * Set the value of [uuid] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setUUID($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uuid !== $v) {
            $this->uuid = $v;
            $this->modifiedColumns[] = ProfileTableMap::UUID;
        }


        return $this;
    } // setUUID()

    /**
     * Set the value of [user_id] column.
     *
     * @param      int $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setUserID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = ProfileTableMap::USER_ID;
        }

        if ($this->aUser !== null && $this->aUser->getID() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserID()

    /**
     * Set the value of [dealer_id] column.
     *
     * @param      int $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setDealerID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dealer_id !== $v) {
            $this->dealer_id = $v;
            $this->modifiedColumns[] = ProfileTableMap::DEALER_ID;
        }


        return $this;
    } // setDealerID()

    /**
     * Set the value of [first_name] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[] = ProfileTableMap::FIRST_NAME;
        }


        return $this;
    } // setFirstName()

    /**
     * Set the value of [last_name] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[] = ProfileTableMap::LAST_NAME;
        }


        return $this;
    } // setLastName()

    /**
     * Set the value of [gender] column.
     *
     * @param      int $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $valueSet = ProfileTableMap::getValueSet(ProfileTableMap::GENDER);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[] = ProfileTableMap::GENDER;
        }


        return $this;
    } // setGender()

    /**
     * Sets the value of [date_of_birth] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \Profile The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->date_of_birth !== null || $dt !== null) {
            if ($dt !== $this->date_of_birth) {
                $this->date_of_birth = $dt;
                $this->modifiedColumns[] = ProfileTableMap::DATE_OF_BIRTH;
            }
        } // if either are not null


        return $this;
    } // setDateOfBirth()

    /**
     * Set the value of [phone_number] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPhoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_number !== $v) {
            $this->phone_number = $v;
            $this->modifiedColumns[] = ProfileTableMap::PHONE_NUMBER;
        }


        return $this;
    } // setPhoneNumber()

    /**
     * Set the value of [mobile_number] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setMobileNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile_number !== $v) {
            $this->mobile_number = $v;
            $this->modifiedColumns[] = ProfileTableMap::MOBILE_NUMBER;
        }


        return $this;
    } // setMobileNumber()

    /**
     * Set the value of [image] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setProfileImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[] = ProfileTableMap::IMAGE;
        }


        return $this;
    } // setProfileImage()

    /**
     * Set the value of [company_name] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setCompanyName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->company_name !== $v) {
            $this->company_name = $v;
            $this->modifiedColumns[] = ProfileTableMap::COMPANY_NAME;
        }


        return $this;
    } // setCompanyName()

    /**
     * Set the value of [primary_address_street] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressStreet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_street !== $v) {
            $this->primary_address_street = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_STREET;
        }


        return $this;
    } // setPrimaryAddressStreet()

    /**
     * Set the value of [primary_address_street_2] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressStreet2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_street_2 !== $v) {
            $this->primary_address_street_2 = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_STREET_2;
        }


        return $this;
    } // setPrimaryAddressStreet2()

    /**
     * Set the value of [primary_address_city] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_city !== $v) {
            $this->primary_address_city = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_CITY;
        }


        return $this;
    } // setPrimaryAddressCity()

    /**
     * Set the value of [primary_address_state] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_state !== $v) {
            $this->primary_address_state = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_STATE;
        }


        return $this;
    } // setPrimaryAddressState()

    /**
     * Set the value of [primary_address_post_code] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressPostCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_post_code !== $v) {
            $this->primary_address_post_code = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_POST_CODE;
        }


        return $this;
    } // setPrimaryAddressPostCode()

    /**
     * Set the value of [primary_address_country] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setPrimaryAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->primary_address_country !== $v) {
            $this->primary_address_country = $v;
            $this->modifiedColumns[] = ProfileTableMap::PRIMARY_ADDRESS_COUNTRY;
        }


        return $this;
    } // setPrimaryAddressCountry()

    /**
     * Set the value of [billing_address_street] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setBillingAddressStreet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_address_street !== $v) {
            $this->billing_address_street = $v;
            $this->modifiedColumns[] = ProfileTableMap::BILLING_ADDRESS_STREET;
        }


        return $this;
    } // setBillingAddressStreet()

    /**
     * Set the value of [billing_address_city] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setBillingAddressCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_address_city !== $v) {
            $this->billing_address_city = $v;
            $this->modifiedColumns[] = ProfileTableMap::BILLING_ADDRESS_CITY;
        }


        return $this;
    } // setBillingAddressCity()

    /**
     * Set the value of [billing_address_state] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setBillingAddressState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_address_state !== $v) {
            $this->billing_address_state = $v;
            $this->modifiedColumns[] = ProfileTableMap::BILLING_ADDRESS_STATE;
        }


        return $this;
    } // setBillingAddressState()

    /**
     * Set the value of [billing_address_post_code] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setBillingAddressPostCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_address_post_code !== $v) {
            $this->billing_address_post_code = $v;
            $this->modifiedColumns[] = ProfileTableMap::BILLING_ADDRESS_POST_CODE;
        }


        return $this;
    } // setBillingAddressPostCode()

    /**
     * Set the value of [billing_address_country] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setBillingAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_address_country !== $v) {
            $this->billing_address_country = $v;
            $this->modifiedColumns[] = ProfileTableMap::BILLING_ADDRESS_COUNTRY;
        }


        return $this;
    } // setBillingAddressCountry()

    /**
     * Set the value of [security_question_1] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setFirstSecurityQuestion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_question_1 !== $v) {
            $this->security_question_1 = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_QUESTION_1;
        }


        return $this;
    } // setFirstSecurityQuestion()

    /**
     * Set the value of [security_answer_1] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setFirstSecurityQuestionAnswer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_answer_1 !== $v) {
            $this->security_answer_1 = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_ANSWER_1;
        }


        return $this;
    } // setFirstSecurityQuestionAnswer()

    /**
     * Set the value of [security_question_2] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setSecondSecurityQuestion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_question_2 !== $v) {
            $this->security_question_2 = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_QUESTION_2;
        }


        return $this;
    } // setSecondSecurityQuestion()

    /**
     * Set the value of [security_answer_2] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setSecondSecurityQuestionAnswer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_answer_2 !== $v) {
            $this->security_answer_2 = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_ANSWER_2;
        }


        return $this;
    } // setSecondSecurityQuestionAnswer()

    /**
     * Set the value of [security_question_custom] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setCustomSecurityQuestion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_question_custom !== $v) {
            $this->security_question_custom = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_QUESTION_CUSTOM;
        }


        return $this;
    } // setCustomSecurityQuestion()

    /**
     * Set the value of [security_answer_custom] column.
     *
     * @param      string $v new value
     * @return   \Profile The current object (for fluent API support)
     */
    public function setCustomSecurityAnswer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_answer_custom !== $v) {
            $this->security_answer_custom = $v;
            $this->modifiedColumns[] = ProfileTableMap::SECURITY_ANSWER_CUSTOM;
        }


        return $this;
    } // setCustomSecurityAnswer()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \Profile The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[] = ProfileTableMap::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \Profile The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[] = ProfileTableMap::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProfileTableMap::translateFieldName('ID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProfileTableMap::translateFieldName('UUID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProfileTableMap::translateFieldName('UserID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProfileTableMap::translateFieldName('DealerID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dealer_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProfileTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProfileTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProfileTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProfileTableMap::translateFieldName('DateOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_of_birth = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProfileTableMap::translateFieldName('PhoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProfileTableMap::translateFieldName('MobileNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mobile_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProfileTableMap::translateFieldName('ProfileImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProfileTableMap::translateFieldName('CompanyName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressStreet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_street = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressStreet2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_street_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressCity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressPostCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_post_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ProfileTableMap::translateFieldName('PrimaryAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->primary_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ProfileTableMap::translateFieldName('BillingAddressStreet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_street = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ProfileTableMap::translateFieldName('BillingAddressCity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ProfileTableMap::translateFieldName('BillingAddressState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ProfileTableMap::translateFieldName('BillingAddressPostCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_post_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ProfileTableMap::translateFieldName('BillingAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ProfileTableMap::translateFieldName('FirstSecurityQuestion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_question_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ProfileTableMap::translateFieldName('FirstSecurityQuestionAnswer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_answer_1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ProfileTableMap::translateFieldName('SecondSecurityQuestion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_question_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ProfileTableMap::translateFieldName('SecondSecurityQuestionAnswer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_answer_2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ProfileTableMap::translateFieldName('CustomSecurityQuestion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_question_custom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ProfileTableMap::translateFieldName('CustomSecurityAnswer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_answer_custom = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ProfileTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ProfileTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 31; // 31 = ProfileTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \Profile object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUser !== null && $this->user_id !== $this->aUser->getID()) {
            $this->aUser = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProfileTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProfileQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Profile::setDeleted()
     * @see Profile::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildProfileQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ProfileTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ProfileTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ProfileTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProfileTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = ProfileTableMap::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProfileTableMap::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProfileTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(ProfileTableMap::UUID)) {
            $modifiedColumns[':p' . $index++]  = 'UUID';
        }
        if ($this->isColumnModified(ProfileTableMap::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'USER_ID';
        }
        if ($this->isColumnModified(ProfileTableMap::DEALER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'DEALER_ID';
        }
        if ($this->isColumnModified(ProfileTableMap::FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'FIRST_NAME';
        }
        if ($this->isColumnModified(ProfileTableMap::LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'LAST_NAME';
        }
        if ($this->isColumnModified(ProfileTableMap::GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'GENDER';
        }
        if ($this->isColumnModified(ProfileTableMap::DATE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'DATE_OF_BIRTH';
        }
        if ($this->isColumnModified(ProfileTableMap::PHONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'PHONE_NUMBER';
        }
        if ($this->isColumnModified(ProfileTableMap::MOBILE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'MOBILE_NUMBER';
        }
        if ($this->isColumnModified(ProfileTableMap::IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'IMAGE';
        }
        if ($this->isColumnModified(ProfileTableMap::COMPANY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'COMPANY_NAME';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STREET)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_STREET';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STREET_2)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_STREET_2';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_CITY';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_STATE';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_POST_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_POST_CODE';
        }
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'PRIMARY_ADDRESS_COUNTRY';
        }
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_STREET)) {
            $modifiedColumns[':p' . $index++]  = 'BILLING_ADDRESS_STREET';
        }
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'BILLING_ADDRESS_CITY';
        }
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'BILLING_ADDRESS_STATE';
        }
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_POST_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'BILLING_ADDRESS_POST_CODE';
        }
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'BILLING_ADDRESS_COUNTRY';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_1)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_QUESTION_1';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_1)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_ANSWER_1';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_2)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_QUESTION_2';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_2)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_ANSWER_2';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_CUSTOM)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_QUESTION_CUSTOM';
        }
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_CUSTOM)) {
            $modifiedColumns[':p' . $index++]  = 'SECURITY_ANSWER_CUSTOM';
        }
        if ($this->isColumnModified(ProfileTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(ProfileTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO profile (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'UUID':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);
                        break;
                    case 'USER_ID':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'DEALER_ID':
                        $stmt->bindValue($identifier, $this->dealer_id, PDO::PARAM_INT);
                        break;
                    case 'FIRST_NAME':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case 'LAST_NAME':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case 'GENDER':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_INT);
                        break;
                    case 'DATE_OF_BIRTH':
                        $stmt->bindValue($identifier, $this->date_of_birth ? $this->date_of_birth->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'PHONE_NUMBER':
                        $stmt->bindValue($identifier, $this->phone_number, PDO::PARAM_STR);
                        break;
                    case 'MOBILE_NUMBER':
                        $stmt->bindValue($identifier, $this->mobile_number, PDO::PARAM_STR);
                        break;
                    case 'IMAGE':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case 'COMPANY_NAME':
                        $stmt->bindValue($identifier, $this->company_name, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_STREET':
                        $stmt->bindValue($identifier, $this->primary_address_street, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_STREET_2':
                        $stmt->bindValue($identifier, $this->primary_address_street_2, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_CITY':
                        $stmt->bindValue($identifier, $this->primary_address_city, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_STATE':
                        $stmt->bindValue($identifier, $this->primary_address_state, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_POST_CODE':
                        $stmt->bindValue($identifier, $this->primary_address_post_code, PDO::PARAM_STR);
                        break;
                    case 'PRIMARY_ADDRESS_COUNTRY':
                        $stmt->bindValue($identifier, $this->primary_address_country, PDO::PARAM_STR);
                        break;
                    case 'BILLING_ADDRESS_STREET':
                        $stmt->bindValue($identifier, $this->billing_address_street, PDO::PARAM_STR);
                        break;
                    case 'BILLING_ADDRESS_CITY':
                        $stmt->bindValue($identifier, $this->billing_address_city, PDO::PARAM_STR);
                        break;
                    case 'BILLING_ADDRESS_STATE':
                        $stmt->bindValue($identifier, $this->billing_address_state, PDO::PARAM_STR);
                        break;
                    case 'BILLING_ADDRESS_POST_CODE':
                        $stmt->bindValue($identifier, $this->billing_address_post_code, PDO::PARAM_STR);
                        break;
                    case 'BILLING_ADDRESS_COUNTRY':
                        $stmt->bindValue($identifier, $this->billing_address_country, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_QUESTION_1':
                        $stmt->bindValue($identifier, $this->security_question_1, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_ANSWER_1':
                        $stmt->bindValue($identifier, $this->security_answer_1, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_QUESTION_2':
                        $stmt->bindValue($identifier, $this->security_question_2, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_ANSWER_2':
                        $stmt->bindValue($identifier, $this->security_answer_2, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_QUESTION_CUSTOM':
                        $stmt->bindValue($identifier, $this->security_question_custom, PDO::PARAM_STR);
                        break;
                    case 'SECURITY_ANSWER_CUSTOM':
                        $stmt->bindValue($identifier, $this->security_answer_custom, PDO::PARAM_STR);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setID($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProfileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getID();
                break;
            case 1:
                return $this->getUUID();
                break;
            case 2:
                return $this->getUserID();
                break;
            case 3:
                return $this->getDealerID();
                break;
            case 4:
                return $this->getFirstName();
                break;
            case 5:
                return $this->getLastName();
                break;
            case 6:
                return $this->getGender();
                break;
            case 7:
                return $this->getDateOfBirth();
                break;
            case 8:
                return $this->getPhoneNumber();
                break;
            case 9:
                return $this->getMobileNumber();
                break;
            case 10:
                return $this->getProfileImage();
                break;
            case 11:
                return $this->getCompanyName();
                break;
            case 12:
                return $this->getPrimaryAddressStreet();
                break;
            case 13:
                return $this->getPrimaryAddressStreet2();
                break;
            case 14:
                return $this->getPrimaryAddressCity();
                break;
            case 15:
                return $this->getPrimaryAddressState();
                break;
            case 16:
                return $this->getPrimaryAddressPostCode();
                break;
            case 17:
                return $this->getPrimaryAddressCountry();
                break;
            case 18:
                return $this->getBillingAddressStreet();
                break;
            case 19:
                return $this->getBillingAddressCity();
                break;
            case 20:
                return $this->getBillingAddressState();
                break;
            case 21:
                return $this->getBillingAddressPostCode();
                break;
            case 22:
                return $this->getBillingAddressCountry();
                break;
            case 23:
                return $this->getFirstSecurityQuestion();
                break;
            case 24:
                return $this->getFirstSecurityQuestionAnswer();
                break;
            case 25:
                return $this->getSecondSecurityQuestion();
                break;
            case 26:
                return $this->getSecondSecurityQuestionAnswer();
                break;
            case 27:
                return $this->getCustomSecurityQuestion();
                break;
            case 28:
                return $this->getCustomSecurityAnswer();
                break;
            case 29:
                return $this->getCreatedAt();
                break;
            case 30:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Profile'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Profile'][$this->getPrimaryKey()] = true;
        $keys = ProfileTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getID(),
            $keys[1] => $this->getUUID(),
            $keys[2] => $this->getUserID(),
            $keys[3] => $this->getDealerID(),
            $keys[4] => $this->getFirstName(),
            $keys[5] => $this->getLastName(),
            $keys[6] => $this->getGender(),
            $keys[7] => $this->getDateOfBirth(),
            $keys[8] => $this->getPhoneNumber(),
            $keys[9] => $this->getMobileNumber(),
            $keys[10] => $this->getProfileImage(),
            $keys[11] => $this->getCompanyName(),
            $keys[12] => $this->getPrimaryAddressStreet(),
            $keys[13] => $this->getPrimaryAddressStreet2(),
            $keys[14] => $this->getPrimaryAddressCity(),
            $keys[15] => $this->getPrimaryAddressState(),
            $keys[16] => $this->getPrimaryAddressPostCode(),
            $keys[17] => $this->getPrimaryAddressCountry(),
            $keys[18] => $this->getBillingAddressStreet(),
            $keys[19] => $this->getBillingAddressCity(),
            $keys[20] => $this->getBillingAddressState(),
            $keys[21] => $this->getBillingAddressPostCode(),
            $keys[22] => $this->getBillingAddressCountry(),
            $keys[23] => $this->getFirstSecurityQuestion(),
            $keys[24] => $this->getFirstSecurityQuestionAnswer(),
            $keys[25] => $this->getSecondSecurityQuestion(),
            $keys[26] => $this->getSecondSecurityQuestionAnswer(),
            $keys[27] => $this->getCustomSecurityQuestion(),
            $keys[28] => $this->getCustomSecurityAnswer(),
            $keys[29] => $this->getCreatedAt(),
            $keys[30] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProfileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setID($value);
                break;
            case 1:
                $this->setUUID($value);
                break;
            case 2:
                $this->setUserID($value);
                break;
            case 3:
                $this->setDealerID($value);
                break;
            case 4:
                $this->setFirstName($value);
                break;
            case 5:
                $this->setLastName($value);
                break;
            case 6:
                $valueSet = ProfileTableMap::getValueSet(ProfileTableMap::GENDER);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setGender($value);
                break;
            case 7:
                $this->setDateOfBirth($value);
                break;
            case 8:
                $this->setPhoneNumber($value);
                break;
            case 9:
                $this->setMobileNumber($value);
                break;
            case 10:
                $this->setProfileImage($value);
                break;
            case 11:
                $this->setCompanyName($value);
                break;
            case 12:
                $this->setPrimaryAddressStreet($value);
                break;
            case 13:
                $this->setPrimaryAddressStreet2($value);
                break;
            case 14:
                $this->setPrimaryAddressCity($value);
                break;
            case 15:
                $this->setPrimaryAddressState($value);
                break;
            case 16:
                $this->setPrimaryAddressPostCode($value);
                break;
            case 17:
                $this->setPrimaryAddressCountry($value);
                break;
            case 18:
                $this->setBillingAddressStreet($value);
                break;
            case 19:
                $this->setBillingAddressCity($value);
                break;
            case 20:
                $this->setBillingAddressState($value);
                break;
            case 21:
                $this->setBillingAddressPostCode($value);
                break;
            case 22:
                $this->setBillingAddressCountry($value);
                break;
            case 23:
                $this->setFirstSecurityQuestion($value);
                break;
            case 24:
                $this->setFirstSecurityQuestionAnswer($value);
                break;
            case 25:
                $this->setSecondSecurityQuestion($value);
                break;
            case 26:
                $this->setSecondSecurityQuestionAnswer($value);
                break;
            case 27:
                $this->setCustomSecurityQuestion($value);
                break;
            case 28:
                $this->setCustomSecurityAnswer($value);
                break;
            case 29:
                $this->setCreatedAt($value);
                break;
            case 30:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProfileTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setID($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUUID($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUserID($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDealerID($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFirstName($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setLastName($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setGender($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDateOfBirth($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setPhoneNumber($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMobileNumber($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setProfileImage($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setCompanyName($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setPrimaryAddressStreet($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setPrimaryAddressStreet2($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setPrimaryAddressCity($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setPrimaryAddressState($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setPrimaryAddressPostCode($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setPrimaryAddressCountry($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setBillingAddressStreet($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setBillingAddressCity($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setBillingAddressState($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setBillingAddressPostCode($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setBillingAddressCountry($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setFirstSecurityQuestion($arr[$keys[23]]);
        if (array_key_exists($keys[24], $arr)) $this->setFirstSecurityQuestionAnswer($arr[$keys[24]]);
        if (array_key_exists($keys[25], $arr)) $this->setSecondSecurityQuestion($arr[$keys[25]]);
        if (array_key_exists($keys[26], $arr)) $this->setSecondSecurityQuestionAnswer($arr[$keys[26]]);
        if (array_key_exists($keys[27], $arr)) $this->setCustomSecurityQuestion($arr[$keys[27]]);
        if (array_key_exists($keys[28], $arr)) $this->setCustomSecurityAnswer($arr[$keys[28]]);
        if (array_key_exists($keys[29], $arr)) $this->setCreatedAt($arr[$keys[29]]);
        if (array_key_exists($keys[30], $arr)) $this->setUpdatedAt($arr[$keys[30]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProfileTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProfileTableMap::ID)) $criteria->add(ProfileTableMap::ID, $this->id);
        if ($this->isColumnModified(ProfileTableMap::UUID)) $criteria->add(ProfileTableMap::UUID, $this->uuid);
        if ($this->isColumnModified(ProfileTableMap::USER_ID)) $criteria->add(ProfileTableMap::USER_ID, $this->user_id);
        if ($this->isColumnModified(ProfileTableMap::DEALER_ID)) $criteria->add(ProfileTableMap::DEALER_ID, $this->dealer_id);
        if ($this->isColumnModified(ProfileTableMap::FIRST_NAME)) $criteria->add(ProfileTableMap::FIRST_NAME, $this->first_name);
        if ($this->isColumnModified(ProfileTableMap::LAST_NAME)) $criteria->add(ProfileTableMap::LAST_NAME, $this->last_name);
        if ($this->isColumnModified(ProfileTableMap::GENDER)) $criteria->add(ProfileTableMap::GENDER, $this->gender);
        if ($this->isColumnModified(ProfileTableMap::DATE_OF_BIRTH)) $criteria->add(ProfileTableMap::DATE_OF_BIRTH, $this->date_of_birth);
        if ($this->isColumnModified(ProfileTableMap::PHONE_NUMBER)) $criteria->add(ProfileTableMap::PHONE_NUMBER, $this->phone_number);
        if ($this->isColumnModified(ProfileTableMap::MOBILE_NUMBER)) $criteria->add(ProfileTableMap::MOBILE_NUMBER, $this->mobile_number);
        if ($this->isColumnModified(ProfileTableMap::IMAGE)) $criteria->add(ProfileTableMap::IMAGE, $this->image);
        if ($this->isColumnModified(ProfileTableMap::COMPANY_NAME)) $criteria->add(ProfileTableMap::COMPANY_NAME, $this->company_name);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STREET)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_STREET, $this->primary_address_street);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STREET_2)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_STREET_2, $this->primary_address_street_2);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_CITY)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_CITY, $this->primary_address_city);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_STATE)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_STATE, $this->primary_address_state);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_POST_CODE)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_POST_CODE, $this->primary_address_post_code);
        if ($this->isColumnModified(ProfileTableMap::PRIMARY_ADDRESS_COUNTRY)) $criteria->add(ProfileTableMap::PRIMARY_ADDRESS_COUNTRY, $this->primary_address_country);
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_STREET)) $criteria->add(ProfileTableMap::BILLING_ADDRESS_STREET, $this->billing_address_street);
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_CITY)) $criteria->add(ProfileTableMap::BILLING_ADDRESS_CITY, $this->billing_address_city);
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_STATE)) $criteria->add(ProfileTableMap::BILLING_ADDRESS_STATE, $this->billing_address_state);
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_POST_CODE)) $criteria->add(ProfileTableMap::BILLING_ADDRESS_POST_CODE, $this->billing_address_post_code);
        if ($this->isColumnModified(ProfileTableMap::BILLING_ADDRESS_COUNTRY)) $criteria->add(ProfileTableMap::BILLING_ADDRESS_COUNTRY, $this->billing_address_country);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_1)) $criteria->add(ProfileTableMap::SECURITY_QUESTION_1, $this->security_question_1);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_1)) $criteria->add(ProfileTableMap::SECURITY_ANSWER_1, $this->security_answer_1);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_2)) $criteria->add(ProfileTableMap::SECURITY_QUESTION_2, $this->security_question_2);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_2)) $criteria->add(ProfileTableMap::SECURITY_ANSWER_2, $this->security_answer_2);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_QUESTION_CUSTOM)) $criteria->add(ProfileTableMap::SECURITY_QUESTION_CUSTOM, $this->security_question_custom);
        if ($this->isColumnModified(ProfileTableMap::SECURITY_ANSWER_CUSTOM)) $criteria->add(ProfileTableMap::SECURITY_ANSWER_CUSTOM, $this->security_answer_custom);
        if ($this->isColumnModified(ProfileTableMap::CREATED_AT)) $criteria->add(ProfileTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ProfileTableMap::UPDATED_AT)) $criteria->add(ProfileTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ProfileTableMap::DATABASE_NAME);
        $criteria->add(ProfileTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getID();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setID($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getID();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Profile (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUUID($this->getUUID());
        $copyObj->setUserID($this->getUserID());
        $copyObj->setDealerID($this->getDealerID());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setGender($this->getGender());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setPhoneNumber($this->getPhoneNumber());
        $copyObj->setMobileNumber($this->getMobileNumber());
        $copyObj->setProfileImage($this->getProfileImage());
        $copyObj->setCompanyName($this->getCompanyName());
        $copyObj->setPrimaryAddressStreet($this->getPrimaryAddressStreet());
        $copyObj->setPrimaryAddressStreet2($this->getPrimaryAddressStreet2());
        $copyObj->setPrimaryAddressCity($this->getPrimaryAddressCity());
        $copyObj->setPrimaryAddressState($this->getPrimaryAddressState());
        $copyObj->setPrimaryAddressPostCode($this->getPrimaryAddressPostCode());
        $copyObj->setPrimaryAddressCountry($this->getPrimaryAddressCountry());
        $copyObj->setBillingAddressStreet($this->getBillingAddressStreet());
        $copyObj->setBillingAddressCity($this->getBillingAddressCity());
        $copyObj->setBillingAddressState($this->getBillingAddressState());
        $copyObj->setBillingAddressPostCode($this->getBillingAddressPostCode());
        $copyObj->setBillingAddressCountry($this->getBillingAddressCountry());
        $copyObj->setFirstSecurityQuestion($this->getFirstSecurityQuestion());
        $copyObj->setFirstSecurityQuestionAnswer($this->getFirstSecurityQuestionAnswer());
        $copyObj->setSecondSecurityQuestion($this->getSecondSecurityQuestion());
        $copyObj->setSecondSecurityQuestionAnswer($this->getSecondSecurityQuestionAnswer());
        $copyObj->setCustomSecurityQuestion($this->getCustomSecurityQuestion());
        $copyObj->setCustomSecurityAnswer($this->getCustomSecurityAnswer());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setID(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \Profile Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param                  ChildUser $v
     * @return                 \Profile The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserID(NULL);
        } else {
            $this->setUserID($v->getID());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addProfile($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param      ConnectionInterface $con Optional Connection object.
     * @return                 ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->user_id !== null)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addProfiles($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->uuid = null;
        $this->user_id = null;
        $this->dealer_id = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->gender = null;
        $this->date_of_birth = null;
        $this->phone_number = null;
        $this->mobile_number = null;
        $this->image = null;
        $this->company_name = null;
        $this->primary_address_street = null;
        $this->primary_address_street_2 = null;
        $this->primary_address_city = null;
        $this->primary_address_state = null;
        $this->primary_address_post_code = null;
        $this->primary_address_country = null;
        $this->billing_address_street = null;
        $this->billing_address_city = null;
        $this->billing_address_state = null;
        $this->billing_address_post_code = null;
        $this->billing_address_country = null;
        $this->security_question_1 = null;
        $this->security_answer_1 = null;
        $this->security_question_2 = null;
        $this->security_answer_2 = null;
        $this->security_question_custom = null;
        $this->security_answer_custom = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProfileTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildProfile The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ProfileTableMap::UPDATED_AT;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
