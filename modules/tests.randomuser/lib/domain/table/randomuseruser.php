<?php
namespace Tests\Randomuser\Domain\Table;

use Bitrix\Main,
    Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * Class RandomuserUserTable
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> gender string(6) mandatory default 'm'
 * <li> name_title string(255) mandatory
 * <li> name_first string(255) mandatory
 * <li> name_last string(255) mandatory
 * <li> location_street string(255) mandatory
 * <li> location_city string mandatory
 * <li> location_state string(255) mandatory
 * <li> location_postcode string(255) mandatory
 * <li> email string(255) mandatory
 * <li> login_username string(255) mandatory
 * <li> login_password string(255) mandatory
 * <li> login_salt string(255) mandatory
 * <li> dob datetime mandatory default 'CURRENT_TIMESTAMP'
 * <li> registered datetime mandatory default 'CURRENT_TIMESTAMP'
 * <li> nat string(2) mandatory
 * <li> picture_large string mandatory
 * <li> picture_medium string mandatory
 * <li> picture_thumbnail string mandatory
 * </ul>
 *
 * @package Tests\Randomuser\Domain\Table
 **/

class RandomuserUserTable extends Main\Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_tests_randomuser_user';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return array(
            'id' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_ID_FIELD'),
            ),
            'gender' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateGender'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_GENDER_FIELD'),
            ),
            'name_title' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateNameTitle'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_NAME_TITLE_FIELD'),
            ),
            'name_first' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateNameFirst'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_NAME_FIRST_FIELD'),
            ),
            'name_last' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateNameLast'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_NAME_LAST_FIELD'),
            ),
            'location_street' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLocationStreet'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOCATION_STREET_FIELD'),
            ),
            'location_city' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOCATION_CITY_FIELD'),
            ),
            'location_state' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLocationState'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOCATION_STATE_FIELD'),
            ),
            'location_postcode' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLocationPostcode'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOCATION_POSTCODE_FIELD'),
            ),
            'email' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateEmail'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_EMAIL_FIELD'),
            ),
            'login_username' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLoginUsername'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOGIN_USERNAME_FIELD'),
            ),
            'login_password' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLoginPassword'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOGIN_PASSWORD_FIELD'),
            ),
            'login_salt' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateLoginSalt'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_LOGIN_SALT_FIELD'),
            ),
            'dob' => array(
                'data_type' => 'datetime',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_DOB_FIELD'),
            ),
            'registered' => array(
                'data_type' => 'datetime',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_REGISTERED_FIELD'),
            ),
            'nat' => array(
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateNat'),
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_NAT_FIELD'),
            ),
            'picture_large' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_PICTURE_LARGE_FIELD'),
            ),
            'picture_medium' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_PICTURE_MEDIUM_FIELD'),
            ),
            'picture_thumbnail' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('RANDOMUSER_USER_ENTITY_PICTURE_THUMBNAIL_FIELD'),
            ),
        );
    }
    /**
     * Returns validators for gender field.
     *
     * @return array
     */
    public static function validateGender()
    {
        return array(
            new Main\Entity\Validator\Length(null, 6),
        );
    }
    /**
     * Returns validators for name_title field.
     *
     * @return array
     */
    public static function validateNameTitle()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for name_first field.
     *
     * @return array
     */
    public static function validateNameFirst()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for name_last field.
     *
     * @return array
     */
    public static function validateNameLast()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for location_street field.
     *
     * @return array
     */
    public static function validateLocationStreet()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for location_state field.
     *
     * @return array
     */
    public static function validateLocationState()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for location_postcode field.
     *
     * @return array
     */
    public static function validateLocationPostcode()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for email field.
     *
     * @return array
     */
    public static function validateEmail()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for login_username field.
     *
     * @return array
     */
    public static function validateLoginUsername()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for login_password field.
     *
     * @return array
     */
    public static function validateLoginPassword()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for login_salt field.
     *
     * @return array
     */
    public static function validateLoginSalt()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
    /**
     * Returns validators for nat field.
     *
     * @return array
     */
    public static function validateNat()
    {
        return array(
            new Main\Entity\Validator\Length(null, 2),
        );
    }
}