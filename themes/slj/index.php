<?php get_header();?>			
<div id="content-wrap">
	<div id="google-search">
		
<form action="http://www.google.com/cse" id="cse-search-box">
  <div>
       <input type="hidden" name="cx" value="partner-pub-1216150828409244:y3w8tp-rrtb" />

       <input type="hidden" name="ie" value="UTF-8" />
       <input type="text" name="q" size="30" />
       <input type="submit" name="sa" value="Search" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>

</div>

	<div id="content" class="blog">

	
	<div id="postchannel">
	<?php if (have_posts()): while(have_posts()): the_post();?>

			<div class="entry">
			     <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                  <p class="meta">Published by <?php the_author();?> on <?php the_date();?></p>
                  <p class="summary">
                  	<?php the_content("Continue Reading &raquo;");?>
                  </p>
                   <p class="submeta">
                   Filed under: <?php the_category(' |');?></p>
			</div> <!-- end entry-->
                      	
<?php endwhile;?>
<?php endif;?>
	<div id="archives">

	<div id="recent">
                      <h3>Previous Articles</h3>
                      <ul>
                      
                      		<?php recent_posts(5);?>
                      
                           <!--<li>
                           <a href="http://astuteo.com/blog/article/the_jerk_store/" title="Read Caught in a Marketing Scheme: The Jerk Store">
                           <span class="date">Thursday, October 30, 2008</span><br/>Caught in a Marketing Scheme: The Jerk Store</a>
                           </li>
                       
                       			
                       
                           <li><a href="http://astuteo.com/blog/article/how_to_sell_your_home_fast_in_a_slow_housing_market/" title="Read How to Sell Your Home Fast in a Slow Housing Market"><span class="date">Friday, October 3, 2008</span><br/>How to Sell Your Home Fast in a Slow Housing Market</a></li>
                       
                           <li><a href="http://astuteo.com/blog/article/how_to_learn_to_stop_worrying_and_love_your_job/" title="Read How to Learn to Stop Worrying and Love Your Job"><span class="date">Tuesday, September 11, 2007</span><br/>How to Learn to Stop Worrying and Love Your Job</a></li>

                       	-->
                      </ul>
                      <a href="http://astuteo.com/blog/archives/" class="fullarchive" title="View Complete Archive">View Complete Archive</a>

                     <span class="subarchives"><a href="http://astuteo.com/blog/archives/category/articles/" title="View Articles Only">Articles Only</a> | <a href="http://astuteo.com/blog/archives/category/via/" title="View Vias Only">Via Via Only</a></span>
                </div>

                <div id="categories">

                     <h3>Browse <em>by</em> Category</h3>
                     <ul id="nav_categories" class="nav_categories">
                     	<?php wp_list_categories("title_li=&depth=1");?>
                     </ul>

                </div>

	</div><!-- end archives -->
		
	</div> <!-- end postchannel -->
	
	<div id="mainchannel">
		
		<div id="viachannel">
			
			<h2><img src="http://astuteo.com/images/interface/subhead-via.png" width="105" height="16" alt="Via! Via!" /></h2>
			
                                <ul id="vialist">

                                

                                         <li><a href="http://www.knockknock.biz/catalog/categories/kits/organizers/home-maintenance-organizer/" title="Home Maintenance Organizer" class="title">Home Maintenance Organizer</a>

                                         <span>
                                              Helpful for keeping track of the paint colors on the walls, upgrades, and maintenance expenses over time.                                                  </span>
                                         </li>
                                
                                

                                         <li><a href="http://www.terrakeramik.com/cappuccino.php" title="Competition Grade Coffee Cups" class="title">Competition Grade Coffee Cups</a>
                                         <span>
                                              Who knew there were actually <em>competition</em> grade mugs for your coffee, espresso, and cappuccino? <a href="http://joshspear.com/item/terra-keramik-x-competition-grade-cups/" title="Via Josh Spear's Trendspotting" class="via">Via!</a>                                                 </span>

                                         </li>
                                
                                

                                         <li><a href="http://www.worldwidefred.com/ginandtitonic.htm" title="Gin and Titonic" class="title">Gin and Titonic</a>
                                         <span>
                                              Gin and tonic drinkers, rejoice! Just when you thought the drink couldn't get any better...                                                  </span>
                                         </li>
                                
                                

                                         <li><a href="http://www.oldtomfoolery.bigcartel.com/" title="Old Tom Foolery Greeting Cards" class="title">Old Tom Foolery Greeting Cards</a>
                                         <span>

                                              Brilliant little buggers. Why didn't I think of this idea? <a href="http://joshspear.com/item/old-tom-foolery-cards/" title="Via Josh Spear's Trendspotting" class="via">Via!</a>                                                 </span>
                                         </li>
                                
                                

                                         <li><a href="http://no-www.org" title="No WWW Class B Validation" class="title">No WWW Class B Validation</a>
                                         <span>
                                              I used to think no-www.org was trivial, but it actually has major SEO implications.                                                  </span>
                                         </li>

                                
                                

                                         <li><a href="http://blog.plover.com/math/right-skewed.html" title="The Lake Wobegon Distribution" class="title">The Lake Wobegon Distribution</a>
                                         <span>
                                              An absolutely fascinating analysis of talent in professional baseball. <a href="http://daringfireball.net/linked/2008/10/01/wobegon" title="Via Daring Fireball" class="via">Via!</a>                                                 </span>
                                         </li>
                                
                                

                                         <li><a href="http://pointov.wordpress.com/2008/09/15/tv-killed-the-human-star/" title="TV Killed The Human Star" class="title">TV Killed The Human Star</a>
                                         <span>

                                              This just in... papier mache TV head guy has been shot. I really loved that guy.                                                   </span>
                                         </li>
                                
                                

                                         <li><a href="http://www.gravatar.com" title="Globally Recognized Avatars" class="title">Globally Recognized Avatars</a>
                                         <span>
                                              Astuteo now supports globally recognized avatars, aka Gravatars, in our blog commenting. <a href="http://veerle.duoh.com/blog/comments/implementation_of_my_comments_in_expression_engine/" title="Via Veerle" class="via">Via!</a>                                                 </span>
                                         </li>

                                
                                

                                         <li><a href="http://remysharp.com/2007/05/18/add-twitter-to-your-blog-step-by-step/" title="Adding Twitter to Your Website" class="title">Adding Twitter to Your Website</a>
                                         <span>
                                              This helpful little script helped me pop Twitter into the footer of my blog.                                                  </span>
                                         </li>
                                
                                

                                         <li><a href="http://loadinfo.net/" title="Loading GIF Generator" class="title">Loading GIF Generator</a>
                                         <span>
                                              Free loading GIFs for your sites and web applications. <a href="http://theletter.co.uk/index/3253/free_loading_gifs/full" title="Via The Letter" class="via">Via!</a>                                                 </span>

                                         </li>
                                
                                	

                                </ul>					

		</div> <!-- end viachannel -->
		
		<div id="linkchannel">
			
			<ul>

                                        <li class="imglink"><a href="http://www.authenticjobs.com/?aff=8c73a" rel="nofollow" title="Full-time and freelance job opportunities for designers and developers"><img src="http://astuteo.com/images/ads/authentic-jobs-140x70.gif" alt="Post a job. Find one. authenticjobs.com" width="140" height="70"/></a></li>

				<li class="feeds">
					<h2>Feeds</h2>

					<ul>
						<li><a href="http://astuteo.com/blog/rss_articles/" title="Articles RSS 2.0 Feed">Articles</a></li>
						<li><a href="http://astuteo.com/blog/rss_via/" title="Via Via RSS 2.0 Feed">Via! Via!</a></li>
						<li><a href="http://astuteo.com/blog/rss/" title="Complete RSS 2.0 Feed">Combined</a></li>
					</ul>
				</li>

				<li class="faves">

					<h2>Favorites</h2>
					<ul>
						
						     <li><a href="http://www.alistapart.com/" rel="nofollow" title="The Legendary Resource AListApart.com">A List Apart</a></li>
						
						     <li><a href="http://www.airbagindustries.com/" rel="nofollow" title="AirbagIndustries.com">Airbag Industries</a></li>
						
						     <li><a href="http://www.cameronmoll.com/" rel="nofollow" title="A Savvy Blend of Marketing and Design at CameronMoll.com">Authentic Boredom</a></li>
						
						     <li><a href="http://www.boxesandarrows.com/" rel="nofollow" title="Graphic, UX, and Business Design at BoxesAndArrows.com">Boxes and Arrows</a></li>

						
						     <li><a href="http://www.copyblogger.com/" rel="nofollow" title="Online Marketing Copywriting Tips at CopyBlogger.com">Copyblogger</a></li>
						
						     <li><a href="http://www.coudal.com/" rel="nofollow" title="The Always Excellent Taste of Coudal.com">Coudal Partners</a></li>
						
						     <li><a href="http://daringfireball.net/" rel="nofollow" title="John Gruber's DaringFireball.net">Daring Fireball</a></li>
						
						     <li><a href="http://drawn.ca/" rel="nofollow" title="Drawn.ca: The Illustration and Cartooning Blog">Drawn!</a></li>
						
						     <li><a href="http://joshspear.com/" rel="nofollow" title="Josh Spear's Trendspotting">Josh Spear</a></li>
						
						     <li><a href="http://lifehacker.com/" rel="nofollow" title="Tips and Tricks for Getting Things Done at LifeHacker.com">Lifehacker</a></li>

						
						     <li><a href="http://www.monoscope.com/" rel="nofollow" title="Inspiring Design at Monoscope.com">Monoscope</a></li>
						
						     <li><a href="http://www.37signals.com/svn/" rel="nofollow" title="Design and Usability from 37Signals.com">Signal vs. Noise</a></li>
						
						     <li><a href="http://www.simplebits.com" rel="nofollow" title="Dan Cedarholm's SimpleBits">SimpleBits</a></li>
						
						     <li><a href="http://www.sitepoint.com/" rel="nofollow" title="Talk and Tutorials for Web Developers at SitePoint.com">Sitepoint</a></li>
						
						     <li><a href="http://www.smashingmagazine.com/" rel="nofollow" title="The Best Site on the Interwebs, SmashingMagazine.com">Smashing Mag</a></li>
						
						     <li><a href="http://www.uncrate.com" rel="nofollow" title="The Buyers Guide for Men at Uncrate.com (Ladies, see OutBlush.com)">Uncrate</a></li>

						
						     <li><a href="http://www.zeldman.com/" rel="nofollow" title="The Man Himself, Jeffrey Zeldman.">Zeldman Presents</a></li>
						
					</ul>
				</li>

                                       <li class="text-link-ads">
                                               
					</li>           

                                        <li class="badges">
                                         
                                        </li>
			</ul>

			
		</div> <!-- end linkchannel -->
		
	</div> <!-- end mainchannel -->
	
	<div class="clearfix"></div>

</div></div> <!-- end content-wrap & content-->
<?php get_footer();?>