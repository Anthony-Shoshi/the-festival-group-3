<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Locations Carousel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FCEBBD; /* Beige background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Stack carousel and controls vertically */
        }

        #carousel-container {
            background: #780B1E; /* Maroon background */
            color: #FCEBBD; /* Beige text */
            border: 1px solid #780B1E;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            height: 400px; /* Fixed height for consistency */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center; /* Center content horizontally and vertically */
            position: relative;
        }

        .carousel-item {
            display: flex;
            align-items: center;
            flex: 1;
            text-align: left;
            padding: 20px;
            width: 100%;
        }

        .carousel-item img {
            max-width: 300px;
            height: auto;
            border-radius: 5px;
            margin-right: 20px;
            max-height: 100%; /* Ensure image fits within the container height */
            object-fit: contain; /* Prevent distortion */
        }

        #location-description {
            flex: 1;
        }

        #location-description h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            padding: 10px;
            margin-top: 10px; /* Space between carousel and controls */
        }

        .carousel-control {
            margin: 5px;
            padding: 10px 15px;
            border: 2px solid #780B1E; /* Maroon border */
            border-radius: 50%;
            background: #FCEBBD; /* Beige background */
            color: #780B1E; /* Maroon text */
            cursor: pointer;
            font-size: 16px;
            width: 40px; /* Fixed size for circle buttons */
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, color 0.3s;
        }

        .carousel-control:hover {
            background: #780B1E; /* Maroon background on hover */
            color: #FCEBBD; /* Beige text on hover */
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + .carousel-item {
            display: flex;
        }

        /* Hide non-active items */
        .carousel-item {
            display: none;
        }
    </style>
</head>
<body>
<div id="carousel-container">
    <?php foreach ($locations as $index => $location): ?>
        <input type="radio" name="carousel" id="location-<?= $index; ?>" <?php if ($index === 0) echo 'checked'; ?>>
        <div class="carousel-item">
            <img src="<?='/images/' . $location['images']?>" alt="<?= $location['location_name']; ?>">
            <div id="location-description">
                <h2><?= $location['location_name']; ?></h2>
                <p><?= $location['description']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="carousel-controls">
    <?php foreach ($locations as $index => $location): ?>
        <label class="carousel-control" for="location-<?php echo $index; ?>"><?php echo chr(65 + $index); ?></label>
    <?php endforeach; ?>
</div>
</body>
</html>
