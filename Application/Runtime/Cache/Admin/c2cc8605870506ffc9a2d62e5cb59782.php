<?php if (!defined('THINK_PATH')) exit(); if(is_array($Cate)): $i = 0; $__LIST__ = $Cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>

        <tr>
<!--            <td width="20px"><input type="checkbox" /></td>-->
            <td><?php echo ($vo["sort"]); ?></td>
            <td><?php echo ($vo["id"]); ?></td>
    <?php $num=count(explode(',',$vo[arrid])); ?>
    <td><?php $__FOR_START_24233__=1;$__FOR_END_24233__=$num;for($i=$__FOR_START_24233__;$i < $__FOR_END_24233__;$i+=1){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
    |--<?php echo ($vo["title"]); ?>                          
</td>

<td><?php if($vo[allow]==1){echo '允许';}else{echo '禁止';} ?>                        
</td>

<td>
<?php echo Getmodelname($vo[modelid]);?>
</td>
<td>
    <input type="hidden" value="<?php echo ($vo["arrid"]); ?>">
    <a href="<?php echo U('Category/add',array('id'=>$vo['id']));?>" title="ADD">添加</a>
    <a href="<?php echo U('Category/edit',array('id'=>$vo['id']));?>" title="EDIT">编辑</a>
    <a href="<?php echo U('Category/delete',array('id'=>$vo['id']));?>" title="DELETE">删除</a> 
</td>
</tr>
</tbody>
<?php echo R('Category/tree',array('id'=>$vo['id'])); endforeach; endif; else: echo "" ;endif; ?>