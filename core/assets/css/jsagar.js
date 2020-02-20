<script type="text/javascript">
			jQuery(document).ready(function(){

				var $grid = jQuery('.grid').isotope({
				  // options
				  itemSelector: '.grid-item',
				  layoutMode: 'fitRows'
				});

				jQuery('.video-category a').on('click',function(){
					jQuery('.video-category a').removeClass('active');
					jQuery(this).addClass('active');
					var active = jQuery(this).data('active');
					$grid.isotope({ filter: '.'+active });
				    if(active == 'all'){
				    	jQuery('.before-grid').removeClass('show');
				    	jQuery('.before-grid').removeClass('hide');
				    }else{
				    	jQuery('.before-grid').css('display','inline-block');
				    	jQuery('.before-grid').css('display','none');
				    	jQuery('.video-content-container .'+active).css('display','inline-block');
				    }
				})

					jQuery('.open-video-popup[data-fancybox="vimeo-popup"]').fancybox({
						'width': 760,
						'height': 430,
						'autoSize': false,
						caption : function( instance, item ) {
							var caption = jQuery(this).data('caption');
							var title = jQuery(this).data('title');
							caption = '<div class="video-title">'+title+'</div><div class="video-caption">'+caption+'</div> ';
							return caption;
						}
					});
					
			});
		</script>