/**
 -------------------------------------------	
 *  Version    1.0                         |
 *  Autor      v-yao                       |
 *  QQ         281310716@qq.com            | 
 *  Date       2014-01-09                  |
 *  web        http://www.chinacoder.cn    | 
 -------------------------------------------
 *  {OPTIONS} |  [type]  |(default And Example)  | Explanation  
 *  --------- | -------- |---------------------|-----------------------------------------
 *  @doArea   | [string] | 必选   , '#ajaxbox' | Ajax操作区域 ID选择器 #ajaxbox 必须唯一 
 *  @getArea  | [string] | 不必须 , '#content' | 默认为''              见下说明
 *  @type     | [string] | 不必须 , 'click'    | 默认为'click'         见下说明
 *  @url      | [string] | 不必须 , 'href'     | 默认为a标签'href'     见下说明
 *  @className| [string] | 不必须 ,            | 默认为'yao-ajax-yes'  见下说明
 *  @imgPath  | [string] | 不必须 ,            | 默认为''              见下说明
 *  notice： 浏览器url变化和后退前进的history部分需要h5支持  不支持 此方面功能无效
 */
(function($){
	//默认参数对象值
    var defaults = {
		doArea:'',           //必须参数  Ajax所要操作的容器
		getArea:'',          //可选参数  请求的地址输出的有效区域的内容 若不填则 输出urlPath的整个页面 一般情况下  请求的是后端数据形式的 不需要填写  若后端输出的是页面 填写去掉公共html部分
		type:'click',        //可选参数  默认为click  绑定的事件
		url:'href',          //可选参数  当前元素下 存放请求地址的标签 默认为href 若为其他 请设置其他标签 存放请求url
		className:'yao-ajax-yes',//可选参数 用于标记class 也可用其标记 当前选中
		imgPath:''		         //可选参数  用于等待提示图片链接 一般为gjf 默认为空 仅文字提示
	};

	//初始化对象
    var settings = {},
		History = window.history;

    $.fn.ajaxLoad = function(options){

		var self = this;//当前

		//对象合并 并加入settings中
		$.extend(settings, defaults, options );

		var Y = {
			ready:function(){
				$(self).live(settings.type, Y.ajaxLoad);//绑定事件 
				Y.windowLoad();
			},
			doLoad:function(url){
				$(settings.doArea).fadeOut("fast");
				Y.waitStart();//提示开始
				var willUrl = url;
				if(settings.getArea != ''){
					willUrl = willUrl + " " + settings.getArea;
				}
				setTimeout(function(){//等待 fadeOut 完成执行
					$(settings.doArea).load(
						willUrl,
						Y.success
					);
				},200);
			},
			ajaxLoad:function(e){
				e.preventDefault();
				var thisSelf = this;//当前

				//防止同意连接重复点击  并且加入class后  前端易于区分当前链接
				if($(thisSelf).hasClass(settings.className) === true){
					return;
				}
				var url = $(thisSelf).attr(settings.url);
				Y.doLoad(url);

				//成功后处理
				$(self).removeClass(settings.className);
				$(thisSelf).addClass(settings.className);
				
				if(!$.browser.msie){//如果是ie浏览器 不支持h5 则弃用此功能
					//将连接地址 加入浏览器history中
					//notice: 浏览器支持h5 才可实现 
					var state = {
						title: document.title,
						url: url
					};
					History.pushState(state, null, url);
				}
			},
			windowLoad:function(){
				//绑定浏览器前进后退 实现ajax无刷新页面 链接变化且可以后退前进 
				//notice: 浏览器支持html5 才可实现
				if(!$.browser.msie){//如果是ie浏览器 不支持h5 弃用此功能
					window.addEventListener('popstate', function(e){
						if(e.state){
							var backUrl = e.state.url;//获取已存入的url
							Y.doLoad(backUrl);//做载入动作
						}
					}, false);
				}
			},
			waitStart:function(){
				Y.waitEnd();
				var left = $(settings.doArea).offset().left + $(settings.doArea).width() / 2 - 64;//提示框left值
				var top = $(settings.doArea).offset().top + $(settings.doArea).height() / 2 - 100;//提示框top值
				var isImg = settings.imgPath == '' ? '' : '<div style="height:15px;width: auto;margin-top:10px;background:url(\''+settings.imgPath+'\');"></div>';	
				$('body').append('<div id="yao-loading" style="position:fixed; z-index:9999;top: '+top+'px;left:'+left+'px;font-weight: bold;margin-top: 20px;width: 128px;height: 15px;text-align:center;">加载中...'+isImg+'</div>');
			},
			waitEnd:function(){
				$("#yao-loading").remove();
			},
			success:function(){
				Y.waitEnd();//提示结束
				$(settings.doArea).fadeIn();//淡入
			}
		};
		Y.ready();
    }	
})(jQuery);