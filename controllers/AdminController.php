<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 15-9-14
 * Time: 下午5:47
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Item;
use app\models\Userview;
use app\models\Membership;
use app\models\Users;
use app\models\UsersInRoles;
use app\models\Map;
use app\models\Roles;
use yii\web\Session;
error_reporting( E_ALL&~E_NOTICE );
class AdminController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'adminLayout';

    public function actionIndex()
    {
        $this->checkSession();
        return $this->renderPartial('index');
    }

    public function actionItem()
    {
        $this->checkSession();
        $sql = 'select ID,Item_NO,Item_Name,Item_Position from Item';
        $results = Item::findBySql($sql)->asArray()->all();
        $arr = array();
        foreach ($results as $k => $v) {
            $v['Item_Edit'] = "<a href=\"#\" name=\"$v[ID]\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick='edit(this)'>编辑</a>
                                <a href=\"#\" name=\"$v[ID]\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-remove',plain:true\">删除</a>
                                ";
            $arr[$k] = $v;
        }
        $results = json_encode($arr);
        $data = array();
        $data['ItemData'] = $results;
        return $this->render('item', $data);
    }
//
//    public function actionUser()
//    {
//        $sql = 'select ID,Item_NO,Item_Name,Item_Position from Item';
//        $results = Item::findBySql($sql)->asArray()->all();
//        $arr = array();
//        foreach ($results as $k => $v) {
//            $v['Item_Edit'] = "<a href=\"#\" name=\"$v[ID]\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick='edit(this)'>编辑</a>
//                                <a href=\"#\" name=\"$v[ID]\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-remove',plain:true\">删除</a>
//                                ";
//            $arr[$k] = $v;
//        }
//        $results = json_encode($arr);
//        $data = array();
//        $data['ItemData'] = $results;
//        return $this->render('user', $data);
//    }

    public function actionEdit()
    {
        $id = $_GET['id'];
        $sql = "select * from Item where ID = " . $id;
        $results = Item::findBySql($sql)->asArray()->one();
        $results = json_encode($results);
        return $results;
    }

    public function actionUpdate()
    {
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $ID = $data['ID'];
            $post1 = Item::findOne($ID);
            $map = Map::findOne($ID);

            $map->ItemID = $data['Item_NO'];
            $map->Lng = $data['Lng'];
            $map->Lat = $data['Lat'];
            $map->Tip_info = $data['Item_Name'];

            $post1->Item_NO = $data['Item_NO'];
            $post1->Item_Name = $data['Item_Name'];
            $post1->Item_Position = $data['Item_Position'];
            $post1->Item_Info = $data['Item_Info'];
            $post1->Item_Photos = $data['Item_Photos'];
            $post1->Item_Graphy = $data['Item_Graphy'];
            $post1->Item_Other = $data['Item_Other'];
            $post1->Env_Nature = $data['Env_Nature'];
            $post1->Env_His = $data['Env_His'];
            $post1->Env_Sur = $data['Env_Sur'];
            $post1->Env_Native = $data['Env_Native'];
            $post1->Res_His = $data['Res_His'];
            $post1->Res_Achi = $data['Res_Achi'];
            $post1->Res_Protect = $data['Res_Protect'];
            $post1->Res_Exp = $data['Res_Exp'];
            $post1->save();
            $map->save();

            $data['success'] = 'success';
            $data = json_encode($data);
            return $data;
        }
    }

    public function actionAdd()
    {
        $this->checkSession();

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $post1 = new Item;
            $map = new Map;
            $map->ItemID = $data['Item_NO'];
            $map->Lng = $data['Lng'];
            $map->Lat = $data['Lat'];
            $map->Tip_info = $data['Item_Name'];
            $post1->Item_NO = $data['Item_NO'];
            $post1->Item_Name = $data['Item_Name'];
            $post1->Item_Position = $data['Item_Position'];
            $post1->Item_Info = $data['Item_Info'];
            $post1->Item_Photos = $data['Item_Photos'];
            $post1->Item_Graphy = $data['Item_Graphy'];
            $post1->Item_Other = $data['Item_Other'];
            $post1->Env_Nature = $data['Env_Nature'];
            $post1->Env_His = $data['Env_His'];
            $post1->Env_Sur = $data['Env_Sur'];
            $post1->Env_Native = $data['Env_Native'];
            $post1->Res_His = $data['Res_His'];
            $post1->Res_Achi = $data['Res_Achi'];
            $post1->Res_Protect = $data['Res_Protect'];
            $post1->Res_Exp = $data['Res_Exp'];
            $map->save();
            $results = $post1->save();
            if($results){
                $data['success'] = 'success';
                $data = json_encode($data);
                return $data;
            }else{
                $data['error'] = 'error';
                $data = json_encode($data);
                return $data;
            }
        }else{
            return $this->render('add');
        }
    }

    public function actionReg()
    {
        $this->checkSession();

        $sql = 'select UserName,Email,CreateDate,LastLoginDate,LastLockoutDate,RoleName from userview';
        $result = Userview::findBySql($sql)->asArray()->all();
        $result = json_encode($result);
        $data['userData'] = $result;
        return $this->render('reguser', $data);
    }

    public function actionRegbyid()
    {
        $request = Yii::$app->request;
        $roleid = $request->get('RoleID');
//        $sql = "select UserName,Email,CreateDate,LastLoginDate,LastLockoutDate from userview where RoleId = "+'"$roleid"';
        $result = Userview::find()->where(['RoleId' => $roleid])->asArray()->all();
//        $result = Userview::findBySql($sql)->asArray()->all();
        $result = json_encode($result);
        if (count($result) != 0) {
            $resData['status'] = 'success';
            $resData['data'] = $result;
            echo json_encode($resData);
        } else {
            $result = array();
            $resData['status'] = 'failed';
            $resData['data'] = $result;
            echo json_encode($resData);
        }
    }

    public function actionAdduser()
    {

        return $this->render('adduser');
    }

    public function actionAddnewuser()
    {

        $user = new Users();
        $mem = new Membership();
        $role = new UsersInRoles();
        $request = Yii::$app->request;
        $username = $request->post('user');

        $isExist = Users::find()->where(['UserName' => $username])->asArray()->all();
        if (count($isExist) == 0) {
            $password = md5($request->post('pass'));
            $roleId = $request->post('roleId');
            $getuuid = "select uuid() as uuid";
            $uuid = UsersInRoles::findBySql($getuuid)->asArray()->all();
            $uuid = "{" . $uuid[0]['uuid'] . "}";
            $user->UserId = $uuid;
            $user->UserName = $username;
            $mem->UserId = $user->UserId;
            $mem->Password = $password;
            $mem->Email = $request->post('email');
            $role->UserId = $user->UserId;
            $role->RoleId = $roleId;
            $user->save();
            $role->save();
            $mem->save();
            $return = array();
            $return['status'] = 'success';
            print_r(json_encode($return));
        } else {
            $return = array();
            $return['status'] = "fail";
            $return['res'] = "存在的用户名";
            $return['data'] = array();
            print_r(json_encode($return));
        }
    }

    public function actionAddquser()
    {
        $user = new Users();
        $mem = new Membership();
        $role = new UsersInRoles();
        $request = Yii::$app->request;
        $username = $request->post('username');

        $isExist = Users::find()->where(['UserName' => $username])->asArray()->all();
        if (count($isExist) == 0) {
            $password = md5($request->post('password'));
            $roleId = "{3404ED17-10BB-411A-BFC0-78BF0407C1F4}";
            $getuuid = "select uuid() as uuid";
            $uuid = UsersInRoles::findBySql($getuuid)->asArray()->all();
            $uuid = "{" . $uuid[0]['uuid'] . "}";
            $user->UserId = $uuid;
            $user->UserName = $username;
            $mem->UserId = $user->UserId;
            $mem->Password = $password;
            $mem->Email = $request->post('email');
            $role->UserId = $user->UserId;
            $role->RoleId = $roleId;
            $user->save();
            $role->save();
            $mem->save();
            $return = array();
            $return['status'] = 'success';
            print_r(json_encode($return));
        } else {
            $return = array();
            $return['status'] = "fail";
            $return['res'] = "存在的用户名";
            $return['data'] = array();
            print_r(json_encode($return));
        }
    }

    public function actionUserlogin()
    {

        $request = Yii::$app->request;
        $username = $request->post('username');
        $result = Userview::find()->where(['UserName' => $username])->asArray()->all();
//        $result = Userview::findBySql($sql)->asArray()->all();
        if ($result[0]['Password'] == md5($request->post('password'))) {
            $session = Yii::$app->session;
            $session->open();
            $session['username'] = $username;
            if($result[0]['RoleId'] == "{AAED6BBE-1DB4-4BF0-B53B-E45F235734D2}")
            {
                $resData['status'] = 'success1';
                $resData['data'] = $result;
                echo  json_encode($resData);
                return ;
            }
            $resData['status'] = 'success';
            $resData['data'] = $result;
            echo json_encode($resData);
        } else {
            $result = array();
            $resData['status'] = 'failed';
            $resData['data'] = $result;
            echo json_encode($resData);
        }
    }

    public function checkSession()
    {
        $session = Yii::$app->session;
        if($session['username'] == ''){
            return $this->redirect('index.php?r=site/index');
        }
    }


}