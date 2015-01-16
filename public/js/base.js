$(function(){
	var categoryBox = $('#categoryBox');
	var categoryLiLength = categoryBox.children().length;
	var categoryALength = categoryBox.find('a').length;
	var categoryAHeight = categoryBox.find('a').height();
	var categoryBtn = $('#categoryBtn');
	var originalcategory = 1;
	categoryBtn.click(function(){
		if( originalcategory == 1){
			$(this).toggle();
			categoryBox.animate(
				{ 
					height:(categoryLiLength + categoryALength) * categoryAHeight
				},
				800,
				function(){
					categoryBtn.html('收起');
					categoryBtn.toggle();
					originalcategory = 0;
				}
			);
		}else{
			$(this).toggle();
			categoryBox.animate(
				{ 
					height: "0px"
				},
				800,
				function(){
					categoryBtn.html('更多');
					categoryBtn.toggle();
				}
			);
			originalcategory = 1;
		}
	});
	ST.setResponsive.judgeType();
})

var ST = {}

ST.leftSmallSlider = {
	'sliderReady': function(){
		var smallSliderBox = $('#smallSliderBox');
		var smallSliderBoxImg = smallSliderBox.find('.answererImg');
		var smallSliderImgNum = 0;
		smallSliderBoxImg.each(function(i){
			var imgDom = $(this);
			var imgLoad = new Image();
			$(imgLoad).load(function(){
				imgDom.attr('src',$(this).attr('src'));
			});
			$(imgLoad).attr('src',$(this).attr('_src'));
			smallSliderImgNum++;
		});
		if(smallSliderImgNum == smallSliderBoxImg.length){
			this.sliderAnimateNow();
			smallSliderBox.hover(function(){
				clearTimeout(ST.leftSmallSlider.sliderTimeout);
			},function(){
				ST.leftSmallSlider.sliderAnimateNow();
			});
		}
	},
	'sliderTimeout': '',
	'sliderAnimateNow': function(){
		if(this.isLoadding == 0){
			this.isLoadding = 1;
			var smallSliderBox = $('#smallSliderBox');
			var smallSliderBoxImg = smallSliderBox.find('.answererImg');
			smallSliderBox.find('.detailBox').first().animate({'marginTop':'61px'},2000,function(){
				smallSliderBox.find('.detailBox').last().hide().insertBefore(smallSliderBox.find('.detailBox').first()).fadeIn(3000);
				$(this).css('marginTop','0px');
				ST.leftSmallSlider.isLoadding = 0;
			});
		}
		this.sliderTimeout = setTimeout(function(){
			ST.leftSmallSlider.sliderAnimateNow();
		},5000);
	},
	'isLoadding': 0
}
	
ST.mainSlider = {
	'imgReady': function(){
		$('#newEssayBox img').each(function(i){
			$(this).attr("src",$(this).attr('_src'));
		})
	}
	
}	

ST.setResponsive = {
	'bannerIsLoad': 0,
	'rightAsideIsLoad': 0,
	'mainContentImgIsLoad': 0,
	'runNow': function(isIndex){
		var isIndex = isIndex || 0;
		var nowScreenType = window.getComputedStyle(document.body,':after').getPropertyValue('content');
		if(/fullScreen/.test(nowScreenType)){
			
			if(this.bannerIsLoad == 0 && isIndex == 1){
				this.bannerIsLoad = 1;
				ST.newBigSlider.animateReady();
			}
			if(this.rightAsideIsLoad == 0){
				this.rightAsideIsLoad = 1;
				ST.leftSmallSlider.sliderReady();
			}
			if(this.mainContentImgIsLoad == 0){
				this.mainContentImgIsLoad = 1;
				ST.mainSlider.imgReady();
			}
		}
		
		if(/bannerHideScreen/.test(nowScreenType)){
			if(this.rightAsideIsLoad == 0){
				this.rightAsideIsLoad = 1;
				ST.leftSmallSlider.sliderReady();
			}
			if(this.mainContentImgIsLoad == 0){
				this.mainContentImgIsLoad = 1;
				ST.mainSlider.imgReady();
			}
		}
		
		if(/rightAsideHideScreen/.test(nowScreenType)){
			if(this.mainContentImgIsLoad == 0){
				this.mainContentImgIsLoad = 1;
				ST.mainSlider.imgReady();
			}
		}
		
		if(/mainContentImgHideScreen/.test(nowScreenType)){
			
		}
	},
	'judgeType': function(){
		var isIndex = $('.mainBody').hasClass('indexOne');
		if(typeof(window.getComputedStyle) === 'function' && Modernizr.csstransforms3d){
			ST.setResponsive.runNow(isIndex);
			$(window).resize(function(){
				ST.setResponsive.runNow(isIndex);
			})
		}else{
			if(isIndex == 1){
				ST.oldBigSlider.animateReady();
			}
			ST.leftSmallSlider.sliderReady();
			ST.mainSlider.imgReady();
		}
	}
}
	