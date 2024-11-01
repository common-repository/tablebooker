<?php
class TablebookerAPI{
	//url
	protected $url = "//reservations.tablebooker.com";
	protected $restaurant_id;
    protected $shop_id;

	public function __construct($restaurant_id, $primary_color = null, $shop_id = null){
		$this->restaurant_id = $restaurant_id;
        $this->shop_id = $shop_id;
		$this->primary_color = $primary_color;
	}

	/*
	 * Reservation
	 */
	public function getReservationFrom($theme = 'light', $lang = 'en', $modal = 0){

		// Embed background color
		if(!in_array($theme, array('light','dark'))){
            $theme = 'light';
		}
	
		// Embed language
		if($lang == 'current'){
			$current_lang = explode('-', get_bloginfo("language"));
			$lang = $current_lang[0];
		}
		if(!in_array($lang, array('nl', 'fr', 'en', 'es', 'de'))){
			$lang = 'en';
		}

		$code = '<tbkr-bm-widget restaurant-id="'.$this->restaurant_id.'" source="website" use-modal="'.$modal.'" lang="'.$lang.'" theme="'.$theme.'"';
		if ($this->primary_color) {
		    $code .= ' primary-color="'.$this->primary_color.'"';
        }
		$code .= '></tbkr-bm-widget>';

		return $code;
	}

    /*
     * Menu
     */
    public function getMenuFrom($theme = 'light', $lang = 'en'){
        // Embed background color
        if(!in_array($theme, array('light','dark'))){
            $theme = 'light';
        }

        // Embed language
        if($lang == 'current'){
            $current_lang = explode('-', get_bloginfo("language"));
            $lang = $current_lang[0];
        }
        if(!in_array($lang, array('nl', 'fr', 'en', 'es', 'de'))){
            $lang = 'en';
        }

        $code = '<iframe src="//embed.tablebooker.be/menu/'.$this->restaurant_id.'/'.$lang.'/'.$theme.'" height="240" width="320" frameborder="0" style="width: 100%; min-width: 120px; height: 440px; border: 0;" allowtransparency="true" id="tablebookerMenuFrame_'.$this->restaurant_id.'"></iframe>';

        return $code;
    }

    /*
     * Feedback
     */
    public function getFeedbackFrom($theme = 'light', $lang = 'en'){
        // Embed background color
        if(!in_array($theme, array('light','dark'))){
            $theme = 'light';
        }

        // Embed language
        if($lang == 'current'){
            $current_lang = explode('-', get_bloginfo("language"));
            $lang = $current_lang[0];
        }
        if(!in_array($lang, array('nl', 'fr', 'en', 'es', 'de'))){
            $lang = 'en';
        }

        $code = '<iframe src="//embed.tablebooker.be/feedback/'.$this->restaurant_id.'/'.$lang.'/'.$theme.'/true" height="240" width="320" frameborder="0" style="width: 100%; min-width: 120px; height: 440px; border: 0;" allowtransparency="true"></iframe>';

        return $code;
    }

    public function getShopFrom($theme = 'light', $lang = 'en', $collections = null){
        if (empty($this->shop_id)) {
            return "Shop id not configured";
        }

        // Embed language
        if($lang == 'current'){
            $current_lang = explode('-', get_bloginfo("language"));
            $lang = $current_lang[0];
        }

        if(!in_array($lang, array('nl', 'fr', 'en', 'es', 'de'))){
            $lang = 'en';
        }

        $code = '<tbkr-shop-widget shop-id="' . $this->shop_id . '" source="website" mode="embed" language="' . $lang . '" theme="' . $theme . '"';
        if ($this->primary_color) {
            $code .= ' primary-color="' . str_replace('#', '', $this->primary_color) . '"';
        }
        if ($collections) {
            $code .= ' collections="' . $collections . '"';
        } else {
            $code .= ' collections="vouchers,takeaway"';
        }
        $code .= '></tbkr-shop-widget>';
        return $code;
    }
}
?>