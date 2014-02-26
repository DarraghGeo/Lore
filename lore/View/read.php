<?php
    for($i = 0; $i < count($v['article']); $i++){
?> 
        <article>
<?php
            echo $v['article'][$i];
?>
        </article>
<?php
    }
    if(count($v['article']) === 0)
    {
?>
        <article>
            <p class='notice'>Nothing Found.</p>
        </article>
<?php
    } 
?>
