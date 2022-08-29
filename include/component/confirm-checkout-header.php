<?php $app = parse_ini_file('app.ini'); $url_logo = $app['url_logo'];?>
<div class="header-container container">
    <div class="title-container">
        <h1 class="title">See you next time!</h1>
        <p class="subtitle">Thank you for checking out</p>
    </div>
    <div class="logo-container">
        <img class="logo" src="<?php echo $url_logo ?>" alt="logo">
    </div>
</div>