<?php
    require_once __DIR__ . '/vendor/autoload.php';
?>
<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    //echo $title;
    $artist = $_POST['artist'];
    //echo $artist;
    $genre = $_POST['genre'];
    //echo $genre;
    $price = $_POST['price'];
    //echo $price;
    $song = new Itp\Music\Song();
    $song->setTitle($title);
    $song->setArtistId($artist);
    $song->setGenreId($genre);
    $song->setPrice($price);
    $song->save();
    $session->getFlashBag()->add('add-success', 'The song "'. $song->getTitle() . '"with an ID of ' . $song->getId() . ' is successfully inserted!');
    header('Location: add-song.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<head>
        <title>Add Songs</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>
</head>	
<body>
    <header>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="search.php">Add Song Page</a>
                </div>
            </div>
        </div>
    </header>
<div class="container-fluid">
    <div class="mini-layout">
    <div class="mini-layout-body">
    <div class="mini-center">

        <p>&nbsp;</p>
        <?php foreach ($session->getFlashBag()->get('add-success') as $message) : ?>
            <p><?php echo $message ?></p>
        <?php endforeach; ?>

	<form method="post" action="add-song.php">
        <p>&nbsp;</p>
        <table align="center" class="table table-hover">
        <tr>
            <th align="center">
			 Title: 
            </th>
			<td><input type="text" name="title" class="form-control" id="title" value="">
            </td>
        </tr>
        <tr>
        <th align="center">
            Artist:
        </th>
        <td>
            <select name="artist" id="artist">
                <?php $AQuery = new Itp\Music\ArtistQuery();
                    $artists = $AQuery->getAll();
                    foreach($artists as $art) : ?>
                <option value="<?php echo $art->id ?>"><?php echo $art->artist_name ?></option>
                    <?php endforeach; ?>
            </select>
        </td>
        </tr>
        <tr>
        <th align="center">
            Genre:
        </th>
        <td>
            <select name="genre" id="genre">
                <?php $GQuery = new Itp\Music\GenreQuery();
                    $genres = $GQuery->getAll();
                    foreach($genres as $gen) : ?>
                <option value="<?php echo $gen->id ?>"><?php echo $gen->genre ?></option>
                    <?php endforeach; ?>
            </select>
        </td>
        </tr>
        <tr>
		<th align="center">
            Price:
        </th>
        <td>
			<input type="text" name="price" class="form-control" id="price" value="">
		</td>
        </tr>
            <tr>     
        <td text-align="center" colspan="2">
		<input type="submit" name="submit" class="btn btn-default" value="submit">
        </td>
            </tr>
	</form>
        </div>
    </div>
    </div>
</div>
</body>
</html>