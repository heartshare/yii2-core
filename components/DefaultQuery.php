<?php

namespace core\components;

use yii\db\ActiveQuery;

class DefaultQuery extends ActiveQuery
{
    /**
     * Adds the default query
     *
     * @return \yii\db\ActiveQuery
     */
    public function active()
    {
        $this->andWhere(['status' => 'active']);
        return $this;
    }
}