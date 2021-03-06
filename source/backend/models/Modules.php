<?php

namespace backend\models;

use common\models\ModulesBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

class Modules extends ModulesBase {

    public $van_dien_tu_ba_nga_up;
    public $van_dien_tu_ba_nga_down;

    function getVan_dien_tu_ba_nga_up() {
        return $this->van_dien_tu_ba_nga_up;
    }

    function getVan_dien_tu_ba_nga_down() {
        return $this->van_dien_tu_ba_nga_down;
    }

    function setVan_dien_tu_ba_nga_down() {
        if ($this->van_dien_tu_ba_nga_up == '00') {
            $this->van_dien_tu_ba_nga_down = '11';
        } else {
            $this->van_dien_tu_ba_nga_down = '00';
        }
    }

    function setVan_dien_tu_ba_nga_up() {
        if (trim($this->moduleStatuses->van_dien_tu_ba_nga) == '00') {
            $this->van_dien_tu_ba_nga_up = '00';
            $this->van_dien_tu_ba_nga_down = '11';
        } else {
            $this->van_dien_tu_ba_nga_up = '11';
            $this->van_dien_tu_ba_nga_down = '00';
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'country_id', 'privincial_id', 'distric_id', 'customer_code'], 'required'],
            [['msisdn'], 'required', 'message' => 'No client request'],
            [['country_id', 'privincial_id', 'distric_id', 'mode_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'password'], 'string', 'max' => 255],
            [['msisdn'], 'match', 'pattern' => '((?=.*\d))', 'message' => \Yii::t('backend', 'Phone number must be number')],
            [['msisdn'], 'string', 'min' => 15, 'max' => 15],
            //[['customer_code'], 'match', 'pattern' => '((?=.*\d))', 'message' => \Yii::t('backend', 'Customer code must be number')],
            //[['customer_code'], 'string', 'min' => 6, 'max' => 6],
            [['customer_code'], 'integer', 'min' => 0, 'max' => 999999],
            [['money'], 'string', 'max' => 160],
            [['data', 'alarm'], 'string', 'max' => 50],
            [['customer_code'], 'unique']
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public static function getAll() {
        $model = \backend\models\Modules::find()->all();
        $data = [];
        foreach ($model as $item) {
            $data[$item->id] = \yii\helpers\Html::encode($item->name);
        }
        return $data;
    }

    public function getMaxCustomerCode() {
        $model = \backend\models\Modules::find()->orderBy(['created_at' => SORT_DESC])->one();
        $customerCode = bindec($model->customer_code) + 1;
        return \common\socket\Socket::alldec2bin($customerCode, 6);
    }

    public function toClient() {
        ini_set('max_execution_time', max_execution_time);
        ini_set('request_terminate_timeout', max_execution_time);
        set_time_limit(max_execution_time);
        $sim = IMSI_HEADER . \common\socket\Socket::dec2bin($this->msisdn) . ID_ASSIGNMENT_DP;
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());

        $newid = \backend\models\Imsi::find()->where(['imsi' => $this->msisdn])->one();
        if ($newid) {
            $newid->module_id = $this->id;
            $newid->module_id_assignment = ID_ASSIGNMENT_HEADER . $sim . $id;
            $newid->status = 1;
            $newid->updated_by = \Yii::$app->user->getId();
            if ($newid->save(false)) {
                return self::setupID($this->msisdn);
            }
        }
        return false;
    }

    public static function setupID($imsi, $counter = 0) {
        sleep(TIME_OUT_REFRESH);
        $newid = \backend\models\Imsi::find()->where(['imsi' => $imsi])->one();
        $status = $newid->status;

        if ($status == 3) {
            return true;
        }

        if ($counter < 4) {
            $newid->status = 1;
            $newid->save(false);
            $counter++;
            return self::setupID($imsi, $counter);
        }
        return false;
    }

    public function mode2Client() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = SYSTEM_MODE_CONFIG_HEADER;
        $data->data = SYSTEM_MODE_CONFIG_HEADER
                . $id
                . SYSTEM_MODE_HEADER
                . \common\socket\Socket::alldec2bin($this->mode->mode, 8);
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function toClientManager() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_ACCOUNT_HEADER;
        $data->data = CHECK_ACCOUNT_HEADER
                . $id
                . CHECK_MONEY_DATA_HEADER
                . '0010101000110001001100000011000100100011'//*101#
                . BACKUP . BACKUP
                . '0010101000110001001100000011001000100011'//*102#
                . BACKUP . BACKUP;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
    }

    public function toClientPay($cardCode) {
        $bkLen = 16 - strlen($cardCode);
        $binCode = "";
        $bkCode = "";
        #Dung cai nay thi phai for nua - \common\socket\Socket::dec2bin()
        for ($i = 0; $i < strlen($cardCode); $i++) {
            $binCode .= \common\socket\Socket::alldec2bin($cardCode[$i]);
        }
        if ($bkLen > 0) {
            #Dung cai nay thi phai for nua - \common\socket\Socket::dec2bin()
            for ($i = 0; $i < strlen($bkLen); $i++) {
                $bkCode .= \common\socket\Socket::alldec2bin("0");
            }
        }
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = RECHARGE_ACCOUNT_HEADER;
        $data->data = RECHARGE_ACCOUNT_HEADER
                . $id
                . CARD_CODE_HEADER
                . '0010101000110001001100000011000000101010'//*100*
                . $binCode
                . '00100011' //#
                . $bkCode;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
    }

    public function getImg() {
        if ($this->imsis->status == CONFIRM_STATUS) {
            if ($this->mode_id) {
                if ($this->checkAlarm()) {
                    return MODULE_ALARM;
                }
                return MODULE_READY;
            }
            return MODULE_SETTING;
        }
        return NO_IMAGE;
    }

    public function OperationLog() {
        $log = new \backend\models\OperationLog();
        $log->module_id = $this->id;
        $log->message = 'System Mode Configuration message, sent by user ' . \Yii::$app->user->identity->username;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

    public function configLog() {
        $log = new \backend\models\ConfigurationLog();
        $log->module_id = $this->id;
        $log->created_by = \Yii::$app->user->getId();
        $log->message = 'System mode: Mode ' . $this->mode->mode;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

    public function toSim($syntax) {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_ACCOUNT_HEADER;
        $data->data = CHECK_ACCOUNT_HEADER
                . $id
                . CHECK_MONEY_DATA_HEADER
                . '&&'
                . $syntax
                . '%%';
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
    }

    public function moduleStatus() {
        $this->checkAlarm();
        switch ($this->status) {
            case 4:
                return '<div class="module-offline">Offline</div>' . $this->moduleWarning();
                break;
            case 1:
            case CONFIRM_STATUS:
                return '<div class="module-online">Online</div>' . $this->moduleWarning();
                break;
            default :
                return 'connection error';
                break;
        }
    }

    public function moduleWarning() {
        $str = '';
        if ($this->over_tank > 3) {
            $str .= '<div class="module-offline">Tràn bể</div>';
        }
        if ($this->over_head) {
            $str .= '<div class="module-offline">Quá nhiệt</div>';
        }
        if ($this->over_pressure) {
            $str .= '<div class="module-offline">Quá áp suất</div>';
        }
        if ($this->lost_supply) {
            $str .= '<div class="module-offline">Mất điện</div>';
        }
        return $str;
    }

}
