<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="http://localhost:8000/mytkp/Public/jquery-easyui-1.3.3/themes/bootstrap/easyui.css">
		<link type="text/css" rel="stylesheet" href="http://localhost:8000/mytkp/Public/jquery-easyui-1.3.3/themes/icon.css">
		<script type="text/javascript" src="http://localhost:8000/mytkp/Public/jquery-easyui-1.3.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost:8000/mytkp/Public/jquery-easyui-1.3.3/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="http://localhost:8000/mytkp/Public/jquery-easyui-1.3.3/locale/easyui-lang-zh_CN.js"></script>
		<style type="text/css">
        #tab{
	        width: 60%;
	        margin:auto;
	        margin-top:20px;
        }
        #tab tr{
            height:40px;	
        }
        </style>
		<script type="text/javascript">
		$(function(){
			$('#win').window('close');
			
			//创建的table
            $('#dg').datagrid({ 
    		    url:'http://localhost:8000/mytkp/index.php/Home/Class/loadClassMenu?pageNo=1&pageSize=10', 
    		    striped:true, 
    		    method:"get",
    		    fitColumns:true, 
    		    pagination:true, 
    		    rownumbers:true,
    		    frozenColumns:[[
                    {field:'check',checkbox:true}
    		    ]],
    		    columns:[[    
    		        {field:'classid',hidden:true},    
    		        {field:'name',title:'班级名称',width:100,align:'center'},    
    		        {field:'status',title:'班级状态',width:200,align:'center'},
    		        {field:'classtype',title:'班级类型',width:200,align:'center'},
    		        {field:'regtime',title:'创建时间',width:200,align:'center'}, 
    		        {field:'pno',title:'班级人数',width:200,align:'center'}, 
    		        {field:'header',title:'班主任',width:200,align:'center'}, 
    		        {field:'manager',title:'项目经理',width:200,align:'center'}, 
    		        {field:'starttime',title:'开班时间',width:200,align:'center'}, 
    		        {field:'endtime',title:'结业时间',width:200,align:'center'},
    		        {field:'mark',title:'备注',width:200,align:'center'} 
    		    ]],

    		    //table内的下拉列表/添加和删除按钮
    		    toolbar:'#tb'
    		    		        
    		}); 
    		
			//翻页功能/翻页工具
			var pager  = $("#dg").datagrid('getPager');
			
			pager.pagination({
				onSelectPage:function(pageNumber, pageSize){
					refreshData(pageNumber,pageSize);
				}
			});
		});

		//添加文件
		function saveOrUpdateMenu(){
			var menuid = $("#menuid").val();
			var name = $("#name").val();
			var url = $("#url").val();
			var parentid = $("#parentid").combo('getValue');
			var isshow = $("#isshow").combo('getValue');
			$.post('http://localhost:8000/mytkp/index.php/Home/Menu/saveOrUpdateMenu',{
				"menuid"	: menuid,
				"name"		: name,
				"url"		: url,
				"parentid"	: parentid,
				"isshow"	: isshow
			},function(data){
				if(data=="insertOK"){
					$.messager.alert('消息','添加成功！','info',function(){
    					refreshData(1,10);
    					$('#win').window('close');
    					$('#ff').form('reset'); 
					});
				}else if(data=="updateOK"){
					$.messager.alert('消息','修改成功！','info',function(){
    					refreshData(1,10);
    					$('#win').window('close');
    					$('#ff').form('reset');
					});
				}
			},"text");
		}


		function refreshData(pageNumber,pageSize){
			$("#dg").datagrid('loading');
    //			alert('pageNumber:'+pageNumber+',pageSize:'+pageSize);
    		$.getJSON("http://localhost:8000/mytkp/index.php/Home/Menu/loadTableMenu?pageNo="+pageNumber+"&pageSize="+pageSize+"&controller=MenuController&methodName=loadMenu",{},function(data){
    			$("#dg").datagrid('loadData',{
    				rows:data.rows,
    				total:data.total
    			});
    			var pager  = $("#dg").datagrid('getPager');
    			
    			pager.pagination({
    				pageSize:pageSize,
    				pageNumber:pageNumber
    			});
    			$("#dg").datagrid('loaded');
    		});
		}
		function searchClass(){
			$.post("http://localhost:8000/mytkp/index.php/Home/Class/loadClassMenu",{
				"pageNo":1,
				"pageSize":10,
				"className":$("#search-className").val(),
				"headerName":$("#search-headerName").val(),
				"managerName":$("#search-managerName").val(),
				"regtime1":$("#search-regtime1").datebox("getValue"),
				"regtime2":$("#search-regtime2").datebox("getValue"),
				"starttime1":$("#search-starttime1").datebox("getValue"),
				"starttime2":$("#search-starttime2").datebox("getValue"),
				"endtime1":$("#search-endtime1").datebox("getValue"),
				"endtime2":$("#search-endtime2").datebox("getValue"),
				"status":$("#search-staid").combo("getValue")
			},function(result){
				$("#dg").datagrid('loadData',{
					rows:result.rows,
					total:result.total
				});
			},"json");
		}
		//班级合并
		/*
		至少选中两个班级才能进行合并
		被选中的班级不能有考试，且状态必须全为正常
		*/
		function combineClass(){
			var selectedRow = $("#dg").datagrid("getSelections");
			if(selectedRow.length < 2){
				alert("请至少选择两个班级才能进行合并");
				return;
			}
			var b = true;
			for (var i=0;i<selectedRow.length;i++){
				if(selectedRow[i].status != "正常"){
					b = false;
					break;
				}
			}
			if(!b){
				alert("对不起,所选班级状态必须全为正常");
				return;
			}
			//获取已选中的班级id
			var cids = new Array();
			var options = new Array();
			options.push({name:"请选择合并后的班级名称",classid:"-1"});
			for(var i=0;i<selectedRow.length;i++){
				cids.push(selectedRow[i].classid);
				options.push({name:selectedRow[i].name,classid:selectedRow[i].classid});
			}
			$.post("http://localhost:8000/mytkp/index.php/Home/Class/checkExamToday",{"cids":cids.join(",")},
			function(data){
				if(data == "OK"){
					//打开合并窗口
					$("#combineClassid").combobox({
						valueField: 'classid',
						textField: 'name',
						data:options,
						value:"-1"
					});
					$('#win').window('open');
					$("#combineHeaderid").combobox({
						url:"http://localhost:8000/mytkp/index.php/Home/User/loadHeader",
						valueField: 'uid',
						textField: 'truename',
						data:options,
						value:"-1"
					});
					$("#combineManagerid").combobox({
						url:"http://localhost:8000/mytkp/index.php/Home/User/loadManager",
						valueField: 'uid',
						textField: 'truename',
						data:options,
						value:"-1"
					});
				}else{
					alert(data);
				}
			},"text");
		}
		function hebingClasses(){
			var classids = new Array();
			var selectedRow = $("#dg").datagrid("getSelections");
			for(var i=0;i<selectedRow.length;i++){
				classids.push(selectedRow[i].classid);
			}
			$.post("http://localhost:8000/mytkp/index.php/Home/Class/hebingClasses",{
				"classids":classids.join(","),
				"combineClassid":$("#combineClassid").combo("getValue"),
				"combineHeaderid":$("#combineHeaderid").combo("getValue"),
				"combineManagerid":$("#combineManagerid").combo("getValue")
			},function(data){
				$('#win').window('close');
				alert("班级合并成功");
				$("#dg").datagrid('loadData',{
					rows:data.rows,
					total:data.total
				});
			},"json");
		}
		</script>
	</head>
	<body>
		<div id="tb">
			<form>
				<table id="tab">
        			<tr>
        				<td align="right"><label for="search-className">班级名称:</label></td>
        				<td><input  class="easyui-validatebox" type="text" id="search-className" placeholder="请输入班级名称"/></td>
        				<td align="right"><label for="search-headerName">班主任:</label></td>
        				<td><input id="search-headerName" class="easyui-validatebox"></td>
        				<td align="right"><label for="search-managerName">项目经理:</label></td>
        				<td><input id="search-managerName" class="easyui-validatebox"></td>
        			</tr>
        			<tr>
        				<td align="right"><label for="search-regtime">创建时间:</label></td>
        				<td>
        					<select id="search-regtime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="search-regtime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="search-starttime">开始时间:</label></td>
        				<td>
        					<select id="search-starttime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="search-starttime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="endtime">结业时间:</label></td>
        				<td>
        					<select id="search-endtime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="search-endtime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="staid">班级状态:</label></td>
        				<td>
        					<select id="search-staid" style="width:150px;" class="easyui-combobox">
	        					<option value="-1">请选择</option>
	        					<option value="1">正常</option>
	        					<option value="2">结业</option>
	        					<option value="3">合并</option>
	        					<option value="4">已废除</option>
        					</select>
    					</td>
        				<td align="center" colspan="2">
        					<a id="btn" href="javascript:searchClass();" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true">搜索</a>
        					<a id="btn" href="javascript:combineClass();" class="easyui-linkbutton" data-options="iconCls:'icon-combine',plain:true">合并</a>
        				</td>
        			</tr>
        		</table>  
			</form>
		</div>
		<!--  
		<div>
			<form id="ff" method="post"> 
        		<input type="hidden" id="classid" name="classid"/>
        		<table id="tab">
        			<tr>
        				<td align="right"><label for="className">班级名称:</label></td>
        				<td><input  class="easyui-validatebox" type="text" id="className" name="className" data-options="" placeholder="请输入班级名称"/></td>
        				<td align="right"><label for="headerName">班主任:</label></td>
        				<td><input id="headerName" name="headerName" class="easyui-validatebox"></td>
        				<td align="right"><label for="managerName">项目经理:</label></td>
        				<td><input id="managerName" name="managerName" class="easyui-validatebox"></td>
        			</tr>
        			<tr>
        				<td align="right"><label for="regtime">创建时间:</label></td>
        				<td>
        					<select id="regtime1" name="regtime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="regtime2" name="regtime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="starttime">开始时间:</label></td>
        				<td>
        					<select id="starttime1" name="starttime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="starttime2" name="starttime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="endtime">结业时间:</label></td>
        				<td>
        					<select id="endtime1" name="endtime1" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
    					<td>至
        					<select id="endtime2" name="endtime2" style="width:150px;" class="easyui-datebox">
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="right"><label for="staid">班级状态:</label></td>
        				<td>
        					<select id="staid" name="staid" style="width:150px;" class="easyui-combobox">
	        					<option value="1">正常</option>
	        					<option value="2">结业</option>
	        					<option value="3">合并</option>
	        					<option value="4">已废除</option>
        					</select>
    					</td>
        				<td align="center" colspan="2">
        					<a id="btn" href="javascript:searchClass();" class="easyui-linkbutton" data-options="iconCls:'icon-search'">搜索</a>
        				</td>
        			</tr>
        		</table>  
            </form> 
		
		</div>-->
		<table id="dg">
			
		</table>
		<!-- 
		<div id="win" class="easyui-window" title="添加菜单" style="width:600px;height:400px"   
        	data-options="iconCls:'icon-add2',modal:true,collapsible:false,minimizable:false,maximizable:false,resizable:false">   
        	
        	<form id="ff" method="post"> 
        		<input type="hidden" id="classid" name="classid"/>
        		<table id="tab">
        			<tr>
        				<td align="right"><label for="name">班级名称:</label></td>
        				<td><input class="easyui-validatebox" type="text" id="name" name="name" data-options="required:true" placeholder="请输入菜单名称"/></td>
        			</tr>
        			<tr>
        				<td align="right"><label for="url">菜单URL:</label></td>
        				<td><input class="easyui-validatebox" type="text" id="url" name="url" data-options=""  placeholder="若添加非最低级菜单,此项可不填"/></td>
        			</tr>
        			<tr>
        				<td align="right"><label for="parentid">父级菜单:</label></td>
        				<td><input id="parentid" name="parentid"></td>
        			</tr>
        			<tr>
        				<td align="right"><label for="isshow">是否展示:</label></td>
        				<td>
        					<select id="isshow" name="isshow" style="width:150px;" class="easyui-combobox">
        						<option value=1>展示</option>
        						<option value=0>隐藏</option>
        					</select>
    					</td>
        			</tr>
        			<tr>
        				<td align="center" colspan="2">
        					<a id="btn" href="javascript:saveOrUpdateMenu();" class="easyui-linkbutton" data-options="iconCls:'icon-submit'">提交</a>
        				</td>
        			</tr>
        		</table>  
            </form> 
        </div> -->
        <div id="win" class="easyui-window" title="合并班级" style="width:600px;height:400px"   
        	data-options="iconCls:'icon-add2',modal:true,collapsible:false,minimizable:false,maximizable:false,resizable:false">   
        	
        	<form id="ff" method="post"> 
        		<input type="hidden" id="cid" name="cid"/>
        		<table id="tab">
        			<tr>
        				<td align="right"><label>合并后班级名称:</label></td>
        				<td><input id="combineClassid" class="easyui-combobox"/></td>
        			</tr>
        			<tr>
        				<td align="right"><label>合并后班主任名称:</label></td>
        				<td><input id="combineHeaderid" class="easyui-combobox"/></td>
        			</tr>
        			<tr>
        				<td align="right"><label>合并后项目经理名称:</label></td>
        				<td><input id="combineManagerid" class="easyui-combobox"></td>
        			</tr>
        			<tr>
        				<td>
        					<a id="btn" href="javascript:hebingClasses();" class="easyui-linkbutton" data-options="iconCls:'icon-combine'">提交</a>
        				</td>
        			</tr>
        		</table>  
            </form> 
        	        
        </div> 
	</body>
</html>