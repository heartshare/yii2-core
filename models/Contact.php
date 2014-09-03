<?php

namespace core\models;

use Yii;
use common\models\Postcode;
use yii\helpers\ArrayHelper;
use core\components\TagsBehavior;
use yii\db\Expression;
use core\models\Tag;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $title
 * @property integer $Group_id
 * @property string $username
 * @property string $type
 * @property string $password
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $last_visit_time
 * @property string $name
 * @property string $firstname
 * @property string $lastname
 * @property string $picture
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $company
 * @property string $address
 * @property integer $Postcode_id
 * @property integer $Administrator_id
 * @property integer $Contact_id
 * @property string $comments
 * @property string $internal_comments
 * @property string $break_from
 * @property string $break_to
 * @property string $dob_date
 * @property string $ignore_activity
 * @property string $sms_subscription
 * @property string $email_subscription
 * @property string $validation_key
 * @property integer $login_attempts
 * @property string $status
 * @property string $update_time
 * @property integer $update_by
 * @property string $create_time
 * @property integer $create_by
 *
 * @property Address[] $addresses
 * @property ContactCredit[] $contactCredits
 * @property Delivery[] $deliveries
 * @property Feedback[] $feedbacks
 * @property Invoice[] $invoices
 * @property Order[] $orders
 * @property Contact $administrator
 * @property Contact[] $contacts
 * @property Contact $contact
 * @property Group $group
 * @property Postcode $postcode
 */
class Contact extends \yii\db\ActiveRecord
{
    var $tags;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Group_id', 'Postcode_id', 'Administrator_id', 'Contact_id', 'login_attempts', 'update_by', 'create_by'], 'integer'],
            [['last_visit_time', 'email'], 'required'],
            [['tags', 'last_visit_time', 'break_from', 'break_to', 'dob_date', 'update_time', 'create_time'], 'safe'],
            [['comments', 'type', 'internal_comments', 'ignore_activity', 'sms_subscription', 'email_subscription', 'status'], 'string'],
            [['title', 'username', 'password', 'name', 'firstname', 'lastname', 'picture', 'email', 'phone', 'mobile', 'fax', 'company', 'address', 'validation_key'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 128],
            [['password_reset_token'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'Group_id' => 'Group ID',
            'username' => 'Username',
            'type' => 'Type',
            'password' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'last_visit_time' => 'Last Visit Time',
            'name' => 'Name',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'picture' => 'Picture',
            'email' => 'Email',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'fax' => 'Fax',
            'company' => 'Company',
            'address' => 'Address',
            'Postcode_id' => 'Postcode ID',
            'Administrator_id' => 'Administrator ID',
            'Contact_id' => 'Contact ID',
            'comments' => 'Comments',
            'internal_comments' => 'Internal Comments',
            'break_from' => 'Break From',
            'break_to' => 'Break To',
            'dob_date' => 'Dob Date',
            'ignore_activity' => 'Ignore Activity',
            'sms_subscription' => 'Sms Subscription',
            'email_subscription' => 'Email Subscription',
            'validation_key' => 'Validation Key',
            'login_attempts' => 'Login Attempts',
            'status' => 'Status',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'create_time' => 'Create Time',
            'create_by' => 'Create By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactCredits()
    {
        return $this->hasMany(ContactCredit::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrator()
    {
        return $this->hasOne(Contact::className(), ['id' => 'Administrator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['Contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'Contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'Group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostcode()
    {
        return $this->hasOne(Postcode::className(), ['id' => 'Postcode_id']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            [
                'tags' => [
                    'class' => TagsBehavior::className(),
                ]
            ],
            parent::behaviors()
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'Tag_id'])
            ->viaTable('Contact_Tag', ['Contact_id' => 'id'], function($query) {
                return $query->where('Contact_Tag.status = "active"');
            });
    }
}