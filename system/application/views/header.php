<div class="header">
<ul class="navigation">
<li><a href="/">Home</a></li>
<li><a href="/profile/">Profile</a></li>
<li></li>
<li></li>
<li></li>
<?php 
if ($this->session->userdata('user_role') == 'clan_master')
{?>
    <li><a href="/clan/control">Clan Control</a></li>
<?php }
?>
</ul>


<div class="login-register">
<?php 
if(!$this->session->userdata('username')){
?>
<a href="/lightbox/login?height=150&width=240&inlineId=myOnPageContent" class="thickbox" style="font-size: 150%; color: white;">Login</a> \ 
<a href="/lightbox/register?height=185&width=260&inlineId=myOnPageContent" class="thickbox" style="font-size: 100%; color: white;">Register</a><br />
<?php 
}else{
    $name = $this->session->userdata('username');
    echo "User:<a href='/profile/' class='username'> $name </a>| <a href='/usercontrol/logout/'>Logout</a>";
}
?>
</div>
</div>