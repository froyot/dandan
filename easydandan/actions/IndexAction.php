<?php


namespace easydandan\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;

class IndexAction extends Action
{
    public $isSortable;

    public $prepareDataProvider;


    /**
     * @return ActiveDataProvider
     */
    public function run()
    {

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $data = $this->prepareDataProvider();
        return $this->controller->render('index',['dataProvider'=>$data]);

    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find();
        if($this->isSortable)
        {
            $query->orderBy('order_num desc');
        }
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }


}
