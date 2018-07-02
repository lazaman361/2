<?php

class CommentsManipulation{

    private $upit;



    public function addComment($newsId,$userId,$content){
        $konekcija = Connection::$connection->prepare("
            INSERT INTO comments (news_id,user_id,content)
            VALUES (?,?,?)
        ");
        $konekcija->bindValue(1,$newsId);
        $konekcija->bindValue(2,$userId);
        $konekcija->bindValue(3,$content);
        $konekcija->execute();
    }



    public function removeComment($commentId){
        $konekcija = Connection::$connection->prepare("
            DELETE FROM comments
            WHERE comment_id = ?
        ");
        $konekcija->bindValue(1,$commentId);
        $konekcija->execute();
    }



    public function exists($tableName,$tableColumn,$value,$polje){
        if( $polje->returnTableNumberRows($tableName,$tableColumn,$value) >= 1){
            return true;
        }else{
            return false;
        }
    }



    public function printComments($md5,$polje,$statusKorisnika,$username,$sessionWhiteList){

        $md5ToNewsId = $polje->returnValueByColumn('news','news_id','md5',$md5);
        $newsTitle = $polje->returnValueByColumn('news','title','md5',$md5);

        $this->queryComments($md5ToNewsId);

        if( $this->upit->rowCount() < 1 ){
            echo $message = "No comments found. Be the first one to share your opinion.";
            $this->printCommentForm('post','#');
            return;
        }

        echo "<div class='centerTitleMain'>$newsTitle</div><br>";

        if( $statusKorisnika != $sessionWhiteList[0] ){
            $this->printCommentForm('post','#');
        }

        foreach ( $this->upit->fetchAll(PDO::FETCH_CLASS, 'CommentsManipulation') as $objekat ){
            if( $objekat->User == null ){
                $user = 'ADMIN';
                echo "<div class='well adminComment'>";
            }else{
                $user = htmlspecialchars( $objekat->User,ENT_QUOTES );
                echo "<div class='well'>";
            }
            echo "$user | ";
            echo $objekat->Date;
            if( $_SESSION['status_korisnika'] == $sessionWhiteList[2]){
                echo " <a href='comments_remove.php?&n=" . $objekat->NewsId . "&u=" . $objekat->UserId . "&c=" . $objekat->CommentId . "'><button type='button' class='btn'>Delete comment</button></a>";
            }else{
                if( $_SESSION['status_korisnika'] == $sessionWhiteList[1] ){
                    if( $username == $objekat->User){
                        echo " <a href='comments_remove.php?&n=" . $objekat->NewsId . "&u=" . $objekat->UserId . "&c=" . $objekat->CommentId . "'><button type='button' class='btn'>Delete comment</button></a>";
                    }
                }
            }
            echo "<br>";
            echo htmlspecialchars($objekat->Content,ENT_QUOTES);
            echo "</div>";
        }

    }



    private function queryComments($newsId){
        $this->upit = Connection::$connection->prepare("
            SELECT 
            news.news_id AS NewsId,
            news.title AS Title,
            comments.comment_id AS CommentId,
            comments.content AS Content,
            comments.date_added AS Date,
            users.user_id AS UserId,
            users.username AS User
            FROM comments
            LEFT JOIN news ON news.news_id = comments.news_id
            LEFT JOIN users ON users.user_id = comments.user_id
            WHERE comments.news_id = ?
            ORDER BY comments.date_added DESC
        ");
        $this->upit->bindValue(1,$newsId);
        $this->upit->execute();
    }



    private function printCommentForm($method,$action){
        $form = "
            <form id='commentsForm' method=\"$method\" action=\"$action\">
                <textarea name=\"comment\" form=\"commentsForm\" rows='5' cols='40' maxlength=\"1000\"></textarea><br>
                <input type='submit' name='submit' value='Leave the comment'>
            </form>
        ";

        echo $form;
    }
}