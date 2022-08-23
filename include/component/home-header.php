<?php $ini = parse_ini_file('app.ini'); $url_logo = $ini['url_logo'];?>
<div class="header-container container">
    <div class="title-container">
        <h1 class="title">Welcome</h1>
        <p class="subtitle">Visitors, please check in on arrival</p>
    </div>
    <div class="logo-container">
        <img class="logo" src="<?php echo $url_logo ?>" alt="logo">
    </div>
</div>