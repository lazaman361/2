<?php

class NewsManipulation{

    private static $upit;


    public static function addNews($authorId,$categoryId,$title,$thumbnail,$preview,$content){


        Connection::$connection->beginTransaction();

        self::$upit = Connection::$connection->prepare("
          INSERT INTO news (author_id,title,thumbnail,content_preview,content,category_id)
          VALUES (?,?,?,?,?,?);
        ");
        self::$upit->bindValue(1,$authorId);
        self::$upit->bindValue(2,$title);
        self::$upit->bindValue(3,$thumbnail);
        self::$upit->bindValue(4,$preview);
        self::$upit->bindValue(5,$content);
        self::$upit->bindValue(6,$categoryId);
        self::$upit->execute();

        self::$upit = Connection::$connection->query("
            UPDATE news
            SET md5 = md5(last_insert_id())
            WHERE news_id = last_insert_id();
        ");

        Connection::$connection->commit();
    }



    public static function removeNews($news_md5){
        self::$upit = Connection::$connection->prepare("
            DELETE FROM news
            WHERE md5 = ?
        ");
        self::$upit->bindValue(1,$news_md5);
        self::$upit->execute();
    }
}