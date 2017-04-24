<?php
//require_once 'HTML/BBCodeParser.php';
//require_once 'HTML/BBCodeParser2/Filter.php';

class HTML_BBCodeParser2_Filter_MyBB extends HTML_BBCodeParser2_Filter
{
    var $_definedTags = 
        array('block' => array( 'htmlopen'  => 'blockquote',
                                'htmlclose' => 'blockquote',
                                'allowed'   => 'all',
                                'attributes'=> array()
                                ),
              'line' =>  array( 'htmlopen'  => 'hr',
                                'htmlclose' => '',
                                'allowed'   => 'all',
                                'attributes'=> array()
                                ),
              'h' =>     array( 'htmlopen'  => 'h1',
                                'htmlclose' => 'h1',
                                'allowed'   => 'all',
                                'attributes'=> array()
                                ),
        );


}
?>