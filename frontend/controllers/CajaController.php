<?php

namespace frontend\controllers;

use frontend\models\Caja;
use frontend\models\Categoria;
use frontend\models\MedioPago;
use frontend\models\CajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * CajaController implements the CRUD actions for Caja model.
 */
class CajaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Caja models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CajaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Caja model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Caja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Caja();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $model->fecha = date('Y-m-d H:i:s');

        $model->tipo_movimiento = Yii::$app->request->get('dato');
        $categorias = Categoria::listaTipos();
        $medios = MedioPago::listaMedios();
        // var_dump($categorias); die();
        //var_dump(Yii::$app->request->get('dato')); die();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => $categorias,
            'medios' => $medios
        ]);
    }

    /**
     * Updates an existing Caja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $categorias = Categoria::listaTipos();
        $medios = MedioPago::listaMedios();

        return $this->render('update', [
            'model' => $model,
            'categorias' => $categorias,
            'medios' => $medios
        ]);
    }

    /**
     * Deletes an existing Caja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Caja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Caja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Caja::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionResumen()
{
    $request = Yii::$app->request;
    $medioPago = $request->get('medio_pago', null);
    // var_dump($medioPago); die();

    $query = \frontend\models\Caja::find();

    if ($medioPago !== null) {
        $query->andWhere(['medio_pago' => $medioPago]);
    }

    $hoy = date('Y-m-d');
    $mes = date('Y-m');
    $anio = date('Y');

    $inicioMes = date('Y-m-01');
$finMes = date('Y-m-t');

$inicioAnio = date('Y-01-01');
$finAnio = date('Y-12-31');


  // var_dump($hoy , $mes, $anio); die();
    // Totales generales
    $ingresosTotales = (clone $query)->andWhere(['tipo_movimiento' => '0'])->sum('monto');
    $egresosTotales = (clone $query)->andWhere(['tipo_movimiento' => '1'])->sum('monto');
    // Año
    $ingresosAnio = (clone $query)->andWhere(['tipo_movimiento' => '0'])
        ->andWhere(['between', 'fecha', $inicioAnio, $finAnio])->sum('monto');
    $egresosAnio = (clone $query)->andWhere(['tipo_movimiento' => '1'])
        ->andWhere(['between', 'fecha', $inicioAnio, $finAnio])->sum('monto');

    // Mes
    $ingresosMes = (clone $query)->andWhere(['tipo_movimiento' => '0'])
        ->andWhere(['between', 'fecha', $inicioMes, $finMes])->sum('monto');
    $egresosMes = (clone $query)->andWhere(['tipo_movimiento' => '1'])
        ->andWhere(['between', 'fecha', $inicioMes, $finMes])->sum('monto');

    
    // Día
    $ingresosDia = (clone $query)->andWhere(['tipo_movimiento' => '0'])
        ->andWhere(['like', 'fecha', $hoy])->sum('monto');
    $egresosDia = (clone $query)->andWhere(['tipo_movimiento' => '1'])
        ->andWhere(['like', 'fecha', $hoy])->sum('monto');



        // var_dump($ingresosDia);die();

    return $this->render('resumen', [
        'ingresosTotales' => $ingresosTotales,
        'egresosTotales' => $egresosTotales,
        'ingresosDia' => $ingresosDia,
        'egresosDia' => $egresosDia,
        'ingresosMes' => $ingresosMes,
        'egresosMes' => $egresosMes,
        'ingresosAnio' => $ingresosAnio,
        'egresosAnio' => $egresosAnio,
        'medioPago' => $medioPago,
    ]);
}

}
