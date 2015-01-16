

ST.newBigSlider = {
	'animateNow': function(judge,timeout){
		if(this.animating == 0){
			this.animating = 1;//judge status
			var aDomList = $('#fullImgBox a');
			var imgLen = aDomList.length;
			var halfImgLeft = $('#halfImgLeft');
			var halfImgRight = $('#halfImgRight');
			var nextIndex = "";
			var imgIndexArray = "";
			var leftImgSrc = "";
			var rightImgSrc = "";
			var zIndexArray = "";
			var contentBox = $('#bigSliderBoxContent .contentBox');
			
			var nowIndex = $('#fullImgBox img:visible').parent().index();//save the one which visible
			
			if(judge == true){//next
				zIndexArray = new Array(2,0);
				if(nowIndex == imgLen-1){
					nextIndex = 0;
				}else{
					nextIndex = nowIndex+1;
				}
				imgIndexArray = new Array(nowIndex,nextIndex);
			}else{//prev
				zIndexArray = new Array(0,2);
				if(nowIndex == 0){
					nextIndex = imgLen-1;
				}else{
					nextIndex = nowIndex-1;
				}
				imgIndexArray = new Array(nextIndex,nowIndex);
			}
			
			leftImgSrc = aDomList.eq(imgIndexArray[0]).children().attr('src');
			rightImgSrc = aDomList.eq(imgIndexArray[1]).children().attr('src');
			halfImgLeft.css({'background': 'url('+ leftImgSrc +') no-repeat top left', 'zIndex': zIndexArray[0]});
			halfImgRight.css({'background': 'url('+ rightImgSrc +') no-repeat top right', 'zIndex': zIndexArray[1]});
			aDomList.eq(nowIndex).children().attr('class','edgeToMiddle');
			setTimeout(function(){
				halfImgLeft.css('zIndex',zIndexArray[1]);
				halfImgRight.css('zIndex',zIndexArray[0]);
				aDomList.eq(nowIndex).children().attr('class','middle');
				aDomList.eq(nextIndex).children().attr('class','middleToEdge');
				contentBox.hide('slow').eq(nextIndex).show('slow');
				setTimeout(function(){
					aDomList.eq(nextIndex).children().attr('class','edge');
					halfImgLeft.css('zIndex','0');
					halfImgRight.css('zIndex','0');
					ST.newBigSlider.animating = 0;
				},2000)
			},2000);
			
			
		}
		if(timeout == true){
			this.defaultTimeout = setTimeout(function(){
				ST.newBigSlider.animateNow(true,true);
			},8000);
		}
	},
	'animating': 0,
	'defaultTimeout': '',
	'btnAnimate': function(){
		var sliderBtn = $('#bigSliderBox div.btn');
		sliderBtn.fadeOut('slow');
		setTimeout(function(){
			sliderBtn.fadeIn('slow');
		},3000);
	},
	'moveSetTimeout': '',
	'animateReady': function(){
		var newImgNum = 0;
		var aDomList = $('#fullImgBox a');
		var imgLen = aDomList.length;
		$('#fullImgBox img').each(function(i){
			var imgDom = $(this);
			var imgLoad = new Image();
			$(imgLoad).load(function(){
				imgDom.attr('src',$(this).attr('src'));
				if(i == 0){
					imgDom.attr('class','edge');
				}else{
					imgDom.attr('class','middle');
				}
			});
			$(imgLoad).attr('src',$(this).attr('_src'));
			newImgNum++;
		});
		if(newImgNum == imgLen){
			this.moveSetTimeout = setTimeout(function(){
				ST.newBigSlider.animateNow(true,true);
			},2000);
			
			$('#prev').click(function(){
				if(ST.newBigSlider.animating == 0){
					ST.newBigSlider.btnAnimate();
					ST.newBigSlider.animateNow(false);
				}
			});
			
			$('#next').click(function(){
				if(ST.newBigSlider.animating == 0){
					ST.newBigSlider.btnAnimate();
					ST.newBigSlider.animateNow(true);
				}
			});
			
			$('#bannerBox').hover(function(){
				if(ST.newBigSlider.animating == 1){
					clearTimeout(ST.newBigSlider.defaultTimeout);
				}
				clearTimeout(ST.newBigSlider.moveSetTimeout);
			},function(){
				ST.newBigSlider.moveSetTimeout = setTimeout(function(){
					ST.newBigSlider.animateNow(true,true);
				},2000);
			});
		}
	}
	
}


ST.oldBigSlider = {
	'oldNowIndex': '',
	'animateNowSetTimeout': '',
	'animateNow': function(){
		var oldNextIndex = "";
		var contentBox = $('#bigSliderBoxContent .contentBox');
		var oldADomList = $('#fullImgBox a');
		var oldALen = oldADomList.length;
		this.oldNowIndex = $('#fullImgBox img:visible').parent().index();
		oldNextIndex = this.oldNowIndex + 1;
		if(oldNextIndex >= oldALen){
			oldNextIndex = 0;
		}
		ST.oldBigSlider.btnChange(oldNextIndex);
		oldADomList.eq(ST.oldBigSlider.oldNowIndex).children().stop().fadeOut('slow',function(){
			oldADomList.eq(oldNextIndex).children().fadeIn('slow');
			contentBox.hide('slow');
			contentBox.eq(oldNextIndex).show('slow',function(){
			});
		});
		ST.oldBigSlider.animateNowSetTimeout = setTimeout(function(){	
			ST.oldBigSlider.animateNow();
		},5000);
	},
	'animatBtnFn': function(btnDom){
		var contentBox = $('#bigSliderBoxContent .contentBox');
		var oldBtnIndex = "";
		var oldADomList = $('#fullImgBox a');
		this.oldNowIndex = $('#fullImgBox img:visible').parent().index();
		oldBtnIndex = btnDom.parent().index();
		ST.oldBigSlider.btnChange(oldBtnIndex);
		contentBox.eq(ST.oldBigSlider.oldNowIndex).stop().hide('fast',function(){
			contentBox.eq(oldBtnIndex).show('fast');
		});
		oldADomList.eq(ST.oldBigSlider.oldNowIndex).children().stop().fadeOut('fast',function(){
			oldADomList.eq(oldBtnIndex).children().fadeIn('fast',function(){
			});
		});
	},
	'btnChange': function(_oldNextIndex){
		var oldAnimatBtn = $('#oldAnimatBtn');
		oldAnimatBtn.find('li').removeClass('active');
		oldAnimatBtn.find('li').eq(_oldNextIndex).addClass('active');
		
	},
	'animateReady': function(){
		var oldADomList = $('#fullImgBox a');
		var oldALen = oldADomList.length;
		var oldAnimatBtns = "";
		var oldAnimatBtn = $('#oldAnimatBtn');
		var oldImgNum = 0;
		$('#fullImgBox img').each(function(i){
			var imgDom = $(this);
			var imgLoad = new Image();
			$(imgLoad).load(function(){
				imgDom.attr('src',$(this).attr('src'));
				if(i == 0){
					imgDom.show();
				}else{
					imgDom.hide();
				}
			});	
			$(imgLoad).attr('src',$(this).attr('_src'));
			oldAnimatBtns += "<li><a href='javascript:;'>"+ oldImgNum +"</a></li>";
			oldImgNum++;
		});
		if(oldImgNum == oldALen){
			oldAnimatBtn.append(oldAnimatBtns).show();
			oldAnimatBtn.children().first().addClass("active");
			ST.oldBigSlider.animateNowSetTimeout = setTimeout(function(){
				ST.oldBigSlider.animateNow()
			},3000);
			$('#bigSliderBox div.btn').hide();
			oldAnimatBtn.find('a').hover(function(){
				clearTimeout(ST.oldBigSlider.animateNowSetTimeout);
				//var _this = $(this);
				ST.oldBigSlider.animatBtnFn($(this));
			},function(){
				ST.oldBigSlider.animateNowSetTimeout = setTimeout(function(){
					ST.oldBigSlider.animateNow()
				},5000);
			});
		}
	}
}














