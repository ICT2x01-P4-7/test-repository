<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px; background:var(--sec-color);">
                    <a href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en">English</a>
                </div>
                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                    <a href="#googtrans(en|zh-CN)" class="lang-es lang-select" data-lang="zh-CN">Chinese</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                    <a href="#googtrans(en|ms)" class="lang-es lang-select" data-lang="ms">Malay</a>
                </div>
                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                    <a href="#googtrans(en|ta)" class="lang-es lang-select" data-lang="ta">Tamil</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="ct-topbar">
    <div class="container">
        <ul class="list-unstyled list-inline ct-topbar__list">
            <li class="ct-language">Language <i class="fa fa-arrow-down"></i>
                <ul class="list-unstyled ct-language__dropdown">
                    <li><a href="#googtrans(en|en)" class="lang-en lang-select" data-lang="en">English</a></li>
                    <li><a href="#googtrans(en|ms)" class="lang-es lang-select" data-lang="ms">Malay</a></li>
                    <li><a href="#googtrans(en|zh-CN)" class="lang-es lang-select" data-lang="zh-CN">Chinese</a></li>
                    <li><a href="#googtrans(en|ta)" class="lang-es lang-select" data-lang="ta">Tamil</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>-->
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
    }

    function triggerHtmlEvent(element, eventName) {
        var event;
        if (document.createEvent) {
            event = document.createEvent('HTMLEvents');
            event.initEvent(eventName, true, true);
            element.dispatchEvent(event);
        } else {
            event = document.createEventObject();
            event.eventType = eventName;
            element.fireEvent('on' + event.eventType, event);
        }
    }

    jQuery('.lang-select').click(function () {
        var theLang = jQuery(this).attr('data-lang');
        jQuery('.goog-te-combo').val(theLang);

        //alert(jQuery(this).attr('href'));
        window.location = jQuery(this).attr('href');
        location.reload();

    });
</script>
