<?php

namespace app\controllers;
use app\models\Usuario;
use Yii;

class UsuarioController extends \yii\web\Controller
{
    
    public function behaviors(){
        $behavios = parent::behaviors();
        $behavios["verbs"] = [
            "class" => \yii\filters\VerbFilter::class,
            "actions" => [
                "index" => ["get",],
                "create" => ["post"],
                "update" => ["put"]
            ]
            
        ];
        return $behavios;
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionCreate(){
        $params = Yii::$app->getRequest()->getBodyParams();
        $usuario = new Usuario();
        $usuario-> load($params, '');
       //  $usuario->nombre = "Andres";
       // $usuario->apellidos = "Salamanca";
       if($usuario->save()){
        return $usuario;
       }else{
           return $usuario -> errors;
       }
        
        
    }
    public function actionIndex()
    {
        $usuario = Usuario::find()->all();
        return $usuario;
    }

    public function actionUpdate($id_usuario){
        $params = Yii::$app->getRequest()->getBodyParams();
        $usuario = Usuario::findOne($id_usuario);
        $usuario-> load($params, '');
        if($usuario->save()){
            return $usuario;
        }else{
           return $usuario -> errors;
        }
    }
        public function actionDelete($id_usuario){
            $params = Yii::$app->getRequest()->getBodyParams();
            $usuario = Usuario::findOne($id_usuario);
            try {
                $usuario-> delete();
            }catch(\Exception $e){
                return $e;
            }
            
           
        
    }

}
