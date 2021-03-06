<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleJadwal;

/**
 * common\models\ModuleJadwalSearch represents the model behind the search form about `common\models\ModuleJadwal`.
 */
 class ModuleJadwalSearch extends ModuleJadwal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kelas_id', 'mapel_id', 'kode_guru', 'jam_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['hari', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ModuleJadwal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kelas_id' => $this->kelas_id,
            'mapel_id' => $this->mapel_id,
            'kode_guru' => $this->kode_guru,
            'jam_id' => $this->jam_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'hari', $this->hari]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchRestore($params)
    {
        $query = ModuleJadwal::findDeleted();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kelas_id' => $this->kelas_id,
            'mapel_id' => $this->mapel_id,
            'kode_guru' => $this->kode_guru,
            'jam_id' => $this->jam_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'hari', $this->hari]);

        return $dataProvider;
    }
}
