<?php

namespace app\controllers\user;
use app\controllers\BaseUserController;
use app\models;
use app\models\ExpensesSettlementItem;
use app\models\ExpensesSettlementMonth;
use app\models\ExpensesSettlementMonthSearch;
use app\models\ExpensesSettlementTransport;
use batsg\helpers\HDateTime;
use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * ExpensesSettlementController implements the CRUD actions for ExpensesSettlementMonth model.
 */
class ExpensesSettlementController extends BaseUserController
{

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
        $esMonth = $this->findModel($id);

        if ($esMonth->load(Yii::$app->request->post()) && $esMonth->save()) {
            return $this->redirect(['view', 'id' => $esMonth->id]);
        } else {
            $esItem = $this->loadExpensesSettlementElement(ExpensesSettlementItem::className(), $esMonth);
            $esTransport = $this->loadExpensesSettlementElement(ExpensesSettlementTransport::className(), $esMonth);

            return $this->renderUpdate($esMonth, $esItem, $esTransport);
        }
    }

    public function actionCreateItem()
    {
        $esItem = new ExpensesSettlementItem();

        if ($esItem->load(Yii::$app->request->post()) && $esItem->save()) {
            return $this->redirect(['update', 'id' => $esItem->expenses_settlement_month_id]);
        } else {
            $esMonth = $esItem->expensesSettlementMonth;
            $esTransport = $this->loadExpensesSettlementElement(ExpensesSettlementTransport::className(), $esMonth);

            return $this->renderUpdate($esMonth, $esItem, $esTransport);
        }
    }

    public function actionCreateTransport()
    {
        $esTransport = new ExpensesSettlementTransport();

        if ($esTransport->load(Yii::$app->request->post()) && $esTransport->save()) {
            return $this->redirect(['update', 'id' => $esTransport->expenses_settlement_month_id]);
        } else {
            $esMonth = $esTransport->expensesSettlementMonth;
            $esItem = $this->loadExpensesSettlementElement(ExpensesSettlementItem::className(), $esMonth);

            return $this->renderUpdate($esMonth, $esItem, $esTransport);
        }
    }

    /**
     * @param ExpensesSettlementMonth $esMonth
     * @param ExpensesSettlementItem $esItem
     * @param ExpensesSettlementTransport $esTransport
     */
    private function renderUpdate(ExpensesSettlementMonth $esMonth,
        ExpensesSettlementItem $esItem,
        ExpensesSettlementTransport $esTransport)
    {
        return $this->render('update', [
            'expensesSettlementMonth' => $esMonth,
            'expensesSettlementItem' => $esItem,
            'expensesSettlementTransport' =>   $esTransport,
        ]);
    }

    /**
     *
     * @param string $elementClassName ExpensesSettlementItem or ExpensesSettlementTransport
     * @param ExpensesSettlementMonth $esMonth
     * @return ActiveRecord
     */
    private function loadExpensesSettlementElement($elementClassName, ExpensesSettlementMonth $esMonth)
    {
        $result = new $elementClassName;
        $result->load(Yii::$app->request->post());
        $result->expenses_settlement_month_id = $esMonth->id;

        return $result;
    }

    //     /**
    //      * @param ExpensesSettlementMonth $esMonth
    //      * @return \app\models\ExpensesSettlementItem
    //      */
    //     private function loadExpensesSettlementItem(ExpensesSettlementMonth $esMonth)
    //     {
    //         $esItem = new ExpensesSettlementItem();
    //         $esItem->load(Yii::$app->request->post());
    //         $esItem->expenses_settlement_month_id = $esMonth->id;

    //         return $esItem;
    //     }

    //     /**
    //      * @param ExpensesSettlementMonth $esMonth
    //      * @return \app\models\ExpensesSettlementTransport
    //      */
    //     private function loadExpensesSettlementTransport(ExpensesSettlementMonth $esMonth)
    //     {
    //         $esTransport = new ExpensesSettlementTransport();
    //         $esTransport->load(Yii::$app->request->post());
    //         $esTransport->expenses_settlement_month_id = $esMonth->id;

    //         return $esTransport;
    //     }

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
