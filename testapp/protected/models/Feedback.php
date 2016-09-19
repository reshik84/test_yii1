<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property int $created_at
 */
class Feedback extends CActiveRecord {

    public $verifyCode;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'feedback';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email, message', 'required'),
            array('name, email', 'length', 'max' => 255),
            array('email', 'email'),
            array('message', 'safe'),
            array('verifyCode', 'captcha'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, email, message', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->created_at = time();
            return TRUE;
        }
    }

    public function sendMessage() {
        $name = '=?UTF-8?B?' . base64_encode($this->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode('new message') . '?=';
        $headers = "From: $name <{$this->email}>\r\n" .
                "Reply-To: {$this->email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/plain; charset=UTF-8";
        mail(Yii::app()->params['adminEmail'], $subject, $this->message, $headers);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feedback the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
