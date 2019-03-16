/**
 * jquery.area.js
 * 移动端省市区三级联动选择插件
 * author: 锐不可挡
 * date: 2016-06-17
**/

/*定义三级省市区数据*/

/*初始化省份*/
function intProvince() {
	areaCont = "";
	for (var i=0; i<pcate.length; i++) {
		var p_cate=pcate[i].split(',');
		areaCont += '<li onClick="selectP(' + p_cate[0]+ ','+i+');">' + p_cate[1] + '</li>';
	}
	areaList.html(areaCont);
	$("#areaBox").scrollTop(0);
	$("#backUp").removeAttr("onClick").hide();
}


/*选择省份*/
function selectP(p,pname) {
	areaCont = "";
	areaList.html("");
	pid=p;

	pp_cate=pcate[pname].split(',');
	if(ccate[p]){
		for (var j=0; j<ccate[p].length; j++) {
			var c_cate=ccate[p][j].split(',');
			areaCont += '<li onClick="selectC(' +p+ ','+j+');">' + c_cate[1] + '</li>';
		}
		areaList.html(areaCont);
		$("#areaBox").scrollTop(0);
		expressArea = pp_cate[1] + " > ";

		$("#backUp").attr("onClick", "intProvince();").show();
	}else{
		expressArea = pp_cate[1];
		$("#art_tag").text(expressArea);
		clockArea();
	}
	
}

function selectC(p,c) {
	var ccates = ccate[p][c].split(',');
	cid=ccates[0];
	expressArea += ccates[1];
	$("#art_tag").text(expressArea);
	clockArea();
}



/*关闭省市区选项*/
function clockArea() {
	$("#areaMask").fadeOut();
	$("#areaLayer").animate({"bottom": "-100%"});
	intProvince();
}

