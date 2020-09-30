<?php

namespace ravesoft\auth\models\forms;

use ravesoft\models\User;
use Yii;
use yii\base\Model;

class SetUsernameForm extends Model
{

    /**
     * @var string
     */
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'trim'],
            ['username', 'validateUsernameUnique'],
        ];
    }

    /**
     * Check that there is no such username in the system
     */
    public function validateUsernameUnique()
    {
        if ($this->username) {
            $exists = User::findOne([
                'username' => $this->username,
            ]);

            if ($exists) {
                $this->addError('username', Yii::t('rave/auth', 'Login has been taken'));
            }
        }
    }

}