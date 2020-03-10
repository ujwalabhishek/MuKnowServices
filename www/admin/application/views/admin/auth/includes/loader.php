<style type="text/css">
    body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    .modal
    {
        position: fixed;
        y-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.6;
        -moz-opacity: 0.8;
    }
    .center
    {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 140px;

    }
    <!--.center img
    {
        height: 128px;
        width: 118px;
    }-->
    .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 90px;
        height: 90px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<!--
<body>
    <div class="modal modal_load" style="display: none">
        <div class="center">
            <div class="loader"></div><!--<img alt="" src="<?php base_url(); ?>/assets/loader.gif" />-->
        <!--</div>
    </div>-->