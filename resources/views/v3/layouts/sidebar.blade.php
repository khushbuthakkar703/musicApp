<div id="scroll_bar" class="dashboard-drawer mdl-layout__drawer mdl-color--black mdl-color-text--grey-300" style="overflow-x: hidden;">
    <div class="drawer-logo-container">
        <a href="#"><img class="drawer-logo" src="/images/SpinstatsApplogo.png"></a>
    </div>
    @auth
        @include('v3.layouts.nav.'.auth()->user()->role)
    @endauth
</div>
<style>
    .container {
        position: relative;
        width: 80%;
    }

    #image {
        display: block;
        width: 100%;
        height: 130px;
        border-radius: 50%;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 15;
        right: 0;
        height: 100%;
        width: 85%;
        opacity: 0;
        transition: .5s ease;
        background-color: #008CBA;
        border-radius: 50%;
    }

    .container:hover .overlay {
        opacity: 1;
    }

    .text {
        color: white;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
