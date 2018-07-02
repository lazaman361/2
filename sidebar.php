<?php
if(basename($_SERVER['PHP_SELF']) == 'sidebar.php'){
    die();
}
?>


        <div id="sidebar" class="col-md-3">
            <h2>Interesting facts:</h2><br>

            <?php
            $facts = new Sidebar();
            $facts->printFacts(2,$polje);
            ?>

        </div>
    </div> <!-- end #middle .row -->

<!--    <div class="clearfix visible-md"></div>-->