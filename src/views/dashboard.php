<?php
/**
 * @var $token string
 * @var $view_id string
 */
?>
<div class="ga-wrapper" id="ga_wrapper"
     data-view-id="<?= $view_id; ?>"
     data-token="<?= $token; ?>"
     data-css="<?= asset('/assets/ga-embed/ga-embed.css') ?>">
<link media="all" type="text/css" rel="stylesheet" href="">
<div class="ga-dashboard-panel">
    <div class="container" id="chart-1-container"></div>
    <div class="container" id="chart-2-container"></div>
    <div class="container" id="chart-3-container"></div>
</div>
<script type="text/javascript" src="<?= asset('/assets/ga-embed/ga-embed.js') ?>"></script>
</div>