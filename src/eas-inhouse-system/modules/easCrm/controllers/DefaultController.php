<?php

namespace app\modules\easCrm\controllers;

use yii\web\Controller;
use app\models\LoginUser;
use app\modules\easCrm\models\Company;
use app\modules\easCrm\models\Division;

/**
 * Default controller for the `easCrm` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInitializeData()
    {
        \Yii::$app->db->transaction(function() {
            $this->initDbUser();
            $this->initDbCompany();
            $this->initDbDivision();
        });
        return "Done";
    }

    /**
     * Create the first user (username: admin, password: admin).
     */
    private function initDbUser()
    {
        $admin = new LoginUser(['username' => 'admin']);
        $admin->setPassword('admin');
        $admin->saveThrowError();
    }


    private function initDbCompany()
    {
        $company = new Company([
            'name' => '株式会社 EVA',
            'name_kana' => 'カ）イーヴィーエー',
            'name_short' => 'EVA',
            'tel' => '090-2007-9057',
            'email' => 'info@evolable.asia',
            'zip_code' => '182-0024',
            'address1' => '東京都調布市布田2-9-5',
            'address2' => '#201',
            'homepage' => 'http://eas.evolable.asia',
            'remarks' => '本店住所は調布市',
            'industry' => 'IT',
            'this_company' => 1,
        ]);

        $company->saveThrowError();
    }

    private function initDbDivision()
    {
        // Get EAS company info.
        $company = Company::findOne(['this_company' => 1]);
        if (!$company) {
            throw new Exception("Error finding EAS company.");
        }
        // Create JP divisions.
        (new Division([
            'company_id' => $company->id,
            'name' => 'JP',
            'tel' => '090-2007-9057',
            'email' => 'thanhtt@evolable.asia',
            'zip_code' => '105-6219',
            'address1' => '東京都港区愛宕2-5-1',
            'address2' => '愛宕グリーンヒルズMORIタワー19F',
            'remarks' => 'エボラブルアジア同オフィス',
        ]))->saveThrowError();
        // Create VN divisions.
        (new Division([
            'company_id' => $company->id,
            'name' => 'VN',
            'address1' => '9F Viet A Building, Duy Tan Street',
            'address2' => 'Cau Giay District, Ha Noi, Vietnam',
            'remarks' => 'エボラブルアジア　ハノイ　オフィス',
        ]))->saveThrowError();
    }


}
