<?php
session_start();
require_once "DB_Con.php";


function makeFacebookApiCall($endpoint, $params){
    $ch = curl_init();
    // echo $endpoint.'?'. http_build_query($params)."<br>";
    curl_setopt($ch,CURLOPT_URL,$endpoint.'?'. http_build_query($params));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    $fb_res=curl_exec($ch);
    $fb_res=json_decode($fb_res,TRUE);
    echo curl_error($ch);
    curl_close($ch);
    
    return array(
        'endpoint'=>$endpoint,
        'params'=>$params,
        'has_error'=>isset($fb_res['error'])?TRUE:FALSE,
        'res'=>$fb_res

    );

}

function getFacebookPagePostsNext($url){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    $fb_res=curl_exec($ch);
    $fb_res=json_decode($fb_res,TRUE);
    echo curl_error($ch);
    curl_close($ch);
    
    return array(
        'endpoint'=>$url,
        'params'=>$url,
        'has_error'=>isset($fb_res['error'])?TRUE:FALSE,
        'res'=>$fb_res

    );

}

function getFacebookLoginUrl(){
    $endpoint="https://www.facebook.com/". FB_GRAPH_VER . "/dialog/oauth";

    $params =array(
        'client_id'=> FB_APP_ID,
        'redirect_uri'=> FB_REDIRECT_URL,
        'state' => FB_GRAPH_STATE,
        'scope'=> 'email,pages_manage_instant_articles,pages_show_list,pages_read_engagement,pages_read_user_content,pages_manage_posts,pages_manage_engagement,pages_manage_metadata,business_management,attribution_read,pages_messaging,pages_messaging_subscriptions,read_insights',
        'auth_type'=>'rerequest'

    );
    return $endpoint.'?'. http_build_query($params);
}

function getAccessTokenWithCode($code){
    $endpoint="https://graph.facebook.com/". FB_GRAPH_VER . "/oauth/access_token";

    $params =array(
        'client_id'=> FB_APP_ID,
        'client_secret'=> FB_APP_PASS,
        'redirect_uri'=> FB_REDIRECT_URL,
        'code'=> $code
    );
    return makeFacebookApiCall($endpoint,$params);
}



function getFacebookUserInfo(){
    $endpoint="https://graph.facebook.com/me";
    $params =array(
        'fields'=> "name,first_name,last_name,email",
        'access_token'=> $_SESSION['Token']
    );
    return makeFacebookApiCall($endpoint,$params);
    
}

function getFacebookUserProfilePic($id){
    $endpoint="https://graph.facebook.com/".$id."/picture?";
    $params =array(
        'type'=> "large"
    );
    return $endpoint. http_build_query($params);
    
}

function getFacebookPageList($id){
    $endpoint="https://graph.facebook.com/".FB_GRAPH_VER."/".$id."/accounts";
    $params =array(
        'access_token'=> $_SESSION['Token']
    );
    return makeFacebookApiCall($endpoint,$params);

}

function getFacebookPagePosts($id,$token,$limit){
    $endpoint="https://graph.facebook.com/".FB_GRAPH_VER."/".$id."/feed";
    $params =array(
        'fields'=>"message,created_time,full_picture,privacy,id",
        'limit'=>$limit,
        'access_token'=> $token
    );
    return makeFacebookApiCall($endpoint,$params);
}

function getFacebookPagePostReaction($id,$token,$type){
    $endpoint="https://graph.facebook.com/".FB_GRAPH_VER."/".$id."/reactions";
    $params =array(
        'summary'=>"total_count",
        'type'=>$type,
        'access_token'=> $token
    );
    return makeFacebookApiCall($endpoint,$params);
}



?>