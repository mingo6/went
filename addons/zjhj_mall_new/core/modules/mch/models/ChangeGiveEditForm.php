<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/9/1
 * Time: 15:01
 */

namespace app\modules\mch\models;

use app\models\ChargeGive;
use app\models\Store;

/**
 * @property ChangeGive $model
 * @property Store $store
 */
class ChangeGiveEditForm extends Model
{
    public $model;
    public $store;

    public $charge_num;
    public $send_num;

    public function rules()
    {
        return [
            [['charge_num', 'send_num',], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'charge_num' => '充值金额',
            'send_num' => '赠送金额',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getModelError();
        }
        $this->model->charge_num = $this->charge_num;
        $this->model->send_num = $this->send_num;
        if ($this->model->isNewRecord) {
            $this->model->store_id = $this->store->id;
            $this->model->addtime = time();
        }
        if ($this->model->save())
            return [
                'code' => 0,
                'msg' => '保存成功',
            ];
        else
            return $this->getModelError($this->model);
    }
}