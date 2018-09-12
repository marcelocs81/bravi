<?php
/**
 * Created by Marcelo
 */

$imageUrl    = $context->imageUrl ;

?>

<div class="movies-home">
    <div class="row text-center">
        <img src="<?php echo $imageUrl; ?>"/>
    </div>
    <div class="row">
        <div class="text-center">
        <form id="search-movie" onsubmit="return(false)">
            <label>
                <input class="form-control" type="text" name="movie" placeholder="Enter title movie" />
            </label>
            <button class="btn btn-default">Search</button>
        </form>
        </div>
        <div class="clear" />
        <div id="movies"></div>
    </div>
</div>
