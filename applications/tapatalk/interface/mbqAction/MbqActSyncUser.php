<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseActSyncUser');

Class MbqActSyncUser extends MbqBaseActSyncUser {

    public function __construct() {
        parent::__construct();
    }

    /**
     * action implement
     */
    public function actionImplement($in) {
        include_once(MBQ_3RD_LIB_PATH . 'classTTCipherEncrypt.php');

        $userIDs = explode(',', $in->userId);
        $cipher = new TT_Cipher();
        $hdomain= _domain_loadprofile();
        $sql = "select identity_id from access_domainUsers where (status=0 or status=4) and deleted = 0 and identity_id > " . $in->start . " LIMIT " . $in->limit;

        $result = $GLOBALS["DB_COM_READER"]->query($sql);
        while ($row = $result->fetch())
        {
            $userId = $row['identity_id'];
            $hidentity = _identity_load($userId);
            $haccount = _account_load($hidentity['account_id']);
            if($haccount)
            {
                $tuser = array(
                    'uid'           => $hidentity['identity_id'],
                    'username'      => $hidentity['fullname'],
                    'language'      => 'en',
                    'allow_email'   => $haccount['recieve_emails_messages'] == 1 ? false : true,
                    'encrypt_email' => base64_encode($cipher->encrypt($haccount['email'],$hdomain['mobiquo_apikey'])),
                    'reg_date'      => $hidentity['create_date'],
                    'post_num'      => $hidentity['total_posts'],
                    'last_active'   => $hidentity['last_seen'],
                    'user_type'     => MbqCM::TT_GetUserType($hidentity),
                );
                $users[] = $tuser;
            }
        }
        $this->data = array(
            'result'  => true,
            'encrypt' => true,
            'users'   => $users,
        );
    }

}
