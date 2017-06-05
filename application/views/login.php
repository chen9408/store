<style>html,body{overflow: hidden;}body{background: url('<?php echo base_url();?>public/img/bg.jpg') no-repeat scroll 0% 0% / cover transparent;}</style>
<body class="uk-height-1-1">
    <nav class="tm-navbar uk-navbar uk-navbar-attached">
        <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>" title="道客商城">
                <img class="uk-margin uk-margin-remove" width="140" height="120" src="<?php echo base_url();?>public/img/logo.gif" width="90" height="30" alt="道客商城">
            </a>
            <a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="<?php echo base_url();?>public/img/logo.gif" width="140" height="120" title="UIkit" alt="UIkit"></div>
        </div>
    </nav>
    <div class="uk-vertical-align uk-text-center uk-height-1-1">
        <div class="uk-vertical-align-middle" style="width: 250px;">
            <img class="uk-border-circle" style="margin-bottom: 5px;" width="120" height="120" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjAwcHgiIGhlaWdodD0iMjAwcHgiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMjAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRDhEOEQ4IiBkPSJNMTgyLjI1NiwxNjUuNzk2Yy0wLjgzNi00LjY3Ny0xLjg5Ni05LjAwNy0zLjE3Mi0xMy4wMDFjLTEuMjc3LTMuOTk2LTIuOTk1LTcuODg4LTUuMTU0LTExLjY4Ng0KCQljLTIuMTU4LTMuNzkzLTQuNjMxLTcuMDI4LTcuNDI3LTkuNzA1Yy0yLjgwMS0yLjY3NC02LjIxMy00LjgxMi0xMC4yNDctNi40MDljLTQuMDM1LTEuNTk3LTguNDg4LTIuMzk2LTEzLjM1OS0yLjM5Ng0KCQljLTAuNzE5LDAtMi4zOTYsMC44NTgtNS4wMzIsMi41NzNjLTIuNjM2LDEuNzIyLTUuNjEyLDMuNjM4LTguOTI3LDUuNzVjLTMuMzE2LDIuMTE4LTcuNjMxLDQuMDM1LTEyLjk0LDUuNzUzDQoJCWMtNS4zMTIsMS43MTktMTAuNjQ2LDIuNTc2LTE1Ljk5NiwyLjU3NmMtNS4zNTIsMC0xMC42ODQtMC44NTctMTUuOTk2LTIuNTc2Yy01LjMxNC0xLjcxOC05LjYyOS0zLjYzNS0xMi45NC01Ljc1Mw0KCQljLTMuMzE5LTIuMTEyLTYuMjkxLTQuMDI4LTguOTI3LTUuNzVjLTIuNjM2LTEuNzE1LTQuMzEyLTIuNTczLTUuMDMzLTIuNTczYy00Ljg3NiwwLTkuMzI5LDAuNzk5LTEzLjM2MSwyLjM5Ng0KCQljLTQuMDMzLDEuNTk4LTcuNDUxLDMuNzM1LTEwLjI0Miw2LjQwOWMtMi44MDEsMi42NzctNS4yNzMsNS45MTItNy40Myw5LjcwNWMtMi4xNTcsMy43OTgtMy44NzcsNy42ODgtNS4xNTMsMTEuNjg2DQoJCWMtMS4yNzgsMy45OTQtMi4zMzcsOC4zMjQtMy4xNzcsMTMuMDAxYy0wLjgzNyw0LjY3MS0xLjM5OCw5LjAyNC0xLjY3NywxMy4wNmMtMC4yNzksNC4wMzMtMC40MTksOC4xNy0wLjQxOSwxMi4zOTkNCgkJYzAsMy4xNCwwLjM0NSw2LjA0LDAuOTY5LDguNzQ1aDE2Ni43NzFjMC42MjUtMi43MDUsMC45NzItNS42MDUsMC45NzItOC43NDVjMC00LjIyOS0wLjE0MS04LjM2Ni0wLjQyMi0xMi4zOTkNCgkJQzE4My42NTQsMTc0LjgyLDE4My4wOTYsMTcwLjQ2NywxODIuMjU2LDE2NS43OTZ6Ii8+DQoJPHBhdGggZmlsbD0iI0Q4RDhEOCIgZD0iTTEwMCwxMzAuMjY4YzEyLjcsMCwyMy41NDQtNC40OTQsMzIuNTMzLTEzLjQ3OWM4Ljk4NC04Ljk4OCwxMy40NzktMTkuODMsMTMuNDc5LTMyLjUzMg0KCQljMC0xMi43MDItNC40OTQtMjMuNTQzLTEzLjQ3OS0zMi41MzFDMTIzLjU0NCw0Mi43MzgsMTEyLjcsMzguMjQzLDEwMCwzOC4yNDNzLTIzLjU0Nyw0LjQ5NS0zMi41MzEsMTMuNDgxDQoJCWMtOC45ODksOC45ODgtMTMuNDgxLDE5LjgyOS0xMy40ODEsMzIuNTMxYzAsMTIuNzAyLDQuNDkyLDIzLjU0NCwxMy40ODEsMzIuNTMyQzc2LjQ1MywxMjUuNzczLDg3LjMsMTMwLjI2OCwxMDAsMTMwLjI2OHoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
            <?php echo form_open('login', $attributes);?>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="text" name="username" required value="<?php echo set_value('username'); ?>" placeholder="道客账号" />
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="password" name="daokePassword" required value="<?php echo set_value('daokePassword'); ?>" placeholder="密码" />
                </div>
                <div class="uk-form-row">
                    <input type="hidden" name="clientIP" value=""/>
                    <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="submit">登录</button>
                </div>
                <p class="uk-text-danger"><?php echo $error;?></p>
                <div class="uk-form-row uk-text-small">
                    <a class="uk-float-left uk-link uk-link-muted" target="_blank" href="http://oauth.daoke.io/mobileRegister">注册道客帐号</a>
                    <a class="uk-float-right uk-link uk-link-muted" target="_blank" href="<?php echo base_url();?>index.php/shopLogin">子店铺登录</a>
                </div>
            </form>
        </div>
    </div>
    <strong>&copy; 2014</strong>
</body>

<script type="text/javascript">
	$.UIkit.notify("请使用谷歌、火狐或者IE10版本以上的浏览器", {status:'success'});       
</script>