<div class="layout_box new_member">
<div class="layout_box_t">
<div class="layout_box_tl"></div>
<div class="layout_box_tr"></div>
</div>
<div class="layout_box_left">
<div class="layout_box_left_ie"></div>
<div class="layout_box_right">
<div class="layout_box_right_ie"></div>
<div class="layout_box_holder">
<h2>Join them to clan</h2>
<ul>
<li class="heading"> 
<span class="cl_1">name</span>
<span class="cl_2">action</span>
</li>
<?php 
$i = 0;
if($joiner){
    foreach($joiner as $user){ ?>
    <li <?php if($i%2==0) echo "class='dark' "?>>
        <span class="cl_1"><?=$user['username']?> (<?=$user['first_name']?> <?=$user['last_name']?>)</span>
		<span class="cl_2 user_<?=$user['id']?>"> <a href ="#" onclick="javascript: new_member('<?=$user['id']?>', 'dismiss')"> - </a> | <a href ="#" onclick="javascript: new_member('<?=$user['id']?>', 'accept')"> + </a> </span>
	</li>	
    <?php 
    $i++;
    }
    
}

?>
</ul>



</div>
</div>
</div>
<div class="layout_box_b">
<div class="layout_box_bl"></div>
<div class="layout_box_br"></div>
</div>
</div>