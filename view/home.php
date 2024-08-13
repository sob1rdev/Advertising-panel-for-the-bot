<?php
use ADPBot\Ads;
$ads = new Ads();
$allAds=$ads->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertising Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container my-5">
    <header class="mb-4">
        <h1 class="text-center">Advertising Panel</h1>
    </header>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Create New Advertisement</h2>
                </div>
                <div class="card-body">
                    <form id="advertising-form" method="POST" action="/text">
                        <div class="mb-3">
                            <label for="title" class="form-label">Advertisement Title:</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Advertisement Description:</label>
                            <textarea id="content" name="content" class="form-control" rows="4" maxlength="500" required></textarea>
                            <small id="charCount" class="form-text text-muted">0/500 characters used</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2>Current Advertisements</h2>
        <div id="advertisements-list" class="list-group">
            <?php if (!empty($allAds)): ?>
                <?php foreach ($allAds as $ad): ?>
                    <div class="list-group-item">
                        <h4><?php echo htmlspecialchars($ad['title']); ?></h4>
                        <p><?php echo nl2br(htmlspecialchars($ad['content'])); ?></p>
                        <small class="text-muted">Created at: <?php echo $ad['created_at']; ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No advertisements found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var contentElement = document.getElementById('content');
        var charCountElement = document.getElementById('charCount');

        contentElement.addEventListener('input', function () {
            var currentLength = contentElement.value.length;
            charCountElement.textContent = currentLength + "/500 characters used";
        });
    });
</script>

</body>
</html>

