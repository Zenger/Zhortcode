jQuery(function() {	


	Zhortcode = {
		init : function() {

			Zhortcode.tooltip();

			Zhortcode.tabs();


		},

		tooltip: function()
		{
			if (jQuery.tooltip !== undefined) {
				jQuery('.zh-tooltip').tooltip();
			}
		},


		tabs: function() {

			Zhortcode.buildTabsHTML(); // build tabs html

			jQuery('div.zh-tabgroup').on('click', '.zh-tab-title', function(e) {
				e.preventDefault();
				$this = jQuery(this);
				var index = $this.index();
				
				var contentWrapper = $this.closest('.zh-tab-title-wrapper').next('.zh-tab-content-wrapper');
				var contentTabHide = contentWrapper.find('.zh-tab-content.active');
				var contentTabShow = contentWrapper.find('.zh-tab-content');
				contentTabHide.fadeOut('fast', function() {
					$this.siblings('.active').removeClass('active').end().addClass('active');
					contentTabHide.removeClass('active');
					contentTabShow.eq(index).fadeIn('fast').addClass('active');
				});
			});

		},

		buildTabsHTML : function () 
		{
			var tabWrapper = jQuery('div.zh-tabgroup');
			tabWrapper.each(function() {
				$this = jQuery(this);
				var objectTitle = $this.find(".zh-tab-title");
				var objectContent = $this.find(".zh-tab-content");
				var sizeTitle = objectTitle.size();
				var sizeContent = objectContent.size();
				var i = 0, j = 0;
				var stringTitle = "", stringContent = "";
				
				if(sizeTitle == sizeContent)
				{
					while(i < sizeTitle)
					{
						if(i == 0)
						{
							stringTitle += objectTitle.eq(i).addClass("active").prop('outerHTML');
							stringContent += objectContent.eq(i).addClass("active").prop('outerHTML');
						}
						else
						{
							stringTitle += objectTitle.eq(i).prop('outerHTML');
							stringContent += objectContent.eq(i).prop('outerHTML');
						}
						i++;
					}
				}
				
				var tabsTitle = "<div class='zh-tab-title-wrapper'>" + stringTitle + "</div>";
				var tabsContent = "<div class='zh-tab-content-wrapper'>" + stringContent + "</div>";
				$this.html(tabsTitle + tabsContent);
			});
		},


	};


	// Tooltips
	try {
		Zhortcode.init();
	}
	catch(e) {
		console.warn("Zhortcodes Error", e.message);
	}
	
	


});


