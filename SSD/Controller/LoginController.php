<?php
require_once "Function.php";
$_SESSION['Token'] = null;
$_SESSION['Fname'] = null;
$_SESSION['Lname'] = null;
$_SESSION['Uimg'] = null;
$_SESSION['Email'] = null;
$_SESSION['ID'] = null;
$_SESSION['Pages']=null;
$_SESSION['Name'] =null;
$_SESSION['next'] =null;
$_SESSION['previous'] =null;
$data="FaceBook Login Error";
$status="0";
if(isset($_GET['code'])){
    $TockenData=getAccessTokenWithCode($_GET['code']);

    if($TockenData['has_error']){
        $data="Error Code : ".$TockenData['res']['error']['code'];
        if(isset($TockenData['res']['error']['error_subcode'])){
            $data.=".".$TockenData['res']['error']['error_subcode'] ;
        }
            
        $data.="\n";
        $data.="Error message :".$TockenData['res']['error']['type'].",".$TockenData['res']['error']['message'];
    }else{
        $_SESSION['Token']=$TockenData['res']['access_token'];
        $fb_data=getFacebookUserInfo();
        if($fb_data['has_error']){
            $data="Error Code : ".$fb_data['res']['error']['code'];
             if(isset($fb_data['res']['error']['error_subcode'])){
                $data.=".".$fb_data['res']['error']['error_subcode'] ;
            }
            $data.="\n";
            $data.="Error message :".$fb_data['res']['error']['type'].",".$fb_data['res']['error']['message'];
        }else{
            // echo "<pre>";
            // print_r($fb_data);
            // echo "</pre>";

            $fbpage=getFacebookPageList($fb_data['res']['id']);
            // echo "<pre>";
            // print_r($fb_pic);
            // echo "</pre>";
            if($fbpage['has_error']){
                $data="Error Code : ".$fbpage['res']['error']['code'];
                $data="Error Code : ".$fb_data['res']['error']['code'];
                if(isset($fbpage['res']['error']['error_subcode'])){
                    $data.=".".$fbpage['res']['error']['error_subcode'] ;
                }
                $data.="\n";
                $data.="Error message :".$fbpage['res']['error']['type'].",".$fbpage['res']['error']['message'];
            }else{
                $fb_pic=getFacebookUserProfilePic($fb_data['res']['id']);
                $_SESSION['Fname'] = $fb_data['res']['first_name'];
                $_SESSION['Name'] = $fb_data['res']['name'];
                $_SESSION['Lname'] = $fb_data['res']['last_name'];
                $_SESSION['Uimg'] = getFacebookUserProfilePic($fb_data['res']['id']);
                $_SESSION['Email'] = $fb_data['res']['email'];
                $_SESSION['ID'] = $fb_data['res']['id'];
                $_SESSION['Pages']=$fbpage['res'];
                $data="WelCome ".$fb_data['res']['first_name'].' '.$fb_data['res']['last_name'];
                $status="1";
            }

            
        }
        
    }
}

$param=array(
    "data"=>$data,
    "status"=>$status
);
$link = "Location:../index.php?". http_build_query($param);
header($link);
