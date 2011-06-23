<?php  
App::import('helper','shortcode'); 
class BbcodeHelper extends Shortcode{ 
	var $helpers = array('Html', 'Autolink');
	
	
    function __construct(){ 
        // Register the shortcodes 
        $this->add_shortcode(array( 
            array( 'b' , array(&$this, 'shortcode_bold')), 
            array( 'i' , array(&$this, 'shortcode_italics') ), 
            array( 'u' , array(&$this, 'shortcode_underline') ), 
            array( 'url' , array(&$this, 'shortcode_url') ), 
            //array( 'img' , array(&$this, 'shortcode_image') ), 
            array( 'quote' , array(&$this, 'shortcode_quote') ), 
			array( 'qquote' , array(&$this, 'shortcode_qquote') ) , 
            array( 'qqquote' , array(&$this, 'shortcode_qqquote') ), 
			array( 'qqqquote' , array(&$this, 'shortcode_qqqquote') ) , 
			array( 'red' , array(&$this, 'shortcode_red') ), 
			array( 'blue' , array(&$this, 'shortcode_blue') ), 
			array( 'green' , array(&$this, 'shortcode_green') ), 
			array( 'yellow' , array(&$this, 'shortcode_yellow') ), 
			array( 'orange' , array(&$this, 'shortcode_orange') ), 
			array( 'Sans-Serif' , array(&$this, 'shortcode_sans_serif') ), 
			array( 'Courier' , array(&$this, 'shortcode_courier') ), 
			array( 'Comic-Sans' , array(&$this, 'shortcode_comic_sans') ), 
			array( 'Times-New-Roman' , array(&$this, 'shortcode_times_new_roman') ), 
			array( 'code' , array(&$this, 'shortcode_code') ), 
			array( 'large' , array(&$this, 'shortcode_large') ), 
			array( 'small' , array(&$this, 'shortcode_small') )
        )); 
    } 
     
    function _beforeShortcode($content){ 
        return htmlspecialchars($content); 
    } 
     
    function _afterShortcode($content){ 
        return nl2br($content); 
    } 
     

    // No-name attribute fixing 
    function attributefix( $atts = array() ) { 
        if ( empty($atts[0]) ) return $atts; 

        if ( 0 !== preg_match( '#=("|\')(.*?)("|\')#', $atts[0], $match ) ) 
            $atts[0] = $match[2]; 

        return $atts; 
    } 


    // Bold shortcode 
    function shortcode_bold( $atts = array(), $content = NULL ) { 
        return '<strong>' . $this->do_shortcode( $content ) . '</strong>'; 
    } 

    // Italics shortcode 
    function shortcode_italics( $atts = array(), $content = NULL ) { 
        return '<em>' . $this->do_shortcode( $content ) . '</em>'; 
    } 

    function shortcode_underline( $atts = array(), $content = NULL ) { 
        return '<span style="text-decoration:underline">' . $this->do_shortcode( $content ) . '</span>'; 
    } 

    function shortcode_url( $atts = array(), $content = NULL ) { 
        $atts = $this->attributefix( $atts ); 

        // Google 
        if ( isset($atts[0]) ) { 
            $url = $atts[0]; 
            $text = $content; 
        } 
        // http://www.google.com/ 
        else { 
            $url = $text = $content; 
        } 

        if ( empty($url) ) return ''; 
        if ( empty($text) ) $text = $url; 
		return $this->Html->link($url);
        //return '<a href="' . $url . '">' . $this->do_shortcode( $text ) . '</a>'; 
    } 

    function shortcode_image( $atts = array(), $content = NULL ) { 
        //echo '<img " src="'.$content.'" />';
		echo '<img " src="http://th00.deviantart.com/fs12/300W/i/2006/263/6/9/Balrog_by_Ironshod.jpg" />';
		//return '<em>' . $this->do_shortcode( $content ) . '</em>'; 
		//return '<a href="' . $this->do_shortcode( $content ) . '">' . $this->do_shortcode( $content ) . '</a>'; 
		//return $this->Html->link("http://www.chachatelier.fr/programmation/images/mozodojo-original-image.jpg");
		//$autolink->images($content);
    } 

    function shortcode_quote( $atts = array(), $content = NULL ) { 
		
        return '<div class="quote"><div class="PostMainContentbox">' . $this->do_shortcode( $content ) . '</div></div>'; 
    } 
     function shortcode_qquote( $atts = array(), $content = NULL ) { 
		
        return '<div class="quote"><div class="PostMainContentbox">' . $this->do_shortcode( $content ) . '</div></div>'; 
    } 
	 function shortcode_qqquote( $atts = array(), $content = NULL ) { 
		
        return '<div class="quote"><div class="PostMainContentbox">' . $this->do_shortcode( $content ) . '</div></div>'; 
    } 
	 function shortcode_qqqquote( $atts = array(), $content = NULL ) { 
		
        return '<div class="quote"><div class="PostMainContentbox">' . $this->do_shortcode( $content ) . '</div></div>'; 
    } 
	
	function shortcode_red( $atts = array(), $content = NULL ) { 
		
        return '<font color="color:#f30302">' . $this->do_shortcode( $content ) . '</font>'; 
    } 
	
	function shortcode_blue( $atts = array(), $content = NULL ) { 
		
        return '<font color="#39adff">' . $this->do_shortcode( $content ) . '</font>'; 
    } 
	
	function shortcode_green( $atts = array(), $content = NULL ) { 
		
        return '<font color="#00C000">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	
	function shortcode_yellow( $atts = array(), $content = NULL ) { 
		
        return '<font color="#e2ca23">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	
	function shortcode_orange( $atts = array(), $content = NULL ) { 
		
        return '<font color="#ff6600">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_sans_serif( $atts = array(), $content = NULL ) { 
		
        return '<font face="sans-serif">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_courier( $atts = array(), $content = NULL ) { 
		
        return '<font face="Courier">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_comic_sans( $atts = array(), $content = NULL ) { 
		
        return '<font face="Comic Sans MS">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_times_new_roman( $atts = array(), $content = NULL ) { 
		
        return '<font face="Times New Roman">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_code( $atts = array(), $content = NULL ) { 
		
        return '<div class="quote"><div class="PostMainContentbox"><font face="Courier">' .  $content  . '</font></div></div>'; 
    }
	function shortcode_large( $atts = array(), $content = NULL ) { 
		
        return '<font  size="5">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	function shortcode_small( $atts = array(), $content = NULL ) { 
		
        return '<font  size="1">' . $this->do_shortcode( $content ) . '</font>'; 
    }
	 
} 
?>