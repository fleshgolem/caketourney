    <?php
     
    /*
    Testing:
     
    $text = "
    Hi there, this is a link: http://cakephp.org/ and this is an image: http://cakephp.org/img/cake-logo.png
    This is a test: <a href=\"http://cakephp.org/\">Foo</a>
    So is this: <img src=\"http://cakephp.org/img/cake-logo.png\" alt=\"Cake\" />
    And so is this: <a href=\"http://cakephp.org\"><img src=\"http://cakephp.org/img/cake-logo.png\" /></a>
    False positives? I <3 http://cakephp.org/
    ";
     
    echo nl2br($autoLink->process($text, array('title' => 'Foo'), array('alt' => 'Bar')));
     
    */
     App::import('helper'); 
    class AutoLinkHelper extends AppHelper {
        var $helpers = array('Html');
     
        var $_settings = array();
       
        function process($text, $linkOptions = array(), $imageOptions = array()) {
            $this->_settings = compact('linkOptions', 'imageOptions');
           
            $regexp = '((?:http|https|ftp|nntp)://[^\s<]+)';
            $regexp = '(?![^<]+>)' . $regexp . '(?![^<]+>)';
            $regexp = '#' . $regexp . '#i';
           
            return preg_replace_callback($regexp, array($this, '_handleLink'), $text);
        }
       
        function _handleLink($bits) {
            list($url) = $bits;
            extract($this->_settings);
            if ($imageOptions !== false && preg_match('/\\.(jpe?g|gif|png|svg|bmp|omg|wtf|bbq)$/i', $url)) {
                return $this->Html->image($url, $imageOptions);
            }
            else {
                return $this->Html->link($url, $url, $linkOptions);
            }
        }
    }
     
    ?>