<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendered Code</title>
    <style>
        {!! $project->cssContent !!}
    </style>
</head>
<body>
    <h1>HTML Content</h1>
    {!! $project->htmlContent !!}

    <div id="output"></div>

    <script>
        {!! $project->jsContent !!} 
    </script>
</body>
</html>
