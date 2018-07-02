<?php

class DatabaseFetch implements IDatabaseFetch {

    private $newsQueried=null;
    private $tableRowsCounted=null;


    public function printSelectedNews($whereColumn,$whereValue,$md5,$admin){

        $this->queryNews($whereColumn,$whereValue);
        if($this->newsQueried->rowCount()<1){
            echo "No results found";
            return;
        }

        $this->printNews($md5,$admin);

    }



    public function returnValueByColumn($table,$valueInColumn,$whereColumn,$whereValue){
        $konekcija = Connection::$connection->prepare("
            SELECT $valueInColumn FROM $table
            WHERE $whereColumn = ?
        ");
        $konekcija->bindValue(1,$whereValue);
        $konekcija->execute();
        $value = $konekcija->fetchObject('DatabaseFetch');
        if( @$value = $value->{$valueInColumn} ){
            return $value;
        }else{
            return false;
        }
    }



    public function returnTableNumberRows($table,$whereColumn,$whereValue){
        $this->queryTableRows($table,$whereColumn,$whereValue);
        $res = $this->tableRowsCounted->fetchObject('DatabaseFetch');
        return $res->counted;
    }






    private function queryNews($whereColumn,$whereValue){
        $this->newsQueried = Connection::$connection->query("
          SELECT 
            DATE_FORMAT(news.date_added, '%d. %b %Y') AS 'Date_added',
            authors.alias AS Alias, 
            news.title as Title, 
            news.content_preview AS NewsPreview, 
            news.content AS News, 
            news.thumbnail AS Thumbnail, 
            news.news_id AS NewsId,
            news.md5 AS MD5
          FROM news 
          LEFT JOIN authors on news.author_id=authors.author_id 
          LEFT JOIN categories ON news.category_id=categories.category_id 
          WHERE $whereColumn = '{$whereValue}'
          ORDER BY news.last_updated DESC
          LIMIT 20
        ");
    }



    private function printNews($md5,$admin){
        foreach($this->newsQueried->fetchAll(PDO::FETCH_CLASS, 'DatabaseFetch') as $objekat){

            global $sessionWhiteList;

            echo "<div class='well'>";
                echo "<b>";
                    echo "Date: " . $objekat->Date_added;
                    echo " | Author: " . $objekat->Alias;
                    echo " | Title: " . $objekat->Title;
                    if($admin == $sessionWhiteList[2]){
                        echo " <a href=\"news_delete.php?n=" . $objekat->MD5 ."\"'><button type='button' class='btn'>Delete news</button></a>";
                    }
                    if($md5 == ''){
                        echo " <a href=\"news.php?n=" . $objekat->MD5 ."\"'><button type='button' class='btn'>Read more</button></a>";
                    }
                echo "</b><br>";
                if($md5 == ''){
                    echo "<div class='newsBox'>";
                        echo "<img class='newsBox1 img-rounded' src='images/" . $objekat->Thumbnail . "'>";
                        echo "<span class='newsBox2'>" . $objekat->NewsPreview . "</span>";
                    echo "</div>";
                }else{
                    echo "<span class='newsBox3'>" . $objekat->News . "</span>";
                    echo "<br><a href=\"comments.php?n=" . $objekat->MD5 ."\"'><button type='button' class='btn'>Read comments or write one</button></a>";
                }
            echo "</div>";
        }
    }



    private function queryTableRows($table,$whereColumn,$whereValue){
        $this->tableRowsCounted = Connection::$connection->prepare("
          SELECT 
            count(*) AS counted 
          FROM $table 
          WHERE BINARY $whereColumn = ?
        ");
        $this->tableRowsCounted->bindValue(1,$whereValue);
        $this->tableRowsCounted->execute();
    }
}