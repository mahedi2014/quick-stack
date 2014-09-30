<?php

namespace Map;

use \Profile;
use \ProfileQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'profile' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProfileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProfileTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quickstack';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'profile';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Profile';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Profile';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 31;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 31;

    /**
     * the column name for the ID field
     */
    const ID = 'profile.ID';

    /**
     * the column name for the UUID field
     */
    const UUID = 'profile.UUID';

    /**
     * the column name for the USER_ID field
     */
    const USER_ID = 'profile.USER_ID';

    /**
     * the column name for the DEALER_ID field
     */
    const DEALER_ID = 'profile.DEALER_ID';

    /**
     * the column name for the FIRST_NAME field
     */
    const FIRST_NAME = 'profile.FIRST_NAME';

    /**
     * the column name for the LAST_NAME field
     */
    const LAST_NAME = 'profile.LAST_NAME';

    /**
     * the column name for the GENDER field
     */
    const GENDER = 'profile.GENDER';

    /**
     * the column name for the DATE_OF_BIRTH field
     */
    const DATE_OF_BIRTH = 'profile.DATE_OF_BIRTH';

    /**
     * the column name for the PHONE_NUMBER field
     */
    const PHONE_NUMBER = 'profile.PHONE_NUMBER';

    /**
     * the column name for the MOBILE_NUMBER field
     */
    const MOBILE_NUMBER = 'profile.MOBILE_NUMBER';

    /**
     * the column name for the IMAGE field
     */
    const IMAGE = 'profile.IMAGE';

    /**
     * the column name for the COMPANY_NAME field
     */
    const COMPANY_NAME = 'profile.COMPANY_NAME';

    /**
     * the column name for the PRIMARY_ADDRESS_STREET field
     */
    const PRIMARY_ADDRESS_STREET = 'profile.PRIMARY_ADDRESS_STREET';

    /**
     * the column name for the PRIMARY_ADDRESS_STREET_2 field
     */
    const PRIMARY_ADDRESS_STREET_2 = 'profile.PRIMARY_ADDRESS_STREET_2';

    /**
     * the column name for the PRIMARY_ADDRESS_CITY field
     */
    const PRIMARY_ADDRESS_CITY = 'profile.PRIMARY_ADDRESS_CITY';

    /**
     * the column name for the PRIMARY_ADDRESS_STATE field
     */
    const PRIMARY_ADDRESS_STATE = 'profile.PRIMARY_ADDRESS_STATE';

    /**
     * the column name for the PRIMARY_ADDRESS_POST_CODE field
     */
    const PRIMARY_ADDRESS_POST_CODE = 'profile.PRIMARY_ADDRESS_POST_CODE';

    /**
     * the column name for the PRIMARY_ADDRESS_COUNTRY field
     */
    const PRIMARY_ADDRESS_COUNTRY = 'profile.PRIMARY_ADDRESS_COUNTRY';

    /**
     * the column name for the BILLING_ADDRESS_STREET field
     */
    const BILLING_ADDRESS_STREET = 'profile.BILLING_ADDRESS_STREET';

    /**
     * the column name for the BILLING_ADDRESS_CITY field
     */
    const BILLING_ADDRESS_CITY = 'profile.BILLING_ADDRESS_CITY';

    /**
     * the column name for the BILLING_ADDRESS_STATE field
     */
    const BILLING_ADDRESS_STATE = 'profile.BILLING_ADDRESS_STATE';

    /**
     * the column name for the BILLING_ADDRESS_POST_CODE field
     */
    const BILLING_ADDRESS_POST_CODE = 'profile.BILLING_ADDRESS_POST_CODE';

    /**
     * the column name for the BILLING_ADDRESS_COUNTRY field
     */
    const BILLING_ADDRESS_COUNTRY = 'profile.BILLING_ADDRESS_COUNTRY';

    /**
     * the column name for the SECURITY_QUESTION_1 field
     */
    const SECURITY_QUESTION_1 = 'profile.SECURITY_QUESTION_1';

    /**
     * the column name for the SECURITY_ANSWER_1 field
     */
    const SECURITY_ANSWER_1 = 'profile.SECURITY_ANSWER_1';

    /**
     * the column name for the SECURITY_QUESTION_2 field
     */
    const SECURITY_QUESTION_2 = 'profile.SECURITY_QUESTION_2';

    /**
     * the column name for the SECURITY_ANSWER_2 field
     */
    const SECURITY_ANSWER_2 = 'profile.SECURITY_ANSWER_2';

    /**
     * the column name for the SECURITY_QUESTION_CUSTOM field
     */
    const SECURITY_QUESTION_CUSTOM = 'profile.SECURITY_QUESTION_CUSTOM';

    /**
     * the column name for the SECURITY_ANSWER_CUSTOM field
     */
    const SECURITY_ANSWER_CUSTOM = 'profile.SECURITY_ANSWER_CUSTOM';

    /**
     * the column name for the CREATED_AT field
     */
    const CREATED_AT = 'profile.CREATED_AT';

    /**
     * the column name for the UPDATED_AT field
     */
    const UPDATED_AT = 'profile.UPDATED_AT';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the GENDER field */
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('ID', 'UUID', 'UserID', 'DealerID', 'FirstName', 'LastName', 'Gender', 'DateOfBirth', 'PhoneNumber', 'MobileNumber', 'ProfileImage', 'CompanyName', 'PrimaryAddressStreet', 'PrimaryAddressStreet2', 'PrimaryAddressCity', 'PrimaryAddressState', 'PrimaryAddressPostCode', 'PrimaryAddressCountry', 'BillingAddressStreet', 'BillingAddressCity', 'BillingAddressState', 'BillingAddressPostCode', 'BillingAddressCountry', 'FirstSecurityQuestion', 'FirstSecurityQuestionAnswer', 'SecondSecurityQuestion', 'SecondSecurityQuestionAnswer', 'CustomSecurityQuestion', 'CustomSecurityAnswer', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_STUDLYPHPNAME => array('iD', 'uUID', 'userID', 'dealerID', 'firstName', 'lastName', 'gender', 'dateOfBirth', 'phoneNumber', 'mobileNumber', 'profileImage', 'companyName', 'primaryAddressStreet', 'primaryAddressStreet2', 'primaryAddressCity', 'primaryAddressState', 'primaryAddressPostCode', 'primaryAddressCountry', 'billingAddressStreet', 'billingAddressCity', 'billingAddressState', 'billingAddressPostCode', 'billingAddressCountry', 'firstSecurityQuestion', 'firstSecurityQuestionAnswer', 'secondSecurityQuestion', 'secondSecurityQuestionAnswer', 'customSecurityQuestion', 'customSecurityAnswer', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProfileTableMap::ID, ProfileTableMap::UUID, ProfileTableMap::USER_ID, ProfileTableMap::DEALER_ID, ProfileTableMap::FIRST_NAME, ProfileTableMap::LAST_NAME, ProfileTableMap::GENDER, ProfileTableMap::DATE_OF_BIRTH, ProfileTableMap::PHONE_NUMBER, ProfileTableMap::MOBILE_NUMBER, ProfileTableMap::IMAGE, ProfileTableMap::COMPANY_NAME, ProfileTableMap::PRIMARY_ADDRESS_STREET, ProfileTableMap::PRIMARY_ADDRESS_STREET_2, ProfileTableMap::PRIMARY_ADDRESS_CITY, ProfileTableMap::PRIMARY_ADDRESS_STATE, ProfileTableMap::PRIMARY_ADDRESS_POST_CODE, ProfileTableMap::PRIMARY_ADDRESS_COUNTRY, ProfileTableMap::BILLING_ADDRESS_STREET, ProfileTableMap::BILLING_ADDRESS_CITY, ProfileTableMap::BILLING_ADDRESS_STATE, ProfileTableMap::BILLING_ADDRESS_POST_CODE, ProfileTableMap::BILLING_ADDRESS_COUNTRY, ProfileTableMap::SECURITY_QUESTION_1, ProfileTableMap::SECURITY_ANSWER_1, ProfileTableMap::SECURITY_QUESTION_2, ProfileTableMap::SECURITY_ANSWER_2, ProfileTableMap::SECURITY_QUESTION_CUSTOM, ProfileTableMap::SECURITY_ANSWER_CUSTOM, ProfileTableMap::CREATED_AT, ProfileTableMap::UPDATED_AT, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'UUID', 'USER_ID', 'DEALER_ID', 'FIRST_NAME', 'LAST_NAME', 'GENDER', 'DATE_OF_BIRTH', 'PHONE_NUMBER', 'MOBILE_NUMBER', 'IMAGE', 'COMPANY_NAME', 'PRIMARY_ADDRESS_STREET', 'PRIMARY_ADDRESS_STREET_2', 'PRIMARY_ADDRESS_CITY', 'PRIMARY_ADDRESS_STATE', 'PRIMARY_ADDRESS_POST_CODE', 'PRIMARY_ADDRESS_COUNTRY', 'BILLING_ADDRESS_STREET', 'BILLING_ADDRESS_CITY', 'BILLING_ADDRESS_STATE', 'BILLING_ADDRESS_POST_CODE', 'BILLING_ADDRESS_COUNTRY', 'SECURITY_QUESTION_1', 'SECURITY_ANSWER_1', 'SECURITY_QUESTION_2', 'SECURITY_ANSWER_2', 'SECURITY_QUESTION_CUSTOM', 'SECURITY_ANSWER_CUSTOM', 'CREATED_AT', 'UPDATED_AT', ),
        self::TYPE_FIELDNAME     => array('id', 'uuid', 'user_id', 'dealer_id', 'first_name', 'last_name', 'gender', 'date_of_birth', 'phone_number', 'mobile_number', 'image', 'company_name', 'primary_address_street', 'primary_address_street_2', 'primary_address_city', 'primary_address_state', 'primary_address_post_code', 'primary_address_country', 'billing_address_street', 'billing_address_city', 'billing_address_state', 'billing_address_post_code', 'billing_address_country', 'security_question_1', 'security_answer_1', 'security_question_2', 'security_answer_2', 'security_question_custom', 'security_answer_custom', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ID' => 0, 'UUID' => 1, 'UserID' => 2, 'DealerID' => 3, 'FirstName' => 4, 'LastName' => 5, 'Gender' => 6, 'DateOfBirth' => 7, 'PhoneNumber' => 8, 'MobileNumber' => 9, 'ProfileImage' => 10, 'CompanyName' => 11, 'PrimaryAddressStreet' => 12, 'PrimaryAddressStreet2' => 13, 'PrimaryAddressCity' => 14, 'PrimaryAddressState' => 15, 'PrimaryAddressPostCode' => 16, 'PrimaryAddressCountry' => 17, 'BillingAddressStreet' => 18, 'BillingAddressCity' => 19, 'BillingAddressState' => 20, 'BillingAddressPostCode' => 21, 'BillingAddressCountry' => 22, 'FirstSecurityQuestion' => 23, 'FirstSecurityQuestionAnswer' => 24, 'SecondSecurityQuestion' => 25, 'SecondSecurityQuestionAnswer' => 26, 'CustomSecurityQuestion' => 27, 'CustomSecurityAnswer' => 28, 'CreatedAt' => 29, 'UpdatedAt' => 30, ),
        self::TYPE_STUDLYPHPNAME => array('iD' => 0, 'uUID' => 1, 'userID' => 2, 'dealerID' => 3, 'firstName' => 4, 'lastName' => 5, 'gender' => 6, 'dateOfBirth' => 7, 'phoneNumber' => 8, 'mobileNumber' => 9, 'profileImage' => 10, 'companyName' => 11, 'primaryAddressStreet' => 12, 'primaryAddressStreet2' => 13, 'primaryAddressCity' => 14, 'primaryAddressState' => 15, 'primaryAddressPostCode' => 16, 'primaryAddressCountry' => 17, 'billingAddressStreet' => 18, 'billingAddressCity' => 19, 'billingAddressState' => 20, 'billingAddressPostCode' => 21, 'billingAddressCountry' => 22, 'firstSecurityQuestion' => 23, 'firstSecurityQuestionAnswer' => 24, 'secondSecurityQuestion' => 25, 'secondSecurityQuestionAnswer' => 26, 'customSecurityQuestion' => 27, 'customSecurityAnswer' => 28, 'createdAt' => 29, 'updatedAt' => 30, ),
        self::TYPE_COLNAME       => array(ProfileTableMap::ID => 0, ProfileTableMap::UUID => 1, ProfileTableMap::USER_ID => 2, ProfileTableMap::DEALER_ID => 3, ProfileTableMap::FIRST_NAME => 4, ProfileTableMap::LAST_NAME => 5, ProfileTableMap::GENDER => 6, ProfileTableMap::DATE_OF_BIRTH => 7, ProfileTableMap::PHONE_NUMBER => 8, ProfileTableMap::MOBILE_NUMBER => 9, ProfileTableMap::IMAGE => 10, ProfileTableMap::COMPANY_NAME => 11, ProfileTableMap::PRIMARY_ADDRESS_STREET => 12, ProfileTableMap::PRIMARY_ADDRESS_STREET_2 => 13, ProfileTableMap::PRIMARY_ADDRESS_CITY => 14, ProfileTableMap::PRIMARY_ADDRESS_STATE => 15, ProfileTableMap::PRIMARY_ADDRESS_POST_CODE => 16, ProfileTableMap::PRIMARY_ADDRESS_COUNTRY => 17, ProfileTableMap::BILLING_ADDRESS_STREET => 18, ProfileTableMap::BILLING_ADDRESS_CITY => 19, ProfileTableMap::BILLING_ADDRESS_STATE => 20, ProfileTableMap::BILLING_ADDRESS_POST_CODE => 21, ProfileTableMap::BILLING_ADDRESS_COUNTRY => 22, ProfileTableMap::SECURITY_QUESTION_1 => 23, ProfileTableMap::SECURITY_ANSWER_1 => 24, ProfileTableMap::SECURITY_QUESTION_2 => 25, ProfileTableMap::SECURITY_ANSWER_2 => 26, ProfileTableMap::SECURITY_QUESTION_CUSTOM => 27, ProfileTableMap::SECURITY_ANSWER_CUSTOM => 28, ProfileTableMap::CREATED_AT => 29, ProfileTableMap::UPDATED_AT => 30, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'UUID' => 1, 'USER_ID' => 2, 'DEALER_ID' => 3, 'FIRST_NAME' => 4, 'LAST_NAME' => 5, 'GENDER' => 6, 'DATE_OF_BIRTH' => 7, 'PHONE_NUMBER' => 8, 'MOBILE_NUMBER' => 9, 'IMAGE' => 10, 'COMPANY_NAME' => 11, 'PRIMARY_ADDRESS_STREET' => 12, 'PRIMARY_ADDRESS_STREET_2' => 13, 'PRIMARY_ADDRESS_CITY' => 14, 'PRIMARY_ADDRESS_STATE' => 15, 'PRIMARY_ADDRESS_POST_CODE' => 16, 'PRIMARY_ADDRESS_COUNTRY' => 17, 'BILLING_ADDRESS_STREET' => 18, 'BILLING_ADDRESS_CITY' => 19, 'BILLING_ADDRESS_STATE' => 20, 'BILLING_ADDRESS_POST_CODE' => 21, 'BILLING_ADDRESS_COUNTRY' => 22, 'SECURITY_QUESTION_1' => 23, 'SECURITY_ANSWER_1' => 24, 'SECURITY_QUESTION_2' => 25, 'SECURITY_ANSWER_2' => 26, 'SECURITY_QUESTION_CUSTOM' => 27, 'SECURITY_ANSWER_CUSTOM' => 28, 'CREATED_AT' => 29, 'UPDATED_AT' => 30, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'uuid' => 1, 'user_id' => 2, 'dealer_id' => 3, 'first_name' => 4, 'last_name' => 5, 'gender' => 6, 'date_of_birth' => 7, 'phone_number' => 8, 'mobile_number' => 9, 'image' => 10, 'company_name' => 11, 'primary_address_street' => 12, 'primary_address_street_2' => 13, 'primary_address_city' => 14, 'primary_address_state' => 15, 'primary_address_post_code' => 16, 'primary_address_country' => 17, 'billing_address_street' => 18, 'billing_address_city' => 19, 'billing_address_state' => 20, 'billing_address_post_code' => 21, 'billing_address_country' => 22, 'security_question_1' => 23, 'security_answer_1' => 24, 'security_question_2' => 25, 'security_answer_2' => 26, 'security_question_custom' => 27, 'security_answer_custom' => 28, 'created_at' => 29, 'updated_at' => 30, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                ProfileTableMap::GENDER => array(
                            self::GENDER_MALE,
            self::GENDER_FEMALE,
        ),
    );

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('profile');
        $this->setPhpName('Profile');
        $this->setClassName('\\Profile');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'ID', 'INTEGER', true, null, null);
        $this->addColumn('UUID', 'UUID', 'CHAR', true, 36, null);
        $this->addForeignKey('USER_ID', 'UserID', 'INTEGER', 'user', 'ID', true, null, null);
        $this->addColumn('DEALER_ID', 'DealerID', 'INTEGER', true, null, null);
        $this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 128, null);
        $this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 128, null);
        $this->addColumn('GENDER', 'Gender', 'ENUM', false, null, null);
        $this->getColumn('GENDER', false)->setValueSet(array (
  0 => 'male',
  1 => 'female',
));
        $this->addColumn('DATE_OF_BIRTH', 'DateOfBirth', 'DATE', false, null, null);
        $this->addColumn('PHONE_NUMBER', 'PhoneNumber', 'VARCHAR', false, 30, null);
        $this->addColumn('MOBILE_NUMBER', 'MobileNumber', 'VARCHAR', false, 30, null);
        $this->addColumn('IMAGE', 'ProfileImage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('COMPANY_NAME', 'CompanyName', 'VARCHAR', false, 128, null);
        $this->addColumn('PRIMARY_ADDRESS_STREET', 'PrimaryAddressStreet', 'VARCHAR', false, 255, null);
        $this->addColumn('PRIMARY_ADDRESS_STREET_2', 'PrimaryAddressStreet2', 'VARCHAR', false, 255, null);
        $this->addColumn('PRIMARY_ADDRESS_CITY', 'PrimaryAddressCity', 'VARCHAR', false, 128, null);
        $this->addColumn('PRIMARY_ADDRESS_STATE', 'PrimaryAddressState', 'VARCHAR', false, 128, null);
        $this->addColumn('PRIMARY_ADDRESS_POST_CODE', 'PrimaryAddressPostCode', 'VARCHAR', false, 20, null);
        $this->addColumn('PRIMARY_ADDRESS_COUNTRY', 'PrimaryAddressCountry', 'VARCHAR', false, 128, null);
        $this->addColumn('BILLING_ADDRESS_STREET', 'BillingAddressStreet', 'VARCHAR', false, 255, null);
        $this->addColumn('BILLING_ADDRESS_CITY', 'BillingAddressCity', 'VARCHAR', false, 128, null);
        $this->addColumn('BILLING_ADDRESS_STATE', 'BillingAddressState', 'VARCHAR', false, 128, null);
        $this->addColumn('BILLING_ADDRESS_POST_CODE', 'BillingAddressPostCode', 'VARCHAR', false, 20, null);
        $this->addColumn('BILLING_ADDRESS_COUNTRY', 'BillingAddressCountry', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_QUESTION_1', 'FirstSecurityQuestion', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_ANSWER_1', 'FirstSecurityQuestionAnswer', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_QUESTION_2', 'SecondSecurityQuestion', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_ANSWER_2', 'SecondSecurityQuestionAnswer', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_QUESTION_CUSTOM', 'CustomSecurityQuestion', 'VARCHAR', false, 128, null);
        $this->addColumn('SECURITY_ANSWER_CUSTOM', 'CustomSecurityAnswer', 'VARCHAR', false, 128, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ID', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('ID', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ProfileTableMap::CLASS_DEFAULT : ProfileTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (Profile object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProfileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProfileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProfileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProfileTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProfileTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ProfileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProfileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProfileTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProfileTableMap::ID);
            $criteria->addSelectColumn(ProfileTableMap::UUID);
            $criteria->addSelectColumn(ProfileTableMap::USER_ID);
            $criteria->addSelectColumn(ProfileTableMap::DEALER_ID);
            $criteria->addSelectColumn(ProfileTableMap::FIRST_NAME);
            $criteria->addSelectColumn(ProfileTableMap::LAST_NAME);
            $criteria->addSelectColumn(ProfileTableMap::GENDER);
            $criteria->addSelectColumn(ProfileTableMap::DATE_OF_BIRTH);
            $criteria->addSelectColumn(ProfileTableMap::PHONE_NUMBER);
            $criteria->addSelectColumn(ProfileTableMap::MOBILE_NUMBER);
            $criteria->addSelectColumn(ProfileTableMap::IMAGE);
            $criteria->addSelectColumn(ProfileTableMap::COMPANY_NAME);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_STREET);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_STREET_2);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_CITY);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_STATE);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_POST_CODE);
            $criteria->addSelectColumn(ProfileTableMap::PRIMARY_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(ProfileTableMap::BILLING_ADDRESS_STREET);
            $criteria->addSelectColumn(ProfileTableMap::BILLING_ADDRESS_CITY);
            $criteria->addSelectColumn(ProfileTableMap::BILLING_ADDRESS_STATE);
            $criteria->addSelectColumn(ProfileTableMap::BILLING_ADDRESS_POST_CODE);
            $criteria->addSelectColumn(ProfileTableMap::BILLING_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_QUESTION_1);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_ANSWER_1);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_QUESTION_2);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_ANSWER_2);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_QUESTION_CUSTOM);
            $criteria->addSelectColumn(ProfileTableMap::SECURITY_ANSWER_CUSTOM);
            $criteria->addSelectColumn(ProfileTableMap::CREATED_AT);
            $criteria->addSelectColumn(ProfileTableMap::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.UUID');
            $criteria->addSelectColumn($alias . '.USER_ID');
            $criteria->addSelectColumn($alias . '.DEALER_ID');
            $criteria->addSelectColumn($alias . '.FIRST_NAME');
            $criteria->addSelectColumn($alias . '.LAST_NAME');
            $criteria->addSelectColumn($alias . '.GENDER');
            $criteria->addSelectColumn($alias . '.DATE_OF_BIRTH');
            $criteria->addSelectColumn($alias . '.PHONE_NUMBER');
            $criteria->addSelectColumn($alias . '.MOBILE_NUMBER');
            $criteria->addSelectColumn($alias . '.IMAGE');
            $criteria->addSelectColumn($alias . '.COMPANY_NAME');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_STREET');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_STREET_2');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_CITY');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_STATE');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_POST_CODE');
            $criteria->addSelectColumn($alias . '.PRIMARY_ADDRESS_COUNTRY');
            $criteria->addSelectColumn($alias . '.BILLING_ADDRESS_STREET');
            $criteria->addSelectColumn($alias . '.BILLING_ADDRESS_CITY');
            $criteria->addSelectColumn($alias . '.BILLING_ADDRESS_STATE');
            $criteria->addSelectColumn($alias . '.BILLING_ADDRESS_POST_CODE');
            $criteria->addSelectColumn($alias . '.BILLING_ADDRESS_COUNTRY');
            $criteria->addSelectColumn($alias . '.SECURITY_QUESTION_1');
            $criteria->addSelectColumn($alias . '.SECURITY_ANSWER_1');
            $criteria->addSelectColumn($alias . '.SECURITY_QUESTION_2');
            $criteria->addSelectColumn($alias . '.SECURITY_ANSWER_2');
            $criteria->addSelectColumn($alias . '.SECURITY_QUESTION_CUSTOM');
            $criteria->addSelectColumn($alias . '.SECURITY_ANSWER_CUSTOM');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ProfileTableMap::DATABASE_NAME)->getTable(ProfileTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProfileTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(ProfileTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new ProfileTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a Profile or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Profile object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Profile) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProfileTableMap::DATABASE_NAME);
            $criteria->add(ProfileTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = ProfileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { ProfileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { ProfileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the profile table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProfileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Profile or Criteria object.
     *
     * @param mixed               $criteria Criteria or Profile object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Profile object
        }

        if ($criteria->containsKey(ProfileTableMap::ID) && $criteria->keyContainsValue(ProfileTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProfileTableMap::ID.')');
        }


        // Set the correct dbName
        $query = ProfileQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // ProfileTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProfileTableMap::buildTableMap();
