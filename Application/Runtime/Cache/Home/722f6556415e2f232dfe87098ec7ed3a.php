<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		模板<br/>
		<?php echo ($aaa); ?><br/>
		<?php echo ($arr["0"]); ?>---<?php echo ($arr[1]); ?>---<?php echo ($arr["2"]); ?><br/>
		<?php echo ($_SERVER['HTTP_USER_AGENT']); ?><br/>
		<?php echo (md5($str)); ?><br/>
		<?php echo ($i+$j); ?><br/>
		<table border="1" bordercolor="blue" width="100%" cellspace="0">
			<tr>
				<td>班级id</td>
				<td>班级名称</td>
				<td>状态</td>
				<td>类型</td>
				<td>创建时间</td>
				<td>人数</td>
				<td>班主任</td>
				<td>管理员</td>
				<td>开始时间</td>
				<td>结束时间</td>
				<td>备注</td>
			</tr>
			<!-- 
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$msg" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?>第<?php echo ($i); ?>次循环的索引为<?php echo ($key); ?>
				<?php if(($mod) == "0"): ?><tr style="background-color:green;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td>
							<?php if($class["staid"] == 1): ?>正常
							<?php elseif($class["staid"] == 2): ?>合并
							<?php else: ?>结业<?php endif; ?>
						</td>
						<td>
							<?php if($class["tid"] == 1): ?>常规班
							<?php elseif($class["tid"] == 2): ?>快速班
							<?php elseif($class["tid"] == 3): ?>flash班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["regtime"]); ?></td>
						<td><?php echo ($class["pno"]); ?></td>
						<td>
							<?php if($class["headerid"] == 1): ?>吴昌勇
							<?php elseif($class["headerid"] == 2): ?>杨丹丹
							<?php elseif($class["headerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td>
							<?php if($class["managerid"] == 1): ?>吴昌勇
							<?php elseif($class["managerid"] == 2): ?>杨丹丹
							<?php elseif($class["managerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["mark"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($mod) == "1"): ?><tr style="background-color:orange;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td>
							<?php if($class["staid"] == 1): ?>正常
							<?php elseif($class["staid"] == 2): ?>合并
							<?php else: ?>结业<?php endif; ?>
						</td>
						<td>
							<?php if($class["tid"] == 1): ?>常规班
							<?php elseif($class["tid"] == 2): ?>快速班
							<?php elseif($class["tid"] == 3): ?>flash班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["regtime"]); ?></td>
						<td><?php echo ($class["pno"]); ?></td>
						<td>
							<?php if($class["managerid"] == 1): ?>吴昌勇
							<?php elseif($class["managerid"] == 2): ?>杨丹丹
							<?php elseif($class["managerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td>
							<?php if($class["managerid"] == 1): ?>吴昌勇
							<?php elseif($class["managerid"] == 2): ?>杨丹丹
							<?php elseif($class["managerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["mark"]); ?></td>
					</tr><?php endif; endforeach; endif; else: echo "$msg" ;endif; ?>
			 -->
			<?php $__FOR_START_3341__=0;$__FOR_END_3341__=$arraylength;for($i=$__FOR_START_3341__;$i < $__FOR_END_3341__;$i+=1){ if(($i%2) == "0"): ?><tr style="background-color:green;">
						<td><?php echo ($data["$i"]["classid"]); ?></td>
						<td><?php echo ($data["$i"]["name"]); ?></td>
						<td><?php echo ($data["$i"]["csname"]); ?></td>
						<td><?php echo ($data["$i"]["ctname"]); ?></td>
						<td><?php echo ($data["$i"]["regtime"]); ?></td>
						<td><?php echo ($data["$i"]["pno"]); ?></td>
						<td><?php echo ($data["$i"]["headerid"]); ?></td>
						<td><?php echo ($data["$i"]["managerid"]); ?></td>
						<td><?php echo ($data["$i"]["starttime"]); ?></td>
						<td><?php echo ($data["$i"]["endtime"]); ?></td>
						<td><?php echo ($data["$i"]["mark"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($i%2) == "1"): ?><tr style="background-color:orange;">
						<td><?php echo ($data["$i"]["classid"]); ?></td>
						<td><?php echo ($data["$i"]["name"]); ?></td>
						<td><?php echo ($data["$i"]["csname"]); ?></td>
						<td><?php echo ($data["$i"]["ctname"]); ?></td>
						<td><?php echo ($data["$i"]["regtime"]); ?></td>
						<td><?php echo ($data["$i"]["pno"]); ?></td>
						<td><?php echo ($data["$i"]["headerid"]); ?></td>
						<td><?php echo ($data["$i"]["managerid"]); ?></td>
						<td><?php echo ($data["$i"]["starttime"]); ?></td>
						<td><?php echo ($data["$i"]["endtime"]); ?></td>
						<td><?php echo ($data["$i"]["mark"]); ?></td>
					</tr><?php endif; } ?>
			<!--  
			<?php if(is_array($data)): foreach($data as $i=>$class): if(($i%2) == "0"): ?><tr style="background-color:green;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td>
							<?php if($class["staid"] == 1): ?>正常
							<?php elseif($class["staid"] == 2): ?>合并
							<?php else: ?>结业<?php endif; ?>
						</td>
						<td>
							<?php if($class["tid"] == 1): ?>常规班
							<?php elseif($class["tid"] == 2): ?>快速班
							<?php elseif($class["tid"] == 3): ?>flash班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["regtime"]); ?></td>
						<td><?php echo ($class["pno"]); ?></td>
						<td>
							<?php if($class["headerid"] == 1): ?>吴昌勇
							<?php elseif($class["headerid"] == 2): ?>杨丹丹
							<?php elseif($class["headerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td>
							<?php if($class["managerid"] == 1): ?>吴昌勇
							<?php elseif($class["managerid"] == 2): ?>杨丹丹
							<?php elseif($class["managerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["mark"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($i%2) == "1"): ?><tr style="background-color:orange;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td>
							<?php if($class["staid"] == 1): ?>正常
							<?php elseif($class["staid"] == 2): ?>合并
							<?php else: ?>结业<?php endif; ?>
						</td>
						<td>
							<?php if($class["tid"] == 1): ?>常规班
							<?php elseif($class["tid"] == 2): ?>快速班
							<?php elseif($class["tid"] == 3): ?>flash班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["regtime"]); ?></td>
						<td><?php echo ($class["pno"]); ?></td>
						<td>
							<?php if($class["headerid"] == 1): ?>吴昌勇
							<?php elseif($class["headerid"] == 2): ?>杨丹丹
							<?php elseif($class["headerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td>
							<?php if($class["managerid"] == 1): ?>吴昌勇
							<?php elseif($class["managerid"] == 2): ?>杨丹丹
							<?php elseif($class["managerid"] == 3): ?>张三丰
							<?php else: ?>张无忌<?php endif; ?>
						</td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["mark"]); ?></td>
					</tr><?php endif; endforeach; endif; ?>-->
		</table>
		<?php if($j == 5): ?>哈哈哈哈哈哈哈
		<?php elseif($j == 3): ?>
			你好
		<?php else: ?>
			呵呵呵呵<?php endif; ?>
	</body>
</html>