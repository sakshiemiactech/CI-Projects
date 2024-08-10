<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Viewer</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include custom CSS for additional styling -->
    <style>
        /* Add your custom CSS styles here */
        /* Example: .news-card { border: 1px solid #ccc; } */
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Latest News</h1>
        <div class="row">

            <?php foreach ($news as $news_item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="../img/ja0n8p78_siraj_625x300_17_September_23.webp" class="card-img-top" alt="News Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $news_item['headline']; ?></h5>
                            <p class="card-text"><?php echo $news_item['main_news']; ?></p>
                            <a href="" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
