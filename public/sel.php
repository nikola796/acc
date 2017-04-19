<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>this is text</p>
<p>I eat food</p>
</body>
<script>
    function getSafeRanges(dangerous) {
        var a = dangerous.commonAncestorContainer;
        // Starts -- Work inward from the start, selecting the largest safe range
        var s = new Array(0), rs = new Array(0);
        if (dangerous.startContainer != a)
            for(var i = dangerous.startContainer; i != a; i = i.parentNode)
                s.push(i)
                ;
        if (0 < s.length) for(var i = 0; i < s.length; i++) {
            var xs = document.createRange();
            if (i) {
                xs.setStartAfter(s[i-1]);
                xs.setEndAfter(s[i].lastChild);
            }
            else {
                xs.setStart(s[i], dangerous.startOffset);
                xs.setEndAfter(
                    (s[i].nodeType == Node.TEXT_NODE)
                        ? s[i] : s[i].lastChild
                );
            }
            rs.push(xs);
        }

        // Ends -- basically the same code reversed
        var e = new Array(0), re = new Array(0);
        if (dangerous.endContainer != a)
            for(var i = dangerous.endContainer; i != a; i = i.parentNode)
                e.push(i)
                ;
        if (0 < e.length) for(var i = 0; i < e.length; i++) {
            var xe = document.createRange();
            if (i) {
                xe.setStartBefore(e[i].firstChild);
                xe.setEndBefore(e[i-1]);
            }
            else {
                xe.setStartBefore(
                    (e[i].nodeType == Node.TEXT_NODE)
                        ? e[i] : e[i].firstChild
                );
                xe.setEnd(e[i], dangerous.endOffset);
            }
            re.unshift(xe);
        }

        // Middle -- the uncaptured middle
        if ((0 < s.length) && (0 < e.length)) {
            var xm = document.createRange();
            xm.setStartAfter(s[s.length - 1]);
            xm.setEndBefore(e[e.length - 1]);
        }
        else {
            return [dangerous];
        }

        // Concat
        rs.push(xm);
        response = rs.concat(re);

        // Send to Console
        return response;
    }

    function highlightSelection() {
        var userSelection = window.getSelection().getRangeAt(0);
        var safeRanges = getSafeRanges(userSelection);
        for (var i = 0; i < safeRanges.length; i++) {
            highlightRange(safeRanges[i]);
        }
    }
</script>
</html>