jQuery(document).ready(function($) {


	// Fallback for no console support
	if (typeof(console) == "undefined") {
		console = { log: function(s){} };
	}
	
	var iv = setInterval(function() {
		if ($("#disqus_thread h3").length) {
			Cufon.refresh("#disqus_thread h3");
			clearInterval(iv);
		}
	}, 100);
	
	if(window.location){
		var path = window.location.pathname;
		if(path == '/ask/' || path == '/ask' || path == '/submit/' || path == '/submit'){
			$('#disqus').hide();
		}
	}
	
	var $contentDiv = $('#content');
	var $loader = $('#loader');
	var $sidebar = $('#sidebar');
	var $footer = $('#footer');
	var $header = $('#header');
	var isPage = false;
	var isPermalinkPage = false;

	if($contentDiv.length > 0){
		isPermalinkPage = true;
	}
	
	function hideLoader(){
		$loader.animate({ opacity: 0 }, 300, function(){
			$(this).remove();
		});
	}

	$('#notes ol.notes').hide();

	if($contentDiv.length > 0){
		hideLoader();
	}

	function formatColor(color){
		var formattedColor = color.split('#')[1];
		if(formattedColor.length == 3){
			var customColorVals = formattedColor.split('');
			formattedColor = customColorVals[0]+customColorVals[0]+customColorVals[1]+customColorVals[1]+customColorVals[2]+customColorVals[2];
		}
		return formattedColor;
	}
	
	//customColor = formatColor(customColor);
	//vimeoColor = formatColor(vimeoColor);

	if($('h1.no_results').length > 0){
		$('h1.has_results').hide();
	}
	if($('h1.has_results').length > 0){
		var parts = $('h1.has_results').html().split(' ');
		if( parts[0] == '1' ){
			$('h1.has_results .plural').hide();
		}
	}
	
	var searchInHeader = true;
	var $posts = $('div.post');
	if($posts.length == 1){
		var $onlyPost = $posts.eq(0);
		if($onlyPost.hasClass('text')){
			if($onlyPost.hasClass('narrow') || $onlyPost.hasClass('full')){
				// do not wrap
			} else 	if($contentDiv.length == 0){
				isPage = true;
				$posts.eq(0).wrap('<div id="content"></div>');
			}
		}
	}
	if($('div.single_col').length > 0){
		isPage = true;
		$('#content .single_wrapper').append('<span class="gutter"></span>');
		if($.browser.msie){
			$('#content .single_wrapper').append('<div class="clear"></div>');
		}
	}
	var imageHeader = false;
	if($('#header.with_image').length > 0){
		imageHeader = true;
	}
	
	$('a.share_toggle').each(function(){
		var $options = $(this).closest('div.post').find('div.share');
		$(this).click(function(e){
			e.preventDefault();
			$options.fadeIn('fast');
		});
		$options.mouseleave(function(){
			$(this).fadeOut();
		})
	});
	
	function replaceYouTube(video){
		// Youtube replacement based on script by Matthew Buchanan - http://mattbu.ch/261951286
		var bgcolor = 'FFFFFF';
		var parent = $(video).parent();
		parent.css("visibility","hidden");
		var youtubeCode = parent.html();
		var params = "";
		if (youtubeCode.toLowerCase().indexOf("<param") == -1) {
			$("param", this).each(function () {
				params += $(this).get(0).outerHTML;
			});
		}
		var oldOpts = /rel=0/g;
		var newOpts = "rel=0&amp;color1=0x"+bgcolor+"&amp;color2=0x"+bgcolor;
		youtubeCode = youtubeCode.replace(oldOpts, newOpts);
		if (params != "") {
			params = params.replace(oldOpts, newOpts);
			youtubeCode = youtubeCode.replace(/<embed/i, params + "<embed");
		}
		// Widescreen
		if( $(video).is('object') ){
			var youtubeIDParam = $(video).find('embed').attr('src');
		} else {
			var youtubeIDParam = $(video).attr('src');
		}
		var youtubeIDPattern = /\/v\/([0-9A-Za-z-_]*)/;
		var youtubeID = youtubeIDParam.match(youtubeIDPattern);
		var youtubeWidth = $(video).attr('width');
		var youtubeHeight = Math.floor(youtubeWidth * 0.75 + 25) -2;
		var youtubeHeightWide = Math.floor(youtubeWidth * 0.5625 + 25) -2;

		$.getJSON("http://gdata.youtube.com/feeds/api/videos/" + youtubeID[1] + "?v=2&alt=json-in-script&callback=?", function (data) {
			oldOpts = /height="?([0-9]*)"?/g;
			if (data.entry.media$group.yt$aspectRatio != null) {
				newOpts = 'height="' + youtubeHeightWide + '"';
			} else {
				newOpts = 'height="' + youtubeHeight + '"';
			}
			youtubeCode = youtubeCode.replace(oldOpts, newOpts);
			if (params != "") {
				params = params.replace(oldOpts, newOpts);
				youtubeCode = youtubeCode.replace(/<embed/i, params + "<embed");
			}
			parent.html(youtubeCode).css("visibility","visible");
			parent.show();
		});
	}
	
	function replaceVimeo(video){
		var parent = $(video).parent();
		// Customised based on code by Matthew Buchanan - http://mattbu.ch/141302328
		var vimeoCode = parent.html();
		var $video = $(video);
		var data = $video.attr("data");
		if(data.split("clip_id=")[1] == null){
			data = $video.find('param[name=flashvars]').val();
		}
		var temp = data.split("clip_id=")[1];
		var id = temp.split("&")[0];
		// var server = temp.split("&")[1];
		var w = $video.attr("width");
		var h = $video.attr("height");
		parent.height(h);
		$video.replaceWith(
			"<iframe src='http://player.vimeo.com/video/"+id+
			"?title=0&byline=0&portrait=0&color="+vimeoColor+"' "+
			"width='"+w+"' height='"+h+"' frameborder='0'></iframe>"
		);
	}
	
	function replaceVimeoIframe(iframe){
		var parent = $(iframe).parent();
		// Customised based on code by Matthew Buchanan - http://mattbu.ch/141302328
		var vimeoCode = parent.html();
		var $iframe = $(iframe);
		var src = $iframe.attr("src");
		var id;
		if(src.indexOf('?') == -1){
			id = src.substring((src.lastIndexOf('/') + 1));
		} else {
			id = src.substring((src.lastIndexOf('/') + 1), src.indexOf('?'));
		}
		var w = $iframe.attr("width");
		var h = $iframe.attr("height");
		parent.css({ width: w, height: h });
		$iframe.replaceWith(
			'<iframe src="http://player.vimeo.com/video/'+id+
			'?title=0&byline=0&portrait=0&color='+vimeoColor+'" '+
			'width="'+w+'" height="'+h+'" frameborder="0"></iframe>'
		);
	}
	
	function loadExternalArtwork(){
		// Adapted from code by Matthew Buchanan - http://mattbu.ch/
		// Now deprecated because Tumblr have added support for uploading album art.
		// Kept for backward-compatability
		var $tags = $('ul.tags a');
		$tags.each(function(){
			var tag = $(this).text();
			if (tag.substring(0,4) == "art:") {
				var imgUrl = tag.replace("art:","");
				var $post = $(this).closest("div.audio, div.single_wrapper");
				if($post.length == 0){
					$post = $(this).closest("#cols");
				}
				$post.find("div.artwork").html("<img src='" + imgUrl + "' alt='Artwork' border='0' />");
				$(this).hide();
			}
			if ($(this).parent().find("a:visible").length == 0){
				$(this).parent().hide();
			}
		});
	}
	
	function fixFancyboxForIE(action){
		if($.browser.msie){
			if(action == 'open'){
				$('embed, object, select').css('visibility', 'hidden');
			} else if(action == 'close'){
				$('embed, object, select').css('visibility', 'visible');
			}
		}
	}
	
	$posts.each(function(){
		if( $(this).hasClass('video') ){
			if( $(this).hasClass('narrow') && $(this).find('.caption').length == 0 ){
				$(this).find('.panel_content').addClass('no_caption');
			}
			var $object = $(this).find('object');
			var $embed = $(this).find('embed');
			var $iframe = $(this).find('iframe');
			if($object.length > 0){
				if($object.attr('data') != null){
					var dataContents = $object.attr('data');
				} else {
					dataContents = '';
				}
				if (dataContents.indexOf('http://vimeo.com') > -1){
					replaceVimeo($object);
				} else if ($object.find("embed[src^='http://www.youtube.com']").length > 0) {
					replaceYouTube($object);
				} else {
					$object.closest('.video_embed').show();
				}
			} else if($embed.length > 0){
				var src = $embed.attr('src');
				if(src.indexOf('http://www.youtube.com') > -1){
					replaceYouTube($embed);
				} if(src.indexOf('http://www.vimeo.com') > -1){
					replaceVimeo($embed);
				} else {
					$embed.closest('.video_embed').show();
				}
			} else if($iframe.length > 0){
				var dataContents = $iframe.attr('src');
				if (dataContents.indexOf('http://player.vimeo.com') > -1){
					replaceVimeoIframe($iframe);
				} else {
					$iframe.closest('.video_embed').show();
				}
			} else {
				// No flash
				$(this).find('.video_embed').addClass('no_flash').show();
			}
		}
		if( $(this).hasClass('quote') ){
			var $quote = $(this).find('blockquote.quote_text');
			$quote.append('<div class="quotemark"></div>');
			var $cite = $(this).find('div.cite');
			if( $cite.html() != '' ){
				$quote.append('<div class="ref"></div>');
				var $citeSource = $cite.find('p.source');
				if($citeSource.length){
					$citeSource.remove();
					if($cite.find('p,blockquote,li').length == 0){
						$cite.wrapInner('<p></p>');
					}
					$cite.append($citeSource);
				} else {
					if($cite.find('p,blockquote,li').length == 0){
						$cite.wrapInner('<p></p>');
					}
				}
			} else {
				$cite.addClass('no_content');
			}
		}
		if( $(this).hasClass('photo') ){
			if( $(this).find('.caption').length > 0 ){
				$(this).find('.photo_narrow, .photo_full').append('<div class="ref"></div>');
			} else {
				if($(this).hasClass('narrow')){
					$(this).find('.panel_content').addClass('no_caption');
				}
			}
			$(this).find('.photo_narrow a, .photo_full a').each(function(){
				var imgLink = $(this).attr('href');
				var imgHighRes = $(this).attr('rel');
				if(imgLink == '' && imgHighRes == ''){
					$(this).find('img').unwrap();
				} else if(imgLink == ''){
					$(this).attr('href', imgHighRes);
				} else {
					$(this).removeClass('lightbox');
				}
				if($(this).hasClass('lightbox')){
					$(this).fancybox({
						"titleShow" : false,
						"type" : "image",
						"hideOnContentClick" : true,
						"centerOnScroll" : true,
						"overlayColor" : "#333",
						"overlayOpacity" : 0.8,
						"onComplete" : function(){
							if($.browser.msie){
								$('embed, object, select').css('visibility', 'hidden');
							}
						},
						"onClosed" : function(){
							if($.browser.msie){
								$('embed, object, select').css('visibility', 'visible');
							}
						}
					});
				}
			});
		}
		if( $(this).hasClass('photoset') ){
			if( $(this).find('.caption').length == 0 ){
				if($(this).hasClass('narrow')){
					$(this).find('.panel_content').addClass('no_caption');
				}
			}
		}
		if( $(this).hasClass('chat') ){
			$(this).find('ul.chat li:last').addClass('last');
		}
		if( $(this).hasClass('audio') ){
			var $header = $(this).find('.panel_head');
			var $footer = $(this).find('.meta_foot, .panel_foot');
			var $notes = $('#notes');
			var $audioInfo = $(this).find('.audio_info');
			
			if(slimAudioPlayer){
				$(this).addClass('inline_audio');
				$(this).find('div.album').wrap('<div class="audio_slim"></div>');
				if( $(this).find('.caption').length == 0 ){
					$(this).find('.caption').hide();
					if(isPermalinkPage){
						$(this).find('.audio_info, .meta_foot').hide();
						$(this).addClass('no_caption');
					} else {
						$(this).find('div.base_format').addClass('no_caption');
					}
				}
			} else {
				$header.remove().prependTo($audioInfo);
				if($notes.length > 0){
					$notes.remove().appendTo($audioInfo);
				}
				$footer.remove().appendTo($audioInfo);
				$(this).find('.album').append('<div class="ref"></div>');
				var $audioMeta = $footer.find('ul.meta');
				if(isPermalinkPage){
					if($audioInfo.find('.caption').length == 0){
						$audioInfo.find('.panel_content').hide();
						if($notes.length == 0){
							$audioInfo.hide();
							$(this).find('div.ref').hide();
						}
					}
				} else {
					if( $audioInfo.find('.caption').length == 0 ){
						$(this).find('div.base_format').addClass('no_caption');
						$(this).find('div.ref').css('top', '4px');
					}
				}
			}
		}
		if( $(this).hasClass('answer') ){
			$(this).find('div.ask_question, div.ask_answer').prepend('<div class="qa"></div>');
		}
		if( $(this).hasClass('text') ){
			$(this).find('img').each(function(){
				if($(this).attr('height')){
					$(this).removeAttr('height');
				}
				if($(this).parent()[0].tagName == 'A'){
					$(this).parent().addClass('img_link');
				}
			});
		}
		if($(this).find('.caption').length > 0){
			$(this).find('.caption > *:last').addClass('last');
		} else {
			$(this).find('.base_format > *:last').addClass('last');
		}
		
		if($(this).find('.meta_foot').children().length == 0){
			$(this).find('.meta_foot').addClass('empty_meta_foot');
		}
	});
	
	loadExternalArtwork();
	
	var $searchForm = $('#search');
	var $searchfield = $('#search_field');
	var searchDefault = 'Search';
	
	$searchfield.val(searchDefault).addClass('empty');
	$searchfield.focus(function(){
		if($searchfield.val() == searchDefault) {
			$searchfield.val("").removeClass('empty');
		}
		$searchfield.blur(function() {
			if($searchfield.val() == "") {
				$searchfield.val(searchDefault).addClass('empty');
			}
		});
	});
	
	function setSidebar(){
		var heightNeeded = $sidebar.outerHeight(true) + $header.outerHeight(true) + $footer.outerHeight(true);
		if(searchInHeader){
			heightNeeded += $searchForm.outerHeight();
		}
		if($(window).height() > heightNeeded){
			if($.browser.opera){
				$sidebar.css({ marginTop: '15px' });
			}
			$sidebar.css({ position: 'fixed' });
		} else {
			if($.browser.opera){
				$sidebar.css({ marginTop: '0' });
			}
			$sidebar.css({ position: 'relative' });
		}
	}
	
	$sidebar.prepend('<div class="sidebar_head"></div>');
	setSidebar();
	
	$('#page').css('min-height', $sidebar.height()+'px');
	
	if( $('div.side_meta .author_avatar').length == 0){
		$('div.side_meta li.authored').addClass('has_icon icon_posted');
	} else {
		$('div.side_meta .author_avatar').append('<div class="avatar_frame"></div>');
	}
	$('.has_icon').prepend('<div class="icon"></div>');
	
	var tumblrname = 'sneakup';
	$('#notes ol.notes li.tumblelog_'+tumblrname).addClass('by_author');
	$('#toggle_notes a').toggle(
		function(e){
			$(this).html('hide');
			$(this).closest('p').addClass('icon_hidenotes');
			$('#notes ol.notes').stop().slideDown();
			e.preventDefault();
		},
		function(e){
			$(this).html('show');
			$(this).closest('p').removeClass('icon_hidenotes');
			$('#notes ol.notes').stop().slideUp();
			e.preventDefault();
	});
	var hash = unescape(self.document.location.hash);
	if(hash.substring(1) == 'notes'){
		$('#toggle_notes a').trigger('click');
	}
	
	var $likes = $('#likes');
	if( $likes.length > 0 ){
		var $like_links = $likes.find('a');
		$like_links.each(function(){
			if( $(this).find('img').length ){
				$(this).addClass('contains_image');
			}
		});
	}
	
	function setup(){
		var contentReplaced = false;
		
		function doMasonry(){
			if(contentReplaced && !isPage){
				$('#cols').masonry({
					singleMode: true,
					itemSelector: '.post'
				}, function(){
					hideLoader();
				});
				clearTimeout(masonryTimeout);
			} else {
				if(isPage){
					hideLoader();
				}
			}
		}
		
		if($contentDiv.length == 0){
			// We are on an index page
			if($('#cols').children().length > 0){
				var $videos = $('div.video');
				if($videos.length > 0){
					$('div.video').each(function(){	
						var $vidObject = $(this).find('object');
						var $vidIframe = $(this).find('iframe');
						var $vidParent = $(this).find('div.video_embed');
						if($vidObject.length){
							$vidParent.height($vidObject.attr('height'));
							$vidParent.show();
						} else if($vidIframe.length){
							$vidParent.height($vidIframe.attr('height'));
							$vidParent.show();
						}
						contentReplaced = true;
					});
				} else {
					contentReplaced = true;
				}
				masonryTimeout = setTimeout(function(){
					doMasonry();
				}, 500);
			} else {
				hideLoader();
			}
		} else {
			var $videos = $('div.video div.video_embed');
			$videos.show();
			hideLoader();
		}
	}
	
	function replacePlayers(){
		$('div.player').each(function(){
			var player = $(this).html();
			player = player.replace(/\"best\"/g, '"best" wmode="transparent"');
			if($(this).hasClass('custom_player')){
				player = player.replace(/FFFFFF/g, 'B3B3B3');
			}
			$(this).html(player);
			$(this).show();
		});
	}
	
	function replacePhotosets(){
		$('div.photoset_narrow').each(function(){
			var photoset = $(this).html();
			photoset = photoset.replace(/\"high\"/g, '"high" wmode="transparent"');
			$(this).html(photoset).show();
		});
	}

	function setSearch(){
		if(!imageHeader){
			if($(window).scrollTop() > $('#header').outerHeight()){
				if(searchInHeader){
					$searchForm.hide().appendTo('#sidebar').fadeIn(300);
					searchInHeader = false;
				}
			} else {
				if(!searchInHeader){
					$searchForm.fadeOut(300, function(){
						$(this).appendTo('#header').fadeIn(300);
					});
					searchInHeader = true;
				}
			}
		}
	}
	
	$(window).load(function(){
		setup();
		//replacePlayers();
		//replacePhotosets();
	});
	
	$(window).scroll(function(){
		setSidebar();
		setSearch();
	});
	
	$(window).resize(function(){
		setSidebar();
	});

});