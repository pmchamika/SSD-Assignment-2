<?php
require_once "Function.php";
 if(isset($_GET['val'])){
     $_SESSION['next'] =null;
     $_SESSION['previous'] =null;
     $pagedata=$_SESSION['Pages']['data'][$_GET['val']];
   
    $posts=getFacebookPagePosts($pagedata['id'],$pagedata['access_token'],2);
    $postlist=[];
    if($posts['has_error']){
        $data="Error Code : ".$posts['res']['error']['code'];
        if(isset($posts['res']['error']['error_subcode'])){
            $data.=".".$posts['res']['error']['error_subcode'] ;
        }
        $data.="<br>";
        $data.="Error message :".$posts['res']['error']['type'].",".$posts['res']['error']['message'];
        echo $data;
    }else{
        // echo json_encode($posts['res']);
        echo "<div width='100%' style='text-align: end;padding-bottom: 2em'><div class='btn-group' role='group' aria-label='Basic example'>";
        if(isset($posts['res']["paging"]['previous'])){
            $_SESSION['previous'] =$posts['res']["paging"]['previous'];
            echo "<button type='button' class='btn btn-secondary' onclick='nextpost(\"previous\")'><em class='fa fa-arrow-left'></em> Previous</button>";
        }
        if(isset($posts['res']["paging"]['next'])){
            $_SESSION['next'] =$posts['res']["paging"]['next'];
            
            echo "<button type='button' class='btn btn-primary' onclick='nextpost(\"next\")'>Next <em class='fa fa-arrow-right'></em></button>";
        }
        
         echo "</div></div>";
        foreach ($posts['res']['data'] as $postdata) {
            $post=array();
            $post['created_time']=date("Y-m-d H:i:s", strtotime($postdata['created_time']));
            $post['full_picture']=$postdata['full_picture'];
            $post['message']=$postdata['message'];
            $post['privacy']=$postdata['privacy']['description'];
            $post['reactions']=array();
            foreach (FB_REACTIONS as $re) {
                $react=getFacebookPagePostReaction($postdata['id'],$pagedata['access_token'],$re);
                if($react['has_error']){
                    $post['reactions'][$re]=0;
                }else{
                    $post['reactions'][$re]=$react['res']['summary']['total_count'];
                }
            }
            array_push($postlist,$post);

        }

        // echo "<pre>";
        // print_r($postlist);
        // echo "</pre>";
        $j=0;
        foreach($postlist as $post){
            $k=0;
            if($j%2==0){
                echo "<div class='row align-items-center no-gutters mb-4 mb-lg-5'>
                        <div class='col-xl-4 col-lg-5'>
                            <div class='featured-text text-center text-lg-left'>
                                <h4>".$post['message']."</h4>
                                <table style='width: 95%;'> 
                                    <tbody>
                                        <tr>
                                            <td align='left'><b>".$post['privacy']."</b></td>
                                            <td colspan='3' align='right'><b>".$post['created_time']."</b></td>
                                        </tr>";
                                        foreach($post['reactions'] as $key=>$re){
                                            if($k%2==0){
                                                echo "<tr valing='middle'>";
                                            }
                                            
                                                echo "<td style='width: 15%;' valing='middle'>
                                                    <span class='' style='font-size: xx-large'>".FB_REACTIONS_IMG[$key]."</span></td>
                                                <td style='width: 35%;'>".$key." : ".$re."</td>";
                                            if($k%2==1){
                                                echo "</tr>";
                                            }
                                            $k++;
                                        }
                                        echo "</tr>";
                                        
                                echo    "</tbody>
                                </table>
                            
                                
                            </div>
                        </div>
                        <div class='col-xl-8 col-lg-7'><img class='img-fluid mb-3 mb-lg-0' src='".$post['full_picture']."' alt='' /></div>
                        
                    </div>";
            }else{
                echo "<div class='row align-items-center no-gutters mb-4 mb-lg-5'>
                        <div class='col-xl-8 col-lg-7'><img class='img-fluid mb-3 mb-lg-0' src='".$post['full_picture']."' alt='' /></div>
                        <div class='col-xl-4 col-lg-5'>
                            <div class='featured-text text-center text-lg-left'>
                                <h4>".$post['message']."</h4>
                                <table style='width: 95%;'> 
                                    <tbody>
                                        <tr>
                                            <td align='left'><b>".$post['privacy']."</b></td>
                                            <td colspan='3' align='right'><b>".$post['created_time']."</b></td>
                                        </tr>";
                                        foreach($post['reactions'] as $key=>$re){
                                            if($k%2==0){
                                                echo "<tr valing='middle'>";
                                            }
                                            
                                                echo "<td style='width: 15%;' valing='middle'>
                                                    <span class='' style='font-size: xx-large'>".FB_REACTIONS_IMG[$key]."</span></td>
                                                <td style='width: 35%;'>".$key." : ".$re."</td>";
                                            if($k%2==1){
                                                echo "</tr>";
                                            }
                                            $k++;
                                        }
                                        echo "</tr>";
                                        
                                echo    "</tbody>
                                </table>
                            
                                
                            </div>
                        </div>
                        
                        
                    </div>";
            }
            $j++;
        }
    }

 }else{
     echo "No Post Found";
 }