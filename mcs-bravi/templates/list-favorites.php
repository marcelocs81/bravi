<?php
/**
 * Created by Marcelo
 */

$movies = $context->movies;
?>

<?php if (!empty($movies)) : ?>
    <div class="table-responsive">
        <table id="tab-favorites" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="no-sort">Thumbnail</th>
                    <th>Movie Title</th>
                    <th>Year</th>
                    <th class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            /** @var \Mcs\Bravi\ValueObject\Movie $movie */
            foreach ($movies as $movie) : ?>
                <tr id="<?php echo $movie->getId(); ?>">
                    <td class="text-center"><img src="<?php echo $movie->getThumbnail(); ?>" class="movie-thumbnail">
                    </td>
                    <td><?php echo $movie->getTitle(); ?></td>
                    <td><?php echo $movie->getYear(); ?></td>
                    <td>
                        <a onclick="removeFavorite('<?php echo $movie->getId(); ?>')" class="btn btn-primary favorite">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3 class="text-center">No data available in favorites</h3>
<?php endif; ?>


