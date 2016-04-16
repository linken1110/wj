function edit_survey(id){
	$.ajax({
                        type: 'POST',
                        url: "/survey_result/get_status",
                        data: {id:id},
                        dataType: 'json',
                        success: function(data){
				if(data['result'] == 0){
					window.location.href='/main/survey_detail?id='+id;
				}else{
					alert('上线的问卷不能编辑');
				}
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
}
function get_return_page(id){
	for(var i=0;i<list.length;i++){
		if(list[i].number == id){
			return list[i].page_index;
		}
	}
}
function add_result(survey_id){
	
	question_and_answer = "";
         $(".question").each(function(){
			answer = "";
			type= $(this).attr('type') ;
                        id = $(this).attr('data-id') ;
                        num  = "answer_"+id;
			if(type == 2){
                        	answer = $("input[name='"+num+"']:checked").val();
			}else if(type == 1 || type == 4){
				answer = $("input[name='"+num+"']").val();
			}else if(type ==3){
				$("input[name='"+num+"']:checked").each(function(){
					var tmp = $(this).val();
					answer = answer+tmp+",";
				});
			}
                        if (typeof(answer)=="undefined"){
                                answer = "";
                        }
                        question_and_answer = question_and_answer + id +":" +answer+"||";
                });
	if(confirm("确定提交吗？")){
		$.ajax({
                        type: 'POST',
                        url: "/survey_result/add_result",
                        data: {question_and_answer:question_and_answer,survey_id:survey_id},
                        dataType: 'json',
                        success: function(result){
				window.location.href="/survey_result/home_list?survey_id="+survey_id;
                        }
                });
	}
	
}
function copy_survey(id){
	if(confirm("确定要复制该问卷吗？")){
		$.ajax({
                        type: 'POST',
                        url: "/main/copy_survey",
                        data: {survey_id:id},
                        dataType: 'json',
                        success: function(result){
				alert('复制成功');
                        }
                });
	
	}
}
function save_survey_result(home_id){
	question_and_answer = "";
	 $(".question").each(function(){
			answer = "";
			type= $(this).attr('type') ;
                        id = $(this).attr('data-id') ;
			num  = "answer_"+id;
			if(type == 2){
                                answer = $("input[name='"+num+"']:checked").val();
                        }else if(type == 1 || type == 4){
                                answer = $("input[name='"+num+"']").val();
                        }else if(type ==3){
                                $("input[name='"+num+"']:checked").each(function(){
                                        var tmp = $(this).val();
                                        answer = answer+tmp+",";
                                });
                        }
			if (typeof(answer)=="undefined"){
				answer = "";
			}
			question_and_answer = question_and_answer + id +":" +answer+"||";
                });
	if(confirm("确定保存修改吗？")){
		$.ajax({
                        type: 'POST',
                        url: "/survey_result/update_question_result",
                        data: {question_and_answer:question_and_answer,home_id:home_id},
                        dataType: 'json',
                        success: function(result){
				if(result['result']){
                                $("#save_message").html('保存成功');
                                $("#save_message").show();
                        	}
                        	else{
                                $("#save_message").html('保存失败');
                                $("#save_message").show();
                        	}
				setTimeout(function(){$("#save_message").hide();},2000);
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
	}
	
}
function change_result_status(id,status){
	var str ="";
	if(status == 1){
		str ="确定审核通过吗？"
	}else{
		str ="确定审核不通过吗？"
	}
	if(confirm(str)){
         $.ajax({
                        type: 'POST',
                        url: "/survey_result/update_result_status",
                        data: {id:id,status:status},
                        dataType: 'json',
                        success: function(result){
                                window.location.reload();
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
	}
}
function change_status_and_flush(survey_id){
	if(confirm("确定要更新状态吗？")){
         $.ajax({
                        type: 'POST',
                        url: "/main/update_status",
                        data: {survey_id:survey_id},
                        dataType: 'json',
                        success: function(result){
				window.location.reload();
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
	}
}
function change_audio_status(survey_id){
        if(confirm("确定要更新状态吗？")){
         $.ajax({
                        type: 'POST',
                        url: "/main/update_audio",
                        data: {survey_id:survey_id},
                        dataType: 'json',
                        success: function(result){
                                window.location.reload();
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
        }
}

function change_status(survey_id){
if(confirm("确定要更新状态吗？")){
	 $.ajax({
                        type: 'POST',
                        url: "/main/update_status",
                        data: {survey_id:survey_id},
                        dataType: 'json',
                        success: function(result){
                                if(result['result'] ){
					if(result['status'] == 1){
						$("#survey_"+survey_id+" .status_col").find('a').html("<i class='status ico ico_green_circle'></i>已上线");
					}else{
						$("#survey_"+survey_id+" .status_col").find('a').html("<i class='status ico ico_red_circle'></i>未上线");
					}
                                }
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });
}
}
function delete_survey(survey_id){
	
	if(confirm("确定要删除该问卷吗？")){
                $.ajax({
                        type: 'POST',
                        url: "/main/delete_survey",
                        data: {survey_id:survey_id},
                        dataType: 'json',
                        success: function(result){
                                if(result['result'] ){
					$("#survey_"+survey_id).remove();
                                }
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
                });

        }
}
function change_page(e){
 	       
         page = $(e).attr('data-pid');
                $(".pages_end").removeClass("current");
                $(e).addClass("current").siblings().removeClass("current");
                $(".page").each(function(){
                        if($(this).attr('data-pid') == page){
                                $(this).show().addClass("current");
				
                        }else{
                                $(this).hide().removeClass("current");
                        }
                        $(".survey_suffix").hide();
                        $("#questions").show();
                        $(".survey_title").show();
                });
}
function delete_page(e){
	page = $(e).attr('data-pid');
	if(confirm("确定要删除吗？")){
		$.ajax({
        	        type: 'POST',
               		url: "/question/delete_page_ajax",
                	data: {page:page,survey_id:survey_id},
                	dataType: 'json',
                	success: function(result){
                        	if(result['result'] ){
                                $("#question_"+result['id']).parent().remove();
                                restore();
                        	}
                	},
                	error: function(){
                        	alert('Error loading PHP document');

                	}
	        });

		$(e).parent().remove();
	}
}
function restore(){
        var num = 1;    
        $(".question").each(function(){
                
               $(this).find('.question_index').html(num);
                num++;
        });
}
function save_survey(){
	name =$("#survey_name").val();
	description = $("#survey_description").val();

         $.ajax({
                type: 'POST',
                url: "/main/update_survey",
                data: {name:name,description:description,id:survey_id},
                dataType: 'json',
                success: function(result){
                        if(result['result']){
                                $("#save_message").html('保存成功');
                                $("#save_message").show();
                        }                       
                        else{
                                $("#save_message").html('保存失败');
                                $("#save_message").show();
                        }
                        setTimeout(function(){$("#save_message").hide();},2000); 
                },
                error: function(){
                        alert('Error loading PHP document');

                } 
        }); 
}
function change_type(e){
        var type = e.options[e.options.selectedIndex].value;
        if(type == 1){
                $(".editor_adv").show();
                $(".editor_options").hide();
        }else if(type ==2 || type == 3){
                $(".editor_adv").hide();
                $(".editor_options").show();
        }
}
function cancel(id){
        $("#question_"+id).show();
        $("#question_edit_"+id).remove();
        edit_flag = false;    
}
function cancel_add(){
	$("#question_edit").remove();
	edit_flag = false;
}
function remove_option(e){
        e.parentNode.remove();
}
function add_option(e){
        var $obj = $(e);
        $obj.prev().append('<li class="option_item " data-id="o-100-ABCD" data-display="" data-goto=""> <span class="handle"></span>  <input type="checkbox" disabled="">  <div class="option_input_wrap">  <input  type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:570px" class="options"></div> </div> <a href="javascript:;" class="btn btn_del btn_del_option" id="btn_del_option" onclick="remove_option(this)">×</a> </li>');
}
function save(id){
        var default_value = $("#mydefault_"+id).val();
        var question = $("#myquestion_"+id).val(); 
        var type = $("#myquestion_type_"+id).val(); 
	var required = $("#question_required").is(':checked')?1:0;
	var count = $("#count").val();
        var option_list = "";
        var num = 1;
        var $obj = $("#question_edit_"+id);
        $obj.find('li.option_item').find('.options').each(function(){
                var content = $(this).val();
                option_list = option_list + num +":" +content +";";
                num++;
        });

        $.ajax({
                type: 'POST',
                url: "/question/update_ajax",
                data: {id:id,question:question,type:type,default:default_value,option_list:option_list,required:required,count:count},
                dataType: 'json',
                success: function(result){
                        window.location.reload();
                                return;
                        if(result['result']){
                                $("#question_"+result['question'].id).find('p').html(result['question'].question);
                                $("#text_"+result['question'].id).val(result['question'].default);
                        }
                        $("#question_"+result['question'].id).show();
                        $("#question_edit_"+result['question'].id).remove();
                        edit_flag = false;    
                                        
                },
                error: function(){
                        alert('Error loading PHP document');

                } 
        });   

}
function add(){
	var default_value = $("#mydefault").val();
        var question = $("#myquestion").val();
        var type = $("#myquestion_type").val();
	var count = $("#count").val();
	var required = $("#question_required").is(':checked');
        var option_list = "";
        var num = 1;
        var $obj = $("#question_edit");
        $('.options').each(function(){
                var content = $(this).val();
                option_list = option_list + num +":" +content +";";
                num++;
        });
	edit_flag = false;
         $.ajax({
                type: 'POST',
                url: "/question/add_ajax",
                data: {survey_id:survey_id,question:question,type:type,default_value:default_value,option_list:option_list,page:page,required:required,count:count},
                dataType: 'json',
                success: function(result){
	str ='<div class="modules">';
	if(type == 1 || type == 4){
                                str = str +'<div class="question question_text required"';
                        }else if(type == 2){
                                str = str +'<div class="question question_radio required"';
                        }else if(type == 3){
                                str = str +'<div class="question question_radio required"';
                        }
	str = str + 'data-type="text" id="question_'+result['id']+'" data-id="2"> <div class="inner"> <div class="title"> <span class="title_index"><span class="question_index" data-for="2">'+question_num+'</span>. </span> <div class="title_text"> <p>'+question+'</p></div>  <span class="required" title="必答" style="display: none;">*</span><span class="tips">  </span> </div><div class="inputs" style="margin-top:10px;"> ';
	if(type == 1 || type == 4){
		str = str + '<input class="survey_form_input" type="text" size="" maxlength="" id="text_2" name="answer_2" value="'+default_value+'" placeholder="默认值">';
	}else if(type == 2){
		$('.options').each(function(){
                	var content = $(this).val();
			str = str +' <div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" name="answer_" data-oid="o-100-ABCD" id="option_o-100-ABCD" value="<p>'+content+'</p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p>'+content+'</p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>';
		});
	}else if(type == 3){
		 $('.options').each(function(){
                        var content = $(this).val();
                        str = str +' <div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="checkbox" name="answer_" data-oid="o-100-ABCD" id="option_o-100-ABCD" value="<p>'+content+'</p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p>'+content+'</p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>';
                });
	}
			
		str = str +'</div> </div> <ul class="control"> <li><b title="编辑" class="edit" onclick="edit('+result['id']+');"><i></i></b></li> <li><b title="设置逻辑" class="logic" onclick="show_logic('+result['id']+');"><i></i></b></li> <li><b title="删除" class="delete" onclick="delete_item('+result['id']+');"><i></i></b></li>  </ul></div></div>';
        	$(".page.current").append(str);
		 $("#question_edit").remove();
		question_num ++;
		update_list();
                },
                error: function(){
                        alert('Error loading PHP document');

                }
        });

}
function delete_item(id){
	if(confirm("确定要删除吗？")){
	 $.ajax({
                type: 'POST',
                url: "/question/delete_question_ajax",
                data: {id:id},
                dataType: 'json',
                success: function(result){
			if(result['result'] ){
				if(result['count'] > 0){
				$("#question_"+result['id']).parent().remove();
				restore();
				}else{
					 window.location.reload();
				}
			}
                },
                error: function(){
                        alert('Error loading PHP document');

                }
        });

	$("#question_"+id).parent().remove();
	}
}
function edit(id){
	var question = $("#question_"+id+" .title_text").find('p').html();
	var default_value = "";
	type =1;
        if(edit_flag){
                return;
        }
/*	var str ='<div class="editor_question" style="position: relative; left: 0px;" id = "question_edit_'+ id+'">';
                        if(type == 1 || type == 4){
                                str = str +'<div class="inner text">';
                        }else if(type == 2){
                                str = str +'<div class="inner radio">';
                        }else if(type == 3){
                                str = str +'<div class="inner checkbox">';
                        }
			str = str +' <div class="row editor_title" style="margin-top:20px;"> <label class="row_title">问题标题</label> <div class="row_content"> <div placeholder="问题标题" contenteditable="true" class="question_title mod_editor inline_editor cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_448" style="position: relative;"><p id="myquestion_'+id+'">'+question+'</p></div> </div> </div> ';
                        str = str +' <div class="row editor_title" style="margin-top:20px;"> <label class="row_title">默认值</label> <div class="row_content"> <div placeholde="问题标题" contenteditable="true" class="question_title mod_editor inline_editor cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_448" style="position: relative;"><p id="mydefault_'+id+'">'+"默认值"+'</p></div> </div> </div> ';
                        str = str +'<div class="row editor_type"> <label class="row_title">问题切换</label> <div class="row_content"> <select class= "select" id="myquestion_type_'+id+'" onchange="change_type(this);"> <option value="2"';
			 if(type == 2){
                                str = str +'selected';
                         }
                        str = str +'>单选题</option> <option value="3" ';
                         if(type == 3){
                                str = str +'selected';
                         }
                        str = str + '>多选题</option> <option value="4"';
                        if(type == 4){
                                str = str +'selected';
                         }
                        str = str + '>位置题</option> <option value="1"';
                        if(type == 1){
                                str = str +'selected';
                        }
                        str = str + '>填空题</option>  </select> <label><input name="question_required" type="checkbox" checked="">必填</label> </div> </div>';
                        if(type == 1){
                                str = str + '<div class="row editor_adv" style="display:block;">';
                        }else{
                                str = str + '<div class="row editor_adv" style="display:none;">';
                        }
                        str = str +'<label>最多填写 <input class="maxlength editor_input number_input" type="number" min="1" name="maxlength" value=""> 字 </label> <label>文>本验证 <select name="validate"> <option selected="" value="">不限</option> <option value="number">数字</option> <option value="date">日期（2014-01-01）</option> <option value="email">电子邮箱</option> <option value="chinese">中文</option> <option value="english">英文</option> <option value="url">网址</option> <option value="idCard">身份证号码</option> <option value="qq">QQ号</option> <option value="mobile">手机号码(仅支持大陆地区)</option> <option value="phone">电话号码</option> </select> </label> </div>';
                        if(type == 2 || type == 3){
                                str = str + '<div class="row editor_options">';
                        }
                        else{
                                str = str + '<div class="row editor_options" style="display:none;">';
                        }
			str = str +'<ul id = "options_list" class="options_list"> <ul class="normal_options_list">';
			 str = str + '</ul><li class="option_item option_create" onclick="add_option(this)"> <div class="option_input_wrap"> <span class="add_option">>新建选项</span> </div> </li></ul></div>';

                        str = str +'<div class="row editor_control"> <a href="javascript:;" id="editor_confirm_btn" class="btn btn_small btn_blue btn_confirm" onclick="save('
+id+')">确定</a> <a href="javascript:;" id="editor_cancel_btn" class="btn btn_small btn_white btn_cancel" onclick="cancel('+id+')">取消</a> </div>';
                        $("#question_"+id).after(str);
                        $("#question_"+id).hide();
                        edit_flag = true;
  */
       $.ajax({
                type: 'POST',
                url: "/question/get_question_detail",
                data: {id:id},
                success: function(result){
                        var str ='<div class="editor_question" style="position: relative; left: 0px;" id = "question_edit_'+ result['id']+'">';
                        if(result['type'] == 1 || result['type'] == 4){
                                str = str +'<div class="inner text">';
                        }else if(result['type'] == 2){
                                str = str +'<div class="inner radio">';
                        }else if(result['type'] == 3){
                                str = str +'<div class="inner checkbox">';
                        }
                    	 str = str +'<div class="row editor_title style="margin-top:20px;""> <label class="row_title">题目</label> <div class="row_content"> <input id= "myquestion_'+result['id']+'" type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:510px" value="'+result['question']+'"> </div> </div>';
                        str = str +'<div class="row editor_title style="margin-top:20px;""> <label class="row_title">默认值</label> <div class="row_content"> <input id= "mydefault_'+result['id']+'" type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:510px" value="'+result['default_value']+'"> </div> </div>';
			str = str +'<div class="row editor_type"> <label class="row_title">问题切换</label> <div class="row_content"> <select class= "select" id="myquestion_type_'+result['id']+'" onchange="change_type(this);"> <option value="2"';
                        if(result['type'] == 2){
                                str = str +'selected';  
                        }
                        str = str +'>单选题</option> <option value="3" ';
                        if(result['type'] == 3){
                                str = str +'selected';  
                        }
                        str = str + '>多选题</option> <option value="4"';
			if(result['type'] == 4){
                                str = str +'selected';  
                         }
                        str = str + '>位置题</option> <option value="1"';
                        if(result['type'] == 1){
                                str = str +'selected';  
                        }
			if(result['is_nessary'] == 1){
                        	str = str + '>填空题</option>  </select> <label><input id="question_required" name="question_required" type="checkbox" checked>必填</label>';
			}else{
				str = str + '>填空题</option>  </select> <label><input id="question_required" name="question_required" type="checkbox" >必填</label> ';
			}
			if(result['type'] == 3){
				str = str + '<label style="padding-left:20px;">最多可选项数<input id="count" name="count" type="text" value="'+result['count']+'" style="width:30px;"></label></div></div>';
                        }else{
                                str = str + '<input id="count" name="count" type="text" value="1"></div></div>';
                        }
                        if(result['type'] == 1){
                                str = str + '<div class="row editor_adv" style="display:block;">'; 
                        }else{
                                str = str + '<div class="row editor_adv" style="display:none;">'; 
                        }
                        str = str +'<label>最多填写 <input class="maxlength editor_input number_input" type="number" min="1" name="maxlength" value=""> 字 </label> <label>文>本验证 <select name="validate"> <option selected="" value="">不限</option> <option value="number">数字</option> <option value="date">日期（2014-01-01）</option> <option value="email">电子邮箱</option> <option value="chinese">中文</option> <option value="english">英文</option> <option value="url">网址</option> <option value="idCard">身份证号码</option> <option value="qq">QQ号</option> <option value="mobile">手机号码(仅支持大陆地区)</option> <option value="phone">电话号码</option> </select> </label> </div>';
                        if(result['type'] == 2 || result['type'] == 3){
                                str = str + '<div class="row editor_options">';
                        }
                        else{
                                str = str + '<div class="row editor_options" style="display:none;">';
                        }
                                str = str +'<ul id = "options_list" class="options_list"> <ul class="normal_options_list">';
                                result.option_list.forEach(function(e){  
					str = str+ '<li class="option_item " data-id="o-100-ABCD" data-display="" data-goto=""> <span class="handle"></span>  <input type="checkbox" disabled="">  <div class="option_input_wrap">  <input  type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:570px" class="options" value="'+e.content+'"> <a href="javascript:;" class="btn btn_del btn_del_option" id="btn_del_option" onclick="remove_option(this)">×</a></li>';
                                })              
                                str = str + '</ul><li class="option_item option_create" onclick="add_option(this)"> <div class="option_input_wrap"> <span class="add_option">新建选项</span> </div> </li></ul></div>'; 
        
                        str = str +'<div class="row editor_control"> <a href="javascript:;" id="editor_confirm_btn" class="btn btn_small btn_blue btn_confirm" onclick="save('+id+')">确定</a> <a href="javascript:;" id="editor_cancel_btn" class="btn btn_small btn_white btn_cancel" onclick="cancel('+id+')">取消</a> </div>';
                        $("#question_"+id).after(str);
                        $("#question_"+id).hide();
                        edit_flag = true;
		 } ,
                error: function(){
                        alert('Error loading PHP document');

                }, 
                dataType: 'json'
        });

}
function add_question(type){
	if(edit_flag){
		return;
	}
	var str ='<div class="modules" draggable="false" id = "question_edit"><div class="editor_question" style="position: relative; left: 0px;">';
                        if(type == 1 || type == 4){
                                str = str +'<div class="inner text">';
                        }else if(type == 2){
                                str = str +'<div class="inner radio">';
                        }else if(type == 3){
                                str = str +'<div class="inner checkbox">';
                        }
 //                       str = str +' <div class="row editor_title" style="margin-top:20px;"> <label class="row_title">问题标题</label> <div class="row_content"> <div placeholder="问题标题" contenteditable="true" class="question_title mod_editor inline_editor cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_448" style="position: relative;"><p id = "myquestion"></p></div> </div> </div> ';
 			str = str +'<div class="row editor_title style="margin-top:20px;""> <label class="row_title">题目</label> <div class="row_content"> <input id= "myquestion" type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:510px"> </div> </div>';
                        str = str +' <div class="row editor_title" style="margin-top:20px;"> <label class="row_title">默认值</label> <div class="row_content"> <input id = "mydefault" type="text" style="padding:0 10px;min-height:36px;line-height:36px;background:#fff;border:1px solid #e0e0e0;display:inline-block;*display:inline;*zoom:1 ;width:510px"></div> </div> ';
                        str = str +'<div class="row editor_type"> <label class="row_title">问题切换</label> <div class="row_content"> <select class= "select" id="myquestion_type" onchange="change_type(this);"> <option value="2"';
                         if(type == 2){
                                str = str +'selected';
                         }
                        str = str +'>单选题</option> <option value="3" ';
                         if(type == 3){
                                str = str +'selected';
                         }
                        str = str + '>多选题</option> <option value="4"';
                        if(type == 4){
                                str = str +'selected';
                         }
                        str = str + '>跳转题</option> <option value="1"';
                        if(type == 1){
                                str = str +'selected';
                        }
                        str = str + '>填空题</option>  </select> <label><input id="question_required" name="question_required" type="checkbox" checked="">必填</label>';
			if(type == 3){
                                str = str + '<label style="padding-left:20px;">最多可选项数<input id="count" name="count" type="text" value="" style="width:30px;"></label></div></div>';
                        }else{
                                str = str + '<input id="count" name="count" type="text" value="1"></div></div>';
                        }
                        if(type == 1){
                                str = str + '<div class="row editor_adv" style="display:block;">';
                        }else{
                                str = str + '<div class="row editor_adv" style="display:none;">';
                        }
                        str = str +'<label>最多填写 <input class="maxlength editor_input number_input" type="number" min="1" name="maxlength" value=""> 字 </label> <label>文本验证 <select name="validate"> <option selected="" value="">不限</option> <option value="number">数字</option> <option value="date">日期（2014-01-01）</option> <option value="email">电子邮箱</option> <option value="chinese">中文</option> <option value="english">英文</option> <option value="url">网址</option> <option value="idCard">身份证号码</option> <option value="qq">QQ号</option> <option value="mobile">手机号码(仅支持大陆地区)</option> <option value="phone">电话号码</option> </select> </label> </div>';
                        if(type == 2 || type == 3){
                                str = str + '<div class="row editor_options">';
                        }
                        else{
                                str = str + '<div class="row editor_options" style="display:none;">';
                        }
                                str = str +'<ul id = "options_list" class="options_list"> <ul class="normal_options_list">';
                                str = str + '</ul><li class="option_item option_create" onclick="add_option(this)"> <div class="option_input_wrap"> <span class="add_option">新建选项</span> </div> </li></ul></div>';

                        str = str +'<div class="row editor_control"> <a href="javascript:;" id="editor_confirm_btn" class="btn btn_small btn_blue btn_confirm" onclick="add()">确定</a> <a href="javascript:;" id="editor_cancel_btn" class="btn btn_small btn_white btn_cancel"onclick="cancel_add()">取消</a> </div></div>';
                        edit_flag = true;
			$(".page.current").prepend(str);
			window.location.hash = "#question_edit";
}
function get_question_detail(id){
	var result = '';
	list.forEach(function(e){  
   	 	if(e.id == id){
			result =  e;
		} 
	})  
	return result;
}
function show_logic(id){
	question = get_question_detail(id);
	str ='<div id="logic_dialog" tabindex="-1" style="position: absolute; display:none;outline: 0px; left: 304px; top: 0px; z-index: 1000002;" aria-labelledby="title:1445244384163" aria-describedby="content:1445244384163" class="ui-popup ui-popup-modal ui-popup-show ui-popup-focus" role="alertdialog"><div i="dialog" class="ui-dialog logic_setting_dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header"><button i="close" class="ui-dialog-close" title="取消" onclick="close_logic();">×</button><div i="title" class="ui-dialog-title" id="title:1445244384163">逻辑设置</div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1445244384163" style="width: 600px;"><div class="tabs">  <div class="tab current">跳转逻辑</div>   </div> <div class="panels">  <div class="options_panel panel current"> <div class="left_panel"> <div class="tip">当用户选择本题选项:</div> <ul> ';
	if(question.option_list){
		question.option_list.forEach(function(e){   
			str =str+'<li class="option" number ="'+e.number +'" return_id="'+e.return_id+'">'+e.number+'.'+e.content+'</li>';
       		})
	}
	str = str +' </ul> </div>  <div class="option_panel right_panel current"> <div class="display_logic"> <div class="tip">则显示以下题目:</div> <div class="goto_logic"> 跳转至: <select name="goto" id="goto" onchange="change_option()"><option value="0">默认</option>';
	list.forEach(function(e){   
		str = str +'<option value="'+e.number+'">第'+e.page_index+'页: '+e.question+'</option>';
	});
	str =str +'<option value="-1">结束页</option></select> </div> </div>  </div>  </div></td></tr><tr><td i="footer" class="ui-dialog-footer"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"><button type="button" i-id="cancel" onclick="close_logic();">取消</button><button type="button" i-id="ok" autofocus="" class="ui-dialog-autofocus" onclick="update_return_logic('+id+');">确定</button></div></td></tr></tbody></table></div></div>';
	$(document.body).append(str);
	 $(".option").click(function(e){
		return_id = $(this).attr('return_id');
                $(this).addClass("current").siblings().removeClass("current");
		$("#goto").val(return_id);
        });
	$("#logic_dialog").show();
}                      
function update_return_logic(id){
	option_list = "";
	$(".option").each(function(e){
		number = $(this).attr('number');
		return_id = $(this).attr('return_id');
		option_list = option_list + number +":" +return_id+";"
	});
	$("#logic_dialog").remove();
	$.ajax({
                        type: 'POST',
                        url: "/question/update_return_id",
                        data: {id:id,option_list:option_list},
                        dataType: 'json',
                        success: function(result){
				update_list();
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
         });
}       
function close_logic(){
	$("#logic_dialog").remove();

}
function change_option(){
	var value = $("#goto").val();
	$(".option").each(function(e){
		if($(this).hasClass('current')){
			$(this).attr('return_id',value);
		}
	});
}
function update_list(){
	$.ajax({
                        type: 'POST',
                        url: "/main/get_new_list",
                        data: {id:survey_id},
                        dataType: 'json',
                        success: function(result){
				list = eval("result['list']");
                        },
                        error: function(){
                                alert('Error loading PHP document');

                        }
         });
}
