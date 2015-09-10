<?php

namespace auction\controllers\site;

use auction\components\Auction;
use auction\components\helpers\DatabaseHelper;

class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {

//        dump(Auction::$app->session->count);
        dump(count($_SESSION));
        exit;

        if(Auction::$app->user->isGuest){
            Auction::warning('Guest User :: Redirecting to Login Page');
            $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('site/login'));
        }
        else {
            switch (Auction::$app->session->get('user.role')) {
                case DatabaseHelper::ADMIN :
                    Auction::info('Redirecting to Admin Module');
                    $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('admin'));
                    break;

                case DatabaseHelper::DEALER :
                    Auction::info('Redirecting to Dealer Module');
                    $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('dealer/profile'));
                    break;

                case DatabaseHelper::COMPANY_USER :
                    Auction::info('Redirecting to Company User Module');
                    $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('company/profile'));
                    break;

                case DatabaseHelper::COMPANY_ADMIN :
                    Auction::info('Redirecting to Company Admin Module');
                    $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('company/info'));
                    break;

                default :
                    $this->redirect(Auction::$app->urlManager->createAbsoluteUrl('site/login'));
                    Auction::warningLog('Logging Out due to Unknown Role Created On Server',['role' => Auction::userRole()]);
            }
        }
    }

}
