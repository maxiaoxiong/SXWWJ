<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Item;
use app\models\Map;
use app\models\Positionview;
use yii\web\Session;

class ItemController extends Controller{
    public $layout = 'itemLayout';
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $this->checkSession();
        $sql = 'select ID,Item_NO,Item_Name,Item_Position from Item';
        $results = Item::findBySql($sql)->asArray()->all();
        $results = json_encode($results);
        $data = array();
        $data['ItemData'] = $results;
        $data['PositionData'] = $this->getAllPosition();
        return $this->render('index',$data);
    }

    public function actionPosition(){
        $request = Yii::$app->request;
        $act = $request->get('act');
        switch($act){
            case "getById":
                print_r($this->getPositionById($request->get('ItemID')));
                break;
            case "getAll":
                print_r($this->getAllPosition());
                break;
            default:
                $res = Yii::$app->response;
                $res->statusCode = '404';
        }
    }

    public function actionItem(){
        $request = Yii::$app->request;
        $act = $request->get('act');
        switch($act){
            case "GBI":
                print_r($this->getItemByItemNO($request->get('ItemID')));
                break;
            default:
                $res = Yii::$app->response;
                $res->statusCode = '404';
        }
    }

    public function getItemByItemNO($id){
        $result = Item::find()->where(['Item_NO'=>$id])->asArray()->all();
        if(count($result) != 0){
            $resData['status'] = 'success';
            $resData['data'] = $result[0];
            return json_encode($resData);
        }else{
            $result = array();
            $resData['status'] = 'failed';
            $resData['data'] = $result;
            return json_encode($resData);
        }
    }

    public function getAllPosition(){
        $result = Positionview::find()->asArray()->all();
        if(count($result) != 0){
            $resData['status'] = 'success';
            $resData['data'] = $result;
            return json_encode($resData);
        }else{
            $result = array();
            $resData['status'] = 'failed';
            $resData['data'] = $result;
            return json_encode($resData);
        }
    }

    public function getPositionById($ItemNO){
        $result = Map::find()->where(['ItemID'=>$ItemNO])->asArray()->all();
        if(count($result) != 0){
            $resData['status'] = 'success';
            $resData['data'] = $result;
            return json_encode($resData);
        }else{
            $result = array();
            $resData['status'] = 'failed';
            $resData['data'] = $result;
            return json_encode($resData);
        }
    }

    public function actionInit()
    {
        $result = Item::find()->min('ID');
        $result = Item::find()->where(['ID'=>$result])->one();
        $data['Item_NO'] = $result['Item_NO'];
        return json_encode($data);
    }

    public function checkSession()
    {
        $session = Yii::$app->session;
        if($session['username'] == ''){
            return $this->redirect('index.php?r=site/index');
        }
    }
}