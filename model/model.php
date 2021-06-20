<?php
class Database {
    private $database;

    function __construct() {
        try {
            $this->database = new PDO('mysql:host=localhost;dbname=twitter', 'root', 'wacademie');
        }
        catch (PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            die;
        }
    }

    function mail_is_use($mail) {
        $sqlResponse = "SELECT mail FROM user WHERE mail = '$mail';";
        $sqlResponse = $this->database->query($sqlResponse);
        $sqlResponse = $sqlResponse->fetch();

        if ($sqlResponse['mail'] == $mail) {
            return false;
        }
        else {
            return true;
        }
    }

    function to_connect($user, $pwd){
        
        if (strpos($user, '@') !== false && strpos($user, '.' , strpos($user, '@')) !== false) {
            $sqlConnect2 = "SELECT * FROM user WHERE email = '$user';";
            $sqlConnect = $this->database->query($sqlConnect2);
            $sqlConnect = $sqlConnect->fetch();

            if ($user == $sqlConnect['email'] && $pwd == $sqlConnect['password']) {
                session_start();
                $_SESSION['user_name'] = $sqlConnect['user_name'];
                $_SESSION['id_user'] = $sqlConnect['id_user'];
                return true;
            } else {

                return false;
            } 

        } else if(preg_match('/^\d+$/', $user)) {
            $sqlConnect2 = "SELECT * FROM user WHERE phone = '$user';";
            $sqlConnect = $this->database->query($sqlConnect2);
            $sqlConnect = $sqlConnect->fetch();

            if ($user == $sqlConnect['phone'] && $pwd == $sqlConnect['password']) {
                session_start();
                $_SESSION['user_name'] = $sqlConnect['user_name'];
                $_SESSION['id_user'] = $sqlConnect['id_user'];
                
                return true;
            } else {
                return false;
            } 
        } else {
            $sqlConnect2 = "SELECT user_name, password, id_user FROM user WHERE user_name = '$user';";
            $sqlConnect = $this->database->query($sqlConnect2);
            $sqlConnect = $sqlConnect->fetch();
    
            if ($user == $sqlConnect['user_name'] && $pwd == $sqlConnect['password']) {
                session_start();
                $_SESSION['user_name'] = $sqlConnect['user_name'];
                $_SESSION['id_user'] = $sqlConnect['id_user'];
                return true;
            } else {
                return false;
            } 
        }
    }

    function get_user_info($user){

        $queryInfo = "SELECT * FROM user WHERE user_name = '$user'";
        $sqlInfo = $this->database->query($queryInfo);
        $sqlInfoFetch = $sqlInfo->fetch();

        return $sqlInfoFetch;

    }

    function find_user($user_info){

        if (strpos($user_info, '@') !== false && strpos($user_info, '.' , strpos($user_info, '@')) !== false) {
            $query = "SELECT * FROM user WHERE email = '$user_info';";
            $queryFind = $this->database->query($query);
            $queryFind = $queryFind->fetch();

            if ($queryFind['email'] == $user_info) {
                return $queryFind['user_name'];
            } else {
                return false;
            }
            
        } else if(preg_match('/^\d+$/', $user_info)) {
            $query = "SELECT * FROM user WHERE phone = '$user_info'";
            $queryFind = $this->database->query($query);
            $queryFind = $queryFind->fetch();

            if ($queryFind['phone'] == $user_info) {
                return $queryFind['user_name'];
            } else {
                return false;
            }        
        } else {
            $query = "SELECT * FROM user WHERE user_name = '$user_info'";
            $queryFind = $this->database->query($query);
            $queryFind = $queryFind->fetch();

            if ($queryFind['user_name'] == $user_info) {
                return $queryFind['user_name'];
            } else {
                return false;
            }
        }

    }

    function do_user_exists($user) {
        $sqlResponse2 = "SELECT user_name FROM user WHERE user = '$user';";
        $sqlResponse2 = $this->database->query($sqlResponse2);
        $sqlResponse2 = $sqlResponse2->fetch();

        if ($sqlResponse2['user'] == $user) {
            return false;
        }
        else {
            return true;
        }
    }
    
    function inscription_recup() {
        $sqlSelect = "SELECT email, user_name FROM user;";
        $sqlSelect = $this->database->query($sqlSelect);

        while($row = $sqlSelect->fetch()) {
            echo $row['email'] .' ';
            echo $row['user_name'] .' ';
        }
        return true;
    }


    function add_user_to_db($nickname, $pseudo, $date, $location, $mail, $tel, $pwd) {
        $sqlInsert = "INSERT INTO user(nick_name, user_name, birthday, location, email, phone, password, inscription_date, website, biography, avatar) VALUES('$nickname', '$pseudo', NOW(), '$location', '$mail', '$tel', '$pwd', NOW(), 'NULL', 'NULL', 'NULL');";
        $checkReqOk = $this->database->prepare($sqlInsert);
        $checkReqOk->execute();
        $count = $checkReqOk->rowCount();
        
        if ($count == 1) {
            return true;
        }
        else {
            return false;
        }
        
    }

    function search_user() {
        $reqSearch = 'SELECT user_name FROM user ;';
        $sqlSearch = $this->database->prepare($reqSearch);
        $sqlSearch->execute();

        while ($donnees = $sqlSearch->fetch()) {
            echo '@' . $donnees[0] . ' ';
        }

    }

    function search_hashtag() {
        $reqShowHash = "SELECT content FROM tweet WHERE content LIKE '%#%';";
        $sqlShowHash = $this->database->prepare($reqShowHash);
        $sqlShowHash->execute();

        while ($donnees = $sqlShowHash->fetch()) {
            
            echo $donnees[0];
        }
    }

    function show_user($recherche_user) {
        $reqShowUser = "SELECT * FROM user WHERE user_name LIKE '$recherche_user';";
        $sqlShowUser = $this->database->prepare($reqShowUser);
        $sqlShowUser->execute();
        while ($donnees = $sqlShowUser->fetch()) {
            
            echo "<div class='col-1'>&#8592;</div> 
                <div id='nickname_header' class='col'>" . $donnees['nick_name'] ."</div>
            </div>
            <div class='row'>
                <div id ='avatar' class='col-2'>
                    <img src=" . $donnees['avatar'] ." width='100px' height='100px' style='border-radius: 50px;'>
                </div>
                <div class='col-6'></div>
                <div class='col-4'>
                    <button type='button' class='btn btn-outline-primary' id='suivre' style='width: auto;'>Suivre</button>
                </div>
            </div>
            <div>
                <span id='nickname'>" . $donnees['nick_name'] ."</span>
                <br>
                <span id='at'>@</span><span id='username'>" . $donnees['user_name'] ."</span>
            </div>
            <div>
                <p id='biography'>" . $donnees['biography'] ."</p>
            </div>
            <div class='row'>
                <div id='location' class='col-4'><i class='fas fa-map-marker-alt'></i> " . $donnees['location'] ."</div>
                <div id='website' class='col-4'>" . $donnees['website'] ."</div>
                <div id='birthday' class='col-4'><i class='far fa-calendar-alt'></i> " . $donnees['birthday'] ."</div>
                <div id='inscription_date' class='col-4'>" . $donnees['creation_date'] ."</div>
            </div>
            <div class='row'>
                <div id='followed' class='col'>Followed</div>
                <div id='follower' class='col'>Followers</div>
                <div id='modal_followed'></div>
                <div id='modal_follower'></div>

            </div>
        </div>
        <script src='script/show.js'></script>
        <script src='script/suivre.js'></script>
        <script src='script/already_follow.js'></script>
        <script src='script/number_follow.js'></script>";
        }
        session_start();

        $_SESSION['user_name_follow'] = $donnees['nick_name'];

    }

    function show_hashtag($recherche_hashtag) {
        $reqShowHash = "SELECT content, creation_date, is_retweet, user_name, nick_name, avatar, id_tweet FROM tweet INNER JOIN user ON tweet.id_user = user.id_user WHERE content LIKE '%$recherche_hashtag%';";
        $sqlShowHash = $this->database->prepare($reqShowHash);
        $sqlShowHash->execute();

        while ($donnees = $sqlShowHash->fetch()) {
            
            echo '<div class="tweet">
            <img class="tweet_picture" width="50" height="50"
            src="'. $donnees['avatar'] .'">
             ' . $donnees['nick_name'] . ' @' . $donnees['user_name'] .
            ' <p> ' . $donnees['content'] . ' </p><p>' . $donnees['creation_date'] .
            '</p><p><i class="far fa-comment"></i>
            <i class="fas fa-retweet" id="' . $donnees['id_tweet'] . '"> ' . $donnees['is_retweet']  . ' </i>
            <i class="far fa-heart"> </i><i class="fas fa-share-square"></i></p></div>';
        }

    }

    function edit_profil($user_name, $avatar, $nick_name, $birthday, $biography, $website, $location ) {
        $req_edit = "UPDATE user SET avatar = '$avatar', nick_name = '$nick_name', birthday = '$birthday', biography = '$biography', website = '$website', location = '$location' WHERE user_name = '$user_name';";
        $sqledit_profil = $this->database->prepare($req_edit);
        $sqledit_profil->execute();
    }

    function send_tweet($tweet_content, $media, $id_user) {
        $req_send = "INSERT INTO tweet(id_user, content, media, creation_date, is_retweet, is_replied) VALUES('$id_user' , '$tweet_content', '$media', CURRENT_DATE , 0, 0);";
        $sqlsend_twt = $this->database->prepare($req_send);
        $sqlsend_twt->execute();
       
        echo "votre tweet a été publié avec succès";
    }

    function follow_user($user, $user_followed){
        $queryInfo = "SELECT * FROM user WHERE user_name = '$user'";
        $sqlInfo = $this->database->query($queryInfo);
        $sqlInfoFetch = $sqlInfo->fetch();

        $user_follow_info = "SELECT * FROM user WHERE user_name = '$user_followed'";
        $sql_user_info = $this->database->query($user_follow_info);
        $sql_user_info_fetch = $sql_user_info->fetch();

        $follow = "INSERT INTO follow (id_follower, id_user, id_tweet, date_follow) VALUES ('$sql_user_info_fetch[id_user]', '$sqlInfoFetch[id_user]', 0, CURRENT_DATE())";
        
        $userFollowed = $this->database->prepare($follow);
        $userFollowed->execute();
        
    }

    function already_followed($user, $user_followed){
        $queryInfo = "SELECT * FROM user WHERE user_name = '$user'";
        $sqlInfo = $this->database->query($queryInfo);
        $sqlInfoFetch = $sqlInfo->fetch();

        $user_follow_info = "SELECT * FROM user WHERE user_name = '$user_followed'";
        $sql_user_info = $this->database->query($user_follow_info);
        $sql_user_info_fetch = $sql_user_info->fetch();

        $already_follow = "SELECT * FROM follow WHERE id_follower = $sql_user_info_fetch[id_user] AND id_user = $sqlInfoFetch[id_user]";
        $nRows = $this->database->query($already_follow)->rowCount();

        if ($nRows >= 1) {
            echo "Success";
        } else {
            echo $nRows;
        }
    }

    function unfollowed($user, $user_followed){
        $queryInfo = "SELECT * FROM user WHERE user_name = '$user'";
        $sqlInfo = $this->database->query($queryInfo);
        $sqlInfoFetch = $sqlInfo->fetch();

        $user_follow_info = "SELECT * FROM user WHERE user_name = '$user_followed'";
        $sql_user_info = $this->database->query($user_follow_info);
        $sql_user_info_fetch = $sql_user_info->fetch();

        $follow = "DELETE FROM follow WHERE id_follower = $sql_user_info_fetch[id_user] AND id_user = $sqlInfoFetch[id_user]";
        
        $userFollowed = $this->database->prepare($follow);
        $userFollowed->execute();
        echo $follow;
    }
        
    function number_follower($query){
        return $this->database->query($query)->rowCount();
    }

    function number_followed($query){
        return $this->database->query($query)->rowCount();
    }

    function list_follower($query){
        $list = $this->database->query($query)->fetchAll();

        foreach ($list as $key => $value) {
            echo $value['user_name'];
            echo '----';
        }
    }

    function list_followed($query){
        $list = $this->database->query($query)->fetchAll();

        foreach ($list as $key => $value) {
            echo $value['user_name'];
            echo '----';
        }
    }
    
    function getID($mail) {
        $req = "SELECT id_user FROM user WHERE email = '$mail';";
        $recupID = $this->database->query($req);
        $row = $recupID->fetch();
        session_start();
        $_SESSION['id_user'] = $row['id_user'];
        return true;
    }
    
    function getIdForMsgIndex() {
        session_start();
        $_SESSION['id_receiver'] = "";
        $_SESSION['user_name'] = "";
        $req = "SELECT DISTINCT id_receiver, user_name FROM message INNER JOIN user ON message.id_receiver = user.id_user WHERE id_sender =  $_SESSION[id_user] OR id_receiver = $_SESSION[id_user];";
        $check  = $this->database->query($req);
        while($row = $check->fetch()) {
            $_SESSION['id_receiver'] .= $row['id_receiver'] . "&";
            $_SESSION['user_name'] .= $row['user_name'] . "&";
        }
        return true;
    }
    
    function getMsg($id) {
        session_start();
        $sqlResponse = "SELECT id_sender, content FROM message WHERE id_receiver = '$id' AND id_sender = $_SESSION[id_user] OR id_sender = $id AND id_receiver = $_SESSION[id_user] ORDER BY id_message ASC;";
        $sqlResponse = $this->database->query($sqlResponse);
        while($row = $sqlResponse->fetch()) {
            echo $row['id_sender'] . "//&&&&&&&&//" . $row['content'] ."//&&&&&&&&//";
        }
        return true;
    }
    
    function send_msg($id_receiver, $content, $id) {
        $rQuest = "INSERT INTO message(id_sender, id_receiver, content, date) VALUES('$id', '$id_receiver', '$content', NOW());";
        $checkMsg = $this->database->prepare($rQuest);
        $checkMsg->execute();
        $count = $checkMsg->rowCount();
        if ($count == 1) {
            return true;
        }
        else {
            return false;
        }   
    }
    function display_tweet($user_name) {
        $reqDisTweet = "SELECT content, creation_date, is_retweet, user_name, nick_name, avatar , id_tweet FROM tweet INNER JOIN user ON tweet.id_user = user.id_user WHERE user_name LIKE '$user_name' ORDER BY id_tweet DESC;";
        $sqlDisTweet = $this->database->prepare($reqDisTweet);
        $sqlDisTweet->execute();

        while ($donnees = $sqlDisTweet->fetch()) {
            
            echo '<div class="tweet">
            <img class="tweet_picture" width="50" height="50"
            src="'. $donnees['avatar'] .'">
             ' . $donnees['nick_name'] . ' @' . $donnees['user_name'] .
            ' <p> ' . $donnees['content'] . ' </p><p>' . $donnees['creation_date'] .
            '</p><p><i class="far fa-comment"></i>
            <i class="fas fa-retweet" id="' . $donnees['id_tweet'] . '"> ' . $donnees['is_retweet']  . ' </i>
            <i class="far fa-heart"> </i><i class="fas fa-share-square"></i></p></div>';
        }
    }

    function deconnect() {
        session_start();
        session_unset();
        session_destroy();
    }

    function display_actuality($id_user) {
        $reqActuality = "SELECT content, creation_date, is_retweet, user_name, nick_name, avatar , tweet.id_tweet FROM tweet INNER JOIN user ON tweet.id_user = user.id_user INNER JOIN follow on tweet.id_user = follow.id_user WHERE id_follower = '$id_user' ORDER BY id_tweet DESC ;";
        $sqlActuality = $this->database->prepare($reqActuality);
        $sqlActuality->execute(); 

        while ($donnees = $sqlActuality->fetch()) {

            echo $donnees['avatar'] . "*" . $donnees['nick_name'] . "*" . $donnees['user_name'] . "*" . $donnees['content'] . "*" . $donnees['creation_date'] . "*" . $donnees['id_tweet'] . "*" . $donnees['is_retweet'] . "*";

        }
            
    } 

    function count_retweet($id_tweet) {
    
        $reqCount = "UPDATE tweet SET is_retweet =  is_retweet + 1 WHERE id_tweet = '$id_tweet' ;";
        $sqlCount = $this->database->prepare($reqCount);
        $sqlCount->execute();

    }

    function retweet($id_tweet, $user_name, $id_user) {
        $reqRetweet = "SELECT content, user_name, nick_name, avatar , media FROM tweet INNER JOIN user ON tweet.id_user = user.id_user WHERE id_tweet LIKE '$id_tweet' ;";
        $sqlRetweet = $this->database->prepare($reqRetweet);
        $sqlRetweet->execute();

        while ($donnees = $sqlRetweet->fetch()) {

            echo '<i class="fas fa-retweet retweeté"></i> a rewteeté from @' . $donnees['user_name'] . " " . $donnees['nick_name'] .
            '<p>' . $donnees['content'] . '</p>';
        }
        
    }

    function find_tweet($id_tweet) {
        $reqFindTweet = "SELECT user_name FROM tweet INNER JOIN user ON tweet.id_user = user.id_user WHERE id_tweet LIKE '$id_tweet' ;";
        $sqlFindTweet = $this->database->prepare($reqFindTweet);
        $sqlFindTweet->execute();

        while ($donnees = $sqlFindTweet->fetch()) {

            echo "En réponse à @" . $donnees['user_name'] . " : ";

        }
    }

    function count_replied($id_tweet) {
        $reqCountRep = "UPDATE tweet SET is_replied =  is_replied + 1 WHERE id_tweet = '$id_tweet' ;";
        $sqlCountRep = $this->database->prepare($reqCountRep);
        $sqlCountRep->execute();
    }

    

}


?>