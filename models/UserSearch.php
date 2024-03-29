<?php

namespace kuainiu\rbac\extension\models;

use mdm\admin\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    /**
     * @param $params
     * @param $userIds
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $userIds)
    {
        $username = $params['username'] ?? null;

        if (empty($userIds) || !is_array($userIds)) {
            $userIds = '-1';
        }

        $query = User::find()
            ->andWhere(['id' => $userIds]);

        $query->andFilterWhere([
            'or',
            ['like', 'username', $username],
            ['like', 'fullname', $username],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}