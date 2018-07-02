<?php
interface IDatabaseFetch {

    public function printSelectedNews($whereColumn, $whereValue, $md5, $admin);
    public function returnTableNumberRows($table, $whereColumn, $whereValue);
    public function returnValueByColumn($table, $valueInColumn, $whereColumn, $whereValue);

}