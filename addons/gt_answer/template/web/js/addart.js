var opts = {
	type :'image',
	direct : false,
	multiple : true,
	tabs : {
		'upload' : 'active',
		'browser' : '',
		'crawler' : ''
	},
	path : '',
	dest_dir : '',
	global : false,
	thumb : false,
	width : 0
};
UE.registerUI('myinsertimage',function(editor,uiName){
	editor.registerCommand(uiName, {
		execCommand:function(){
			require(['fileUploader'], function(uploader){
				uploader.show(function(imgs){
					if (imgs.length == 0) {
						return;
					} else if (imgs.length == 1) {
						editor.execCommand('insertimage', {
							'src' : imgs[0]['url'],
							'_src' : imgs[0]['attachment'],
							'width' : '100%',
							'alt' : imgs[0].filename
						});
					} else {
						var imglist = [];
						for (i in imgs) {
							imglist.push({
								'src' : imgs[i]['url'],
								'_src' : imgs[i]['attachment'],
								'width' : '100%',
								'alt' : imgs[i].filename
							});
						}
						editor.execCommand('insertimage', imglist);
					}
				}, opts);
			});
		}
	});
	var btn = new UE.ui.Button({
		name: '插入图片',
		title: '插入图片',
		cssRules :'background-position: -726px -77px',
		onclick:function () {
			editor.execCommand(uiName);
		}
	});
	editor.addListener('selectionchange', function () {
		var state = editor.queryCommandState(uiName);
		if (state == -1) {
			btn.setDisabled(true);
			btn.setChecked(false);
		} else {
			btn.setDisabled(false);
			btn.setChecked(state);
		}
	});
	return btn;
}, 19);
UE.registerUI('myinsertvideo',function(editor,uiName){
	editor.registerCommand(uiName, {
		execCommand:function(){
			require(['fileUploader'], function(uploader){
				uploader.show(function(video){
					if (!video) {
						return;
					} else {
						var videoType = video.isRemote ? 'iframe' : 'video';
						editor.execCommand('insertvideo', {
							'url' : video.url,
							'width' : 300,
							'height' : 200
						}, videoType);
					}
				}, {type : 'video', allowUploadVideo : 'true'});
			});
		}
	});
	var btn = new UE.ui.Button({
		name: '插入视频',
		title: '插入视频',
		cssRules :'background-position: -320px -20px',
		onclick:function () {
			editor.execCommand(uiName);
		}
	});
	editor.addListener('selectionchange', function () {
		var state = editor.queryCommandState(uiName);
		if (state == -1) {
			btn.setDisabled(true);
			btn.setChecked(false);
		} else {
			btn.setDisabled(false);
			btn.setChecked(state);
		}
	});
	return btn;
}, 20);



var myyapp = angular.module('myyapp',['ng.ueditor','ui.sortable']);
myyapp.controller('ctr',['$scope',function($scope){
	
	$scope.modules = [
		{
			name : 'slide',
			title : '幻灯片',
			params : {
				ischange : 0,
				changetime : 3,
				changelast : 500,
				pointcolor : '#dddddd',
				actcolor : '#585656',
				showpoint : 0,
				data : [
					{
						id : '00000001',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/stemp.png',
						type : 'url',
					}
				]
			}
		},
		{
			name : 'nav',
			title : '导航',
			params : {
				num : 4,
				radius : 0,
				padding : 5,
				bgcolor : '#ffffff',
				fontcolor : '#000',
				data : [
					{
						id : '00000001',
						title : '导航名称',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
						type : 'url',
						url : ''
					},
					{
						id : '00000002',
						title : '导航名称',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
						type : 'url',
						url : ''
					},
					{
						id : '00000003',
						title : '导航名称',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
						type : 'url',
						url : ''
					},
					{
						id : '00000004',
						title : '导航名称',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
						type : 'url',
						url : ''
					},
					{
						id : '00000005',
						title : '导航名称',
						img: window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
						type : 'url',
						url : ''
					},																		
				]
			}
		},
		{
			name : 'image',
			title : '图片',
			params : {
				padding : 1,
				type : 1,
				istext : 0,
				fontsize : 14,
				fontcolor : '#333',
				bgcolor : '#fff',
				data : [
					{
						id : '00000001',
						img : window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/stemp.png',
						url : '',
						title : '',
						type : 'url',
					}
				]

			}
		},
		{
			name : 'card',
			title : '卡片',
			params : {
				margin : 5,
				bgcolor : '#ffffff',
				ishead : 0,
				isbot : 0,
				headsize : 14,
				headcontent : '卡头',
				headcolor : '#333',
				headalign : 'center',

				botcontent : '卡尾',
				botcolor : '#333',
				botsize : 14,
				botalign : 'center',

				content : '卡片内容',
				fontsize : 14,
			}
		},
		{
			name : 'list',
			title : '列表',
			params : {
				bgcolor : '#ffffff',
				color : '#333',
				titlesize : 14,
				descsize : 14,
				padding : 5,
				data : [
					{
						id : '00000001',
						img : window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/stemp.png',
						type : 'url',
						url : '',
						title : '',
						desc : '',
					}
				]
			}
		},			
		{
			name : 'text',
			title : '富文本',
			params : {
				bgcolor : '#ffffff',
				margin : 0,
				padding : 5,
				content : '请输入内容'
			}
		},
		{
			name : 'space',
			title : '空白',
			params : {
				height : '10',
				bgcolor : '#f3f4f5'
			}
		},
		{
			name : 'title',
			title : '标题',
			params : {
				content : '标题内容',
				paddingv : '10',
				paddingh : '10',
				bgcolor : '#ffffff',
				color : '#333',
				size : 14,
				pos : 'left',
				lefticon : 0,
				leftimg : '',
				lwidth : 20,

				righticon : 0,
				rightimg : '',
				rwidth : 20,
				type : 'url',
				url : '',
			}
		},
		{
			name : 'newstitle',
			title : '新闻头',
			params : {
				padding : '10',
				size : 18,
				bgcolor : '#ffffff',
				color2 : '#999',
				color : '#333',
				content : '请修改标题',
				time : new Date().getFullYear() +'-'+ new Date().getMonth() +'-'+ new Date().getDate(),
				author : ''
			}
		},
		{
			name : 'form',
			title : '表单',
			params : {
				bgcolor : '#ffffff',
				padding : 5,
				btnbg : '#ed414a',
				btncolor : '#fff',
				data : [
					{
						id : '00000001',
						type : 'input',
						name : '名称',
						pla : '',
						ismust : 0, // 0是必须填写
					}
				]
			}
		},
		{
			name : 'video',
			title : '视频',
			params : {
				bgcolor : '#ffffff',
				padding : 5,
				url : '',
				type : 1,
				isauto : 0,
			}
		},
		{
			name : 'btn',
			title : '按钮',
			params : {
				mbg : '#ffffff',
				padding : 0,
				bgcolor : '#ed414a',
				color : '#ffffff',
				height : 40,
				width : 90,
				size  : 14,
				radius : 2,
				type : 'url',
				text : '按钮',
			}
		},
		{
			name : 'fix',
			title : '悬浮',
			params : {
				img : window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/thank.png',
				mbg : 'rgba(255, 255, 255, 0)',
				padding : 0,
				height : 50,
				width : 50,
				type : 'url',
				top : 40,
				right : 0,
			}
		},
		{
			name : 'article',
			title : '文章列表',
			params : {
				title : '行业新闻',
				botfont : '更多内容',
				bgcolor : '#ffffff',
				paddingv : 10,
				paddings : 10,
				topcolor : '#44b549',
				topsize : 20,
				botcolor : '#44b549',
				botbord : '#44b549',
				titlecolor : '#333333',
				timecolor : '#8c8c8c',
			}
		},
		{
			name : 'webview',
			title : '网页容器',
			params : {
				url : '',
			}
		},		
				
	];


	$scope.otherurl = [
		{title:'查看表单数据',url:'/zofui_sitetemp/pages/form/form'},
		{title:'文章列表',url:'/zofui_sitetemp/pages/artlist/artlist'}
	];


	$scope.params = page && page.params ? page.params : {}; // 初始数据
	
	if( page && page.params ){
	    angular.forEach($scope.params.data,function(m,i){
	       	if(m.name == 'text'){
	        	m.params.content = decodeURIComponent(m.params.content);
	        }
	    })
	}

	$scope.focus = {
		id : '00000000',
		name : 'basic'
	};
	
	$scope.article = article;
	$scope.allsort = allsort;
	$scope.op = op;

	$scope.items = page && page.params ? page.params.data : [];
	$scope.basic =  page && page.params ? page.params.basic : {
		id:'0000000',
		name : '',
		title : '',
		sharetitle : '',
		shareimg : '',
		isbar : 0,
		topbg : '#ffffff',
		topcolor : '#000000',
	};


	$scope.selectType = function(type){
		if(type == 1){
			$scope.params.arttype = 1;
		}else{
			$scope.params.arttype = 2;
			var newitem = $.extend(true,{},$scope.imgmodule);
			$scope.items.push(newitem);
			$scope.imgfocus = '00000001'; // 图片组默认焦点
		}
		$scope.params.isselect = 1;
	};

	$scope.imageType = function( tid,type ){

	    angular.forEach($scope.items, function(obj){
	        if(obj.id== tid){

	            var nowlength = obj.params.data.length;
	            var diff = type - nowlength;
	            obj.params.type = type;
	            if( diff > 0 ) {
	            	for (var i = 0; i < diff; i++) {
	            		var mid = 'm'+i+new Date().getTime();
						obj.params.data.push({
							id : mid,
							img : window.sysinfo.siteroot+'/addons/zofui_sitetemp/public/images/stemp.png',
							type : 'url',
							url : '',
							title : '',
						})
	            	}
	            	
	            	console.log( $scope.items );
	            }else if( diff < 0 ){
	            	for (var i = -diff; i > 0; i--) {
	            		obj.params.data.splice(i,1);
	            	}
	            }
	            return false;
	        }
	    });
	};

	$scope.addForm = function( id,type ){

		angular.forEach($scope.items, function(obj){
			if( obj.id == id ) {
        		var mid = 'm'+ new Date().getTime();
				obj.params.data.push({
					id : mid,
					type : type,
					name : '名称',
					pla : '',
					data : [],
				})
			}
		});
	};

	$scope.addFormIn = function(id,iid){

		angular.forEach($scope.items, function(obj){
			if( obj.id == id ) {
        		
				angular.forEach(obj.params.data, function(objin){
					if( objin.id == iid ) {
		        		var fid = 'f'+ new Date().getTime();
						objin.data.push(
							{id : fid,name : ''}
						);
		        		
					}
				});				
			}
		});
	};


	$scope.deleteFormIn = function(id,iid,fid){
		angular.forEach($scope.items, function(obj){
			if( obj.id == id ) {
				angular.forEach(obj.params.data, function(obji){
					if( obji.id == iid ) {
						angular.forEach(obji.data, function(objf,f){
							if( objf.id == fid ) {
				        		obji.data.splice(f,1);
							}
						});
					}
				});				
			}
		});
	}

	// 保存数据
	$scope.issaving = false;
	$scope.saveData = function(){
		if($scope.issaving) return false;
		
        var arr = [];
        $(".view_item,.view_item_fix").each(function(i) {
            arr[i] = $(this).attr('viewid');
        });
        var newarr = [];
        angular.forEach(arr, function(aid){
        	
            angular.forEach($scope.items, function(obj){
                if(obj.id== aid){
                	var newdata = $.extend(true,{},obj);
                    newarr.push( newdata );
                    return false;
                }
            });
        });
		

        angular.forEach(newarr,function(m,i){
        	if(m.name == 'text'){
        		m.params.content = encodeURIComponent(m.params.content);
        	}
        })
        
		var items = angular.toJson(newarr);
		var basic = angular.toJson($scope.basic);
		$scope.issaving = true;
        $.ajax({
            type: 'POST',
            dataType : 'json',
            url: window.sysinfo.siteroot + '/web/index.php?c=site&a=entry&op=savepage&do=ajax&m=zofui_sitetemp',
            data: {data : items,basic : basic,tid : tempid,id : page && page.id ? page.id : 0 },
            success: function(data){
                if(data.status == 200){
                    alert("已保存！");
					if( op == 'add' ) location.href = window.sysinfo.siteroot + '/web/index.php?c=site&a=entry&op=list&do=page&m=zofui_sitetemp'+'&tid='+tempid;
            	}else{
                    alert("保存失败");
                }
            },
            error: function(){
                alert('保存失败请重试,如果站点设置了cdn加速可能被cdn拦截了。');
            },
            complete : function(){
            	$scope.issaving = false;
            }
        })
	}

	$scope.changeS = function(type,s){
		if(type == 'status') $scope.mystatus = s;
		if(type == 'top') $scope.mytop = s;
	}


	$scope.addGoodImages = function(){
		var newitem = $.extend(true,{},$scope.imgmodule);
		newitem.id = 'i'+ new Date().getTime();
		$scope.items.push(newitem);
		$scope.imgfocus = newitem.id;
		$scope.getFocus('00000002');
	};

	$scope.seturltype = 'page';
	$scope.pagetype = function( type ){
		$scope.seturltype = type;
	}

	// 导入页面
	$scope.isloaded = false;
	$scope.loadpagelist = [];
	$scope.loadpage = function(){
		if( $scope.loadpagelist.length <= 0 ) {
			Http('post','json','loadpagelist',{},function(data){
				if( data.obj.length > 0 ){
					$scope.loadpagelist = data.obj;
				}
				$scope.$apply();
			},true);
		}
		$('.my_model[loadpage]').show();
	};

	// 选择页面
	$scope.loadPageByid = function( id ){

		if( confirm('此功能是将以前设计的页面导入，可进行编辑添加页面，确定导入页面吗？') ) {
			location.href = window.sysinfo.siteroot + '/web/index.php?c=site&a=entry&op=add&do=page&m=zofui_sitetemp'+'&tid='+tempid + '&lid='+id ;
		}

	};

	// 设置链接
	$scope.setlinkiid = 0;
	$scope.setlinkdid = 0;
	$scope.allpage = null;
	$scope.allapp = null;
	$scope.allnews = null;
	$scope.urltype = '';
	$scope.showLink = function(itemid,dataid,type){
		$scope.urltype = type;
		$scope.setlinkiid = itemid;
		if( dataid ) {
			$scope.setlinkdid = dataid;
		}else{
			$scope.setlinkdid = 0; // 来自第一级的设为0
		}

		if( !$scope.allpage && type == 'my' ) {
			Http('post','json','getlink',{tid : tempid},function(data){
				//webAlert(data.res);
				if( data.obj.page.length > 0 ){
					$scope.allpage = data.obj.page;
				}
				if( data.obj.news.length > 0 ){
					$scope.allnews = data.obj.news;
				}				
				$scope.$apply();
			},true);
		}

		// 小程序链接
		if( !$scope.allapp && type == 'app' ) {
			Http('post','json','getapp',{tid : tempid},function(data){
				//webAlert(data.res);
				if( data.obj.length > 0 ){
					$scope.allapp = data.obj;
				}
				$scope.$apply();
			},true);
		}

		$('.my_model[url]').show();
	};


	$scope.setLink = function(url,name){
	    angular.forEach($scope.items, function(m) {
	        if(m.id == $scope.setlinkiid){

	        	if( $scope.setlinkdid ) {
				    angular.forEach(m.params.data, function(n) {
				        if(n.id == $scope.setlinkdid){

				            n.url = url;
				            n.urlname = name;
				            return false;
				        }
				    }); 
	        	}else{
		            m.params.url = url;
		            m.params.urlname = name;
		            return false;
	        	}
	        }
	    }); 
		$('.my_model[url]').hide();
	};	

	// 其他小程序链接
	$scope.setotherLink = function(item,initem){
	    angular.forEach($scope.items, function(m) {
	        if(m.id == $scope.setlinkiid){

	        	if( $scope.setlinkdid ) {
				    angular.forEach(m.params.data, function(n) {
				        if(n.id == $scope.setlinkdid){

				            n.appid = item.appid;
				            n.appurl = initem.url;
				            return false;
				        }
				    }); 
	        	}else{
		            m.params.appid = item.appid;
		            m.params.appurl = initem.url;
		            return false;
	        	}
	        }
	    }); 
		$('.my_model[url]').hide();
	};


    $scope.ismap = false;
    $scope.lng = 0;
    $scope.lat = 0;
    $scope.mapaid = -1;
    $scope.mapdid = -1;

    $scope.showMap = function(aid,did){
        $scope.mapaid = aid;
        $scope.mapdid = did;
        //$scope.lng = $scope.lat = 0;

        if( !$scope.ismap ) {
            $scope.ismap = true;
            var map = new qq.maps.Map(document.getElementById("map"), {
                center: new qq.maps.LatLng(39.916527,116.397128),
                zoom:11,
                disableDefaultUI: true
            });
            //获取城市列表接口设置中心点
            citylocation = new qq.maps.CityService({
                complete : function(result){
                    map.setCenter(result.detail.latLng);
                }
            });
            //调用searchLocalCity();方法    根据用户IP查询城市信息。
            citylocation.searchLocalCity();

            // 点击
            var markers = [];
            qq.maps.event.addListener(map, 'click', function(e) {
                if( markers ) clearOverlays( markers );
                var pointer = new qq.maps.LatLng(e.latLng.lat,e.latLng.lng);
                var marker = new qq.maps.Marker({
                    position: pointer,
                    map: map,
                    animation: qq.maps.MarkerAnimation.BOUNCE
                });

                markers.push( marker );

                $scope.lng = e.latLng.lng;
                $scope.lat = e.latLng.lat;             
            });

            // 检索
            var latlngBounds = new qq.maps.LatLngBounds();
            //调用Poi检索类
            searchService = new qq.maps.SearchService({
                complete : function(results){

                    var pois = results.detail.pois;

                    if( pois && pois.length > 0 ) {

                        for(var i = 0,l = pois.length;i < l; i++){
                            var poi = pois[i];
                            latlngBounds.extend(poi.latLng);  
                            var marker = new qq.maps.Marker({
                                map:map,
                                position: poi.latLng
                            });
                            marker.setTitle(i+1);
                            markers.push(marker);
                        }
                        map.fitBounds(latlngBounds);
                    }else{
                        alert('没有找到');
                    }
                }
            });

            //清除地图上的marker
            function clearOverlays(overlays){
                if( !overlays ) return;
                var overlay;
                while(overlay = overlays.pop()){
                    overlay.setMap(null);
                }
            }

            geocoder = new qq.maps.Geocoder({
                complete : function(result){
                    console.log( result );
                    map.setCenter(result.detail.location);

                    clearOverlays(markers);
                    searchService.setLocation( result.detail.addressComponents.city );

                    var keyword = document.getElementById("searaddress").value;
                    searchService.search(keyword);

                }
            });


            $('#find_address').click(function(){
                var p = map.getCenter();
                var latLng = new qq.maps.LatLng(p.lat, p.lng);
                geocoder.getAddress(latLng);                
            });

        }

        $('.my_model[map]').show();
    }

    $scope.setLocation = function(){
        if( $scope.lng <= 0 || $scope.lat <= 0 || $scope.mapindex < 0 ) {
            webAlert('请先点击选择坐标');return false;
        }
        
        angular.forEach($scope.items, function(m){
        	if( m.id == $scope.mapaid ) {
        		
        		if( $scope.mapdid > 0 ) {
		            angular.forEach(m.params.data, function(n){
		                if(n.id== $scope.mapdid){
        					n.lng = $scope.lng;
        					n.lat = $scope.lat;
		                }
		            });
        		}else{
        		console.log( m,$scope.lng,$scope.lat );	
        			m.params.lng = $scope.lng;
        			m.params.lat = $scope.lat;
        		}
        	}
        });

        $scope.mapaid = -1;
        $scope.mapdid = -1;

        $('.my_model[map]').hide();
    };

	// 上传图片
    $scope.uploadImage = function(id,type){
        require(['jquery', 'util'], function($, util){
            util.image('',function(data){
            	if(type == 'shareimg'){
            		$scope.basic.shareimg = data['url'];

            	}else if(type == 'goodimg'){
            		id.img = data['url'];
            	}else{
	                var items = $scope.items;
	                angular.forEach(items, function(m,index) {
	                    if(m.id == id){
	                        m.params[type] = data['url'];
	                    }
	                }); 
            	}
				//处理图片后重置焦点到当前模块
				$scope.$apply();
                //$("div[viewid="+id+"]").trigger("click");
            });
        });
    };

    $scope.sortableOptions = function(){
        $scope.sortableOptions = {
            update: function(e, ui) {
                console.log("update",e,ui);
                //需要使用延时方法，否则会输出原始数据的顺序，可能是BUG？
                $timeout(function() {
                    var resArr = [];
                    /*for (var i = 0; i < $scope.data.length; i++) {
                        resArr.push($scope.data[i].i);
                    }*/
                })
            },

            // 完成拖拽动作
            stop: function(e, ui) {
                console.log( 'end' );
            }
        }
    }


   	$scope.getFocus = function(id){
		$scope.focus.id = id;

		if($scope.params.arttype == 2 && id == '00000002'){
			height = 400;
		}else{
			var $this = $('div[viewid='+id+']');
       		var height = $this.offset().top;
		}

        var starttop = $('.my_article_box').offset().top;
        $('.portable_editor').css('margin-top',height-starttop-10);
   };

   $scope.addgood = function(good){
   		var id = 'g'+new Date().getTime();
   		var newgood = $.extend(true,{},$scope.modules[0].params.data[0]);
   		//console.log(newgood)
   		newgood.id = id;
   		good.push(newgood);
   };



   	$scope.deleteItem = function(pid,cid){
   		if(cid == 'images'){
	   		angular.forEach($scope.items,function(m,i){
	   			if(pid == m.id){
	   				if($scope.items.length <= 1){
	   					alert('至少一张图片');
	   					return false;
	   				}
	   				$scope.items.splice(i,1);
	   				if(i == 0){
	   					$scope.imgfocus = $scope.items[0].id; // 焦点
	   				}else{
	   					$scope.imgfocus = $scope.items[i-1].id; // 焦点
	   				}
	   				
	   			}
	   		})
   		}else{
	   		angular.forEach($scope.items,function(m,i){
	   			if(m.id == pid){
	   				angular.forEach(m.params.data,function(cm,ci){
	   					if(cm.id == cid){
	   						m.params.data.splice(ci,1);
	   						if(m.params.data.length <= 0){
	   							$scope.items.splice(i,1);
	   						}
	   						return false;
	   					}
	   				})
	   				return false;
	   			}
	   		}) 			
   		}

   	};
  
   $scope.delItem = function(id,e){
   		e.stopPropagation();
   		if(confirm('确定要删除吗？')){
   			angular.forEach($scope.items,function(m,i){
   				if(m.id == id){
   					$scope.items.splice(i,1);
   					$scope.focus.id = '';
   					return false;
   				}
   			})
   		}
   		return false;
   };


   $scope.move = function(id){
   		$this = $('.view_item');
            $this.off("mousedown").mousedown(function(e) {
                if(e.which != 1 || $(e.target).is("textarea") || window.downing) return;
                var _this = $(this);
                e.preventDefault();
                e.stopPropagation();
                var x = e.pageX;
                var y = e.pageY;
                var w = _this.width();
                var h = _this.height();
                var w2 = w/2;
                var h2 = h/2;
                var left = _this.position().left;
                var top = _this.position().top;
                window.downing = true;

                _this.before('<div id="holder"></div>');
                var wid = $("#holder");

                wid.css({"border":"2px dashed #ccc", "height" : _this.outerHeight(true)});
               _this.css({"width":w, "height":h, "position":"absolute", opacity: 0.8, "z-index": 900, "left":left, "top":top});
                 $('body').mousemove(function(e) {
                    e.preventDefault();
                    var l = left + e.pageX - x;
                    var t = top + e.pageY - y;
                    _this.css({"left":l, "top":t});
                    var ml = l+w2;
                    var mt = t+h2;
                    _this.siblings().not(_this).not(wid).each(function(i) {
                    	
                        var obj = $(this);
                        var a1 = obj.position().left;
                        var a2 = obj.position().left + obj.width();
                        var a3 = obj.position().top;
                        var a4 = obj.position().top + obj.height();
                        if(a1 < ml && ml < a2 && a3 < mt && mt < a4) {
                            if(!obj.next("#holder").length) {
                                wid.insertAfter(this);
                            }else{
                                wid.insertBefore(this);
                            }
                            return;
                        }
                    });
                });
                $('body').mouseup(function() {
                	
                	$('body').off('mouseup').off('mousemove');
                    $('.mobile_body').each(function() {
                        var obj = $(this).children();
                        var len = obj.length;
                        if(len == 1 && obj.is(_this)) {
                            $("<div></div>").appendTo(this).attr("class", "kp_widget_block").css({"height":100});
                        }
                        else if(len == 2 && obj.is(".kp_widget_block")){
                            $(this).children(".kp_widget_block").remove();
                        }
                    });
                    var p = wid.position();
                    _this.animate({"left":p.left, "top":p.top}, 100, function() {
                        _this.removeAttr("style");
                        wid.replaceWith(_this);
                        window.downing = null;
                        /*var arr = [];
                        $(".view_item").each(function(i) {
                        	
                            arr[i] = $(this).attr('viewid');
                        });
                        var newarr = [];

                    	//var nowitem = $.extend(true,{},scope.items)
                        angular.forEach(arr, function(aid){
                            angular.forEach($scope.items, function(obj){
                                if(obj.id== aid){
                                    newarr.push(obj);
                                    return false;
                                }
                            });
                        });

                        $scope.items = newarr;*/
                    });
                });
            });
   }



}])
.directive('viewDelete',function(){
	return {
		restrict : 'A',
		link : function(scope,elem,attr){
			$(elem).on('mouseover',function(e){
				$(elem).next().show();
				e.stopPropagation();
			})
			$(elem).on('mouseleave',function(e){
				$(elem).next().hide();
				e.stopPropagation();
			})			
		}
	}
})
.directive('addModule',function($timeout){
	return {
		restrict : 'A',
		link : function(scope,elem,attr){
			$(elem).on('click',function(){

				if( (scope.items.length > 0 && attr.name == 'webview') || ( scope.items[0] && scope.items[0].name == 'webview') ){
					webAlert('网页容器只能有一个，而且不能与其他元素同时存在');return false;
				}

				angular.forEach(scope.modules,function(m){
					if(m.name == attr.name){
						
						var mid = 'm'+new Date().getTime();
						var tempobj = $.extend(true,{},m);
						
						var newitem = {id:mid,name:tempobj.name,params:tempobj.params};
						var index = -1;
						angular.forEach(scope.items,function(m,i){
							if(m.id == scope.focus.id){
								index = i;
								return false;
							}
						})
						
						scope.items.splice(index+1,0,newitem);
						
						
						scope.$apply();
						$('div[viewid='+mid+']').trigger('click');
						return false;
					}
				})
			})
		}
	}
})
.directive('stringHtml' , function(){
    return function(scope , el , attr){
        if(attr.stringHtml){
            scope.$watch(attr.stringHtml , function(html){
                el.html(html || '');
            });
        }
    };
})
.directive('mySlider',function(){
	return {
		restrict : 'A',
		link : function(scope,elem,attr){
			require(['jquery.ui'],function(){	
					$(elem).slider({
						min: parseInt( attr.min, 10 ),
						max: parseInt( attr.max, 10 ),
						value : parseInt( attr.value, 10 ) ? parseInt( attr.value, 10 ) : 0,
						slide : function(event,ui){
							if(attr.type == 2){
								scope.image[attr.name] = ui.value;
							}else{
								scope.item.params[attr.name] = ui.value;	
							}
							scope.$apply();	
						}
					});
			});
		}
	}
})
.directive("myDatePicker", function() {
        var a = {
            transclude: !0,
            template: "<span ng-transclude></span>",
            scope: {
                dateValue: "=myDateValue"
            },
            link: function(a, c, d) {	
                var e = {
                    lang: "zh",
                    step: "30",
                    format: "Y-m-d H:i:s",
                    closeOnDateSelect: !0,
                    onSelectDate: function(b, c) {
                        a.dateValue = b.dateFormat("Y-m-d H:i:s"), a.$apply("dateValue")
                    },
                    onSelectTime: function(b, c) {
                        a.dateValue = b.dateFormat("Y-m-d H:i:s"), a.$apply("dateValue")
                    }
                };
                require(['datetimepicker'], function() {
                	$(c).datetimepicker(e);
                });
            }
        };
    	return a
})
.directive('timeDesc',function($timeout){
	return {
		restrict : 'A',
		link :function(scope,elem,attr){
			setInterval(function(){
					var date = new Date();
					var time = date.getTime();  //当前时间距1970年1月1日之间的毫秒数 
					var timestr = attr.time;
					var endTime = timestr.replace(/-/g,'/'); 
					var endTime = new Date(endTime).getTime(); //结束时间字符串	
					var lag = (endTime - time); //当前时间和结束时间之间的秒数	
					if(lag > 0){
						var second = Math.floor(lag/1000%60);     
						var minite = Math.floor(lag/1000/60%60);
						var hour = Math.floor(lag/1000/60/60%24);
						var day = Math.floor(lag/1000/60/60/24);
						second = second.toString().length == 2 ? second : '0'+second;
						minite = minite.toString().length == 2 ? minite : '0'+minite;
						hour = hour.toString().length == 2 ? hour : '0'+hour;
						day = day.toString().length == 2 ? day : '0'+day;
					}else{
						var second = '00';
						var minite = '00';
						var hour = '00';
						var day = '00';
					}
					$(elem).find('.day').text(day);
					$(elem).find('.hour').text(hour);
					$(elem).find('.minite').text(minite);
					$(elem).find('.second').text(second);
			},1000)	
		}
	}
})
.directive('onSelected', function ($timeout) {
    return {
        restrict: 'A',
        scope : {
        	style : '=ngModel'
        },
        link: function (scope, elem, attr) {
        	
    		var v = scope.style ? scope.style : 0;
            if(v == $(elem).val()){
            	$(elem).parent().addClass('selected');
            }

        }
    }
})
.directive('onSelectSort', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, elem, attr) {
        	if( scope.$last ){
        		//console.log( attr )	
        	}
           	
        }
    }
})
.directive('onFinishRender',['$timeout', '$parse', function ($timeout, $parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
        	

            if (scope.$last === true) {
        		
            	$('.dsadasda').each(function(){
            		var _this = $(this);
            		console.log( _this.attr('model') );
            		if( _this.attr('model') == _this.attr('value') ){

            			_this.parent().addClass('selected');
            		}
            	});
            }
        }
    }
}])
.directive('squareImage',function(){
    return {
        restrict: 'A',
        link: function (scope, elem, attr) {
        	var img = $(elem).find('img');
        	img.height(img.width());
        }
    }
});
