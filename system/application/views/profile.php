<div class="profile_left">
<div class="layout_box profile_form">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">

<h2>Profile</h2>


<form method="post" id="profile_form" action="">
<fieldset>
<ul>
    <li>
        <div class="error"></div>
    </li>
    <li><?=$this->session->userdata('user_role')?></li>
    <li>Login: <?php echo $this->session->userdata('username'); ?> <br /></li>
    <li>E-mail: <?php echo $this->session->userdata('email'); ?></li>
    <li>
        <label for="first">First name</label>
        <input type="text" name="first" class="first" value="<?php echo $this->session->userdata('first_name'); ?>">
    </li>
    <li>
        <label for="last">Last name</label>
        <input type="text" name="last" class="last" value="<?php echo $this->session->userdata('last_name'); ?>">
    </li>
<li>
<input type="button" title="press it" value="UPDATE" class="profile_btn">
</li>
</ul>


</fieldset>
</form>



						</div>
					</div>
				</div>
				<div class="layout_box_b">
					<div class="layout_box_bl"></div>
					<div class="layout_box_br"></div>
				</div>
			</div>
	<!--  ============== -->		
			
	<div class="layout_box pwd_update">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">

<h2>Change password</h2>
<form method="post" id="pwd_form" action="">
<fieldset>
<ul>
    <li>
        <div class="error"></div>
    </li>
    <li>
        <label for="pwd">password</label>
        <input type="password" name="pwd" class="pwd" value="123456">
    </li>
    <li>
        <label for="pwd2">retype</label>
        <input type="password" name="re_pwd" class="re_pwd" value="123456">
    </li>
<li>
<input type="button" title="press it for change your password" value="Change" class="change_pwd">
</li>
</ul>


</fieldset>
</form>

						</div>
					</div>
				</div>
				<div class="layout_box_b">
					<div class="layout_box_bl"></div>
					<div class="layout_box_br"></div>
				</div>
			</div>		
			
			
			</div>
<!--  ============================================================ -->
<div class="profile_center">
<div class="layout_box profile_clan">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">
<h2>Clan</h2>

<?php
if ($this->session->userdata('user_role') == 'no_active') {
    echo 'Your account is not active, check yor mail, if your stil not resive letter, generate <a href="/mail/validate/" alt="vait 10 min">new</a>';
}elseif($join_request){
    echo "Your request was submited<br /> Please waite for answer. <br /> Or <a href='/clan/cancel_join/'>Cancel</a> waiting";
} 
elseif($this->session->userdata('user_role') == 'user') {
  ?>  
<p id='profile_clan' >
If you <b>Clan Leader</b>, you must <a href='#' onclick='javascript: clan_create_form("cl");'>create clan</a>, <br /><br />
if you <b>Clan Member</b>, leave your <a href='#' onclick='javascript: clan_create_form("join");'>request</a>, and wait when KL accept them, <br /><br />
if you <b>New Player</b> your can <a href='#' onclick='javascript: clan_create_form("resume");'>create resume </a>.</p>

<?php
}
else{?>
    <ul>
    	<li>Server: <?=$clan['server']?></li>
    	<li class="dark">Clan name: <?=$clan['name']?></li>
    	<li>Clan lvl: <?=$clan['clan_lvl']?></li>
    	<li class="dark">Clan Leader: <?=$clan['cl_name']?></li>
    	<li>Members: <?=$clan['members']?></li>
    	<li class="dark"><a href="/clan/">more info...</a></li>
    </ul>
    <?php //print_r($clan);
}

?>
<div class="cl" style="display: none;">
<form method="post" id="profile_new_clan" action="">
<fieldset>
<ul>
    <li>
        <div class="error"></div>
    </li>
    <li>
        <label for="server_name">Server</label>
        <input type="text" name="server_name" class="server_name">
    </li>
    <li>
        <label for="clan_name">Clan name</label>
        <input type="text" name="clan_name" class="clan_name">
    </li>
    <li>
        <label for="clan_lvl">Clan lvl</label>
        <select name="clan_lvl" class="clan_lvl">
        	<option value="1">1</option>
        	<option value="2">2</option>
        	<option value="3">3</option>
        	<option value="4">4</option>
        	<option value="5">5</option>
        	<option value="6">6</option>
        	<option value="7">7</option>
        	<option value="8">8</option>
        </select>
    </li>
<li>
<input type="button" title="press it for create new clan" value="Create" class="new_clan_btn" onclick="javascript: create_clan();">
</li>
</ul>


</fieldset>
</form>

</div>

<!--  ======================= -->

<div class="join" style="display: none;">
<p>Please, select your clan <br>
<table cellspacing="1" cellpadding="1" border="1">
<tr>
    <td>server</td>
    <td>clan</td>
	<td>level</td>
	<td>action</td>
</tr>
<?php 
$i=0;
foreach($clan_list as $clan){
    ?>
<tr <?php if($i % 2==0) {echo "bgcolor='#F3F6F7'";} $i++; ?> >
	<td><?=$clan['server']?></td>    
	<td><?=$clan['name']?></td>    
	<td><?=$clan['clan_lvl']?></td>    
	<td><a href="#" onclick="javascript: join_request('<?=$clan['id']?>');">request</a></td>    
</tr>
    <?php 
}

?>


</table>


</div>

<!--  ======================= -->
<div class="resume" style="display: none;">
form for resume
<br>В стадии разработки</br>
</div>
<!--  ======================= -->

						</div>
					</div>
				</div>
				<div class="layout_box_b">
					<div class="layout_box_bl"></div>
					<div class="layout_box_br"></div>
				</div>
			</div>

<!--  ============================================================ -->

<!--  ============================================================ -->


<div class="layout_box profile_clan">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">

<h2>Notifications</h2>						
<ul>
<?php 
$i=0;
foreach($notification as $news){?>
    <li title="<?=$news['describe']?>" <?php if ($i%2==0) echo "class='dark'";?>><?=$news['name']?></li>
<?php 
$i++;
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







</div>


<!--  ============================================================ -->
<div style="width: 340px; float: right;">
<div class="layout_box">
				<div class="layout_box_t">
					<div class="layout_box_tl"></div>
					<div class="layout_box_tr"></div>
				</div>
				<div class="layout_box_left">
					<div class="layout_box_left_ie"></div>
					<div class="layout_box_right">
						<div class="layout_box_right_ie"></div>
						<div class="layout_box_holder">

TEXT TAB

						</div>
					</div>
				</div>
				<div class="layout_box_b">
					<div class="layout_box_bl"></div>
					<div class="layout_box_br"></div>
				</div>
			</div>
</div>

						





















