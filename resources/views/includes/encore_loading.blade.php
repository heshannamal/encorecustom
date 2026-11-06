<style type="text/css">
    .encore-loader {
        position: fixed;
        inset: 0;
        background: rgba(158, 155, 155, 0.8);
        /* Adjusted for better visibility */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 9999;

        /* Smooth Transition Setup */
        transition: opacity 0.6s ease-out, visibility 0.6s ease-out;
        opacity: 0;
        visibility: hidden;
    }

    /* Show loader when Pace is running */
    body.pace-running .encore-loader {
        opacity: 1;
        visibility: visible;
    }

    /* Keep loader visible during the transition to 'done' */
    body.pace-done .encore-loader {
        opacity: 0;
        visibility: hidden;
    }

    /* Rest of your existing animations (pulse, bounce, etc.) */
    .loader-logo {
        width: 450px;
        margin-bottom: 18px;
        animation: pulse 1.8s infinite ease-in-out;
    }

    .dot-loader {
        display: flex;
        gap: 8px;
    }

    .dot-loader span {
        width: 8px;
        height: 8px;
        background: #ff2d2d;
        border-radius: 50%;
        animation: bounce 1.4s infinite ease-in-out both;
    }

    .dot-loader span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .dot-loader span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @media (max-width: 909px) {
        .loader-logo {
            width: 350px;
            margin-bottom: 18px;
            animation: pulse 1.8s infinite ease-in-out;
        }
    }
</style>

<div class="encore-loader">
    <img src="{{ asset('assets/logos/logo_dark.png') }}" alt="Encore Loader" class="loader-logo">

    <div class="dot-loader">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<script>
    // $(document).ready(function(){
    //     $(".encore-loader").fadeOut('slow');
    // });
</script>