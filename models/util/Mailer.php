<?php
/**
 * 发送邮件类
 * 调用方式统一采用实例调用
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;

class Mailer extends Model{
    private $mail;
    public function init()
    {
        parent::init();
        $config = [
            'useFileTransport' => true,
            'messageConfig'=>[
               'charset'=>'UTF-8',
               'from'=>[
                        ViewHelper::getSiteOption('smtp_username') =>
                        ViewHelper::getSiteOption('smtp_label')
                    ]
               ],
        ];
        $mailer = Yii::createObject('yii\swiftmailer\Mailer',$config);
        $mailer->setTransport([
               'class' => 'Swift_SmtpTransport',
               'host' => ViewHelper::getSiteOption('smtp_host'),  //每种邮箱的host配置不一样
               'username' => ViewHelper::getSiteOption('smtp_username'),
               'password' => ViewHelper::getSiteOption('smtp_password'),
               'port' => ViewHelper::getSiteOption('smtp_port'),
               'encryption' => 'tls',
            ]);
        $this->mail = $mailer->compose();
    }

    /**
     * send register email to user
     * @param  string $email    邮件地址
     * @param  string $username 注册用户名
     * @param  string $code     激活码
     * @return boolean           是否发送成功
     */
    public function sendRegisterMail( $email, $username, $code )
    {
        if(!$this->mail)
        {
            return;
        }
        Yii::trace('sendRegisterMail send mail');
        $this->mail->setTo( $email );
        $this->mail->setSubject( Yii::t('app','active email') );
        $this->mail->setHtmlBody(
            '<p>Hi '.$username.':</p><p>'.
            Yii::t('app','active_code').'<a href="'.
            Yii::$app->request->hostInfo.Url::to(['site/active','code'=>$code]).
            '">'.Yii::t('app','link').'</a>,'.Yii::t('app','or_copy_link').':'.Yii::$app->request->hostInfo.Url::to(['site/active','code'=>$code])
        );    //发布可以带html标签的文本
        set_time_limit(30);
        if( $this->mail->send() )
        {
            Yii::trace('sendRegisterMail send mail ok');
            return true;
        }
        else
        {
            Yii::error('sendRegisterMail send mail error');
            return false;
        }

    }
}

