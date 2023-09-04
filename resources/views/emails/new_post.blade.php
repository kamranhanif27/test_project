<!DOCTYPE html>
<html>
<head>
    <title>New Post Published</title>
</head>
<body>
    <h1>New Post Published</h1>
    <p>A new post has been published on our website:</p>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->description }}</p>
    <p>Click <a href="{{ url('/posts/' . $post->id) }}">here</a> to view the post.</p>
    <p>Thank you for subscribing!</p>
</body>
</html>
