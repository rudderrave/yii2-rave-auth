<?php

namespace ravesoft\auth\models\forms;

use ravesoft\models\User;
use Yii;
use yii\base\Model;

class UpdatePasswordForm extends Model
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $current_password;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $repeat_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'repeat_password'], 'required'],
            [['password', 'repeat_password', 'current_password'], 'string', 'max' => 255],
            [['password', 'repeat_password', 'current_password'], 'string', 'min' => 6],
            [['password', 'repeat_password', 'current_password'], 'trim'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
            ['current_password', 'required', 'except' => 'restoreViaEmail'],
            ['current_password', 'validateCurrentPassword', 'except' => 'restoreViaEmail'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'current_password' => Yii::t('rave/auth', 'Current password'),
            'password' => Yii::t('rave/auth', 'Password'),
            'repeat_password' => Yii::t('rave/auth', 'Repeat password'),
        ];
    }

    /**
     * Validates current password
     */
    public function validateCurrentPassword()
    {
        if (!Yii::$app->rave->checkAttempts()) {
            $this->addError('current_password', Yii::t('rave/auth', 'Too many attempts'));
            return false;
        }

        if (!Yii::$app->security->validatePassword($this->current_password, $this->user->password_hash)) {
            $this->addError('current_password', Yii::t('rave/auth', "Wrong password"));
        }
    }

    /**
     * @param bool $performValidation
     *
     * @return bool
     */
    public function updatePassword($performValidation = true)
    {
        if ($performValidation AND !$this->validate()) {
            return false;
        }

        $this->user->password = $this->password;
        $this->user->removeConfirmationToken();
        return $this->user->save();
    }
}
