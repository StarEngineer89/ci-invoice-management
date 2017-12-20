<?php
require_once( 'Facebook/autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


Class Facebook {
	protected $CI;

	public function __construct() {
        session_start();
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->config->load('facebook_config');
        FacebookSession::setDefaultApplication($this->CI->config->item('facebook_app_id'),$this->CI->config->item('facebook_app_secret'));
        $this->helper = new FacebookRedirectLoginHelper($this->CI->config->item('facebook_app_redirect_url'));
        
    }
    public function get_login_url(){

        
        return $this->helper->getLoginUrl(array('scope'=>'email'));
    }

    public function validate(){
        //check if the facebook token is in session /if not get a new one
        if(isset($_SESSION['fb_token'])){
            $sess= new FacebookSession($_SESSION['fb_token']);
        }else{
            try {
              $sess = $this->helper->getSessionFromRedirect();
            } catch(FacebookRequestException $ex) {
              // When Facebook returns an error
                return $ex->getMessage();
                //print_r($ex);
            } catch(\Exception $ex) {
              // When validation fails or other local issues
                return $ex->getMessage();

                print_r($ex);
            }
        }
        if (isset($sess)) {

            //store the token in session 
            $_SESSION['fb_token']=$sess->getToken();
            
          // Logged in
            $request = new FacebookRequest($sess, 'GET', '/me');
            $response = $request->execute();
            $graphObject = $response->getGraphObject(GraphUser::className());
            $data=$graphObject->asArray();
            return $data;

        }

    }






}