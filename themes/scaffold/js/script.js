var $j = jQuery.noConflict();
var disqus_developer = 1;
$j(document).ready(function($j) {
    var scaffold = new Scaffold();
});
var Scaffold = $j.Class({
	
    init: function(){
        var self = this;
		this.contentDiv = $j('#content');
		this.loader = $j('#loader');
		this.sidebar = $j('#sidebar');
		this.footer = $j('#footer');
		this.header = $j('#header');
		this.searchForm = $j('#search');
		this.searchfield = $j('#search_field');
		this.searchDefault = 'Search';		
		
		$j(window).scroll(function(){
			self.setSidebar();
			self.setSearch();
		});

		$j(window).resize(function(){
			self.setSidebar();
		});
		self.imageHeader = false;
		if($j('#header.with_image').length > 0){
			self.imageHeader = true;
		};
		self.searchfield.val(self.searchDefault).addClass('empty');
		self.searchfield.focus(function(){
			if(self.searchfield.val() == self.searchDefault) {
				self.searchfield.val("").removeClass('empty');
			}
			$searchfield.blur(function() {
				if(self.searchfield.val() == "") {
					self.searchfield.val(self.searchDefault).addClass('empty');
				}
			});
		});
		
		if( $j('div.side_meta .author_avatar').length == 0){
			$j('div.side_meta li.authored').addClass('has_icon icon_posted');
		} else {
			$j('div.side_meta .author_avatar').append('<div class="avatar_frame"></div>');
		}
		$j('.has_icon').prepend('<div class="icon"></div>');

	},
	

	
	setSidebar: function(){
		var heightNeeded = this.sidebar.outerHeight(true) + this.header.outerHeight(true) + this.footer.outerHeight(true);
		/*if(searchInHeader){
			heightNeeded += this.searchForm.outerHeight();
		}*/
		if($j(window).height() > heightNeeded){
			if($j.browser.opera){
				this.sidebar.css({ marginTop: '15px' });
			}
			this.sidebar.css({ position: 'fixed' });
		} else {
			if($j.browser.opera){
				this.sidebar.css({ marginTop: '0' });
			}
			this.sidebar.css({ position: 'relative' });
		}
	},


	 setSearch: function(){
		if(!this.imageHeader){
			if($j(window).scrollTop() > $j('#header').outerHeight()){
				if(this.searchInHeader){
					this.searchForm.hide().appendTo('#sidebar').fadeIn(300);
					this.searchInHeader = false;
				}
			} else {
				if(!this.searchInHeader){
					this.searchForm.fadeOut(300, function(){
						$j(this).appendTo('#header').fadeIn(300);
					});
					this.searchInHeader = true;
				}
			}
		}
	}

});
