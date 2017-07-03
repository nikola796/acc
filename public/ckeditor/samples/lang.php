<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Setting editor UI language</title>
    <script src="http://localhost/intranet_test/public/ckeditor/ckeditor.js"></script>
</head>

<body>

<textarea cols="80" id=editor1 name="editor1" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
	</textarea>

<script>
    CKEDITOR.replace( 'editor1');
</script>
</body>

</html>