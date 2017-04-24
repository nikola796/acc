<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Creating captioned images</title>
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
</head>

<body>

	<textarea cols="80" id="editor1" name="editor1" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
	</textarea>

    <script>
        CKEDITOR.replace( 'editor1', {
            extraPlugins: 'image2',
            height: 450
        } );
    </script>
</body>

</html>