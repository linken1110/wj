function queryByPage (src,totalPage){
		var page = document.getElementById("pageInput").value;
		if(src == '' || src=='null'){
			alert("查询URL不能为空"+src);
			return ;
		}
		if(page.trim()== '' || isNaN(page)){
			alert("请输入数字");
			return ;
		}
		if(page>totalPage){
			alert("您输入的页数大于总页数");
			return;
		}
		window.location.href=src+page;
	}
function queryPOST(){
	var form = $("#queryForm");
	
	
}