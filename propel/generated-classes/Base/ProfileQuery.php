<?php

namespace Base;

use \Profile as ChildProfile;
use \ProfileQuery as ChildProfileQuery;
use \Exception;
use \PDO;
use Map\ProfileTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'profile' table.
 *
 *
 *
 * @method     ChildProfileQuery orderByID($order = Criteria::ASC) Order by the id column
 * @method     ChildProfileQuery orderByUUID($order = Criteria::ASC) Order by the uuid column
 * @method     ChildProfileQuery orderByUserID($order = Criteria::ASC) Order by the user_id column
 * @method     ChildProfileQuery orderByDealerID($order = Criteria::ASC) Order by the dealer_id column
 * @method     ChildProfileQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildProfileQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildProfileQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildProfileQuery orderByDateOfBirth($order = Criteria::ASC) Order by the date_of_birth column
 * @method     ChildProfileQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 * @method     ChildProfileQuery orderByMobileNumber($order = Criteria::ASC) Order by the mobile_number column
 * @method     ChildProfileQuery orderByProfileImage($order = Criteria::ASC) Order by the image column
 * @method     ChildProfileQuery orderByCompanyName($order = Criteria::ASC) Order by the company_name column
 * @method     ChildProfileQuery orderByPrimaryAddressStreet($order = Criteria::ASC) Order by the primary_address_street column
 * @method     ChildProfileQuery orderByPrimaryAddressStreet2($order = Criteria::ASC) Order by the primary_address_street_2 column
 * @method     ChildProfileQuery orderByPrimaryAddressCity($order = Criteria::ASC) Order by the primary_address_city column
 * @method     ChildProfileQuery orderByPrimaryAddressState($order = Criteria::ASC) Order by the primary_address_state column
 * @method     ChildProfileQuery orderByPrimaryAddressPostCode($order = Criteria::ASC) Order by the primary_address_post_code column
 * @method     ChildProfileQuery orderByPrimaryAddressCountry($order = Criteria::ASC) Order by the primary_address_country column
 * @method     ChildProfileQuery orderByBillingAddressStreet($order = Criteria::ASC) Order by the billing_address_street column
 * @method     ChildProfileQuery orderByBillingAddressCity($order = Criteria::ASC) Order by the billing_address_city column
 * @method     ChildProfileQuery orderByBillingAddressState($order = Criteria::ASC) Order by the billing_address_state column
 * @method     ChildProfileQuery orderByBillingAddressPostCode($order = Criteria::ASC) Order by the billing_address_post_code column
 * @method     ChildProfileQuery orderByBillingAddressCountry($order = Criteria::ASC) Order by the billing_address_country column
 * @method     ChildProfileQuery orderByFirstSecurityQuestion($order = Criteria::ASC) Order by the security_question_1 column
 * @method     ChildProfileQuery orderByFirstSecurityQuestionAnswer($order = Criteria::ASC) Order by the security_answer_1 column
 * @method     ChildProfileQuery orderBySecondSecurityQuestion($order = Criteria::ASC) Order by the security_question_2 column
 * @method     ChildProfileQuery orderBySecondSecurityQuestionAnswer($order = Criteria::ASC) Order by the security_answer_2 column
 * @method     ChildProfileQuery orderByCustomSecurityQuestion($order = Criteria::ASC) Order by the security_question_custom column
 * @method     ChildProfileQuery orderByCustomSecurityAnswer($order = Criteria::ASC) Order by the security_answer_custom column
 * @method     ChildProfileQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProfileQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProfileQuery groupByID() Group by the id column
 * @method     ChildProfileQuery groupByUUID() Group by the uuid column
 * @method     ChildProfileQuery groupByUserID() Group by the user_id column
 * @method     ChildProfileQuery groupByDealerID() Group by the dealer_id column
 * @method     ChildProfileQuery groupByFirstName() Group by the first_name column
 * @method     ChildProfileQuery groupByLastName() Group by the last_name column
 * @method     ChildProfileQuery groupByGender() Group by the gender column
 * @method     ChildProfileQuery groupByDateOfBirth() Group by the date_of_birth column
 * @method     ChildProfileQuery groupByPhoneNumber() Group by the phone_number column
 * @method     ChildProfileQuery groupByMobileNumber() Group by the mobile_number column
 * @method     ChildProfileQuery groupByProfileImage() Group by the image column
 * @method     ChildProfileQuery groupByCompanyName() Group by the company_name column
 * @method     ChildProfileQuery groupByPrimaryAddressStreet() Group by the primary_address_street column
 * @method     ChildProfileQuery groupByPrimaryAddressStreet2() Group by the primary_address_street_2 column
 * @method     ChildProfileQuery groupByPrimaryAddressCity() Group by the primary_address_city column
 * @method     ChildProfileQuery groupByPrimaryAddressState() Group by the primary_address_state column
 * @method     ChildProfileQuery groupByPrimaryAddressPostCode() Group by the primary_address_post_code column
 * @method     ChildProfileQuery groupByPrimaryAddressCountry() Group by the primary_address_country column
 * @method     ChildProfileQuery groupByBillingAddressStreet() Group by the billing_address_street column
 * @method     ChildProfileQuery groupByBillingAddressCity() Group by the billing_address_city column
 * @method     ChildProfileQuery groupByBillingAddressState() Group by the billing_address_state column
 * @method     ChildProfileQuery groupByBillingAddressPostCode() Group by the billing_address_post_code column
 * @method     ChildProfileQuery groupByBillingAddressCountry() Group by the billing_address_country column
 * @method     ChildProfileQuery groupByFirstSecurityQuestion() Group by the security_question_1 column
 * @method     ChildProfileQuery groupByFirstSecurityQuestionAnswer() Group by the security_answer_1 column
 * @method     ChildProfileQuery groupBySecondSecurityQuestion() Group by the security_question_2 column
 * @method     ChildProfileQuery groupBySecondSecurityQuestionAnswer() Group by the security_answer_2 column
 * @method     ChildProfileQuery groupByCustomSecurityQuestion() Group by the security_question_custom column
 * @method     ChildProfileQuery groupByCustomSecurityAnswer() Group by the security_answer_custom column
 * @method     ChildProfileQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProfileQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProfileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProfileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProfileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProfileQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildProfileQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildProfileQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildProfile findOne(ConnectionInterface $con = null) Return the first ChildProfile matching the query
 * @method     ChildProfile findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProfile matching the query, or a new ChildProfile object populated from the query conditions when no match is found
 *
 * @method     ChildProfile findOneByID(int $id) Return the first ChildProfile filtered by the id column
 * @method     ChildProfile findOneByUUID(string $uuid) Return the first ChildProfile filtered by the uuid column
 * @method     ChildProfile findOneByUserID(int $user_id) Return the first ChildProfile filtered by the user_id column
 * @method     ChildProfile findOneByDealerID(int $dealer_id) Return the first ChildProfile filtered by the dealer_id column
 * @method     ChildProfile findOneByFirstName(string $first_name) Return the first ChildProfile filtered by the first_name column
 * @method     ChildProfile findOneByLastName(string $last_name) Return the first ChildProfile filtered by the last_name column
 * @method     ChildProfile findOneByGender(int $gender) Return the first ChildProfile filtered by the gender column
 * @method     ChildProfile findOneByDateOfBirth(string $date_of_birth) Return the first ChildProfile filtered by the date_of_birth column
 * @method     ChildProfile findOneByPhoneNumber(string $phone_number) Return the first ChildProfile filtered by the phone_number column
 * @method     ChildProfile findOneByMobileNumber(string $mobile_number) Return the first ChildProfile filtered by the mobile_number column
 * @method     ChildProfile findOneByProfileImage(string $image) Return the first ChildProfile filtered by the image column
 * @method     ChildProfile findOneByCompanyName(string $company_name) Return the first ChildProfile filtered by the company_name column
 * @method     ChildProfile findOneByPrimaryAddressStreet(string $primary_address_street) Return the first ChildProfile filtered by the primary_address_street column
 * @method     ChildProfile findOneByPrimaryAddressStreet2(string $primary_address_street_2) Return the first ChildProfile filtered by the primary_address_street_2 column
 * @method     ChildProfile findOneByPrimaryAddressCity(string $primary_address_city) Return the first ChildProfile filtered by the primary_address_city column
 * @method     ChildProfile findOneByPrimaryAddressState(string $primary_address_state) Return the first ChildProfile filtered by the primary_address_state column
 * @method     ChildProfile findOneByPrimaryAddressPostCode(string $primary_address_post_code) Return the first ChildProfile filtered by the primary_address_post_code column
 * @method     ChildProfile findOneByPrimaryAddressCountry(string $primary_address_country) Return the first ChildProfile filtered by the primary_address_country column
 * @method     ChildProfile findOneByBillingAddressStreet(string $billing_address_street) Return the first ChildProfile filtered by the billing_address_street column
 * @method     ChildProfile findOneByBillingAddressCity(string $billing_address_city) Return the first ChildProfile filtered by the billing_address_city column
 * @method     ChildProfile findOneByBillingAddressState(string $billing_address_state) Return the first ChildProfile filtered by the billing_address_state column
 * @method     ChildProfile findOneByBillingAddressPostCode(string $billing_address_post_code) Return the first ChildProfile filtered by the billing_address_post_code column
 * @method     ChildProfile findOneByBillingAddressCountry(string $billing_address_country) Return the first ChildProfile filtered by the billing_address_country column
 * @method     ChildProfile findOneByFirstSecurityQuestion(string $security_question_1) Return the first ChildProfile filtered by the security_question_1 column
 * @method     ChildProfile findOneByFirstSecurityQuestionAnswer(string $security_answer_1) Return the first ChildProfile filtered by the security_answer_1 column
 * @method     ChildProfile findOneBySecondSecurityQuestion(string $security_question_2) Return the first ChildProfile filtered by the security_question_2 column
 * @method     ChildProfile findOneBySecondSecurityQuestionAnswer(string $security_answer_2) Return the first ChildProfile filtered by the security_answer_2 column
 * @method     ChildProfile findOneByCustomSecurityQuestion(string $security_question_custom) Return the first ChildProfile filtered by the security_question_custom column
 * @method     ChildProfile findOneByCustomSecurityAnswer(string $security_answer_custom) Return the first ChildProfile filtered by the security_answer_custom column
 * @method     ChildProfile findOneByCreatedAt(string $created_at) Return the first ChildProfile filtered by the created_at column
 * @method     ChildProfile findOneByUpdatedAt(string $updated_at) Return the first ChildProfile filtered by the updated_at column
 *
 * @method     array findByID(int $id) Return ChildProfile objects filtered by the id column
 * @method     array findByUUID(string $uuid) Return ChildProfile objects filtered by the uuid column
 * @method     array findByUserID(int $user_id) Return ChildProfile objects filtered by the user_id column
 * @method     array findByDealerID(int $dealer_id) Return ChildProfile objects filtered by the dealer_id column
 * @method     array findByFirstName(string $first_name) Return ChildProfile objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return ChildProfile objects filtered by the last_name column
 * @method     array findByGender(int $gender) Return ChildProfile objects filtered by the gender column
 * @method     array findByDateOfBirth(string $date_of_birth) Return ChildProfile objects filtered by the date_of_birth column
 * @method     array findByPhoneNumber(string $phone_number) Return ChildProfile objects filtered by the phone_number column
 * @method     array findByMobileNumber(string $mobile_number) Return ChildProfile objects filtered by the mobile_number column
 * @method     array findByProfileImage(string $image) Return ChildProfile objects filtered by the image column
 * @method     array findByCompanyName(string $company_name) Return ChildProfile objects filtered by the company_name column
 * @method     array findByPrimaryAddressStreet(string $primary_address_street) Return ChildProfile objects filtered by the primary_address_street column
 * @method     array findByPrimaryAddressStreet2(string $primary_address_street_2) Return ChildProfile objects filtered by the primary_address_street_2 column
 * @method     array findByPrimaryAddressCity(string $primary_address_city) Return ChildProfile objects filtered by the primary_address_city column
 * @method     array findByPrimaryAddressState(string $primary_address_state) Return ChildProfile objects filtered by the primary_address_state column
 * @method     array findByPrimaryAddressPostCode(string $primary_address_post_code) Return ChildProfile objects filtered by the primary_address_post_code column
 * @method     array findByPrimaryAddressCountry(string $primary_address_country) Return ChildProfile objects filtered by the primary_address_country column
 * @method     array findByBillingAddressStreet(string $billing_address_street) Return ChildProfile objects filtered by the billing_address_street column
 * @method     array findByBillingAddressCity(string $billing_address_city) Return ChildProfile objects filtered by the billing_address_city column
 * @method     array findByBillingAddressState(string $billing_address_state) Return ChildProfile objects filtered by the billing_address_state column
 * @method     array findByBillingAddressPostCode(string $billing_address_post_code) Return ChildProfile objects filtered by the billing_address_post_code column
 * @method     array findByBillingAddressCountry(string $billing_address_country) Return ChildProfile objects filtered by the billing_address_country column
 * @method     array findByFirstSecurityQuestion(string $security_question_1) Return ChildProfile objects filtered by the security_question_1 column
 * @method     array findByFirstSecurityQuestionAnswer(string $security_answer_1) Return ChildProfile objects filtered by the security_answer_1 column
 * @method     array findBySecondSecurityQuestion(string $security_question_2) Return ChildProfile objects filtered by the security_question_2 column
 * @method     array findBySecondSecurityQuestionAnswer(string $security_answer_2) Return ChildProfile objects filtered by the security_answer_2 column
 * @method     array findByCustomSecurityQuestion(string $security_question_custom) Return ChildProfile objects filtered by the security_question_custom column
 * @method     array findByCustomSecurityAnswer(string $security_answer_custom) Return ChildProfile objects filtered by the security_answer_custom column
 * @method     array findByCreatedAt(string $created_at) Return ChildProfile objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildProfile objects filtered by the updated_at column
 *
 */
abstract class ProfileQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\ProfileQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quickstack', $modelName = '\\Profile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProfileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProfileQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \ProfileQuery) {
            return $criteria;
        }
        $query = new \ProfileQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProfile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProfileTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProfileTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildProfile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, UUID, USER_ID, DEALER_ID, FIRST_NAME, LAST_NAME, GENDER, DATE_OF_BIRTH, PHONE_NUMBER, MOBILE_NUMBER, IMAGE, COMPANY_NAME, PRIMARY_ADDRESS_STREET, PRIMARY_ADDRESS_STREET_2, PRIMARY_ADDRESS_CITY, PRIMARY_ADDRESS_STATE, PRIMARY_ADDRESS_POST_CODE, PRIMARY_ADDRESS_COUNTRY, BILLING_ADDRESS_STREET, BILLING_ADDRESS_CITY, BILLING_ADDRESS_STATE, BILLING_ADDRESS_POST_CODE, BILLING_ADDRESS_COUNTRY, SECURITY_QUESTION_1, SECURITY_ANSWER_1, SECURITY_QUESTION_2, SECURITY_ANSWER_2, SECURITY_QUESTION_CUSTOM, SECURITY_ANSWER_CUSTOM, CREATED_AT, UPDATED_AT FROM profile WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildProfile();
            $obj->hydrate($row);
            ProfileTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProfile|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProfileTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProfileTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterByID(1234); // WHERE id = 1234
     * $query->filterByID(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterByID(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $iD The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByID($iD = null, $comparison = null)
    {
        if (is_array($iD)) {
            $useMinMax = false;
            if (isset($iD['min'])) {
                $this->addUsingAlias(ProfileTableMap::ID, $iD['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iD['max'])) {
                $this->addUsingAlias(ProfileTableMap::ID, $iD['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::ID, $iD, $comparison);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUUID('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUUID('%fooValue%'); // WHERE uuid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uUID The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByUUID($uUID = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uUID)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uUID)) {
                $uUID = str_replace('*', '%', $uUID);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::UUID, $uUID, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserID(1234); // WHERE user_id = 1234
     * $query->filterByUserID(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserID(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByUserID($userID = null, $comparison = null)
    {
        if (is_array($userID)) {
            $useMinMax = false;
            if (isset($userID['min'])) {
                $this->addUsingAlias(ProfileTableMap::USER_ID, $userID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userID['max'])) {
                $this->addUsingAlias(ProfileTableMap::USER_ID, $userID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::USER_ID, $userID, $comparison);
    }

    /**
     * Filter the query on the dealer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDealerID(1234); // WHERE dealer_id = 1234
     * $query->filterByDealerID(array(12, 34)); // WHERE dealer_id IN (12, 34)
     * $query->filterByDealerID(array('min' => 12)); // WHERE dealer_id > 12
     * </code>
     *
     * @param     mixed $dealerID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByDealerID($dealerID = null, $comparison = null)
    {
        if (is_array($dealerID)) {
            $useMinMax = false;
            if (isset($dealerID['min'])) {
                $this->addUsingAlias(ProfileTableMap::DEALER_ID, $dealerID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dealerID['max'])) {
                $this->addUsingAlias(ProfileTableMap::DEALER_ID, $dealerID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::DEALER_ID, $dealerID, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * @param     mixed $gender The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        $valueSet = ProfileTableMap::getValueSet(ProfileTableMap::GENDER);
        if (is_scalar($gender)) {
            if (!in_array($gender, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $gender));
            }
            $gender = array_search($gender, $valueSet);
        } elseif (is_array($gender)) {
            $convertedValues = array();
            foreach ($gender as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $gender = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the date_of_birth column
     *
     * Example usage:
     * <code>
     * $query->filterByDateOfBirth('2011-03-14'); // WHERE date_of_birth = '2011-03-14'
     * $query->filterByDateOfBirth('now'); // WHERE date_of_birth = '2011-03-14'
     * $query->filterByDateOfBirth(array('max' => 'yesterday')); // WHERE date_of_birth > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateOfBirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByDateOfBirth($dateOfBirth = null, $comparison = null)
    {
        if (is_array($dateOfBirth)) {
            $useMinMax = false;
            if (isset($dateOfBirth['min'])) {
                $this->addUsingAlias(ProfileTableMap::DATE_OF_BIRTH, $dateOfBirth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateOfBirth['max'])) {
                $this->addUsingAlias(ProfileTableMap::DATE_OF_BIRTH, $dateOfBirth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::DATE_OF_BIRTH, $dateOfBirth, $comparison);
    }

    /**
     * Filter the query on the phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
     * $query->filterByPhoneNumber('%fooValue%'); // WHERE phone_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneNumber)) {
                $phoneNumber = str_replace('*', '%', $phoneNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PHONE_NUMBER, $phoneNumber, $comparison);
    }

    /**
     * Filter the query on the mobile_number column
     *
     * Example usage:
     * <code>
     * $query->filterByMobileNumber('fooValue');   // WHERE mobile_number = 'fooValue'
     * $query->filterByMobileNumber('%fooValue%'); // WHERE mobile_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mobileNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByMobileNumber($mobileNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobileNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mobileNumber)) {
                $mobileNumber = str_replace('*', '%', $mobileNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::MOBILE_NUMBER, $mobileNumber, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByProfileImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByProfileImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $profileImage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByProfileImage($profileImage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profileImage)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $profileImage)) {
                $profileImage = str_replace('*', '%', $profileImage);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::IMAGE, $profileImage, $comparison);
    }

    /**
     * Filter the query on the company_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyName('fooValue');   // WHERE company_name = 'fooValue'
     * $query->filterByCompanyName('%fooValue%'); // WHERE company_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $companyName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByCompanyName($companyName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $companyName)) {
                $companyName = str_replace('*', '%', $companyName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::COMPANY_NAME, $companyName, $comparison);
    }

    /**
     * Filter the query on the primary_address_street column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressStreet('fooValue');   // WHERE primary_address_street = 'fooValue'
     * $query->filterByPrimaryAddressStreet('%fooValue%'); // WHERE primary_address_street LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressStreet The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressStreet($primaryAddressStreet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressStreet)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressStreet)) {
                $primaryAddressStreet = str_replace('*', '%', $primaryAddressStreet);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_STREET, $primaryAddressStreet, $comparison);
    }

    /**
     * Filter the query on the primary_address_street_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressStreet2('fooValue');   // WHERE primary_address_street_2 = 'fooValue'
     * $query->filterByPrimaryAddressStreet2('%fooValue%'); // WHERE primary_address_street_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressStreet2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressStreet2($primaryAddressStreet2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressStreet2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressStreet2)) {
                $primaryAddressStreet2 = str_replace('*', '%', $primaryAddressStreet2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_STREET_2, $primaryAddressStreet2, $comparison);
    }

    /**
     * Filter the query on the primary_address_city column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressCity('fooValue');   // WHERE primary_address_city = 'fooValue'
     * $query->filterByPrimaryAddressCity('%fooValue%'); // WHERE primary_address_city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressCity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressCity($primaryAddressCity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressCity)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressCity)) {
                $primaryAddressCity = str_replace('*', '%', $primaryAddressCity);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_CITY, $primaryAddressCity, $comparison);
    }

    /**
     * Filter the query on the primary_address_state column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressState('fooValue');   // WHERE primary_address_state = 'fooValue'
     * $query->filterByPrimaryAddressState('%fooValue%'); // WHERE primary_address_state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressState The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressState($primaryAddressState = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressState)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressState)) {
                $primaryAddressState = str_replace('*', '%', $primaryAddressState);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_STATE, $primaryAddressState, $comparison);
    }

    /**
     * Filter the query on the primary_address_post_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressPostCode('fooValue');   // WHERE primary_address_post_code = 'fooValue'
     * $query->filterByPrimaryAddressPostCode('%fooValue%'); // WHERE primary_address_post_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressPostCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressPostCode($primaryAddressPostCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressPostCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressPostCode)) {
                $primaryAddressPostCode = str_replace('*', '%', $primaryAddressPostCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_POST_CODE, $primaryAddressPostCode, $comparison);
    }

    /**
     * Filter the query on the primary_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryAddressCountry('fooValue');   // WHERE primary_address_country = 'fooValue'
     * $query->filterByPrimaryAddressCountry('%fooValue%'); // WHERE primary_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $primaryAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryAddressCountry($primaryAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($primaryAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $primaryAddressCountry)) {
                $primaryAddressCountry = str_replace('*', '%', $primaryAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::PRIMARY_ADDRESS_COUNTRY, $primaryAddressCountry, $comparison);
    }

    /**
     * Filter the query on the billing_address_street column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressStreet('fooValue');   // WHERE billing_address_street = 'fooValue'
     * $query->filterByBillingAddressStreet('%fooValue%'); // WHERE billing_address_street LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingAddressStreet The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByBillingAddressStreet($billingAddressStreet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingAddressStreet)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $billingAddressStreet)) {
                $billingAddressStreet = str_replace('*', '%', $billingAddressStreet);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::BILLING_ADDRESS_STREET, $billingAddressStreet, $comparison);
    }

    /**
     * Filter the query on the billing_address_city column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressCity('fooValue');   // WHERE billing_address_city = 'fooValue'
     * $query->filterByBillingAddressCity('%fooValue%'); // WHERE billing_address_city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingAddressCity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByBillingAddressCity($billingAddressCity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingAddressCity)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $billingAddressCity)) {
                $billingAddressCity = str_replace('*', '%', $billingAddressCity);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::BILLING_ADDRESS_CITY, $billingAddressCity, $comparison);
    }

    /**
     * Filter the query on the billing_address_state column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressState('fooValue');   // WHERE billing_address_state = 'fooValue'
     * $query->filterByBillingAddressState('%fooValue%'); // WHERE billing_address_state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingAddressState The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByBillingAddressState($billingAddressState = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingAddressState)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $billingAddressState)) {
                $billingAddressState = str_replace('*', '%', $billingAddressState);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::BILLING_ADDRESS_STATE, $billingAddressState, $comparison);
    }

    /**
     * Filter the query on the billing_address_post_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressPostCode('fooValue');   // WHERE billing_address_post_code = 'fooValue'
     * $query->filterByBillingAddressPostCode('%fooValue%'); // WHERE billing_address_post_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingAddressPostCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByBillingAddressPostCode($billingAddressPostCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingAddressPostCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $billingAddressPostCode)) {
                $billingAddressPostCode = str_replace('*', '%', $billingAddressPostCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::BILLING_ADDRESS_POST_CODE, $billingAddressPostCode, $comparison);
    }

    /**
     * Filter the query on the billing_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressCountry('fooValue');   // WHERE billing_address_country = 'fooValue'
     * $query->filterByBillingAddressCountry('%fooValue%'); // WHERE billing_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByBillingAddressCountry($billingAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $billingAddressCountry)) {
                $billingAddressCountry = str_replace('*', '%', $billingAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::BILLING_ADDRESS_COUNTRY, $billingAddressCountry, $comparison);
    }

    /**
     * Filter the query on the security_question_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstSecurityQuestion('fooValue');   // WHERE security_question_1 = 'fooValue'
     * $query->filterByFirstSecurityQuestion('%fooValue%'); // WHERE security_question_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstSecurityQuestion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByFirstSecurityQuestion($firstSecurityQuestion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstSecurityQuestion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstSecurityQuestion)) {
                $firstSecurityQuestion = str_replace('*', '%', $firstSecurityQuestion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_QUESTION_1, $firstSecurityQuestion, $comparison);
    }

    /**
     * Filter the query on the security_answer_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstSecurityQuestionAnswer('fooValue');   // WHERE security_answer_1 = 'fooValue'
     * $query->filterByFirstSecurityQuestionAnswer('%fooValue%'); // WHERE security_answer_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstSecurityQuestionAnswer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByFirstSecurityQuestionAnswer($firstSecurityQuestionAnswer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstSecurityQuestionAnswer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstSecurityQuestionAnswer)) {
                $firstSecurityQuestionAnswer = str_replace('*', '%', $firstSecurityQuestionAnswer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_ANSWER_1, $firstSecurityQuestionAnswer, $comparison);
    }

    /**
     * Filter the query on the security_question_2 column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondSecurityQuestion('fooValue');   // WHERE security_question_2 = 'fooValue'
     * $query->filterBySecondSecurityQuestion('%fooValue%'); // WHERE security_question_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secondSecurityQuestion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterBySecondSecurityQuestion($secondSecurityQuestion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondSecurityQuestion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secondSecurityQuestion)) {
                $secondSecurityQuestion = str_replace('*', '%', $secondSecurityQuestion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_QUESTION_2, $secondSecurityQuestion, $comparison);
    }

    /**
     * Filter the query on the security_answer_2 column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondSecurityQuestionAnswer('fooValue');   // WHERE security_answer_2 = 'fooValue'
     * $query->filterBySecondSecurityQuestionAnswer('%fooValue%'); // WHERE security_answer_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secondSecurityQuestionAnswer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterBySecondSecurityQuestionAnswer($secondSecurityQuestionAnswer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondSecurityQuestionAnswer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secondSecurityQuestionAnswer)) {
                $secondSecurityQuestionAnswer = str_replace('*', '%', $secondSecurityQuestionAnswer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_ANSWER_2, $secondSecurityQuestionAnswer, $comparison);
    }

    /**
     * Filter the query on the security_question_custom column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomSecurityQuestion('fooValue');   // WHERE security_question_custom = 'fooValue'
     * $query->filterByCustomSecurityQuestion('%fooValue%'); // WHERE security_question_custom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customSecurityQuestion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByCustomSecurityQuestion($customSecurityQuestion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customSecurityQuestion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $customSecurityQuestion)) {
                $customSecurityQuestion = str_replace('*', '%', $customSecurityQuestion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_QUESTION_CUSTOM, $customSecurityQuestion, $comparison);
    }

    /**
     * Filter the query on the security_answer_custom column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomSecurityAnswer('fooValue');   // WHERE security_answer_custom = 'fooValue'
     * $query->filterByCustomSecurityAnswer('%fooValue%'); // WHERE security_answer_custom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customSecurityAnswer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByCustomSecurityAnswer($customSecurityAnswer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customSecurityAnswer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $customSecurityAnswer)) {
                $customSecurityAnswer = str_replace('*', '%', $customSecurityAnswer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::SECURITY_ANSWER_CUSTOM, $customSecurityAnswer, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProfileTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProfileTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProfileTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProfileTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfileTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(ProfileTableMap::USER_ID, $user->getID(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProfileTableMap::USER_ID, $user->toKeyValue('PrimaryKey', 'ID'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProfile $profile Object to remove from the list of results
     *
     * @return ChildProfileQuery The current query, for fluid interface
     */
    public function prune($profile = null)
    {
        if ($profile) {
            $this->addUsingAlias(ProfileTableMap::ID, $profile->getID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the profile table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProfileTableMap::clearInstancePool();
            ProfileTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildProfile or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildProfile object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProfileTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ProfileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProfileTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProfileTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProfileTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProfileTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProfileTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProfileTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildProfileQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProfileTableMap::CREATED_AT);
    }

} // ProfileQuery
