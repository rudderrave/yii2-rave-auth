<?php

/**
 * @link email:rudder.rave@gmail.com
 * @copyright Copyright (c) 2019 Rave
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace yeesoft\auth;

use Yii;
use yii\base\Exception;

/**
 * Class AuthAction
 *
 * @package yeesoft\auth
 * @author Rave <rudder.rave@gmail.com>
 */
class AuthAction extends \yii\authclient\AuthAction
{

    /**
     * Runs the action.
     */
    public function run()
    {
        try {
            return parent::run();
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('error', $ex->getMessage());
            //Yii::$app->session->setFlash('error', Yii::t('yee/auth', "Authentication error occured."));

            return $this->redirectCancel();
        }
    }
}