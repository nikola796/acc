<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>





<div class="panel" id="postingbox">
    <div class="inner"><span class="corners-top"><span></span></span>

        <h3>Публикувай нова тема</h3>

        <script type="text/javascript">
            // <![CDATA[
            onload_functions.push('apply_onkeypress_event()');
            // ]]>
        </script>

        <fieldset class="fields1">

            <dl style="clear: left;">
                <dt><label for="subject">Заглавие:</label></dt>
                <dd><input name="subject" id="subject" size="45" maxlength="60" tabindex="2" value="" class="inputbox autowidth" type="text"></dd>
            </dl>
            <script type="text/javascript">
                // <![CDATA[
                var form_name = 'postform';
                var text_name = 'message';
                var load_draft = false;
                var upload = false;

                // Define the bbCode tags
                var bbcode = new Array();
                var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]');
                var imageTag = false;

                // Helpline messages
                var help_line = {
                    b: 'Удебелен текст: [b]текст[/b]  (alt+b)',
                    i: 'Наклонен текст: [i]text[/i]  (alt+i)',
                    u: 'Подчертан текст: [u]текст[/u]  (alt+u)',
                    q: 'Цитиран текст: [quote]текст[/quote]  (alt+q)',
                    c: 'Еднотипен текст: [code]код[/code]  (alt+c)',
                    l: 'Създай списък: [list]текст[/list]  (alt+l)',
                    o: 'Подреден списък: [list=]текст[/list]  (alt+o)',
                    p: 'Добави изображение: [img]http://image_url[/img]  (alt+p)',
                    w: 'Добави URL адрес: [url]http://url[/url] или [url=http://url]URL текст[/url]  (alt+w)',
                    a: 'Качен файл: [attachment=]filename.ext[/attachment]',
                    s: 'Цвят на текста: [color=red]текст[/color]  Съвет: можеш да използваш и =#FF0000',
                    f: 'Размер на шрифта: [size=85]малък[/size]',
                    y: 'Създай списък: добави елементи',
                    d: 'Флаш елемент: [flash=ширина,височина]http://url[/flash]  (alt+d)'

                }

                var panels = new Array('options-panel', 'attach-panel', 'poll-panel');
                var show_panel = 'options-panel';


                // ]]>
            </script>
            <script type="text/javascript" src="./styles/prosilver/template/editor.js"></script>


            <div id="colour_palette" style="display: none;">
                <dl style="clear: left;">
                    <dt><label>Цвят на шрифта:</label></dt>
                    <dd>
                        <script type="text/javascript">
                            // <![CDATA[
                            function change_palette()
                            {
                                dE('colour_palette');
                                e = document.getElementById('colour_palette');

                                if (e.style.display == 'block')
                                {
                                    document.getElementById('bbpalette').value = 'Скрий цвета на текста';
                                }
                                else
                                {
                                    document.getElementById('bbpalette').value = 'Цвят на шрифта';
                                }
                            }

                            colorPalette('h', 15, 10);
                            // ]]>
                        </script><table border="0" cellpadding="0" cellspacing="1">
                            <tbody><tr>
                                <td style="width: 15px; height: 10px;" bgcolor="#000000"><a href="#" onclick="bbfontstyle('[color=#000000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#000000" title="#000000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#000040"><a href="#" onclick="bbfontstyle('[color=#000040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#000040" title="#000040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#000080"><a href="#" onclick="bbfontstyle('[color=#000080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#000080" title="#000080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0000BF"><a href="#" onclick="bbfontstyle('[color=#0000BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0000BF" title="#0000BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0000FF"><a href="#" onclick="bbfontstyle('[color=#0000FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0000FF" title="#0000FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#004000"><a href="#" onclick="bbfontstyle('[color=#004000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#004000" title="#004000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#004040"><a href="#" onclick="bbfontstyle('[color=#004040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#004040" title="#004040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#004080"><a href="#" onclick="bbfontstyle('[color=#004080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#004080" title="#004080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0040BF"><a href="#" onclick="bbfontstyle('[color=#0040BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0040BF" title="#0040BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0040FF"><a href="#" onclick="bbfontstyle('[color=#0040FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0040FF" title="#0040FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#008000"><a href="#" onclick="bbfontstyle('[color=#008000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#008000" title="#008000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#008040"><a href="#" onclick="bbfontstyle('[color=#008040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#008040" title="#008040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#008080"><a href="#" onclick="bbfontstyle('[color=#008080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#008080" title="#008080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0080BF"><a href="#" onclick="bbfontstyle('[color=#0080BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0080BF" title="#0080BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#0080FF"><a href="#" onclick="bbfontstyle('[color=#0080FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#0080FF" title="#0080FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00BF00"><a href="#" onclick="bbfontstyle('[color=#00BF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00BF00" title="#00BF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00BF40"><a href="#" onclick="bbfontstyle('[color=#00BF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00BF40" title="#00BF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00BF80"><a href="#" onclick="bbfontstyle('[color=#00BF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00BF80" title="#00BF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00BFBF"><a href="#" onclick="bbfontstyle('[color=#00BFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00BFBF" title="#00BFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00BFFF"><a href="#" onclick="bbfontstyle('[color=#00BFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00BFFF" title="#00BFFF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00FF00"><a href="#" onclick="bbfontstyle('[color=#00FF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00FF00" title="#00FF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00FF40"><a href="#" onclick="bbfontstyle('[color=#00FF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00FF40" title="#00FF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00FF80"><a href="#" onclick="bbfontstyle('[color=#00FF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00FF80" title="#00FF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00FFBF"><a href="#" onclick="bbfontstyle('[color=#00FFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00FFBF" title="#00FFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#00FFFF"><a href="#" onclick="bbfontstyle('[color=#00FFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#00FFFF" title="#00FFFF" height="10" width="15"></a></td>
                            </tr>
                            <tr>
                                <td style="width: 15px; height: 10px;" bgcolor="#400000"><a href="#" onclick="bbfontstyle('[color=#400000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#400000" title="#400000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#400040"><a href="#" onclick="bbfontstyle('[color=#400040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#400040" title="#400040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#400080"><a href="#" onclick="bbfontstyle('[color=#400080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#400080" title="#400080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4000BF"><a href="#" onclick="bbfontstyle('[color=#4000BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4000BF" title="#4000BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4000FF"><a href="#" onclick="bbfontstyle('[color=#4000FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4000FF" title="#4000FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#404000"><a href="#" onclick="bbfontstyle('[color=#404000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#404000" title="#404000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#404040"><a href="#" onclick="bbfontstyle('[color=#404040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#404040" title="#404040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#404080"><a href="#" onclick="bbfontstyle('[color=#404080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#404080" title="#404080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4040BF"><a href="#" onclick="bbfontstyle('[color=#4040BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4040BF" title="#4040BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4040FF"><a href="#" onclick="bbfontstyle('[color=#4040FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4040FF" title="#4040FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#408000"><a href="#" onclick="bbfontstyle('[color=#408000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#408000" title="#408000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#408040"><a href="#" onclick="bbfontstyle('[color=#408040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#408040" title="#408040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#408080"><a href="#" onclick="bbfontstyle('[color=#408080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#408080" title="#408080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4080BF"><a href="#" onclick="bbfontstyle('[color=#4080BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4080BF" title="#4080BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#4080FF"><a href="#" onclick="bbfontstyle('[color=#4080FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#4080FF" title="#4080FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40BF00"><a href="#" onclick="bbfontstyle('[color=#40BF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40BF00" title="#40BF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40BF40"><a href="#" onclick="bbfontstyle('[color=#40BF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40BF40" title="#40BF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40BF80"><a href="#" onclick="bbfontstyle('[color=#40BF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40BF80" title="#40BF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40BFBF"><a href="#" onclick="bbfontstyle('[color=#40BFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40BFBF" title="#40BFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40BFFF"><a href="#" onclick="bbfontstyle('[color=#40BFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40BFFF" title="#40BFFF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40FF00"><a href="#" onclick="bbfontstyle('[color=#40FF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40FF00" title="#40FF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40FF40"><a href="#" onclick="bbfontstyle('[color=#40FF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40FF40" title="#40FF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40FF80"><a href="#" onclick="bbfontstyle('[color=#40FF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40FF80" title="#40FF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40FFBF"><a href="#" onclick="bbfontstyle('[color=#40FFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40FFBF" title="#40FFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#40FFFF"><a href="#" onclick="bbfontstyle('[color=#40FFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#40FFFF" title="#40FFFF" height="10" width="15"></a></td>
                            </tr>
                            <tr>
                                <td style="width: 15px; height: 10px;" bgcolor="#800000"><a href="#" onclick="bbfontstyle('[color=#800000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#800000" title="#800000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#800040"><a href="#" onclick="bbfontstyle('[color=#800040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#800040" title="#800040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#800080"><a href="#" onclick="bbfontstyle('[color=#800080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#800080" title="#800080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8000BF"><a href="#" onclick="bbfontstyle('[color=#8000BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8000BF" title="#8000BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8000FF"><a href="#" onclick="bbfontstyle('[color=#8000FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8000FF" title="#8000FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#804000"><a href="#" onclick="bbfontstyle('[color=#804000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#804000" title="#804000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#804040"><a href="#" onclick="bbfontstyle('[color=#804040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#804040" title="#804040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#804080"><a href="#" onclick="bbfontstyle('[color=#804080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#804080" title="#804080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8040BF"><a href="#" onclick="bbfontstyle('[color=#8040BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8040BF" title="#8040BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8040FF"><a href="#" onclick="bbfontstyle('[color=#8040FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8040FF" title="#8040FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#808000"><a href="#" onclick="bbfontstyle('[color=#808000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#808000" title="#808000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#808040"><a href="#" onclick="bbfontstyle('[color=#808040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#808040" title="#808040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#808080"><a href="#" onclick="bbfontstyle('[color=#808080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#808080" title="#808080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8080BF"><a href="#" onclick="bbfontstyle('[color=#8080BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8080BF" title="#8080BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#8080FF"><a href="#" onclick="bbfontstyle('[color=#8080FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#8080FF" title="#8080FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80BF00"><a href="#" onclick="bbfontstyle('[color=#80BF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80BF00" title="#80BF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80BF40"><a href="#" onclick="bbfontstyle('[color=#80BF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80BF40" title="#80BF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80BF80"><a href="#" onclick="bbfontstyle('[color=#80BF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80BF80" title="#80BF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80BFBF"><a href="#" onclick="bbfontstyle('[color=#80BFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80BFBF" title="#80BFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80BFFF"><a href="#" onclick="bbfontstyle('[color=#80BFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80BFFF" title="#80BFFF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80FF00"><a href="#" onclick="bbfontstyle('[color=#80FF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80FF00" title="#80FF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80FF40"><a href="#" onclick="bbfontstyle('[color=#80FF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80FF40" title="#80FF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80FF80"><a href="#" onclick="bbfontstyle('[color=#80FF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80FF80" title="#80FF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80FFBF"><a href="#" onclick="bbfontstyle('[color=#80FFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80FFBF" title="#80FFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#80FFFF"><a href="#" onclick="bbfontstyle('[color=#80FFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#80FFFF" title="#80FFFF" height="10" width="15"></a></td>
                            </tr>
                            <tr>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF0000"><a href="#" onclick="bbfontstyle('[color=#BF0000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF0000" title="#BF0000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF0040"><a href="#" onclick="bbfontstyle('[color=#BF0040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF0040" title="#BF0040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF0080"><a href="#" onclick="bbfontstyle('[color=#BF0080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF0080" title="#BF0080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF00BF"><a href="#" onclick="bbfontstyle('[color=#BF00BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF00BF" title="#BF00BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF00FF"><a href="#" onclick="bbfontstyle('[color=#BF00FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF00FF" title="#BF00FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF4000"><a href="#" onclick="bbfontstyle('[color=#BF4000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF4000" title="#BF4000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF4040"><a href="#" onclick="bbfontstyle('[color=#BF4040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF4040" title="#BF4040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF4080"><a href="#" onclick="bbfontstyle('[color=#BF4080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF4080" title="#BF4080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF40BF"><a href="#" onclick="bbfontstyle('[color=#BF40BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF40BF" title="#BF40BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF40FF"><a href="#" onclick="bbfontstyle('[color=#BF40FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF40FF" title="#BF40FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF8000"><a href="#" onclick="bbfontstyle('[color=#BF8000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF8000" title="#BF8000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF8040"><a href="#" onclick="bbfontstyle('[color=#BF8040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF8040" title="#BF8040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF8080"><a href="#" onclick="bbfontstyle('[color=#BF8080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF8080" title="#BF8080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF80BF"><a href="#" onclick="bbfontstyle('[color=#BF80BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF80BF" title="#BF80BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BF80FF"><a href="#" onclick="bbfontstyle('[color=#BF80FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BF80FF" title="#BF80FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFBF00"><a href="#" onclick="bbfontstyle('[color=#BFBF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFBF00" title="#BFBF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFBF40"><a href="#" onclick="bbfontstyle('[color=#BFBF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFBF40" title="#BFBF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFBF80"><a href="#" onclick="bbfontstyle('[color=#BFBF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFBF80" title="#BFBF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFBFBF"><a href="#" onclick="bbfontstyle('[color=#BFBFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFBFBF" title="#BFBFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFBFFF"><a href="#" onclick="bbfontstyle('[color=#BFBFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFBFFF" title="#BFBFFF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFFF00"><a href="#" onclick="bbfontstyle('[color=#BFFF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFFF00" title="#BFFF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFFF40"><a href="#" onclick="bbfontstyle('[color=#BFFF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFFF40" title="#BFFF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFFF80"><a href="#" onclick="bbfontstyle('[color=#BFFF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFFF80" title="#BFFF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFFFBF"><a href="#" onclick="bbfontstyle('[color=#BFFFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFFFBF" title="#BFFFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#BFFFFF"><a href="#" onclick="bbfontstyle('[color=#BFFFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#BFFFFF" title="#BFFFFF" height="10" width="15"></a></td>
                            </tr>
                            <tr>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF0000"><a href="#" onclick="bbfontstyle('[color=#FF0000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF0000" title="#FF0000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF0040"><a href="#" onclick="bbfontstyle('[color=#FF0040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF0040" title="#FF0040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF0080"><a href="#" onclick="bbfontstyle('[color=#FF0080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF0080" title="#FF0080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF00BF"><a href="#" onclick="bbfontstyle('[color=#FF00BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF00BF" title="#FF00BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF00FF"><a href="#" onclick="bbfontstyle('[color=#FF00FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF00FF" title="#FF00FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF4000"><a href="#" onclick="bbfontstyle('[color=#FF4000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF4000" title="#FF4000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF4040"><a href="#" onclick="bbfontstyle('[color=#FF4040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF4040" title="#FF4040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF4080"><a href="#" onclick="bbfontstyle('[color=#FF4080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF4080" title="#FF4080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF40BF"><a href="#" onclick="bbfontstyle('[color=#FF40BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF40BF" title="#FF40BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF40FF"><a href="#" onclick="bbfontstyle('[color=#FF40FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF40FF" title="#FF40FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF8000"><a href="#" onclick="bbfontstyle('[color=#FF8000]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF8000" title="#FF8000" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF8040"><a href="#" onclick="bbfontstyle('[color=#FF8040]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF8040" title="#FF8040" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF8080"><a href="#" onclick="bbfontstyle('[color=#FF8080]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF8080" title="#FF8080" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF80BF"><a href="#" onclick="bbfontstyle('[color=#FF80BF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF80BF" title="#FF80BF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FF80FF"><a href="#" onclick="bbfontstyle('[color=#FF80FF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FF80FF" title="#FF80FF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFBF00"><a href="#" onclick="bbfontstyle('[color=#FFBF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFBF00" title="#FFBF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFBF40"><a href="#" onclick="bbfontstyle('[color=#FFBF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFBF40" title="#FFBF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFBF80"><a href="#" onclick="bbfontstyle('[color=#FFBF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFBF80" title="#FFBF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFBFBF"><a href="#" onclick="bbfontstyle('[color=#FFBFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFBFBF" title="#FFBFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFBFFF"><a href="#" onclick="bbfontstyle('[color=#FFBFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFBFFF" title="#FFBFFF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFFF00"><a href="#" onclick="bbfontstyle('[color=#FFFF00]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFFF00" title="#FFFF00" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFFF40"><a href="#" onclick="bbfontstyle('[color=#FFFF40]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFFF40" title="#FFFF40" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFFF80"><a href="#" onclick="bbfontstyle('[color=#FFFF80]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFFF80" title="#FFFF80" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFFFBF"><a href="#" onclick="bbfontstyle('[color=#FFFFBF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFFFBF" title="#FFFFBF" height="10" width="15"></a></td>
                                <td style="width: 15px; height: 10px;" bgcolor="#FFFFFF"><a href="#" onclick="bbfontstyle('[color=#FFFFFF]', '[/color]'); return false;"><img src="images/spacer.gif" alt="#FFFFFF" title="#FFFFFF" height="10" width="15"></a></td>
                            </tr>
                            </tbody></table>

                    </dd>
                </dl>
            </div>

            <div id="format-buttons">
                <input class="button2" accesskey="b" name="addbbcode0" value=" B " style="font-weight:bold; width: 30px" onclick="bbstyle(0)" title="Удебелен текст: [b]текст[/b]  (alt+b)" type="button">
                <input class="button2" accesskey="i" name="addbbcode2" value=" i " style="font-style:italic; width: 30px" onclick="bbstyle(2)" title="Наклонен текст: [i]text[/i]  (alt+i)" type="button">
                <input class="button2" accesskey="u" name="addbbcode4" value=" u " style="text-decoration: underline; width: 30px" onclick="bbstyle(4)" title="Подчертан текст: [u]текст[/u]  (alt+u)" type="button">

                <input class="button2" accesskey="q" name="addbbcode6" value="Quote" style="width: 50px" onclick="bbstyle(6)" title="Цитиран текст: [quote]текст[/quote]  (alt+q)" type="button">

                <input class="button2" accesskey="c" name="addbbcode8" value="Code" style="width: 40px" onclick="bbstyle(8)" title="Еднотипен текст: [code]код[/code]  (alt+c)" type="button">
                <input class="button2" accesskey="l" name="addbbcode10" value="List" style="width: 40px" onclick="bbstyle(10)" title="Създай списък: [list]текст[/list]  (alt+l)" type="button">
                <input class="button2" accesskey="o" name="addbbcode12" value="List=" style="width: 40px" onclick="bbstyle(12)" title="Подреден списък: [list=]текст[/list]  (alt+o)" type="button">
                <input class="button2" accesskey="y" name="addlistitem" value="[*]" style="width: 40px" onclick="bbstyle(-1)" title="Списък: [*]text[/*]" type="button">

                <input class="button2" accesskey="p" name="addbbcode14" value="Img" style="width: 40px" onclick="bbstyle(14)" title="Добави изображение: [img]http://image_url[/img]  (alt+p)" type="button">

                <input class="button2" accesskey="w" name="addbbcode16" value="URL" style="text-decoration: underline; width: 40px" onclick="bbstyle(16)" title="Добави URL адрес: [url]http://url[/url] или [url=http://url]URL текст[/url]  (alt+w)" type="button">

                <input class="button2" accesskey="d" name="addbbcode18" value="Flash" onclick="bbstyle(18)" title="Флаш елемент: [flash=ширина,височина]http://url[/flash]  (alt+d)" type="button">

                <select name="addbbcode20" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;" title="Размер на шрифта: [size=85]малък[/size]">
                    <option value="50">Мъничък</option>
                    <option value="85">Малък</option>
                    <option value="100" selected="selected">Нормален</option>

                    <option value="150">Голям</option>

                    <option value="200">Огромен</option>

                </select>
                <input class="button2" name="bbpalette" id="bbpalette" value="Цвят на шрифта" onclick="change_palette();" title="Цвят на текста: [color=red]текст[/color]  Съвет: можеш да използваш и =#FF0000" type="button">

            </div>


            <div id="smiley-box">

                <strong>Усмивки</strong><br>

                <a href="#" onclick="insert_text(':D', true); return false;"><img src="./images/smilies/icon_e_biggrin.gif" alt=":D" title="Very Happy" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':)', true); return false;"><img src="./images/smilies/icon_e_smile.gif" alt=":)" title="Smile" height="17" width="15"></a>

                <a href="#" onclick="insert_text(';)', true); return false;"><img src="./images/smilies/icon_e_wink.gif" alt=";)" title="Wink" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':(', true); return false;"><img src="./images/smilies/icon_e_sad.gif" alt=":(" title="Sad" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':o', true); return false;"><img src="./images/smilies/icon_e_surprised.gif" alt=":o" title="Surprised" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':shock:', true); return false;"><img src="./images/smilies/icon_eek.gif" alt=":shock:" title="Shocked" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':?', true); return false;"><img src="./images/smilies/icon_e_confused.gif" alt=":?" title="Confused" height="17" width="15"></a>

                <a href="#" onclick="insert_text('8-)', true); return false;"><img src="./images/smilies/icon_cool.gif" alt="8-)" title="Cool" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':lol:', true); return false;"><img src="./images/smilies/icon_lol.gif" alt=":lol:" title="Laughing" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':x', true); return false;"><img src="./images/smilies/icon_mad.gif" alt=":x" title="Mad" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':P', true); return false;"><img src="./images/smilies/icon_razz.gif" alt=":P" title="Razz" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':oops:', true); return false;"><img src="./images/smilies/icon_redface.gif" alt=":oops:" title="Embarrassed" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':cry:', true); return false;"><img src="./images/smilies/icon_cry.gif" alt=":cry:" title="Crying or Very Sad" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':evil:', true); return false;"><img src="./images/smilies/icon_evil.gif" alt=":evil:" title="Evil or Very Mad" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':twisted:', true); return false;"><img src="./images/smilies/icon_twisted.gif" alt=":twisted:" title="Twisted Evil" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':roll:', true); return false;"><img src="./images/smilies/icon_rolleyes.gif" alt=":roll:" title="Rolling Eyes" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':!:', true); return false;"><img src="./images/smilies/icon_exclaim.gif" alt=":!:" title="Exclamation" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':?:', true); return false;"><img src="./images/smilies/icon_question.gif" alt=":?:" title="Question" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':idea:', true); return false;"><img src="./images/smilies/icon_idea.gif" alt=":idea:" title="Idea" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':arrow:', true); return false;"><img src="./images/smilies/icon_arrow.gif" alt=":arrow:" title="Arrow" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':|', true); return false;"><img src="./images/smilies/icon_neutral.gif" alt=":|" title="Neutral" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':mrgreen:', true); return false;"><img src="./images/smilies/icon_mrgreen.gif" alt=":mrgreen:" title="Mr. Green" height="17" width="15"></a>

                <a href="#" onclick="insert_text(':geek:', true); return false;"><img src="./images/smilies/icon_e_geek.gif" alt=":geek:" title="Geek" height="17" width="17"></a>

                <a href="#" onclick="insert_text(':ugeek:', true); return false;"><img src="./images/smilies/icon_e_ugeek.gif" alt=":ugeek:" title="Uber Geek" height="18" width="17"></a>
                <hr>
                <a href="./faq.php?mode=bbcode&amp;sid=2f5e14e01a922d44f0ad0e0301512502">BBCode</a> е <em>Включен</em><br>

                [img] е <em>Включен</em><br>
                [flash] е <em>Включен</em><br>
                [url] е <em>Включено</em><br>

                Усмивките са <em>Включени</em>

            </div>

            <div id="message-box">
                <textarea name="message" id="message" rows="15" cols="76" tabindex="4" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onfocus="initInsertions();" class="inputbox"></textarea>
            </div>
        </fieldset>


        <span class="corners-bottom"><span></span></span></div>
</div>

<div class="panel bg2">
    <div class="inner"><span class="corners-top"><span></span></span>
        <fieldset class="submit-buttons">

            <input name="lastclick" value="1489069644" type="hidden">
            <input accesskey="k" tabindex="7" name="save" value="Запази черновата" class="button2" type="submit">&nbsp;
            <input tabindex="5" name="preview" value="Прегледай" class="button1" onclick="document.getElementById('postform').action += '#preview';" type="submit">&nbsp;
            <input accesskey="s" tabindex="6" name="post" value="Изпрати" class="button1 default-submit-action" type="submit">&nbsp;

        </fieldset>

        <span class="corners-bottom"><span></span></span></div>
</div>

<div id="tabs">
    <ul>
        <li id="options-panel-tab" class="activetab"><a href="#tabs" onclick="subPanels('options-panel'); return false;"><span>Настройки</span></a></li>
        <li class="" id="attach-panel-tab"><a href="#tabs" onclick="subPanels('attach-panel'); return false;"><span>Прикачи файл</span></a></li><li class="" id="poll-panel-tab"><a href="#tabs" onclick="subPanels('poll-panel'); return false;"><span>Анкета</span></a></li>
    </ul>
</div>

<div style="display: block;" class="panel bg3" id="options-panel">
    <div class="inner"><span class="corners-top"><span></span></span>

        <fieldset class="fields1">

            <div><label for="disable_bbcode"><input name="disable_bbcode" id="disable_bbcode" type="checkbox"> Изключи BBCode</label></div>

            <div><label for="disable_smilies"><input name="disable_smilies" id="disable_smilies" type="checkbox"> Изключи усмивките</label></div>

            <div><label for="disable_magic_url"><input name="disable_magic_url" id="disable_magic_url" type="checkbox"> Недей автоматично да правиш URL адреси</label></div>

            <div><label for="attach_sig"><input name="attach_sig" id="attach_sig" checked="checked" type="checkbox"> Добави подпис (подписите се променят от Профила)</label></div>

            <div><label for="notify"><input name="notify" id="notify" type="checkbox"> Изпрати ми email щом в темата се появи отговор</label></div>

            <hr class="dashed">

            <dl>
                <dt><label for="topic_type-0">След публикуването:</label></dt>
                <dd><label for="topic_type-0"><input name="topic_type" id="topic_type-0" value="0" checked="checked" type="radio">Направи нормална</label> <label for="topic_type-1"><input name="topic_type" id="topic_type-1" value="1" type="radio">Закачи темата</label> <label for="topic_type-2"><input name="topic_type" id="topic_type-2" value="2" type="radio">Направи важна</label> <label for="topic_type-3"><input name="topic_type" id="topic_type-3" value="3" type="radio">Съобщение</label> </dd>
            </dl>

            <dl>
                <dt><label for="topic_time_limit">Закачи темата за:</label></dt>
                <dd><label for="topic_time_limit"><input name="topic_time_limit" id="topic_time_limit" size="3" maxlength="3" value="0" class="inputbox autowidth" type="text"> Дни</label></dd>
                <dd>Въведи 0 или остави празно за Закачена/Важна тема без лимит</dd>
            </dl>

        </fieldset>

        <input name="creation_time" value="1489069644" type="hidden">
        <input name="form_token" value="edd5ba9fba5ef83dd2465c5442ef19c78ade974a" type="hidden">

        <span class="corners-bottom"><span></span></span></div>
</div>

<div style="display: none;" class="panel bg3" id="attach-panel">
    <div class="inner"><span class="corners-top"><span></span></span>

        <p>Ако искате да прикачите файл към вашето мнение въведете детайлите долу</p>

        <fieldset class="fields2">
            <dl>
                <dt><label for="fileupload">Име на файл:</label></dt>
                <dd>
                    <input name="fileupload" id="fileupload" maxlength="52428800" value="" class="inputbox autowidth" type="file">
                    <input name="add_file" value="Добави файл" class="button2" onclick="upload = true;" type="submit">
                </dd>
            </dl>
            <dl>
                <dt><label for="filecomment">Коментар на файл:</label></dt>
                <dd><textarea name="filecomment" id="filecomment" rows="1" cols="40" class="inputbox autowidth"></textarea></dd>
            </dl>
        </fieldset>

        <span class="corners-bottom"><span></span></span></div>
</div><div style="display: none;" class="panel bg3" id="poll-panel">
    <div class="inner"><span class="corners-top"><span></span></span>


        <p>Ако не искате да добавяте анкета към темата си не попълвайте нищо</p>


        <fieldset class="fields2">

            <dl>
                <dt><label for="poll_title">Въпрос на анкетата:</label></dt>
                <dd><input name="poll_title" id="poll_title" maxlength="255" value="" class="inputbox" type="text"></dd>
            </dl>
            <dl>
                <dt><label for="poll_option_text">Възможности на анкетата:</label><br><span>Сложи всяка възможност на нов ред. Можете да въведете до <strong>10</strong> възможности.</span></dt>
                <dd><textarea name="poll_option_text" id="poll_option_text" rows="5" cols="35" class="inputbox"></textarea></dd>
            </dl>

            <hr class="dashed">

            <dl>
                <dt><label for="poll_max_options">Възможности за глас:</label></dt>
                <dd><input name="poll_max_options" id="poll_max_options" size="3" maxlength="3" value="1" class="inputbox autowidth" type="text"></dd>
                <dd>Това е номера възможности за които може да гласува потребител.</dd>
            </dl>
            <dl>
                <dt><label for="poll_length">Активност на анкетата:</label></dt>
                <dd><label for="poll_length"><input name="poll_length" id="poll_length" size="3" maxlength="3" value="0" class="inputbox autowidth" type="text"> Дни</label></dd>
                <dd>Въведете 0 или оставете празно за анкета без лимит</dd>
            </dl>


            <hr class="dashed">

            <dl>
                <dt><label for="poll_vote_change">Позволи промяна на глас:</label></dt>
                <dd><label for="poll_vote_change"><input id="poll_vote_change" name="poll_vote_change" type="checkbox"> Ако е включена потребителите ще могат да променят гласовете си (анкети).</label></dd>
            </dl>

        </fieldset>

        <span class="corners-bottom"><span></span></span></div>
</div>



</body>
</html>
