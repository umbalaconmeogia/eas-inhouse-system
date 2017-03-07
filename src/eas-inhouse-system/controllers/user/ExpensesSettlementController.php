<?php

namespace app\controllers\user;
use app\models;
use Yii;
use app\models\ExpensesSettlementMonth;
use app\models\ExpensesSettlementMonthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ExpensesSettlementItem;
use app\models\ExpensesSettlementTransport;
use batsg\helpers\HDateTime;

/**
 * ExpensesSettlementController implements the CRUD actions for ExpensesSettlementMonth model.
 */
class ExpensesSettlementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ExpensesSettlementMonth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpensesSettlementMonthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExpensesSettlementMonth model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ExpensesSettlementMonth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExpensesSettlementMonth();
        $model->user_id = \Yii::$app->user->id;

        $submitted = $model->load(Yii::$app->request->post());
        if (!$submitted) {
            $model->month = HDateTime::now()->toString(HDateTime::FORMAT_DATE);
        } else {
            $this->monthToDate($model);
        }

        if ($submitted && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExpensesSettlementMonth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $expensesSettlementItem = new ExpensesSettlementItem();
        $expensesSettlementItem->load(Yii::$app->request->post());
        $expensesSettlementItem->expenses_settlement_month_id = $model->id;
        
//         transport section

        $expensesSettlementTransport = new ExpensesSettlementTransport();
        $expensesSettlementTransport->load(Yii::$app->request->post());
        $expensesSettlementTransport->expenses_settlement_month_id = $model->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'expensesSettlementMonth' => $model,
                'expensesSettlementItem' => $expensesSettlementItem,
                'expensesSettlementTransport' =>   $expensesSettlementTransport,
            ]);
        }
    }

    public function actionCreateItem()
    {
        $expensesSettlementItem = new ExpensesSettlementItem();

        if ($expensesSettlementItem->load(Yii::$app->request->post()) && $expensesSettlementItem->save()) {
            return $this->redirect(['update', 'id' => $expensesSettlementItem->expenses_settlement_month_id]);
        } else {
            return $this->render('update', [
                'expensesSettlementMonth' => $expensesSettlementItem->expensesSettlementMonth,
                'expensesSettlementItem' => $expensesSettlementItem,
            ]);
        }
    }
    
    public function actionCreateTransport()
    {
        $expensesSettlementTransport = new ExpensesSettlementTransport();
    
        if ($expensesSettlementTransport->load(Yii::$app->request->post()) && $expensesSettlementTransport->save()) {
            return $this->redirect(['update', 'id' => $expensesSettlementTransport->expenses_settlement_month_id]);
        } else {
            return $this->render('update', [
                'expensesSettlementMonth' => $expensesSettlementTransport->expensesSettlementMonth,
                'expensesSettlementTransport' => $expensesSettlementTransport,
            ]);
        }
    }

    /**
     * Deletes an existing ExpensesSettlementMonth model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExpensesSettlementMonth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExpensesSettlementMonth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExpensesSettlementMonth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Convert month to date (which day is set to 1) if it is not formed as date.
     * @param ExpensesSettlementMonth $esMonth
     */
    private function monthToDate(ExpensesSettlementMonth $esMonth)
    {
        if (substr_count($esMonth->month, '-') < 2) {
            $esMonth->month .= '-01';
        }
    }
}
